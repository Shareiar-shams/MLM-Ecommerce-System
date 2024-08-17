<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:mange product type', ['only' => ['index','create','status','store','edit','update','destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = ProductType::orderBy('id','DESC')->get();
        return view('admin.product.type.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.type.create');
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

        $item = new ProductType();
        $item->name = $request->name;
        $item->slug = $request->slug;
        
        $item->save();

        $notification = array(
            'message' => 'Product Type Add Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('type.index'))->with($notification);
    }

    public function status(Request $request, string $id){
        $this->validate($request,[
            'status' => 'required',
        ]);
        $item = ProductType::find($request->id);

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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = ProductType::findOrFail($id);
        return view('admin.product.type.edit',compact('data'));
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

        $item = ProductType::find($id);
        $item->name = $request->name;
        $item->slug = $request->slug;
        
        $item->save();

        $notification = array(
            'message' => 'Product Type Update Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('type.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ProductType::where('id',$id)->delete();
        $notification = array(
            'message' => 'Product Type Destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
