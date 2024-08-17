<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug','text','meta_keywords','meta_descriptions','status'
    ];

    public function faq()
    {
        return $this->hasMany('App\Models\Admin\Faq', 'category_id');
    }
}
