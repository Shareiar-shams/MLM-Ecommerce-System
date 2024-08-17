<?php

namespace App\Models\Admin;

use App\Models\Admin\AttributeOption;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
 
    public function attributeOptions(): HasMany
    {
        return $this->hasMany(AttributeOption::class);
    }
}
