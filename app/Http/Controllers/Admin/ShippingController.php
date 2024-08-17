<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:manage shipping', ['only' => ['index','create','store','show','edit','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shippings = Shipping::orderBy('id','ASC')->get();
        return view('admin.shipping.index',compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'cost' => 'required',
        ]);

        $data = new Shipping();
        $data->title = $request->title;
        $data->cost = $request->cost;
        $data->save();

        $notification = array(
        'message' => 'Shipping Sucessfully Add', 
            'alert-type' => 'success',
        );
        return redirect(route('shipping.index'))->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipping $shipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipping $shipping)
    {
        return view('admin.shipping.edit',compact('shipping'));
    }

    public function status(Request $request,$id)
    {
        $this->validate($request,[
            'status' => 'required',
        ]);
        $item = Shipping::find($id);
        $item->status = $request->status;
        $item->save(); 
        $notification = array(
            'message' => 'Status Change!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'cost' => 'required',
        ]);

        $data = Shipping::findOrFail($id);
        $data->title = $request->title;
        $data->cost = $request->cost;
        $data->save();

        $notification = array(
        'message' => 'Shipping Sucessfully Update', 
            'alert-type' => 'success',
        );
        return redirect(route('shipping.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipping $shipping)
    {
        Shipping::where('id',$shipping)->delete();
        $notification = array(
            'message' => 'Slider destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
