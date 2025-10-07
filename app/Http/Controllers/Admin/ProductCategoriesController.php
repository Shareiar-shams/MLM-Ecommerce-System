<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CategoryCreateRequest;
use App\Http\Requests\Categories\CategoryUpdateRequest;
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
        $categories = $this->categoriesService->getAllCategories();
        return view('admin.product.categories.index',compact('categories'));
    }

    /**
     * Handle subcategories request.
     */
    public function subcategories(Request $request)
    {
        $subcategories = $this->categoriesService->getCategoriesWithChildren($request->parent_id);
        return response()->json([
            'subcategories' => $subcategories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoriesService->getParentCategories();
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
        $this->categoriesService->toggleCategoryStatus($id);
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
        $category =  $this->categoriesService->getCategoryById($id);
        $categories = $this->categoriesService->getParentCatWithoutThisCategory($category->id);
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
