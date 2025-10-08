<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeValue extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['attribute_id','value'];

    public function attribute()
    {
    return $this->belongsTo(Attribute::class);
    }


    public function products()
    {
    return $this->belongsToMany(Product::class, 'product_attribute_values');
    }


    public function variations()
    {
    return $this->belongsToMany(ProductVariation::class, 'product_variation_values');
    }
}
