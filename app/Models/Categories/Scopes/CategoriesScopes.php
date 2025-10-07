<?php

namespace App\Models\Categories\Scopes;

trait CategoriesScopes
{
    /**
     * Scope a query to only include root categories (no parent).
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }

    // --- Scope for active categories ---
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // --- Scope for excluding specific category ---
    public function scopeWithoutCategory($query, $excludeId)
    {
        return $query->where('id', '!=', $excludeId);
    }

    // --- Scope for children of a given parent ---
    public function scopeChildrenOf($query, $parentId)
    {
        return $query->where('parent_id', $parentId);
    }

    /**
     * Scope a query to only include subcategories (have parent).
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSubcategories($query)
    {
        return $query->whereNotNull('parent_id');
    }

    /**
     * Scope a query to order by sort order.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('name', 'asc');
    }

    /**
     * Scope a query to only include categories with products.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithProducts($query)
    {
        return $query->has('products');
    }
}