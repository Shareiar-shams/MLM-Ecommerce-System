<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Faq;
use App\Models\Admin\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:manage faqs', ['only' => ['index','create','store','show','edit','update','destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::all();
        return view('admin.faq.faq.index',compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = FaqCategory::where('status',1)->orderBy('id','ASC')->get();
        return view('admin.faq.faq.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|min:3',
            'category_id'   => 'required|numeric',
            'description' => 'required',

        ]);


        $item = new Faq();
        $item->title = $request->title;
        $item->category_id = $request->category_id;
        $item->description = $request->description;
        $item->save(); 
        
        $notification = array(
            'message' => 'Faq Add Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('faq.index'))->with($notification);
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
        $categories = FaqCategory::where('status',1)->orderBy('id','ASC')->get();
        $faq = Faq::find($id);
         return view('admin.faq.faq.edit',compact('faq','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'title' => 'required|min:3',
            'category_id'   => 'required|numeric',
            'description' => 'required',

        ]);


        $item = Faq::find($id);
        $item->title = $request->title;
        $item->category_id = $request->category_id;
        $item->description = $request->description;
        $item->save(); 
        
        $notification = array(
            'message' => 'Faq Update Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('faq.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Faq::where('id',$id)->delete();
        $notification = array(
            'message' => 'Faq Destroy!', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
