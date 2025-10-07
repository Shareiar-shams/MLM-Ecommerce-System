<?php

namespace App\Models\Categories\Accessors;

use App\Services\Admin\ImageService;

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
     * Get the plain text version of the description
     */
    public function getDecodedDescriptionAttribute(): ?string
    {
        if (!$this->description) {
            return null;
        }
        
        // First decode HTML entities
        $decoded = htmlspecialchars_decode($this->description);
        // Strip HTML tags and convert line breaks to spaces
        $plainText = strip_tags(str_replace(['<br>', '<br/>', '<br />', "\n", "\r"], ' ', $decoded));
        // Remove extra whitespace
        return preg_replace('/\s+/', ' ', trim($plainText));
    }

    /**
     * Get the HTML version of the description
     */
    public function getHtmlDescriptionAttribute(): ?string
    {
        return $this->description
            ? htmlspecialchars_decode($this->description)
            : null;
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
        $imageService = app(ImageService::class);
        return $this->image ? $imageService->getSingleImageUrl('categories', $this->image) : asset('images/default-category.png');
    }
}