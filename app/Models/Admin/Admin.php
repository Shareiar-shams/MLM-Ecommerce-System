<?php

namespace App\Models\Admin;

use App\Models\Admin\Message;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Admin as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = 'admins';
    protected $guard = 'admin';
    protected $fillable = [
        'name', 'email', 'phone', 'password','image','position','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function messagesSent()
    {
        return $this->morphMany(Message::class, 'sender');
    }

    public function messagesReceived()
    {
        return $this->morphMany(Message::class, 'receiver');
    }
}
