<?php
namespace App\Services;

use App\Models\User;
use Auth;
use Session;
use App\Mail\MlmInvoiceEmail;
use App\Models\Admin\DigitalProduct;
use App\Models\Admin\Mlmuser;
use App\Models\Admin\Order;
use App\Models\Admin\Transection;

use Illuminate\Support\Facades\Mail;

class PaymentProcessingService
{
	public function _rootuserPay($userCredential, $response){
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

	public function _findParentId($referrer_id,$referrerDetails){
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

	public function _checkParentId($referrer_id,$referrerDetails){
	    $user = Mlmuser::where('user_id',Auth::user()->id)->first();

	    $referrerParentId = isset($referrerDetails->mlmUser->parent_id) ? $referrerDetails->mlmUser->parent_id : "root";
	    $refferUsers = Mlmuser::where('refferer_id',$referrer_id)->get();
	    if(count($refferUsers) > 2 && ((isset($refferUsers[2]->id) && $refferUsers[2]->id == $user->id) || (isset($refferUsers[4]->id) && $refferUsers[4]->id == $user->id))){
	        return $referrerParentId;
	    }else{
	        return $referrer_id;
	    }
	}
}