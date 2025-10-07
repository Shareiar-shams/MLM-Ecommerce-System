<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductType\TypeCreateRequest;
use App\Http\Requests\ProductType\TypeUpdateRequest;
use App\Services\Admin\ProductType\TypeService;

class ProductTypeController extends Controller
{
    protected $typeService;
    public function __construct()
    {
        $this->typeService = new TypeService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = $this->typeService->getAllTypes();
        return view('admin.product.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeCreateRequest $request)
    {
        $this->typeService->createType($request);
        $notification = array(
            'message' => 'Type create successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('admin.product.types.index'))->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $type = $this->typeService->getTypeById($id);
        return view('admin.product.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeUpdateRequest $request, string $id)
    {
        $this->typeService->updateType($request, $id);
        $notification = array(
            'message' => 'Type update successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('admin.product.types.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->typeService->deleteType($id);
        $notification = array(
            'message' => 'Type delete successfully!', 
            'alert-type' => 'success',
        );
        return redirect(route('admin.product.types.index'))->with($notification);
    }
}
