<?php

namespace App\Models\Translation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Translation extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['source_text', 'locale', 'translated_text'];
}