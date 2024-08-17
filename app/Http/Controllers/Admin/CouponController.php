<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:manage coupons', ['only' => ['index','create','store','status','show','edit','update','destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = coupon::all();
        return view('admin.coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|min:3',
            'code' => 'required',
            'number_of_times' => 'required',
            'discount_type' => 'required',
            'discount' => 'required',
        ]);

        $cou = new coupon();
        $cou->title = $request->title;
        $cou->code = $request->code;
        $cou->number_of_times = $request->number_of_times;
        $cou->discount_type = $request->discount_type;
        $cou->discount = $request->discount;
        $cou->save();

        $notification = array(
            'message' => 'Coupon Add Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('code.index'))->with($notification);
    }

    public function status(Request $request,$id)
    {
        $this->validate($request,[
            'status' => 'required',
        ]);
        $cou = coupon::find($id);
        $cou->status = $request->status;
        $cou->save(); 
        $notification = array(
            'message' => 'Status Change!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
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
        $coupon = coupon::where('id',$id)->first();
        return view('admin.coupon.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'title' => 'required|min:3',
            'code' => 'required',
            'number_of_times' => 'required',
            'discount_type' => 'required',
            'discount' => 'required',
        ]);

        $cou = coupon::find($id);
        $cou->title = $request->title;
        $cou->code = $request->code;
        $cou->number_of_times = $request->number_of_times;
        $cou->discount_type = $request->discount_type;
        $cou->discount = $request->discount;
        $cou->save();
        $notification = array(
            'message' => 'Coupon Update Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('code.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        coupon::where('id',$id)->delete();
        $notification = array(
            'message' => 'Coupon destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
