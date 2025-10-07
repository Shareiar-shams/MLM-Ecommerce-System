<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CategoryCreateRequest;
use App\Http\Requests\Categories\CategoryUpdateRequest;
use App\Models\Categories\Categories;
use App\Services\Admin\Categories\CategoriesService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
    protected $categoriesService;

    public function __construct(CategoriesService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = Categories::with('children')->orderBy('id','DESC')->get();
        return view('admin.product.categories.index',compact('categories'));
    }

    /**
     * Handle subcategories request.
     */
    public function subcategories(Request $request)
    {
        $parent_id = $request->parent_id;
         
        $subcategories = Categories::where('parent_id',$parent_id)->with('children')->get();
        return response()->json([
            'subcategories' => $subcategories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::whereNull('parent_id')->get();
        return view('admin.product.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request)
    {
        $this->categoriesService->createCategory($request->validated());
        $notification = array(
            'message' => 'Category create successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('admin.product.categories'))->with($notification);
    }

    /**
     * Update category status
     */
    public function status($id)
    {
        $category = Categories::findOrFail($id);
        $category->status = !$category->status;
        $category->save();

        $notification = array(
            'message' => 'Category status updated successfully!', 
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
        $category =  Categories::findOrFail($id);
        $categories = Categories::whereNull('parent_id')->where('id', '!=', $category->id)->get();
        return view('admin.product.categories.edit', compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
        $this->categoriesService->updateCategory($id, $request->validated());
        $notification = array(
            'message' => 'Category update successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('admin.product.categories'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->categoriesService->deleteCategory($id);
        $notification = array(
            'message' => 'Category delete successfully!', 
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
