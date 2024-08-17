<?php

namespace App\Models\Admin;

use App\Models\Admin\Offer;
use App\Models\Admin\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferProduct extends Model
{
    use HasFactory;

    protected $table = 'offer_products';
    public $timestamps = true;

    // public function offer()
    // {
    //     return $this->belongsTo(Offer::class);
    // }

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }
}
