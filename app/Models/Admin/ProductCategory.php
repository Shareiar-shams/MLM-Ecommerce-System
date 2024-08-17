<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['parent_id', 'name','slug'];

    public function children()
    {
        return $this->hasMany('App\Models\Admin\ProductCategory', 'parent_id');
    } 
    public function products()
    {
        return $this->hasMany('App\Models\Admin\Product', 'category_id');
    }

    public function chindrenproducts()
    {
        return $this->hasMany('App\Models\Admin\Product', 'subcategory_id');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
