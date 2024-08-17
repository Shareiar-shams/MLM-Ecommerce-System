<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Coderflex\LaravelTicket\Models\Label;

class TicketLabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:view ticket label|create ticket label|update ticket label|delete ticket label', ['only' => ['index','store','status']]);
         $this->middleware('permission:create ticket label', ['only' => ['create','store']]);
         $this->middleware('permission:update ticket label', ['only' => ['edit','update']]);
         $this->middleware('permission:delete ticket label', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::orderBy('id','DESC')->get();

        return view('admin.ticketlabels.index',compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ticketlabels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'slug' => 'required|min:3|max:255|unique:labels',
            
        ]);

        $item = new Label();
        $item->name = $request->name;
        $item->slug = $request->slug;
        
        $item->save();

        $notification = array(
            'message' => 'Label Add Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('ticket-labels.index'))->with($notification);
    }


    public function status(Request $request, string $id){
        $this->validate($request,[
            'is_visible' => 'required',
        ]);
        $item = Label::find($request->id);

        $item->is_visible = $request->is_visible;
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Label::findOrFail($id);
        return view('admin.ticketlabels.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'slug' => 'required|min:3|max:255',
            
        ]);

        $item = Label::find($id);
        $item->name = $request->name;
        $item->slug = $request->slug;
        
        $item->save();

        $notification = array(
            'message' => 'Label Update Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('ticket-labels.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Label::where('id',$id)->delete();
        $notification = array(
            'message' => 'Label Destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
