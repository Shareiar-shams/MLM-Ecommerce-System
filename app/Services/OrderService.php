<?php

namespace App\Services;

use Illuminate\Support\Facades\Cart;
use Illuminate\Support\Facades\DB; // Use DB facade if needed for transactions
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderInvoiceMail;
use App\Models\Admin\Order;
use App\Models\Admin\Product;
use App\Models\Admin\Transection;
use App\Models\Admin\coupon;
use App\Models\User\BkashPaySessionData;
use App\Models\User\OrderedItem;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session; 

class OrderService
{
    public function __construct(Order $order, Transection $transection, OrderedItem $orderItem, Product $product)
    {
        $this->order = $order;
        $this->transection = $transection;
        $this->orderItem = $orderItem;
        $this->product = $product;
    }

    public function saveOrder($data, $response, $gateway)
    {
        $json_data = array(
            'shipping_name' => $data->shipping_name,
            'shipping_email' => $data->shipping_email,
            'shipping_phone' => $data->shipping_phone,
            'shipping_company' => $data->shipping_company,
            'shipping_address' => $data->shipping_address,
            'shipping_town_city' => $data->shipping_town_city,
            'shipping_postal_code' => $data->shipping_postal_code,
        );
        $shipping_data = json_encode($json_data);
        $coupon_receive_data = \Cart::session(Session::getId())->getConditions()->last();
        $coupon_data = '';
        if($coupon_receive_data){
            $coupon_json_data = array(
                'name' => $coupon_receive_data->getName(),
                'type' => $coupon_receive_data->getType(),
                'value' => $coupon_receive_data->getValue(),
                'code' => $coupon_receive_data->getAttributes()['code'],
                'discount' => $coupon_receive_data->getAttributes()['discount'],
            );
            $coupon_data = json_encode($coupon_json_data);

            coupon::where('code', $coupon_receive_data->getAttributes()['code'])->update(['number_of_times' => $coupon_receive_data->getAttributes()['number_of_times'] - 1]);
        }

        $order = new Order();
        $order->order_type = "Ecommerce";
        $order->subtotal = \Cart::session(Session::getId())->getSubtotal();
        $order->order_quantity = \Cart::session(Session::getId())->getTotalQuantity();
        $order->total = $data->total;
        $order->user_id  = Auth::user()->id;
        $order->tracking_id  = uniqid();
        $order->invoice  = $data->invoice;
        $order->name  = $data->name;
        $order->email  = $data->email;
        $order->phone  = $data->phone;
        $order->company  = $data->company;
        $order->billing_address  = $data->billing_address;
        $order->billing_town  = $data->billing_town;
        $order->billing_postal_code  = $data->billing_postal_code;
        $order->shipping_data = $shipping_data;
        $order->coupon = $coupon_data;
        $order->shipping_title = $data->shipping_title;
        $order->shipping_cost = $data->shipping_cost;
        $order->payment_status  = "Paid";
        $order->order_status  = "Pending";
        $order->order_comments = $data->order_comments;
        $order->save();

        if($gateway == 'COD'){
        	$transaction_number = Str::random(8);
        	$paymentId = null;
        	$transection_time = date('Y-m-d H:i:s.u');
        	$amount = $data->total;
        	$payment_type = 'Cash On Delivery';
        }elseif($gateway == 'bkash'){
        	$transaction_number = $response['trxID'];
        	$paymentId = $response['paymentID'];
        	$transection_time = $response['paymentExecuteTime'];
        	$amount = $response['amount'];
        	$payment_type = 'bKash';
        }elseif($gateway == 'paypal'){
        	$transaction_number = $response['id'];
        	$paymentId = $response['payerId'];
        	$transection_time = date('Y-m-d H:i:s.u');
        	$amount = $data->total;
        	$payment_type = 'Paypal';
        }elseif($gateway == 'stripe'){
        	$transaction_number = $response->balance_transaction;
        	$paymentId = $response->id;
        	$transection_time = date('Y-m-d H:i:s.u', $response->created);
        	$amount = $data->total;
        	$payment_type = 'Stripe';
        }

        $transection = new Transection();
        $transection->user_id  = Auth::user()->id;
        $transection->order_id   = $order->id;
        $transection->transaction_number = $transaction_number;
        $transection->paymentId = $paymentId;
        $transection->formable_type = "user";
        $transection->formable_id = Auth::user()->id;
        $transection->toable_type = "admin";
        $transection->toable_id = 1;
        $transection->payment_type = $payment_type;
        $transection->amount = $amount;
        $transection->transection_time = $transection_time;
        
        $transection->save();

        $orderProducts = []; // Use a new variable to collect data for insert

        foreach (\Cart::session(Session::getId())->getContent() as $item) {

            $customizationData = [];
            if (is_array($item->attributes->customizeOptionStore)) {

                foreach ($item->attributes->customizeOptionStore as $option) {
                    $customizationItem = [
                        'option_name' => $option['option_name'],
                        'option_value' => $option['option_value'],
                        'option_type'=> $option['option_type']
                    ];

                    // If you want to include option_image:
                    if (isset($option['option_image'])) {
                        $customizationItem['option_image'] = $option['option_image'];
                    }

                    $customizationData[] = $customizationItem;
                }
            }

            $orderProducts[] = [
                'order_id' => $order->id,
                'product_id' => $item->id,
                'product_name' => $item->name,
                'product_price' => $item->price,
                'product_slug' => $item->attributes->slug,
                'product_SKU' => $item->attributes->SKU,
                'quantity' => $item->quantity,
                'product_attributes' => json_encode($item->attributes->attributes), // Encode JSON data if needed
                'product_attributes_value' => json_encode($item->attributes->attributes_value), // Encode JSON data if needed
                'product_refferer' => $item->attributes->refferer,
                'customize_attribute' => json_encode($customizationData),
                'product_category' => $item->attributes->category,
                'product_subcategory' => $item->attributes->subcategory,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $product_fetch = Product::where('id',$item->id)->first();
            $stock = $product_fetch->stock - $item->quantity;
            $product_fetch->update(['stock' => $stock]);
        }

        OrderedItem::insert($orderProducts);

        \Cart::session(Session::getId())->clear();
        \Cart::session(Session::getId())->clearCartConditions();

        Mail::to($order->email)->later(now()->addMinutes(1), new OrderInvoiceMail($order,$transection));

        // Payment successful! Process the charge and handle success logic
	    // return response()->json(['transectionId' => $transaction_number, 'trackingId' => $order->tracking_id]);
        return ['transactionId' => $transaction_number, 'trackingId' => $order->tracking_id];
    }
}