<?php

namespace App\Models\Product;

use App\Services\Admin\ImageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['product_id', 'image_path'];
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    /**
     * Get the category's image URL.
     *
     * @return string|null
     */
    public function getImagePathUrlAttribute(): ?string
    {
        $imageService = app(ImageService::class);
        return $this->image_path ? $imageService->getSingleImageUrl('products/gallery', $this->image_path) : asset('images/default-product.png');
    }
}
