<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderedItem extends Model
{
    use HasFactory;
    //Table Name

    protected $table = 'ordered_items';

    //Primary Key

    public $primaryKey = 'id';


    //Timestamps

    public $timestamps =true;

    public function order(){         
        return $this->belongsTo('App\Models\Admin\Order');   

    }
    public function product(){
        return $this->belongsTo('App\Models\Admin\Product','product_id');   

    }
}
