<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    use HasFactory;

    protected $fillable = ['name','image','text','data','sandbox','status'];


    //Primary Key

    public $primaryKey = 'id';


    //Timestamps

    public $timestamps = true;
}
