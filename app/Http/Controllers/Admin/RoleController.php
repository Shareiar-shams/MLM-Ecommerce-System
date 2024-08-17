<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:view role', ['only' => ['index']]);
        $this->middleware('permission:create role', ['only' => ['create','store','addPermissionToRole','givePermissionToRole']]);
        $this->middleware('permission:update role', ['only' => ['update','edit']]);
        $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('id','DESC')->get();
        return view('admin.user.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permission = Permission::get();
        return view('admin.user.role.create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'admin'
        ]);
        if(isset($request->all_permission)){
            // Lets give all permission to super-admin role.
            $allPermissionNames = Permission::pluck('name')->toArray();

            $role->givePermissionTo($allPermissionNames);
        }else{

            $role->syncPermissions($request->input('permission'));
            $role->givePermissionTo($request->input('permission'));
        }
        $notification = array(
            'message' => 'Role created successfully', 
            'alert-type' => 'success',
        );
        return redirect(route('roles.index'))->with($notification);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $permissions = Permission::get();
        // $role = Role::findOrFail($roleId);
        // $rolePermissions = DB::table('role_has_permissions')
        //                         ->where('role_has_permissions.role_id', $role->id)
        //                         ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        //                         ->all();

        // return view('role-permission.role.add-permissions', [
        //     'role' => $role,
        //     'permissions' => $permissions,
        //     'rolePermissions' => $rolePermissions
        // ]);

        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('admin.user.role.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('admin.user.role.edit',compact('role','permission','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
        
        $notification = array(
            'message' => 'Role updated successfully', 
            'alert-type' => 'success',
        );
        return redirect(route('roles.index'))->with($notification);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {

        DB::table("roles")->where('id',$id)->delete();
        $notification = array(
            'message' => 'Role deleted successfully', 
            'alert-type' => 'error',
        );
        return redirect(route('roles.index'))->with($notification);
    }
}
