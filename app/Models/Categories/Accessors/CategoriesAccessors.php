<?php

namespace App\Models\Categories\Accessors;

trait CategoriesAccessors
{
    /**
     * Get the category's display name.
     *
     * @return string
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name ?? 'Unnamed Category';
    }

    /**
     * Get the category's full path (parent > child).
     *
     * @return string
     */
    public function getFullPathAttribute(): string
    {
        if ($this->parent) {
            return $this->parent->name . ' > ' . $this->name;
        }
        return $this->name;
    }

    /**
     * Get the category's level (0 for root, 1 for subcategory, etc.).
     *
     * @return int
     */
    public function getLevelAttribute(): int
    {
        if (!$this->parent_id) {
            return 0;
        }
        return $this->parent->level + 1;
    }

    /**
     * Get the category's image URL.
     *
     * @return string|null
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}