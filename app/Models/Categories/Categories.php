<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Categories\Mutators\CategoriesMutators;
use App\Models\Categories\Accessors\CategoriesAccessors;
use App\Models\Categories\Helpers\CategoriesHelpers;
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

    // Helpers
    use CategoriesHelpers;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'image',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'parent_id' => 'integer',
        'status' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}