<?php

namespace App\Services\Admin\ProductType;

use App\Models\ProductType\ProductType;

class TypeService
{
    public function getAllTypes()
    {
        return ProductType::orderBy('id', 'DESC')->get();
    }

    public function createType($request)
    {
        return ProductType::create($request);
    }

    public function getTypeById($id)
    {
        return ProductType::find($id);
    }

    public function updateType($request, $id)
    {
        $type = $this->getTypeById($id);
        if ($type) {
            $type->update($request->all());
            return $type;
        }
        return null;
    }
    public function deleteType($id)
    {
        $type = $this->getTypeById($id);
        if ($type) {
            return $type->delete();
        }
        return false;
    }
}
