<?php

namespace App\Models\Admin;

use App\Models\Admin\ProductCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectedCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','subcategory_id']; // Add other fillable fields if needed

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(ProductCategory::class, 'subcategory_id');
    }
}
