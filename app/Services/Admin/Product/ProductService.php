<?php

namespace App\Services\Admin\Product;

use App\Models\Categories\Categories;
use App\Models\Product\Product;
use App\Models\ProductType\ProductType;
use App\Services\Admin\ImageService;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function getAll()
    {
        return Product::all();
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
        // Handle featured image upload
        if (isset($data['featured_image'])) {
            $data['featured_image'] = $this->imageService->uploadAndResize($data['featured_image'], 'products/featured');
        }

        // Handle gallery images uploadAndResize
        if (isset($data['gallery_image']) && is_array($data['gallery_image'])) {
            $galleryPaths = [];
            foreach ($data['gallery_image'] as $image) {
                $galleryPaths[] = $this->imageService->storeSingleImage($image, 'products/gallery');
            }
            $data['gallery_image'] = json_encode($galleryPaths);
        }

        return Product::create($data);
    }

}