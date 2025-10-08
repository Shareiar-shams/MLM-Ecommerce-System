<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['product_id','sku','price','stock','image'];

    public function product()
    {
    return $this->belongsTo(Product::class);
    }


    public function values()
    {
    return $this->belongsToMany(AttributeValue::class, 'product_variation_values');
    }
}
