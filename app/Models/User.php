<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Admin\Message;
use App\Models\Admin\Mlmuser;
use App\Models\Admin\Order;
use App\Models\Admin\Transection;
use App\Models\User\BkashPaySessionData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Coderflex\LaravelTicket\Concerns\HasTickets;
use Coderflex\LaravelTicket\Contracts\CanUseTickets;
use LamaLama\Wishlist\HasWishlists;

class User extends Authenticatable implements CanUseTickets
{
    use HasApiTokens, HasFactory, Notifiable, HasTickets, HasWishlists;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'facebook_id', 
        'google_id',
        'status',
        'phone',
        'referrer_id',
        'user_type',
        'others',
        'link',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function mlmUser()
    {
        return $this->hasOne(Mlmuser::class);
    }

    public function bkashSession()
    {
        return $this->hasOne(BkashPaySessionData::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transection::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
    * Get the reviews the user has made.
    */
    public function reviews()
    {
        return $this->hasMany('App\Models\Admin\Review');
    }
}
