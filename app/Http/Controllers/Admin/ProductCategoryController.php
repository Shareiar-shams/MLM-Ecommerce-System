<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:mange categories', ['only' => ['index','create','store','edit','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategory::with('children')->whereNull('parent_id')->orderBy('id','DESC')->get();
        return view('admin.product.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate($request,[
            'name'      => 'required|min:3|max:255|string',
            'slug'      => 'required|min:3|max:255|string|unique:product_categories',
            'parent_id' => 'sometimes|nullable|numeric',
        ]);
        ProductCategory::create($validatedData);       
        $notification = array(
            'message' => 'Category create successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('categories.index'))->with($notification);
    }

    public function subCat(Request $request)
    {
         
        $parent_id = $request->parent_id;
         
        $subcategories = ProductCategory::where('parent_id',$parent_id)->with('children')->get();
        return response()->json([
            'subcategories' => $subcategories
        ]);
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
        $validatedData = $this->validate($request, [
            'name'  => 'required|min:3|max:255|string',
            'slug'      => 'required|min:3|max:255|string',
            'parent_id' => 'sometimes|nullable|numeric',
        ]);

        ProductCategory::where('id',$id)->update($validatedData);
        $notification = array(
                'message' => 'Category Updated Successfully!', 
                'alert-type' => 'success',
            );
        return redirect(route('categories.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = ProductCategory::find($id);
        if ($category->children) {
            // foreach ($category->children()->with('products')->get() as $child) {
            //     foreach ($child->products as $product) {
            //         // product::where('category_id',$id)->update(['category_id' => NULL]);
            //     }
            // }
            
            $category->children()->delete();
        }

        // foreach ($category->products as $product) {
        //     // $product->update(['category_id' => NULL]);
        //     product::where('category_id',$id)->update(['category_id' => NULL]);
        // }

        $category->delete();

        $notification = array(
            'message' => 'Category Delete Successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('categories.index'))->with($notification);
    }
}
