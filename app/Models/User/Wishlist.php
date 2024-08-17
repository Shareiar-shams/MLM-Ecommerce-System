<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LamaLama\Wishlist\Wishlistable;

class Wishlist extends Model
{
    use HasFactory, Wishlistable;
}
