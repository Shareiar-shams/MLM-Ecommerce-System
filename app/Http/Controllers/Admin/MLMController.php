<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Mlmuser;
use App\Models\Admin\Transection;
use Illuminate\Http\Request;

class MLMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:view mlm users|create mlm users|update mlm users|delete mlm users', ['only' => ['index','store','active','inactivebyparent','inactivebyadmin','show']]);
         $this->middleware('permission:create mlm users', ['only' => ['create','store']]);
         $this->middleware('permission:update mlm users', ['only' => ['edit','update']]);
         $this->middleware('permission:delete mlm users', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Mlmuser::orderBy('id','ASC')->get();
        return view('admin.mlm.show',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Mlmuser::orderBy('id','DESC')->get();
        return view('admin.mlm.specialUser',compact('data'));
    }

    /**
     * Show the Active Mlm users for Display a listing of the resource.
     */
    public function active()
    {
        $data = Mlmuser::where('parent_activation',1)->where('admin_activation',1)->orderBy('id','DESC')->get();
        return view('admin.mlm.activeUser',compact('data'));
    }

     /**
     * Show the Unctive Mlm users by parent for Display a listing of the resource.
     */
    public function inactivebyparent()
    {
        $data = Mlmuser::where('parent_activation',0)->where('admin_activation',1)->orderBy('id','DESC')->get();
        return view('admin.mlm.inactiveByparentUser',compact('data'));
    }

     /**
     * Show the Unctive Mlm users by admin for Display a listing of the resource.
     */
    public function inactivebyadmin()
    {
        $data = Mlmuser::where('parent_activation',1)->where('admin_activation',0)->orderBy('id','DESC')->get();
        return view('admin.mlm.inactiveByadminUser',compact('data'));
    }

    public function payuser($id)
    {
        $mainUser = Mlmuser::where('id',$id)->with('user')->first();
        $mlmuser = Mlmuser::where('user_id',$mainUser->parent_id)->with('user')->first();
        $data = Transection::where('user_id',$mainUser->user_id)->where('formable_type','admin')->where('toable_type','user')->first();

        return view('admin.transection.pay',compact('data','mlmuser'));
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
        $status = isset($_GET['status']) ? $_GET['status'] : null;
        $data = Mlmuser::find($id);
        $activeChildCount = Mlmuser::where('parent_id', $id)
        ->where('admin_activation', 1)
        ->where('parent_activation', 1)
        ->get();
        if ($status == 'activechild') {
            $childUsers = Mlmuser::where('parent_id', $id)
                ->where('admin_activation', 1)
                ->where('parent_activation', 1)
                ->get();
        } elseif ($status == 'inactivechild') {
            $childUsers = Mlmuser::where('parent_id', $id)
                ->where(function ($query) {
                    $query->where('admin_activation', 0)
                        ->orWhere('parent_activation', 0);
                })
                ->get();
        }
        else{
            $childUsers = Mlmuser::where('parent_id', $id)->get();
        }
        // $inactiveChildcount = ($data->children->count() - $activeChildCount);
        // dd($activeChildCount);
        return view('admin.mlm.view',compact('data','activeChildCount','childUsers'));
    }

    /**
     * Show the chat box for chatting with specific user.
     */

    public function chat(string $id)
    {
        $data = Mlmuser::find($id);
        return view('admin.mlm.chat',$data);
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
