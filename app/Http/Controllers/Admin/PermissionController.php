<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:view permission|create permission|update permission|delete permission', ['only' => ['index','store']]);
         $this->middleware('permission:create permission', ['only' => ['create','store']]);
         $this->middleware('permission:update permission', ['only' => ['edit','update']]);
         $this->middleware('permission:delete permission', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::orderBy('id','DESC')->get();
        return view('admin.user.permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);
    
        $permission = Permission::create([
            'name' => $request->input('name'),
            'guard_name' => 'admin'
        ]);

        $notification = array(
            'message' => 'Permission created successfully', 
            'alert-type' => 'success',
        );
        return redirect(route('permissions.index'))->with($notification);

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
    public function edit($id): View
    {
        $permission = Permission::find($id);
        return view('admin.user.permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
    
        $permission = Permission::find($id);
        $permission->name = $request->name;
        // $permission->guard_name = $request->guard_name;
        $permission->save();

        $notification = array(
            'message' => 'Permission updated successfully', 
            'alert-type' => 'success',
        );
        return redirect(route('permissions.index'))->with($notification);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {

        DB::table("permissions")->where('id',$id)->delete();
        $notification = array(
            'message' => 'Permission deleted successfully', 
            'alert-type' => 'error',
        );
        return redirect(route('permissions.index'))->with($notification);
    }
}
