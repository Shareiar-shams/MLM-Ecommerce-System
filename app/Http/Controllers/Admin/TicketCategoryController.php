<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Coderflex\LaravelTicket\Models\Category;

class TicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:view ticket category|create ticket category|update ticket category|delete ticket category', ['only' => ['index','store','status']]);
         $this->middleware('permission:create ticket category', ['only' => ['create','store']]);
         $this->middleware('permission:update ticket category', ['only' => ['edit','update']]);
         $this->middleware('permission:delete ticket category', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id','DESC')->get();

        return view('admin.ticketcategory.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ticketcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'slug' => 'required|min:3|max:255|unique:categories',
            
        ]);

        $item = new Category();
        $item->name = $request->name;
        $item->slug = $request->slug;
        
        $item->save();

        $notification = array(
            'message' => 'Category Add Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('ticket-categories.index'))->with($notification);
    }


    public function status(Request $request, string $id){
        $this->validate($request,[
            'is_visible' => 'required',
        ]);
        $item = Category::find($request->id);

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
        $data = Category::findOrFail($id);
        return view('admin.ticketcategory.edit',compact('data'));
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

        $item = Category::find($id);
        $item->name = $request->name;
        $item->slug = $request->slug;
        
        $item->save();

        $notification = array(
            'message' => 'Category Update Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('ticket-categories.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::where('id',$id)->delete();
        $notification = array(
            'message' => 'Category Destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
