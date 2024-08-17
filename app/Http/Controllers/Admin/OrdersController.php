<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderStatusMail;
use App\Models\Admin\Order;
use App\Models\User\OrderedItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use DB;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:view order|create order|update order|delete order', ['only' => ['index','store','customize_orders','order_type']]);
         $this->middleware('permission:create order', ['only' => ['create','store','payment_status']]);
         $this->middleware('permission:update order', ['only' => ['edit','update','payment_status']]);
         $this->middleware('permission:delete order', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->start_date && $request->end_date){
            $orders = Order::whereBetween('created_at',[
                $request->start_date,
                Carbon::parse($request->end_date)->endOfDay()
            ])->orderBy('id','DESC')->get();
        }else{

            $orders = Order::orderBy('id','DESC')->get();
        }
        return view('admin.order.index',compact('orders'));
    }

    public function getChartData(Request $request)
    {
        $currentYear = Carbon::now()->year; // Get the current year

        $orders = Order::whereYear('created_at', $currentYear)
                   ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total) as total_sales')) // Assuming 'amount' for order value
                   ->groupBy('month')
                   ->get();

        $labels = [];
        $data = [];

        foreach ($orders as $order) {
            $labels[] = Carbon::createFromDate($currentYear, $order->month)->format('M'); // Format month labels
            $data[] = $order->total_sales;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function order_type(Request $request, $type='')
    {
        if($request->start_date && $request->end_date){
            $orders = Order::whereBetween('created_at',[
                $request->start_date,
                Carbon::parse($request->end_date)->endOfDay()
            ])->where('order_status', $type)->orderBy('id','DESC')->get();
        }else{

            $orders = Order::where('order_status', $type)->orderBy('id','DESC')->get();
        }
        return view('admin.order.orderType',compact('orders','type'));
    }

    public function customize_orders()
    {

        $orderItems = OrderedItem::where('customize_attribute', '!=', '')->where('customize_attribute', '!=', '[]')->where('customize_attribute', '!=', null)->orderBy('id','DESC')->get();

        return view('admin.order.customizeOrder',compact('orderItems'));
    }

    public function print_invoice($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.printorder',compact('order'));
    }


    public function payment_status(Request $request,$id)
    {
        $this->validate($request,[
            'payment_status' => 'required',
        ]);
        $order = Order::find($id);
        $order->payment_status = $request->payment_status;
        $order->save(); 
        $notification = array(
            'message' => 'Payment Status Change!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function type_status($id, $type)
    {
        $order = Order::find($id);
        $order->order_status = $type;
        $order->save(); 
        $notification = array(
            'message' => 'Order Type Status Change!', 
            'alert-type' => 'success',
        );
        Mail::to($order->email)->later(now()->addMinutes(1), new OrderStatusMail($order));
        return redirect()->back()->with($notification);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.show',compact('order'));
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
        Order::where('id',$id)->delete();
        $notification = array(
            'message' => 'Order destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
