<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:manage site pages', ['only' => ['index','create','status','store','show','edit','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::all();
        return view('admin.page.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|min:3',
            'slug' => 'required|min:3|max:255|unique:pages',
            'description' => 'required',
            'meta_keywords' => 'nullable',
            'meta_descriptions' => 'nullable',

        ]);

        $meta_keywords = isset($request->meta_keywords) ? json_encode($request->meta_keywords) : null;

        $item = new Page();
        $item->title = $request->title;
        $item->slug = $request->slug;
        $item->description = $request->description;
        $item->meta_keywords = $meta_keywords;
        $item->meta_descriptions = $request->meta_descriptions;
        $item->save(); 
        
        $notification = array(
            'message' => 'Page Add Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('page.index'))->with($notification);
    }

    public function status(Request $request,$id)
    {
        $this->validate($request,[
            'status' => 'required',
        ]);
        $item = Page::find($id);
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
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page = Page::find($id);
        return view('admin.page.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'title' => 'required|min:3',
            'slug' => 'required|min:3|max:255',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'description' => 'required',
            'meta_keywords' => 'nullable',
            'meta_descriptions' => 'nullable',

        ]);


        $meta_keywords = isset($request->meta_keywords) ? json_encode($request->meta_keywords) : null;
        $item = Page::find($id);

        if($request->hasFile('image'))
        {
            $imageName = $request->image->getClientOriginalName();
            $imageName = $request->image->store('public');
        }else{

            $imageName = $item->image;
        }        

        $item->title = $request->title;
        $item->slug = $request->slug;
        $item->image = $imageName;
        $item->description = $request->description;
        $item->meta_keywords = $meta_keywords;
        $item->meta_descriptions = $request->meta_descriptions;
        $item->save(); 
        
        $notification = array(
            'message' => 'Page Update Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('page.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Page::where('id',$id)->delete();
        $notification = array(
            'message' => 'Page destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
