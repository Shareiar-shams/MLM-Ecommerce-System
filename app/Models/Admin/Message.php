<?php

namespace App\Models\Admin;

use App\Models\Admin\Mlmuser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

Relation::enforceMorphMap([
    'admin'=>'App\Models\Admin\Admin',
    'mlmuser'=>'App\Models\Admin\Mlmuser',
]);
class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_type',
        'sender_id',
        'receiver_type',
        'receiver_id',
        'message',
    ];

    public function mlmuser()
    {
        return $this->belongsTo(Mlmuser::class, 'sender_id', 'id');
    }

    public function sender()
    {
        return $this->morphTo();
    }

    public function receiver()
    {
        return $this->morphTo();
    }
}
