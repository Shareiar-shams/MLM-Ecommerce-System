<?php

namespace App\Models\Product\Relations;

use App\Models\Categories\Categories;
use App\Models\Product\AttributeValue;
use App\Models\Product\ProductImage;
use App\Models\Product\ProductVariation;
use App\Models\ProductType\ProductType;

trait ProductRelations
{
    /**
     * Get the type that owns the product.
     */
    public function type() {
        return $this->belongsTo(ProductType::class);
    }

    /**
     * Get the category that owns the product.
     */
    public function category() {
        return $this->belongsTo(Categories::class);
    }

    /**
     * Get the subcategory that owns the product.
     */
    public function subCategory()
    {
        return $this->belongsTo(Categories::class, 'subcategory_id');
    }

    /**
     * Get all of the product's images.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get all of the product's variations.
     */
    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    /**
     * The attribute values that belong to the product.
     */
    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_values');
    }
}