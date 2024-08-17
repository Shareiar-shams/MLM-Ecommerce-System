<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Attribute;
use App\Models\Admin\AttributeOption;
use App\Models\Admin\CustomizeProductOption;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $attributes = Attribute::all();
        return view('admin.product.item.attribute',compact('attributes','id'));
    }

    public function optionlist($id)
    {
        $options = AttributeOption::all();
        return view('admin.product.item.attributeoptionlist',compact('options','id'));
    }

    public function design_list($id)
    {
        $product = Product::find($id);
        return view('admin.product.item.designList',compact('product'));
    }

    public function designcreate($id)
    {
        $product = Product::find($id);
        return view('admin.product.item.designcreate',compact('product'));
    }
    public function designstore(Request $request,$id)
    {
        $this->validate($request,[
            'option_name' => 'required',
            'option_value' => 'required|min:3|max:255|unique:customize_product_options',
            'option_type' => 'required',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
        ]);
        if($request->hasFile('image'))
        {
            $imageName = $request->image->getClientOriginalName();
            $imageName = $request->image->store('public');
        }
        $option = new CustomizeProductOption();
        $option->product_id = $id;
        $option->option_type = $request->option_type;
        $option->option_name = $request->option_name;
        $option->option_value = $request->option_value;
        $option->image = $imageName;
        $option->save();
        // $product->options()->create($request);
        
        $notification = array(
            'message' => 'Customize Option Add Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('product.customize.design',$id))->with($notification);
    }

    public function designedit($productId,string $id)
    {
        $product = Product::find($productId);
        $design_option = CustomizeProductOption::find($id);
        return view('admin.product.item.designedit',compact('design_option','product'));
    }
    public function designupdate(Request $request, $productId, string $id)
    {
        $this->validate($request,[
            'option_name' => 'required',
            'option_value' => 'required|min:3|max:255',
            'option_type' => 'required',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
        ]);
        $option = CustomizeProductOption::find($id);
        
        if($request->hasFile('image'))
        {
            $imageName = $request->image->getClientOriginalName();
            $imageName = $request->image->store('public');
        }else{

            $imageName = $option->image;
        }
        $option->product_id = $productId;
        $option->option_type = $request->option_type;
        $option->option_name = $request->option_name;
        $option->option_value = $request->option_value;
        $option->image = $imageName;
        $option->save();
        // $product->options()->create($request);
        
        $notification = array(
            'message' => 'Customize Option Update Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('product.customize.design',$productId))->with($notification);
    }

    public function designedestroy(string $id)
    {
        CustomizeProductOption::where('id',$id)->delete();
        $notification = array(
            'message' => 'Customize Option destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('admin.product.item.attributecreate',compact('id'));
    }
    
    public function optioncreate($id)
    {
        $attributes = Attribute::all();
        return view('admin.product.item.attributeoptioncreate',compact('attributes','id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        $attribute = new Attribute();
        $attribute->name = $request->name;
        $attribute->save();

        $notification = array(
            'message' => 'Attribute Add Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('product.attribute',$id))->with($notification);
    }

    public function optionstore(Request $request,$id)
    {
        $this->validate($request,[
            'attribute_id' => 'required',
            'value' => 'required',
            'price' => 'required|numeric'
        ]);
        $attribute = new AttributeOption();
        $attribute->attribute_id = $request->attribute_id;
        $attribute->value = $request->value;
        $attribute->price = $request->price;
        $attribute->save();

        $product = Product::find($id); // Replace with the selected attribute option IDs
        // $product->attributeOptions()->sync($attribute->id);

        if (!$product->attributeOptions->contains($attribute->id)) {
            // Attach the new AttributeOption to the product
            $product->attributeOptions()->attach($attribute->id);
        }

        if (!$product->attribute->contains($request->attribute_id)) {
            // Attach the new AttributeOption to the product
            $product->attribute()->attach($request->attribute_id);
        }
        $notification = array(
            'message' => 'Attribute Option Add Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('product.attribute.option',$id))->with($notification);
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
    public function edit($productId,string $id)
    {
        $attribute = Attribute::find($id);
        return view('admin.product.item.attributeedit',compact('attribute','productId'));
    }

    public function editoption($productId,string $id)
    {
        $option = AttributeOption::find($id);
        $attributes = Attribute::all();
        return view('admin.product.item.attributeoptionedit',compact('option','attributes','productId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $productId, string $id)
    {
        $this->validate($request,[
            'name' => 'required|min:3'
        ]);
        $attribute = Attribute::find($id);
        $attribute->name = $request->name;
        $attribute->save();

        $notification = array(
            'message' => 'Attribute Update Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('product.attribute',$productId))->with($notification);
    }

    public function optionupdate(Request $request, $productId, string $id)
    {
        $this->validate($request,[
            'attribute_id' => 'required',
            'value' => 'required',
            'price' => 'required|numeric'
        ]);
        $attribute = AttributeOption::find($id);
        $attribute->attribute_id = $request->attribute_id;
        $attribute->value = $request->value;
        $attribute->price = $request->price;
        $attribute->save();

        $product = Product::find($productId); // Replace with the selected attribute option IDs

        if (!$product->attributeOptions->contains($attribute->id)) {
            // Attach the new AttributeOption to the product
            $product->attributeOptions()->attach($attribute->id);
        }

        if (!$product->attribute->contains($request->attribute_id)) {
            // Attach the new AttributeOption to the product
            $product->attribute()->attach($request->attribute_id);
        }

        $notification = array(
            'message' => 'Attribute Option Update Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('product.attribute.option',$productId))->with($notification);
    }

    public function connect($productId, string $id){
        $product = Product::find($productId); // Replace with the selected attribute option IDs
        $attribute = AttributeOption::find($id);
        if (!$product->attributeOptions->contains($id)) {
            // Attach the new AttributeOption to the product
            $product->attributeOptions()->attach($id);
        }

        if (!$product->attribute->contains($attribute->attribute_id)) {
            // Attach the new AttributeOption to the product
            $product->attribute()->attach($attribute->attribute_id);
        }

        $notification = array(
            'message' => 'Attribute Option attach with Product!', 
            'alert-type' => 'success',
        );
        return redirect(route('product.attribute.option',$productId))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Attribute::where('id',$id)->delete();
        $notification = array(
            'message' => 'Attribute destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }

    public function optiondestroy(string $id)
    {
        AttributeOption::where('id',$id)->delete();
        $notification = array(
            'message' => 'Attribute Option destroy.', 
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }
}
