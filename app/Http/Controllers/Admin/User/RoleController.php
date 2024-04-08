<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRoleRequest;
use App\Http\Requests\Admin\User\UpdatePermissionRequest;
use App\Http\Requests\Admin\User\UpdateRoleRequest;
use App\Models\User\Permission;
use App\Models\User\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles= Role::all();
        return view('admin.user.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.user.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $inputs= $request->all();
        $role= Role::create($inputs);

        $inputs['permissions']= $inputs['permissions'] ?? [];
        $role->permissions()->sync($inputs['permissions']);

        return redirect()->route('admin.user.role.index')->with('swal-success','نقش مورد نظر با موفقیت ایجاد شد');
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
    public function edit(Role $role)
    {
        $permissions= Permission::all();
        return view('admin.user.role.edit', compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $inputs= $request->all();
        $role->update($inputs);
        return redirect()->route('admin.user.role.index')->with('swal-success','نقش مورد نظر با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.user.role.index')->with('swal-success','نقش مورد نظر با موفقیت حذف شد');
    }

    public function permission(Role $role){

        $permissions= Permission::all();
        return view('admin.user.role.permission', compact('permissions','role'));

    }

    public function updatePermission(UpdatePermissionRequest $request , Role $role){

        $inputs= $request->all();
        $inputs['permissions']= $inputs['permissions'] ?? [];
        $role->permissions()->sync($inputs['permissions']);
        return redirect()->route('admin.user.role.index')->with('swal-success','دسترسی های نقش مورد نظر با موفقیت ویرایش شد');

    }
}
