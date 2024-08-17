<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PaymentGateway;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:manage payment gatways', ['only' => ['index','create','store','show','edit','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cod = PaymentGateway::where('slug','cod')->first();
        $stripe = PaymentGateway::where('slug','stripe')->first();
        $paypal = PaymentGateway::where('slug','paypal')->first();
        $ssl = PaymentGateway::where('slug','ssl')->first();
        $bkash = PaymentGateway::where('slug','bkash')->first();
        return view('admin.payment.index',compact('cod','stripe','paypal','ssl','bkash'));
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
        $this->validate($request,[
            'name' => 'required',
            'image.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'text' => 'required',
            'data' => 'nullable',
            'sandbox' => 'nullable',
            'status' => 'nullable',

        ]);

        $arr_tojson = json_encode($request->data);

        $data = PaymentGateway::find($request->id);

        if($request->hasFile('image'))
        {
            $imageName = $request->image->getClientOriginalName();
            $imageName = $request->image->store('public');
        }else{

            $imageName = $data->image;
        }

        $data->name = $request->name;
        $data->image = $imageName;
        $data->text = $request->text;
        $data->data = $arr_tojson;
        $data->sandbox = $request->sandbox;
        $data->status = $request->status;

        $data->save();

        $notification = array(
        'message' => 'Gateway Content update successfully.', 
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
