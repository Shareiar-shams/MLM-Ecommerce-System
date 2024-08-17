<?php

namespace App\Models\Admin;

use App\Models\Admin\FaqCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','category_id','description'
    ];

    public function category() {
        return $this->belongsTo(FaqCategory::class);
    }
}
