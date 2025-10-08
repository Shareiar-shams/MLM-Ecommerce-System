<?php

namespace App\Services\Admin\ProductType;

use App\Models\ProductType\ProductType;

class TypeService
{
    /**
     * Retrieve all product types.
     */
    public function getAllTypes()
    {
        return ProductType::orderBy('id', 'DESC')->get();
    }

    /**
     * Create a new product type.
     */
    public function createType($request)
    {
        return ProductType::create($request->all());
    }

    /**
     * Restore a type by ID.
     */
    public function restoreById(int $id): bool
    {
        $type = ProductType::withTrashed()->find($id);
        return $type ? $type->restore() : false;
    }

    /**
     * Restore all soft-deleted types.
     */
    public function restoreAll(): int
    {
        return ProductType::onlyTrashed()->restore();
    }

    /**
     * Change the status of a type by ID.
     */
    public function changeStatus($id)
    {
        $type = $this->getTypeById($id);
        if ($type) {
            $type->status = !$type->status;
            $type->save();
            return $type;
        }
        return null;
    }

    /**
     * Get a type by ID.
     */
    public function getTypeById($id)
    {
        return ProductType::find($id);
    }

    /**
     * Update a type by ID.
     */
    public function updateType($request, $id)
    {
        $type = $this->getTypeById($id);
        if ($type) {
            $type->update($request->all());
            return $type;
        }
        return null;
    }

    /**
     * Soft delete a type by ID.
     */
    public function deleteType($id)
    {
        $type = $this->getTypeById($id);
        if ($type) {
            return $type->delete();
        }
        return false;
    }

    /**
     * Permanently delete a type by ID.
     */
    public function forceDeleteById(int $id): bool
    {
        $type = ProductType::withTrashed()->find($id);
        return $type ? $type->forceDelete() : false;
    }
    
}
