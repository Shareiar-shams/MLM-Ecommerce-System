<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany('App\Models\Admin\Product', 'type_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
