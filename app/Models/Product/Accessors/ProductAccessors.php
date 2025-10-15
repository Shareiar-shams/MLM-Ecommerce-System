<?php

namespace App\Models\Product\Accessors;

use App\Services\Admin\ImageService;

trait ProductAccessors
{
    /**
     * Get the category's image URL.
     *
     * @return string|null
     */
    public function getFeatureImageAttribute(): ?string
    {
        $imageService = app(ImageService::class);
        return $this->featured_image ? $imageService->getSingleImageUrl('products/featured', $this->featured_image) : asset('images/default-product.png');
    }
}