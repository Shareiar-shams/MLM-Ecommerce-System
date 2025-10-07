<?php

namespace App\Observers\Administration\ProductType;

use App\Models\ProductType\ProductType;

class ProductTypeObserver
{
    /**
     * Handle the ProductType "created" event.
     */
    public function created(ProductType $productType): void
    {
        //
    }

    /**
     * Handle the ProductType "updated" event.
     */
    public function updated(ProductType $productType): void
    {
        //
    }

    /**
     * Handle the ProductType "deleted" event.
     */
    public function deleted(ProductType $productType): void
    {
        //
    }

    /**
     * Handle the ProductType "restored" event.
     */
    public function restored(ProductType $productType): void
    {
        //
    }

    /**
     * Handle the ProductType "force deleted" event.
     */
    public function forceDeleted(ProductType $productType): void
    {
        //
    }
}
