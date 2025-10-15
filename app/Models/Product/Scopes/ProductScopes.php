<?php

namespace App\Models\Product\Scopes;

trait ProductScopes
{
    public function scopeProductType($query, $productType)
    {
        return $query->where('product_type', $productType);
    }

    public function scopeType($query, $typeId)
    {
        return $query->where('type_id', $typeId);
    }
    public function scopeCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
    public function scopeActive($query, $status = 1)
    {
        return $query->where('status', $status);
    }
}