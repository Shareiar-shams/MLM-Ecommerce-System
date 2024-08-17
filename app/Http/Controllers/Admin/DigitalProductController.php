<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DigitalProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DigitalProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:view digital product|create digital product|update digital product|delete digital product', ['only' => ['index','store']]);
         $this->middleware('permission:create digital product', ['only' => ['create','store']]);
         $this->middleware('permission:update digital product', ['only' => ['edit','update']]);
         $this->middleware('permission:delete digital product', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DigitalProduct::all();
        return view('admin.digitalProduct.show',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sku = Str::random(10);
        return view('admin.digitalProduct.add',compact('sku'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3|unique:digital_products',
            'slug' => 'required|min:3|max:255|unique:digital_products',
            'SKU' => 'required|min:3|max:12|unique:digital_products',
            'short_description' => 'nullable',
            'description' => 'required',
            'featured_image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'gallery_image'=>'nullable',
            'gallery_image.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100|max:4096',
            'price' => 'required|integer',
            'special_price' => 'nullable|numeric',
            'delivery_type' => 'required',
            'delivery_link' => 'nullable',
            'delivery_file' => 'nullable',
            'status' => 'nullable|boolean',
            'meta_keyword' => 'nullable',
            'meta_desc' => 'nullable',
        ]);

        if($request->hasFile('featured_image'))
        {
            $featured_image = $request->featured_image->getClientOriginalName();
            $featured_image = $request->featured_image->store('public');
        }
        else
        {
            $featured_image = 'noimage.jpg';
        }

        if($request->hasFile('gallery_image'))
        {
            $gallery_image = $request->gallery_image->getClientOriginalName();
            $gallery_image = $request->gallery_image->store('public');
        }
        else
            $gallery_image = null;

        if($request->hasFile('delivery_file'))
        {
            $delivery_file = $request->delivery_file->getClientOriginalName();
            $delivery_file = $request->delivery_file->store('public');
        }

        $delivery_entity = isset($request->delivery_link) ? $request->delivery_link : $delivery_file;

        $item = new DigitalProduct();
        $item->name = $request->name;
        $item->short_description = $request->short_description;
        $item->description = $request->description;
        $item->slug = $request->slug;
        $item->SKU = $request->SKU;
        $item->featured_image = $featured_image;
        $item->gallery_image = $gallery_image;
        $item->price = $request->price;
        $item->special_price = $request->special_price;
        $item->status = 1;
        $item->delivery_type = $request->delivery_type;
        $item->delivery_entity = $delivery_entity;
        $item->meta_keyword = $request->meta_keyword;
        $item->meta_desc = $request->meta_desc;
        
        $item->save();

        $notification = array(
            'message' => 'Digital Product Add Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('digitalproduct.create'))->with($notification);
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
        $data = DigitalProduct::find($id);
        return view('admin.digitalProduct.edit',compact('data'));
    }

    public function status(Request $request, string $id){
        $this->validate($request,[
            'status' => 'required',
        ]);
        $item = DigitalProduct::find($request->id);

        $item->status = $request->status;
        $item->save(); 
        $notification = array(
            'message' => 'Status Change!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'slug' => 'required|min:3|max:255',
            'SKU' => 'required|min:3|max:12',
            'short_description' => 'nullable',
            'description' => 'required',
            'featured_image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'gallery_image'=>'nullable',
            'gallery_image.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100|max:4096',
            'price' => 'required|integer',
            'special_price' => 'nullable|numeric',
            'delivery_type' => 'required',
            'delivery_link' => 'nullable',
            'delivery_file' => 'nullable',
            'status' => 'nullable|boolean',
            'meta_keyword' => 'nullable',
            'meta_desc' => 'nullable',
        ]);
        $data = DigitalProduct::where('id',$id)->first();
        if($request->hasFile('featured_image'))
        {
            $featured_image = $request->featured_image->getClientOriginalName();
            $featured_image = $request->featured_image->store('public');
        }
        else
        {
            $featured_image = $data->featured_image;
        }

        if($request->hasFile('gallery_image'))
        {
            $gallery_image = $request->gallery_image->getClientOriginalName();
            $gallery_image = $request->gallery_image->store('public');
        }
        else
        {
            
            $gallery_image = $data->gallery_image;
        }

        if($request->hasFile('delivery_file'))
        {
            $delivery_file = $request->delivery_file->getClientOriginalName();
            $delivery_file = $request->delivery_file->store('public');
        }else{
            $delivery_file = $data->delivery_entity;
        }

        $delivery_entity = isset($request->delivery_link) ? $request->delivery_link : $delivery_file;

        $item = DigitalProduct::find($id);
        $item->name = $request->name;
        $item->short_description = $request->short_description;
        $item->description = $request->description;
        $item->slug = $request->slug;
        $item->SKU = $request->SKU;
        $item->featured_image = $featured_image;
        $item->gallery_image = $gallery_image;
        $item->price = $request->price;
        $item->special_price = $request->special_price;
        $item->status = $data->status;
        $item->delivery_type = $request->delivery_type;
        $item->delivery_entity = $delivery_entity;
        $item->meta_keyword = $request->meta_keyword;
        $item->meta_desc = $request->meta_desc;
        
        $item->save();

        $notification = array(
            'message' => 'This Product Update Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('digitalproduct.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DigitalProduct::where('id',$id)->delete();
        $notification = array(
            'message' => 'Digital Product Destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
