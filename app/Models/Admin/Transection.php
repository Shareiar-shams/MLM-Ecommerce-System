<?php

namespace App\Models\Admin;

use App\Models\Admin\DigitalProduct;
use App\Models\Admin\Mlmuser;
use App\Models\Admin\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transection extends Model
{
    use HasFactory;
    public function mlmuser()
    {
        return $this->belongsTo(Mlmuser::class,'user_id','user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function digitalProduct()
    {
        return $this->belongsTo(DigitalProduct::class);
    }

    // Your other properties and methods for the Transaction model

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
