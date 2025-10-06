<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CategoryCreateRequest;
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
        $categories = Categories::with('children')->whereNull('parent_id')->orderBy('id','DESC')->get();
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
        return view('admin.product.categories.create');
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
        return redirect(route('categories.index'))->with($notification);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
