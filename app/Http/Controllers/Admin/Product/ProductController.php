<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product\Product;
use App\Services\Admin\Product\ProductService;
use Illuminate\Http\Request;
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
    public function index(Request $request)
    {
        $types = $this->productService->getTypes();
        $categories = $this->productService->getCategories();
        
        $products = $this->productService->getAll($request->all());
        return view('admin.product.item.index', compact('products', 'types', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->productService->getCategories();
        $types = $this->productService->getTypes();
        return view('admin.product.item.create', compact('categories', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request)
    {
        $data = $request->validated();
        $data['featured_image'] = $request->file('featured_image');
        $this->productService->create($data);
        $notification = array(
            'message' => 'Product created successfully!', 
            'alert-type' => 'success',
        );
        return redirect()->route('admin.product.item.index')->with($notification);
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
    public function edit(Product $product)
    {
        $categories = $this->productService->getCategories();
        $types = $this->productService->getTypes();
        return view('admin.product.item.edit', compact('categories', 'types' ,'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
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
