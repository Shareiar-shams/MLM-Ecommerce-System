<?php

namespace App\Models\Admin;

use App\Models\Admin\Offer;
use App\Models\Admin\Product;
use App\Models\Admin\Transection;
use App\Models\User;
use App\Models\User\MlmuserProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mlmuser extends Model
{
    use HasFactory;

    //Table Name

    protected $table = 'mlmusers';

    //Primary Key

    public $primaryKey = 'id';


    //Timestamps

    public $timestamps =true;

    public function user()
    {
        return $this->belongsTo(User::class); 
    }

    public function parent_user()
    {
        return $this->belongsTo(User::class, 'parent_id', 'id');
    }

    public function refferer_user()
    {
        return $this->belongsTo(User::class, 'refferer_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Mlmuser::class, 'parent_id', 'user_id');
    }

    // Relationship: Recursive Parent (parent of user)
    public function recursiveParents()
    {
        return $this->children()->with('recursiveParents');
    }

    public function refererchildren()
    {
        return $this->hasMany(Mlmuser::class, 'refferer_id', 'user_id');
    }

    // Relationship: Recursive Referrals (Referrals of Referrals)
    public function recursiveReferrals()
    {
        return $this->refererchildren()->with('recursiveReferrals');
    }


    public function transaction()
    {
        return $this->hasOne(Transection::class,'mlmuser_id','id');
    }

    public function messagesSent()
    {
        return $this->morphMany(Message::class, 'sender');
    }

    public function messagesReceived()
    {
        return $this->morphMany(Message::class, 'receiver');
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'offer__mlmusers');
    }

    // Offer.php
    public function MlmuserProducts()
    {
        return $this->hasMany(MlmuserProduct::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'mlmuser_products')->withPivot('id');
    }
}
