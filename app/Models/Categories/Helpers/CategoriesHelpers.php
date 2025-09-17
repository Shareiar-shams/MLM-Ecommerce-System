<?php

namespace App\Models\Categories\Helpers;

trait CategoriesHelpers
{
    /**
     * Check if the category is a root category.
     *
     * @return bool
     */
    public function isRoot(): bool
    {
        return is_null($this->parent_id);
    }

    /**
     * Check if the category is a subcategory.
     *
     * @return bool
     */
    public function isSubcategory(): bool
    {
        return !is_null($this->parent_id);
    }

    /**
     * Check if the category has children.
     *
     * @return bool
     */
    public function hasChildren(): bool
    {
        return $this->children()->exists();
    }
}