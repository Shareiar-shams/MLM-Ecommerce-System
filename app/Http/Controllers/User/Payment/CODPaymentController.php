<?php

namespace App\Http\Controllers\User\Payment;

use App\Http\Controllers\Controller;
use App\Mail\OrderInvoiceMail;
use App\Models\Admin\Order;
use App\Models\Admin\Product;
use App\Models\Admin\Transection;
use App\Models\Admin\coupon;
use App\Models\User\BkashPaySessionData;
use App\Models\User\OrderedItem;
use App\Services\OrderService;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Session;

class CODPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $session_id = Session::getId();
        $order_form_data = session()->get('order_data');

        $json_data = array(
            'order_type' => 'Ecommerce',
            'order_quantity' => \Cart::session(Session::getId())->getTotalQuantity(),
            'total' => $order_form_data['total_cost'],
            'user_id' => Auth::user()->id,
            'invoice' => $request->invoice,
            'name' => $order_form_data['billing_first_name'].' '.$order_form_data['billing_last_name'],
            'email' => $order_form_data['billing_email'],
            'phone' => $order_form_data['billing_phone'],
            'company' => $order_form_data['billing_company'],
            'billing_address' => $order_form_data['billing_address'],
            'billing_town' => $order_form_data['billing_town_city'],
            'billing_postal_code' => $order_form_data['postal_code'],
            'order_comments' => $order_form_data['order_notes'],

            'shipping_name' => $order_form_data['shipping_first_name'].' '.$order_form_data['shipping_last_name'],
            'shipping_email' => $order_form_data['shipping_email'],
            'shipping_phone' => $order_form_data['shipping_phone'],
            'shipping_company' => $order_form_data['shipping_company'],
            'shipping_address' => $order_form_data['shipping_address'],
            'shipping_town_city' => $order_form_data['shipping_town_city'],
            'shipping_postal_code' => $order_form_data['shipping_postal_code'],
            'shipping_title' => $order_form_data['shipping_title'],
            'shipping_cost' => $order_form_data['shipping_cost'],
        );
        $session_data = json_encode($json_data);

        $find = BkashPaySessionData::where('user_id', Auth::user()->id)->first();

        if(empty($find)){
            $item = new BkashPaySessionData();
        }else{
            $item = BkashPaySessionData::find($find->id);
        }
        $item->user_id  = Auth::user()->id;
        $item->session_name  = "ecommerce_order_payment";
        $item->session_data = $session_data;
        $item->save();

        $data = json_decode($item->session_data);

        $orderService = new OrderService(new Order, new Transection, new OrderedItem, new Product);
        $orderId = $orderService->saveOrder($data, '', 'COD');

        $transactionId = $orderId['transactionId'];
        $trackingId = $orderId['trackingId'];


        // Payment successful! Process the charge and handle success logic
        return response()->json(['transectionId' => $transactionId, 'trackingId' => $trackingId]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
