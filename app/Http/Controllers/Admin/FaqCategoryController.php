<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:manage faq category', ['only' => ['index','create','status','store','show','edit','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = FaqCategory::all();
        return view('admin.faq.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faq.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'slug' => 'required|min:3|max:255|unique:faq_categories',
            'text' => 'required',
            'meta_keywords' => 'nullable',
            'meta_descriptions' => 'nullable',

        ]);

        $meta_keywords = isset($request->meta_keywords) ? json_encode($request->meta_keywords) : null;

        $item = new FaqCategory();
        $item->name = $request->name;
        $item->slug = $request->slug;
        $item->text = $request->text;
        $item->meta_keywords = $meta_keywords;
        $item->meta_descriptions = $request->meta_descriptions;
        $item->save(); 
        
        $notification = array(
            'message' => 'Category Add Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('faqcategory.index'))->with($notification);
    }

    public function status(Request $request,$id)
    {
        $this->validate($request,[
            'status' => 'required',
        ]);
        $item = FaqCategory::find($id);
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
    public function show(FaqCategory $faqCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faqCategory = FaqCategory::find($id);
        return view('admin.faq.category.edit',compact('faqCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'slug' => 'required|min:3|max:255',
            'text' => 'required',
            'meta_keywords' => 'nullable',
            'meta_descriptions' => 'nullable',

        ]);


        $meta_keywords = isset($request->meta_keywords) ? json_encode($request->meta_keywords) : null;

        $item = FaqCategory::find($id);

        
        $item->name = $request->name;
        $item->slug = $request->slug;
        $item->text = $request->text;
        $item->meta_keywords = $meta_keywords;
        $item->meta_descriptions = $request->meta_descriptions;
        $item->save(); 
        
        $notification = array(
            'message' => 'Category Add Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('faqcategory.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        FaqCategory::where('id',$id)->delete();
        $notification = array(
            'message' => 'Category destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
