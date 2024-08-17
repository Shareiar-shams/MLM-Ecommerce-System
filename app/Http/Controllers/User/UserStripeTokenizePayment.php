<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User\BkashPaySessionData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;
use Auth;
use Session;
use App\Helpers\CurrencyConverter;
use App\Mail\MlmInvoiceEmail;
use App\Models\Admin\DigitalProduct;
use App\Models\Admin\Mlmuser;
use App\Models\Admin\Order;
use App\Models\Admin\Transection;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;



class UserStripeTokenizePayment extends Controller
{
    public function testStripe()
    {
        return view('user.stripeTest');
    }
    public function createPayment(Request $request)
    {
        $this->validate($request, [
            'card_holder_name' => 'required',
            'stripeToken' => 'required',
        ]);

        $amount = CurrencyConverter::convertCurrency($request->amount);

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $user = User::find(Auth::id());
        
        $json_data = array(
            'invoice' => $request->invoice,
            'amount' => $request->amount,
            'productId' => $request->productId,
            'pay_transfer_parent' => $request->pay_transfer_parent,
            'gateway' => 'Stripe',
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
        $amount = $this->getAmountInCents($amount);
        $customer = Customer::create(array(
            'name' => $request->card_holder_name,
            'description' => 'Purchase Multi Media Product For registration as a multi media user. Invoice Id:'.$request->invoice,
            'email' => $user->email,
            'source' => $request->input('stripeToken'),
            "address" => $request->address

        ));
        try {
            $charge = Charge::create([
                'amount' => $amount,  // Replace with logic to calculate amount
                "currency" => "usd",
                "customer" =>  $customer["id"],
                "description" => "Purchase MLM Pack for registration as a MLM users"
            ]);

            $data = json_decode($find->session_data);
            $this->_rootuserPay($data,$charge);
            
            // Payment successful! Process the charge and handle success logic
            return response()->json(['transectionId' => $charge->balance_transaction]);

        } catch (StripeException $e) {

            $notification = array(
                'message' => $e->getMessage(), 
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);


            // return response()->json(['error' => $e->getMessage()], 422);
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
        $item->payment_type = "Stripe";
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
            $item1->payment_type = "Stripe";
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
            $item->transaction_number = $response->balance_transaction;
            $item->paymentId = $response->id;
            $item->formable_type = "user";
            $item->formable_id = Auth::user()->id;
            $item->toable_type = "admin";
            $item->toable_id = 1;
            $item->payment_type = "Stripe";
            $item->amount = $amount;
            $item->transection_time = date('Y-m-d H:i:s.u', $response->created);
            
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
            $item->transaction_number = $response->balance_transaction;
            $item->paymentId = $response->id;
            $item->formable_type = "user";
            $item->formable_id = Auth::user()->id;
            $item->toable_type = "admin";
            $item->toable_id = 1;
            $item->payment_type = "Stripe";
            $item->amount = $amount;
            $item->transection_time = date('Y-m-d H:i:s.u', $response->created);
            
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
            'transection_id' => $response->balance_transaction,
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

    //
    public function createPayment_bkup1(Request $request) {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = Customer::create(array(
            'name' => 'test',
            'description' => 'test description',
            'email' => 'email@gmail.com',
            'source' => $request->input('stripeToken'),
            "address" => ["city" => "San Francisco", "country" => "US", "line1" => "510 Townsend St", "postal_code" => "98140", "state" => "CA"]

        ));
        try {
            Charge::create ( array (
                "amount" => 300 * 100,
                "currency" => "usd",
                "customer" =>  $customer["id"],
                "description" => "Test payment."
            ) );
            Session::flash ( 'success-message', 'Payment done successfully !' );
            return view ( 'user.stripeTest' );
        } catch ( \Stripe\Error\Card $e ) {
            Session::flash ( 'fail-message', $e->get_message() );
            return view ( 'user.stripeTest' );
        }
    }

    public function createPayment_bkup(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $redirectUrl = route('stripe.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}';
        $response =  $stripe->checkout->sessions->create([
            'success_url' => $redirectUrl,
            'payment_method_types' => ['link', 'card'],
            'line_items' => [
                [
                    'price_data'  => [
                        'product_data' => [
                            'name' => $request->product,
                        ],
                        'unit_amount'  => 100 * $request->price,
                        'currency'     => 'USD',
                    ],
                    'quantity'    => 1
                ],
            ],
            'mode' => 'payment',
            'allow_promotion_codes' => false
        ]);

        return redirect($response['url']);
        // Set your Stripe API key.
        // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // // Get the payment amount and email address from the form.
        // $amount = 1 * 100;
        // $email = 'islamshareiar@gmail.com';

        // // Create a new Stripe customer.
        // $customer = \Stripe\Customer::create([
        //     'email' => $email,
        //     'source' => $request->input('stripeToken'),
        // ]);
        
        // // Create a new Stripe charge.
        // $charge = \Stripe\Charge::create([
        //     'customer' => $customer->id,
        //     'amount' => $amount,
        //     'currency' => 'usd',
        // ]);

        // // Display a success message to the user.
        // return 'Payment successful!';
    }

    public function stripeCheckoutSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $session = $stripe->checkout->sessions->retrieve($request->session_id);
        info($session);

        $successMessage = "We have received your payment request and will let you know shortly.";

        return redirect(route('test.stripe.route'));
    }
}
