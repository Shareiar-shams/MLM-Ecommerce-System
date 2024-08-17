<?php

namespace App\Models\Admin;

use App\Models\Admin\DigitalProduct;
use App\Models\Admin\Transection;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Your other properties and methods for the Order model

    public function transactions()
    {
        return $this->hasOne(Transection::class);
    }

    public function digitalProduct()
    {
        return $this->belongsTo(DigitalProduct::class,'digitalProdcut_id','id');
    }

    public function orderproduct(){
        return $this->hasMany('App\Models\User\OrderedItem');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
