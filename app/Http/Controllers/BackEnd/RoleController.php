<?php

namespace App\Http\Controllers\BackEnd;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleSaveRequest;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    //role list
    public function listRole()
    {

        $roles = Role::with('permissions')->get();
        return Inertia::render('BackEnd/Roles/RoleListPage', ['roles' => $roles]);
    }

    //role save page
    public function roleSavePage(Request $request)
    {
        $roleId = $request->role_id;
        $permissions = Permission::all();
        $role = Role::where('id', $roleId)->with('permissions')->first();
        return Inertia::render('BackEnd/Roles/RoleSavePage', ['role' => $role, 'permissions' => $permissions]);
    }

    //create role
    public function createRole(Request $request)
    {
        $role = Role::create([
            'name' => $request->roleName,
        ]);
        $permissionId = array_map('intval', $request->permissions);
        $role->syncPermissions($permissionId);
        return redirect()->back()->with(['status' => true, 'message' => 'Role has been created successfully']);
    }

    //update role
    public function updateRole(RoleSaveRequest $request, $id)
    {

        $role = Role::where('id', $id)->first();
        if ($role->name == 'superadmin') {
            return redirect()->back()->with(['status' => false, 'message' => 'Superadmin role cannot be updated']);
        }
        $role->update([
            'name' => $request->roleName,
        ]);
        $permissionId = array_map('intval', $request->permissions);
        $role->syncPermissions($permissionId);
        return redirect()->back()->with(['status' => true, 'message' => 'Role has been updated successfully']);
    }

    //delete role
    public function deleteRole($id)
    {
        $role = Role::find($id);
        if ($role->name == 'superadmin') {
            return redirect()->back()->with(['status' => false, 'message' => 'Superadmin role cannot be deleted']);
        }
        $role->delete();
        return redirect()->back()->with(['status' => true, 'message' => 'Role has been deleted successfully']);
    }
}
