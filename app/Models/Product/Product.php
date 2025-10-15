<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product\Mutators\ProductMutators;
use App\Models\Product\Accessors\ProductAccessors;
use App\Models\Product\Relations\ProductRelations;
use App\Models\Product\Scopes\ProductScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\Administration\Product\ProductObserver;
use App\Traits\HasImage;

#[ObservedBy([ProductObserver::class])]
class Product extends Model
{
    use HasFactory, HasImage, SoftDeletes;

    // Relations
    use ProductRelations;

    // Accessors & Mutators
    use ProductAccessors, ProductMutators;

    // Scopes
    use ProductScopes;

    //Primary Key
    public $primaryKey = 'id';

    //Timestamps
    public $timestamps = true;

    protected $casts = [
        'tags' => 'array',
        'specifications' => 'array',
        'status' => 'boolean',
        'price' => 'decimal:2',
        'special_price' => 'decimal:2',
        'customize_charge' => 'decimal:2',
    ];

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'affiliate_link',
        'featured_image',
        'gallery_image',
        'short_description',
        'description',
        'product_type',
        'tags',
        'specifications',
        'specification_name',
        'specification_data',
        'stock',
        'type_id',
        'category_id',
        'subcategory_id',
        'price',
        'special_price',
        'video_link',
        'meta_keywords',
        'meta_description',
        'customize_charge',
        'status',
    ];

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