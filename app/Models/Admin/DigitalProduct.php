<?php

namespace App\Models\Admin;

use App\Models\Admin\Offer;
use App\Models\Admin\Transection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalProduct extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug','SKU','featured_image','desc','price','status','delivery_type','delivery_entity'];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    //Primary Key

    public $primaryKey = 'id';


    //Timestamps

    public $timestamps =true;

    public function offer()
    {
        return $this->hasOne(Offer::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transection::class, 'digitalProdcut_id', 'id');
    }
}
