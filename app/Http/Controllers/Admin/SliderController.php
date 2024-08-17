<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:manage slider setting', ['only' => ['index','create','status','store','show','edit','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::orderBy('id','DESC')->get();
        return view('admin.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }


    public function status(Request $request,$id)
    {
        $this->validate($request,[
            'status' => 'required',
        ]);
        $item = Slider::find($id);
        $item->status = $request->status;
        $item->save(); 
        $notification = array(
            'message' => 'Status Change!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|min:3',
            'link' => 'required',
            'featured_image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'short_description' => 'nullable'

        ]);

        if($request->hasFile('featured_image'))
        {
            $imageName = $request->featured_image->getClientOriginalName();
            $imageName = $request->featured_image->store('public');
        }

        $item = new Slider();
        $item->title = $request->title;
        $item->link = $request->link;
        $item->description = $request->description;
        $item->featured_image = $imageName;
        $item->active_slide = $request->active_slide;
        $item->save();

        $notification = array(
            'message' => 'Slider Add Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('slider.index'))->with($notification);
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
        $slider = Slider::find($id);
        return view('admin.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'title' => 'required|min:3',
            'link' => 'required',
            'description' => 'nullable',
            'featured_image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100'

        ]);

        $item = Slider::find($id);

        if($request->hasFile('featured_image'))
        {
            $imageName = $request->featured_image->getClientOriginalName();
            $imageName = $request->featured_image->store('public');
        }else{

            $imageName = $item->featured_image;
        }
        
        $item->title = $request->title;
        $item->link = $request->link;
        $item->featured_image = $imageName;
        $item->description = $request->description;
        $item->active_slide = $request->active_slide;
        $item->save(); 
        $notification = array(
            'message' => 'Slider Add Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('slider.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Slider::where('id',$id)->delete();
        $notification = array(
            'message' => 'Slider destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
