<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Admin\Mlmuser;
use App\Models\Admin\Transection;
use App\Models\User\BkashPaySessionData;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;
use Session;
class MlmUserBkashTokenizePaymentController extends Controller
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
        $request['payerReference'] = $request->payerReference;
        $request['currency'] = 'BDT';
        $request['amount'] = $request->amount;
        $request['merchantInvoiceNumber'] = $request->invoice;
        $request['gateway'] = "bKash";
        $request['callbackURL'] = config("bkash.callbackURL");
        
        $json_data = array(
            'invoice' => $request->invoice,
            'transfer_user' => $request->transfer_user,
            'productId' => $request->productId,
            'pay_transfer_parent' => $request->pay_transfer_parent,
            'gateway' => 'bKash',
            'userId' => $request->userId
        );
        $arr_tojson = json_encode($json_data);
        $find = BkashPaySessionData::where('user_id', Auth::user()->id)->first();

        if(empty($find)){
            $item = new BkashPaySessionData();
            $item->user_id  = Auth::user()->id;
            $item->session_name  = "mlm_bkash_payment_user";
            $item->session_data = $arr_tojson;
            $item->save();
        }else{
            $item = BkashPaySessionData::find($find->id);
            $item->user_id  = Auth::user()->id;
            $item->session_name  = "mlm_bkash_payment_user";
            $item->session_data = $arr_tojson;
            $item->save();
        }

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
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
                //$response = BkashPaymentTokenize::queryPayment($request->paymentID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            }

            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                    if (session()->has('mlm_bkash_payment_user')) {
                        $userCredential = session()->get('mlm_bkash_payment_user');

                        // Retrieve the parameters and process them
                        $userId = $userCredential['userId'];
                        $invoice = $userCredential['invoice'];

                        $user = Mlmuser::find($userId);
                        $user->admin_activation = 1;
                        $user->save();

                        $item = new Transection();
                        $item->user_id  = $user->user->id;
                        $item->mlmuser_id  = $userId;
                        $item->digitalProdcut_id = $user->activate_product;
                        $item->transaction_number = $response['trxID'];
                        $item->formable_type = "user";
                        $item->formable_id = Auth::user()->id();
                        $item->toable_type = "admin";
                        $item->toable_id = 1;
                        $item->payment_type = "bKash";
                        $item->amount = $response['amout'];
                        $item->transection_time = $response['paymentExecuteTime'];
                        
                        $item->save();
                    }
                    

                    return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
            }
            return BkashPaymentTokenize::failure($response['statusMessage']);
        }else if ($request->status == 'cancel'){
            return BkashPaymentTokenize::cancel('Your payment is canceled');
        }else{
            return BkashPaymentTokenize::failure('Your transaction is failed');
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
