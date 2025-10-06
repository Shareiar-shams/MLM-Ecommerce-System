<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminThemeSetting extends Model
{
    protected $fillable = ['admin_id', 'settings'];

    protected $casts = [
        'settings' => 'array'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}