<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminPayToUserNotification;
use App\Models\Admin\Mlmuser;
use App\Models\Admin\Transection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TransectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:manage transaction', ['only' => ['index','create','store','show','edit','update','destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Transection::orderBy('id', 'DESC')->get();
        return view('admin.transection.index',compact('data'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mlmuser = '';
        $data = Transection::findOrFail($id);
        if($data->formable_type == 'admin' && $data->toable_type == 'user'){
            $mlmuser = Mlmuser::where('user_id',$data->toable_id)->with('user')->first();
        }
        return view('admin.transection.pay',compact('data','mlmuser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'transaction_number' => 'required',
            'payment_type' => 'required'
            
        ]);


        $data = Transection::findOrFail($id);
        $data->transaction_number = $request->transaction_number;
        $data->payment_type = $request->payment_type;
        $data->save();


        $user = Mlmuser::findOrFail($data->mlmuser->id);
        $user->parent_activation = 1;
        $user->admin_activation = 1;

        if($data->user->user_type == 'special'){   
            $user->parent_id = null;
        }
        
        $user->save();  

        // Send email notification to the parent user
        if ($user->parent_id) {
            $childUser = $user->user;
            $userName= $user->parent_user->name;
            $amount = $data->amount;
            
            Mail::to($user->parent_user->email)->send(new AdminPayToUserNotification($childUser, $userName, $amount));
        }
        $notification = array(
            'message' => 'Payment Succesfull. Contact with Creditor.', 
            'alert-type' => 'success',
        );
        return redirect(route('transections.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Transection::where('id',$id)->delete();
        $notification = array(
            'message' => 'Transaction destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
