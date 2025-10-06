<?php

namespace App\Services\Admin\Categories;

use App\Models\Categories\Categories;
use App\Services\Admin\ImageService;

class CategoriesService
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function createCategory(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->imageService->storeSingleImage($data['image'], 'categories');
        }

        return Categories::create($data);
    }

}
