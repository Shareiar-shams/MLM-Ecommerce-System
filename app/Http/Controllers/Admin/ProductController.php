<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Services\Admin\Product\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = $this->productService->getTypes();
        $categories = $this->productService->getCategories();
        
        $products = $this->productService->getAll();
        return view('admin.product.item.index', compact('products', 'types', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request)
    {
        $this->productService->create($request->validated());
        $notification = array(
            'message' => 'Product created successfully!', 
            'alert-type' => 'success',
        );
        return redirect()->route('admin.products.item.index')->with($notification);
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
    public function update(ProductUpdateRequest $request, string $id)
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
