<?php

namespace App\Models\ProductType;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProductType\Mutators\ProductTypeMutators;
use App\Models\ProductType\Accessors\ProductTypeAccessors;
use App\Models\ProductType\Relations\ProductTypeRelations;
use App\Models\ProductType\Scopes\ProductTypeScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\Administration\ProductType\ProductTypeObserver;

#[ObservedBy([ProductTypeObserver::class])]
class ProductType extends Model
{
    use HasFactory, SoftDeletes;

    // Relations
    use ProductTypeRelations;

    // Accessors & Mutators
    use ProductTypeAccessors, ProductTypeMutators;

    // Scopes
    use ProductTypeScopes;

    protected $casts = [];

    /** The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    // Mass Assignable attributes
    protected $fillable = ['name', 'slug', 'status'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}