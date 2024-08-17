<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Announcement;
use App\Models\Admin\EmailConfig;
use App\Models\Admin\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:manage social login', ['only' => ['index','store','show','edit','update','destroy']]);

        $this->middleware('permission:manage announcement', ['only' => ['create','announcementupdate']]);

        $this->middleware('permission:manage email configuration', ['only' => ['email','email_configuration']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facebook = SocialMedia::where('media_name','Facebook')->first();
        $google = SocialMedia::where('media_name','Google')->first();
        return view('admin.socialMedia.index',compact('facebook','google'));
    }

    public function email()
    {
        $email = EmailConfig::first();
        return view('admin.emailConfig.index',compact('email'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $announcement = Announcement::first();
        return view('admin.announcement.index',compact('announcement'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function announcementupdate(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'delay_duration' => 'required',
            'title' => 'required',
            'description' => 'required',
            'url' => 'required',
            'status' => 'required',
            // Add validation rules for other categories if needed
        ]);

        if(isset($request->id)){

            $data = Announcement::find($request->id);

            if($request->hasFile('image'))
            {
                $imageName = $request->image->getClientOriginalName();
                $imageName = $request->image->store('public');
            }else{

                $imageName = $data->image;
            }
        }
        else{
            if($request->hasFile('image'))
            {
                $imageName = $request->image->getClientOriginalName();
                $imageName = $request->image->store('public');
            }

            $data = new Announcement();
        }

        $data->type = $request->type;;
        $data->image = $imageName;
        $data->delay_duration = $request->delay_duration;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->url = $request->url;
        $data->status = $request->status;

        $data->save();

        $notification = array(
        'message' => 'Email Configuration Successfully Updated', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'app_id' => 'required',
            'app_secret' => 'required',
            'redirect_url' => 'required',
            // Add validation rules for other categories if needed
        ]);

        $data = SocialMedia::find($request->id);

        $data->app_id = $request->app_id;;
        $data->app_secret = $request->app_secret;
        $data->redirect_url = $request->redirect_url;
        $data->status = $request->status;

        $data->save();

        $notification = array(
            'message' => 'Facebook Data Successfully Updated', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function email_configuration(Request $request)
    {
        $request->validate([
            'driver' => 'required',
            'host' => 'required',
            'port' => 'required',
            'encryption' => 'required',
            'username' => 'required',
            'password' => 'required',
            'sendermail' => 'required',
            // Add validation rules for other categories if needed
        ]);

        $data = EmailConfig::find($request->id);

        $data->driver = $request->driver;
        $data->host = $request->host;
        $data->port = $request->port;
        $data->encryption = $request->encryption;
        $data->username = $request->username;
        $data->password = $request->password;
        $data->sendermail = $request->sendermail;

        $data->save();

        $notification = array(
        'message' => 'Email Configuration Successfully Updated', 
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
