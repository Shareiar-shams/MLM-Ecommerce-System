<?php

namespace App\Models\Admin;

use App\Models\Admin\DigitalProduct;
use App\Models\Admin\Mlmuser;
use App\Models\Admin\OfferProduct;
use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    public function digitalProduct()
    {
        return $this->belongsTo(DigitalProduct::class);
    }

    public function mlmUsers()
    {
        return $this->belongsToMany(Mlmuser::class, 'offer__mlmusers');
    }

    // Offer.php
    public function offerProducts()
    {
        return $this->hasMany(OfferProduct::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'offer_products')->withPivot('id','status', 'index');
    }
}
