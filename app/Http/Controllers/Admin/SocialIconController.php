<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SocialIcon;
use Illuminate\Http\Request;

class SocialIconController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:manage social media setting', ['only' => ['index','create','status','store','show','edit','update','destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $icons = SocialIcon::all();
        return view('admin.icon.index',compact('icons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.icon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'icon' => 'required',
            'url' => 'required',
        ]);

        $item = new SocialIcon();
        $item->icon = $request->icon;
        $item->url = $request->url;
        $item->save(); 
        
        $notification = array(
            'message' => 'Icon Add Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('icon.index'))->with($notification);
    }

    public function status(Request $request,$id)
    {
        $this->validate($request,[
            'status' => 'required',
        ]);
        $item = SocialIcon::find($id);
        $item->status = $request->status;
        $item->save(); 
        $notification = array(
            'message' => 'Status Change!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(SocialIcon $SocialIcon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $icon = SocialIcon::find($id);
        return view('admin.icon.edit',compact('icon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'icon' => 'required',
            'url' => 'required',
        ]);

        $item = SocialIcon::find($id);
        $item->icon = $request->icon;
        $item->url = $request->url;
        $item->save(); 
        
        $notification = array(
            'message' => 'Icon Update Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('icon.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SocialIcon::where('id',$id)->delete();
        $notification = array(
            'message' => 'Icon destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
