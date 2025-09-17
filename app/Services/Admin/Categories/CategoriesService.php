<?php

namespace App\Services\Admin\Categories;

use App\Services\Admin\ImageService;

class CategoriesService
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

}
