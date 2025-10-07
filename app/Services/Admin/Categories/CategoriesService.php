<?php

namespace App\Services\Admin\Categories;

use App\Models\Categories\Categories;
use App\Services\Admin\ImageService;
use Illuminate\Support\Facades\Storage;

class CategoriesService
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function getCategoryById($id)
    {
        return Categories::findOrFail($id);
    }

    public function getAllCategories()
    {
        return Categories::with('children')->orderBy('id','DESC')->get();
    }

    public function getActiveCategories()
    {
        return Categories::active()->with('children')->orderBy('id','DESC')->get();
    }

    public function getCategoriesWithChildren($id)
    {
        return Categories::with('children')->childrenOf($id)->get();
    }

    public function getParentCategories()
    {
        return Categories::parent()->get();
    }

    public function getParentCatWithoutThisCategory($excludeId)
    {
        return Categories::parent()->withoutCategory($excludeId)->get();
    }

    public function createCategory(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->imageService->storeSingleImage($data['image'], 'categories', null, 600, 600);
        }

        return Categories::create($data);
    }

    public function toggleCategoryStatus($id)
    {
        $category = $this->getCategoryById($id);
        $category->status = !$category->status;
        $category->save();

        return $category;
    }

    public function updateCategory($id, array $data)
    {
        $category = $this->getCategoryById($id);
        if(empty($data['parent_id'])){
            $data['parent_id'] = null;
        }
        if (isset($data['image'])) {
            // Delete old image from storage
            if ($category->image && Storage::disk('public')->exists('categories/' . $category->image)) {
                Storage::disk('public')->delete('categories/' . $category->image);
            }
            
            $data['image'] = $this->imageService->storeSingleImage($data['image'], 'categories', null, 600, 600);
        }

        $category->update($data);

        return $category;
    }

    public function deleteCategory($id)
    {
        $category = $this->getCategoryById($id);

        // Delete image from storage
        if ($category->image && Storage::disk('public')->exists('categories/' . $category->image)) {
            Storage::disk('public')->delete('categories/' . $category->image);
        }

        // Optionally, handle deletion of subcategories or reassign them
        Categories::where('parent_id', $id)->update(['parent_id' => null]);

        return $category->delete();
    }
}
