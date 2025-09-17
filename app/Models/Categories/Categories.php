<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Categories\Mutators\CategoriesMutators;
use App\Models\Categories\Accessors\CategoriesAccessors;
use App\Models\Categories\Relations\CategoriesRelations;
use App\Models\Categories\Scopes\CategoriesScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\Administration\Categories\CategoriesObserver;

#[ObservedBy([CategoriesObserver::class])]
class Categories extends Model
{
    use HasFactory, SoftDeletes;

    // Relations
    use CategoriesRelations;

    // Accessors & Mutators
    use CategoriesAccessors, CategoriesMutators;

    // Scopes
    use CategoriesScopes;

    protected $casts = [];

    protected $fillable = [];
}