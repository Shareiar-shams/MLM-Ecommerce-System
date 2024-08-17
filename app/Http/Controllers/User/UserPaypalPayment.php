<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\MlmInvoiceEmail;
use App\Models\Admin\DigitalProduct;
use App\Models\Admin\Mlmuser;
use App\Models\Admin\Order;
use App\Models\Admin\Transection;
use App\Models\User;
use App\Models\User\BkashPaySessionData;
use App\Services\PaymentProcessingService;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Helpers\CurrencyConverter;

class UserPaypalPayment extends Controller
{
    // public function __construct(PaymentProcessingService $paymentProcessingService)
    // {
    //     $this->paymentProcessingService = $paymentProcessingService;
    // }
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransaction()
    {
        return view('user.stripeTest');
    }

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request)
    { 
        $amount = CurrencyConverter::convertCurrency($request->amount);

        $product = DigitalProduct::where('id',$request->productId)->first();

        // 2. Create PayPal client instance
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        // 3. Set currency (optional, adjust as needed)
        $provider->setCurrency('USD');
        $paypalToken = $provider->getAccessToken();

        // 4. Create PayPal order
        $order = $provider->createOrder([
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => $provider->getCurrency(),
                        'value' => $amount,
                    ],
                    'description' => $product->name,
                ],
            ],
            'application_context' => [
                'brand_name' => config('app.name'), // Your application name
                'return_url'=> route('successPaypalTransaction'),
                'cancel_url'=> route('cancelPaypalTransaction')
            ],
        ]);
        // 5. Handle successful order creation
        if ( isset($order['id']) && $order['id'] != null && $order['status'] === 'CREATED') {
            $user = User::find(Auth::id());
        
            $json_data = array(
                'invoice' => $request->invoice,
                'amount' => $request->amount,
                'productId' => $request->productId,
                'pay_transfer_parent' => $request->pay_transfer_parent,
                'gateway' => 'Paypal',
                'referrer_id' => $request->referrer_id
            );
            $arr_tojson = json_encode($json_data);

            $find = BkashPaySessionData::where('user_id', Auth::user()->id)->first();

            if(empty($find)){
                $item = new BkashPaySessionData();
                
            }else{
                $item = BkashPaySessionData::find($find->id);
                
            }
            $item->user_id  = Auth::user()->id;
            $item->session_name  = "user_bkash_payment";
            $item->session_data = $arr_tojson;
            $item->save();

            foreach ($order['links'] as $key => $link) {
                if($link['rel'] === 'approve'){
                    return redirect()->away($link['href']);
                }
            }
        } else {
            // Handle errors (refer to PayPal documentation for error codes)
            // return back()->withErrors(['error' => $order->message]);
            return redirect()->route('cancelPaypalTransaction');
        }
        
    }

    private function getAmountInCents($amount): int
    {
        // Replace with logic to calculate the total amount in cents based on your application

        // Example (assuming a 'total' input field):
        return (int) ($amount * 100); // Convert to cents

        // You can also retrieve the amount from your database or logic
        // based on the product/service being purchased

        throw new Exception('Missing logic to calculate the payment amount.');
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */

    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        $transectionId = $response['id'];
        $response['payerId'] = $request->PayerID;
        $type = 'success';
        if(isset($response['id']) && $response['id'] != null && $response['status'] === "COMPLETED"){
            $find = BkashPaySessionData::where('user_id', Auth::user()->id)->first();
            $data = json_decode($find->session_data);
            // $this->paymentProcessingService->_rootuserPay($data, $response);
            $this->_rootuserPay($data,$response);
        }
        return view('user.paypalResponse',compact('transectionId','type'));
        // return response()->json(['transectionId' => $response->id]);
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
            $item->transaction_number = $response['id'];
            $item->paymentId = $response['payerId'];
            $item->formable_type = "user";
            $item->formable_id = Auth::user()->id;
            $item->toable_type = "admin";
            $item->toable_id = 1;
            $item->payment_type = "Paypal";
            $item->amount = $amount;
            $item->transection_time = date('Y-m-d H:i:s.u');
            
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
            $item->transaction_number = $response['id'];
            $item->paymentId = $response['payerId'];
            $item->formable_type = "user";
            $item->formable_id = Auth::user()->id;
            $item->toable_type = "admin";
            $item->toable_id = 1;
            $item->payment_type = "Paypal";
            $item->amount = $amount;
            $item->transection_time = date('Y-m-d H:i:s.u');
            
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
                    $item1->payment_type = "Stripe";
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
            'transection_id' => $response['id'],
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
    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction()
    {
        $type = 'cancel';
        return view('user.paypalResponse',compact('type'));
    }
}
