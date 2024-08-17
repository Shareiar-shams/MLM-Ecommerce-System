<?php

namespace App\Http\Controllers;
use App\Mail\MlmInvoiceEmail;
use App\Models\Admin\DigitalProduct;
use App\Models\Admin\Mlmuser;
use App\Models\Admin\Order;
use App\Models\Admin\Transection;
use App\Models\User;
use App\Models\User\BkashPaySessionData;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;
use Session;
class BkashTokenizePaymentController extends Controller
{
    public function index()
    {
        return view('bkashT::bkash-payment');
    }
    public function createPayment(Request $request)
    {
        $inv = uniqid();
        $request['intent'] = 'sale';
        $request['mode'] = '0011'; //0011 for checkout
        $request['payerReference'] = $inv;
        $request['currency'] = 'BDT';
        $request['amount'] = 100;
        $request['merchantInvoiceNumber'] = $inv;
        $request['callbackURL'] = config("bkash.callbackURL");;

        $request_data_json = json_encode($request->all());

        $response =  BkashPaymentTokenize::cPayment($request_data_json);
        //$response =  BkashPaymentTokenize::cPayment($request_data_json,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..

        //store paymentID and your account number for matching in callback request
        // dd($response) //if you are using sandbox and not submit info to bkash use it for 1 response
        // Log::info('Create payment Response: ',['response' => $response]);
        if (isset($response['bkashURL'])) return redirect()->away($response['bkashURL']);
        else return redirect()->back()->with('error-alert2', $response['statusMessage']);
    }

    public function callBack(Request $request)
    {
        //callback request params
        // paymentID=your_payment_id&status=success&apiVersion=1.2.0-beta
        //using paymentID find the account number for sending params

        if ($request->status == 'success'){
            $response = BkashPaymentTokenize::executePayment($request->paymentID);
            // Log::info('Execute payment Response: ',['response' => $response]);
            //$response = BkashPaymentTokenize::executePayment($request->paymentID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            if (!$response){ //if executePayment payment not found call queryPayment
                $response1 = BkashPaymentTokenize::queryPayment($request->paymentID);
                // dd("QUery payment:". $response);
                //$response = BkashPaymentTokenize::queryPayment($request->paymentID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            }
            
            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                
                $find = Auth::user()->bkashSession;

                if ( isset($find) && $find->session_name == 'mlm_bkash_payment_user' ) {

                    $data = json_decode($find->session_data);
                    $this->_mlmuserPay($data,$response);
                    
                }elseif( isset($find) && $find->session_name == 'user_bkash_payment' ) {
                    $data = json_decode($find->session_data);
                    $this->_rootuserPay($data,$response);
                    

                }
                /*
                 * for refund need to store
                 * paymentID and trxID
                 * */
                return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
            }
            // dd($response);
            $statusMessage = isset($response['statusMessage']) ? $response['statusMessage'] : "Something went wrong, please try again later!"; 
            
            return BkashPaymentTokenize::failure($statusMessage);
        }else if ($request->status == 'cancel'){
            return BkashPaymentTokenize::cancel('Your payment is canceled');
        }else{
            return BkashPaymentTokenize::failure('Your transaction is failed');
        }
    }

    protected function _mlmuserPay($userCredential, $response){
        // Retrieve the parameters and process them
        $userId = $userCredential->userId;
        $invoice = $userCredential->invoice;
        $productId = $userCredential->productId;
        $transfer_user = $userCredential->transfer_user;
        $pay_transfer_parent = isset($userCredential->pay_transfer_parent) ? $userCredential->pay_transfer_parent : null;
        $referrer_parent_id = isset(Auth::user()->mlmUser->parent_id) ? Auth::user()->mlmUser->parent_id : null;

        $user = Mlmuser::find($userId);
        if($transfer_user == 1 && $referrer_parent_id != null){
            $user->parent_activation = 0;
        }else{
            $user->parent_activation = 1;
        }
        $user->admin_activation = 1;
        $user->save();

        $item = new Transection();
        $item->user_id  = $user->user->id;
        $item->mlmuser_id  = $userId;
        $item->digitalProdcut_id = $productId;
        $item->transaction_number = $response['trxID'];
        $item->paymentId = $response['paymentID'];
        $item->formable_type = "user";
        $item->formable_id = Auth::user()->id;
        $item->toable_type = "admin";
        $item->toable_id = 1;
        $item->payment_type = "bKash";
        $item->amount = $response['amount'];
        $item->transection_time = $response['paymentExecuteTime'];
        
        $item->save();

        if($transfer_user == 1 && $referrer_parent_id != null){
            $item1 = new Transection();
            $item1->user_id  = $user->user->id;
            $item1->mlmuser_id  = $userId;
            $item1->digitalProdcut_id = $productId;
            $item1->transaction_number = null;
            $item1->paymentId = null;
            $item1->formable_type = "admin";
            $item1->formable_id = 1;
            $item1->toable_type = "user";
            $item1->toable_id = $referrer_parent_id;
            $item1->payment_type = "bKash";
            $item1->amount = $pay_transfer_parent;
            $item1->transection_time = null;

            $item1->save();
        }
    }

    protected function _rootuserPay($userCredential, $response){
        // Retrieve the parameters and process them
        $referrer_id = $userCredential->referrer_id;
        $invoice = $userCredential->invoice;
        $amount = $userCredential->amount;
        $productId = $userCredential->productId;
        $pay_transfer_parent = $userCredential->pay_transfer_parent;

        if(isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->parent_activation == 1 && Auth::user()->mlmUser->admin_activation == 1){
            $order = new Order();
            $order->order_type = "Mlm";
            $order->order_quantity = 1;
            $order->total = $amount;
            $order->user_id  = Auth::user()->id;
            $order->digitalProdcut_id  = $productId;
            $order->tracking_id  = uniqid();
            $order->invoice  = $invoice;
            $order->name  = Auth::user()->name;
            $order->email  = isset(Auth::user()->email) ? Auth::user()->email : null;
            $order->phone  = isset(Auth::user()->phone) ? Auth::user()->phone : null;
            $order->billing_address  = isset(Auth::user()->address) ? Auth::user()->address : null;
            $order->payment_status  = "Paid";
            $order->order_status  = "Received";
            $order->save();


            $item = new Transection();
            $item->user_id  = Auth::user()->id;
            $item->order_id   = $order->id;
            $item->digitalProdcut_id = $productId;
            $item->transaction_number = $response['trxID'];
            $item->paymentId = $response['paymentID'];
            $item->formable_type = "user";
            $item->formable_id = Auth::user()->id;
            $item->toable_type = "admin";
            $item->toable_id = 1;
            $item->payment_type = "bKash";
            $item->amount = $response['amount'];
            $item->transection_time = $response['paymentExecuteTime'];
            
            $item->save();
            
        }else{
            $user = new Mlmuser();
            $user->user_id  = Auth::user()->id;
            $user->invoice = $invoice;
            $user->admin_activation = 1;
            $user->activate_product = $productId;
            if(isset($referrer_id)){

                $referrerDetails = User::find($referrer_id);
                $referrerParentId = $this->_findParentId($referrer_id,$referrerDetails);
                if($referrerParentId == "root"){
                    $user->parent_id = null;
                    $user->parent_activation = 1;
                }else{
                    $user->parent_id = $referrerParentId;
                    $user->parent_activation = 0;
                }
                $user->refferer_id = $referrer_id;
                $user->reffer_code = $referrerDetails->username;

            }else{

                $user->parent_id = null;
                $user->refferer_id = null;
                $user->reffer_code = null;   
                $user->parent_activation = 1;
                $user->others_documents = null;
                $user->save();
            }
            $user->others_documents = null;
            $user->save();

            $item = new Transection();
            $item->user_id  = Auth::user()->id;
            $item->mlmuser_id  = $user->id;
            $item->digitalProdcut_id = $productId;
            $item->transaction_number = $response['trxID'];
            $item->paymentId = $response['paymentID'];
            $item->formable_type = "user";
            $item->formable_id = Auth::user()->id;
            $item->toable_type = "admin";
            $item->toable_id = 1;
            $item->payment_type = "bKash";
            $item->amount = $response['amount'];
            $item->transection_time = $response['paymentExecuteTime'];
            
            $item->save();

            if(isset($referrer_id)){
                $referrerDetails = User::find($referrer_id);
                $referrerParentId = $this->_checkParentId($referrer_id,$referrerDetails);

                if($referrerParentId != "root"){

                    $item1 = new Transection();
                    $item1->user_id  = Auth::user()->id;
                    $item1->mlmuser_id  = $user->id;
                    $item1->digitalProdcut_id = $productId;
                    $item1->transaction_number = null;
                    $item1->paymentId = null;
                    $item1->formable_type = "admin";
                    $item1->formable_id = 1;
                    $item1->toable_type = "user";
                    $item1->toable_id = $referrerParentId;
                    $item1->payment_type = "bKash";
                    $item1->amount = $pay_transfer_parent;
                    $item1->transection_time = null;
                    $item1->save();
                }
            }    
        }
        $digitalproduct =  DigitalProduct::findOrFail($productId);

        $invoiceData = [
            'title' => "Invoice for Your Purchase Digital Product",
            'invoiceNo' => $invoice,
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'address' => Auth::user()->address,
            'amount' => $amount,
            'productName' => $digitalproduct->name,
            'productSKU' => $digitalproduct->SKU,
            'paymentMethod' => 'Bkash',
            'transection_id' => $response['trxID'],
        ];

        // Send the email with the attached invoice
        Mail::to(Auth::user()->email)->later(now()->addMinutes(2),new MlmInvoiceEmail($invoiceData));

        
    }

    protected function _findParentId($referrer_id,$referrerDetails){
        $referrerParentId = isset($referrerDetails->mlmUser->parent_id) ? $referrerDetails->mlmUser->parent_id : "root";
        $refferUsers = Mlmuser::where('refferer_id',$referrer_id)->get();
        $count = count($refferUsers);
        if($count < 2){
            return $referrer_id;
        }else{
            if($count == 2){
                return $referrerParentId;
            }else{
                return ($count == 4) ? $referrerParentId : $referrer_id;
            }
        }
    }

    protected function _checkParentId($referrer_id,$referrerDetails){
        $user = Mlmuser::where('user_id',Auth::user()->id)->first();

        $referrerParentId = isset($referrerDetails->mlmUser->parent_id) ? $referrerDetails->mlmUser->parent_id : "root";
        $refferUsers = Mlmuser::where('refferer_id',$referrer_id)->get();
        if(count($refferUsers) > 2 && ((isset($refferUsers[2]->id) && $refferUsers[2]->id == $user->id) || (isset($refferUsers[4]->id) && $refferUsers[4]->id == $user->id))){
            return $referrerParentId;
        }else{
            return $referrer_id;
        }
    }
    public function searchTnx($trxID)
    {
        //response
        return BkashPaymentTokenize::searchTransaction($trxID);
        //return BkashPaymentTokenize::searchTransaction($trxID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }

    public function refund(Request $request)
    {
        $paymentID='Your payment id';
        $trxID='your transaction no';
        $amount=5;
        $reason='this is test reason';
        $sku='abc';
        //response
        return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku);
        //return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
    public function refundStatus(Request $request)
    {
        $paymentID='Your payment id';
        $trxID='your transaction no';
        return BkashRefundTokenize::refundStatus($paymentID,$trxID);
        //return BkashRefundTokenize::refundStatus($paymentID,$trxID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
}
