<?php

namespace App\Services\Admin\Product;

use App\Models\Categories\Categories;
use App\Models\Product\Product;
use App\Models\Product\ProductImage;
use App\Models\ProductType\ProductType;
use App\Services\Admin\ImageService;
use Illuminate\Support\Str;

class ProductService
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function getAll(array $request)
    {
        $products = Product::query();

        if (isset($request['productType'])) {
            $products->productType($request['productType']);
        }

        if (isset($request['is_type'])) {
            $products->type($request['is_type']);
        }
        if (isset($request['category'])) {
            $products->category($request['category']);
        }

        if (isset($request['status'])) {
            $products->active($request['status']);
        }

        $products = $products->get();
        return $products;
    }

    public function getById($id)
    {
        return Product::findOrFail($id);
    }

    public function getTypes()
    {
        return ProductType::active()->get();
    }

    public function getCategories()
    {
        return Categories::active()->get();
    }
    public function create(array $data)
    {
        // Handle type creation or retrieval
        $data['type_id'] = $this->resolveType($data['type_id']);

        // Handle featured image upload
        if (isset($data['featured_image']) && $data['featured_image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['featured_image'] = $this->imageService->storeSingleImage($data['featured_image'], 'products/featured');
        }

        $data['product_type'] = $data['product_type'] ?? 'physical';
        // Prepare JSON-encoded fields
        $data['tags'] = $this->encodeJson($data['tags']);
        // Build specifications as JSON array
        $data['specification_data'] = $this->combineSpecifications(
            $data['specification_name'],
            $data['specification_description']
        );
        $data['specifications'] = isset($data['specifications'])
            ? ($data['specifications'] ? 1 : 0)
            : 0;
            
        // JSON-encode it before saving
        $data['specification_data'] = json_encode($data['specification_data']);
        // Build meta keywords as JSON array
        $data['meta_keywords'] = $this->encodeJson($data['meta_keywords']);

        // Create the product
        $product = Product::create($data);
        // Handle gallery images uploadAndResize
        if (isset($data['gallery_image']) && is_array($data['gallery_image'])) {
            foreach ($data['gallery_image'] as $image) {
                $galleryPaths = $this->imageService->storeSingleImage($image, 'products/gallery');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $galleryPaths,
                ]);
            }
        }
        return $product;
        
    }

    /**
     * Handle dynamic type creation or fetch existing type ID.
     */
    private function resolveType($typeInput)
    {
        // If numeric, assume it's an existing type_id
        if (is_numeric($typeInput)) {
            return (int) $typeInput;
        }

        // Otherwise, treat as a new name
        $name = trim($typeInput);
        if ($name === '') {
            throw new \Exception('Invalid type name.');
        }

        // Generate slug like your JS function
        $slug = Str::slug($name, '-');

        // Check existing by name or slug (case-insensitive)
        $existing = ProductType::whereRaw('LOWER(name) = ?', [strtolower($name)])
            ->orWhere('slug', $slug)
            ->first();
        if ($existing) {
            return $existing->id;
        }

        // Create new
        $newType = ProductType::create([
            'name' => $name,
            'slug' => $slug,
            'status' => true,
        ]);
        return $newType->id;
    }

    /**
     * Helper to safely JSON encode nullable values.
     */
    private function encodeJson($value)
    {
        return isset($value) ? json_encode($value) : null;
    }

    /**
     * Combine specification name & description into an array of objects.
     */
    private function combineSpecifications($names, $descriptions)
    {
        if (!is_array($names) || !is_array($descriptions)) {
            return [];
        }

        $specifications = [];

        foreach ($names as $index => $name) {
            if (!empty($name) || !empty($descriptions[$index] ?? null)) {
                $specifications[] = [
                    'name' => $name,
                    'description' => $descriptions[$index] ?? null,
                ];
            }
        }

        return $specifications;
    }

}