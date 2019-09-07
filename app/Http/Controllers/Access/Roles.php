<?php

namespace App\Http\Controllers\Access;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Roles extends Controller
{
    /**
     * Display all roles available
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = \Spatie\Permission\Models\Role::all();
        $pageVars = [
            //This is the title of my custom view.
                'pageTitle'=> __('acl.rolesBtn'),
            //My list of roles
                'roles' => $roles
    
            ];
        return view('acl/roles')->with($pageVars);

    }

    /**
     * Show form for creating a new role
     *
     * @return \Illuminate\Http\Response
     */
    public function createRole()
    {
        $pageVars = [
            //This is the title of my custom view.
                'pageTitle'=> __('acl.createRole'),    
            ];
        return view('acl/createRoleForm')->with($pageVars);
    }

    /**
     * Store a newly created role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRole(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles|max:200',
        ]);

        Role::create(['name' => filter_var(str_replace(' ', '-', strtolower($request->name)),FILTER_SANITIZE_STRING)]);
        return redirect()->route('manageRoles');
    }

    

    /**
     * Show the form for adding permissions to role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editRolePermissions($id)
    {
        $role = Role::findById($id);
        $permissions = \Spatie\Permission\Models\Permission::all();
        $pageVars = [
            //This is the title of my custom view.
                'pageTitle'=> __('acl.permissionsToRole'),
                'role' => $role,
                'permissions' => $permissions
            ];
        return view('acl/editRolePermissions')->with($pageVars);
    }


     /**
     * Assign permissions to a specific role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setPermissionsToRole(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'role_id' => 'required|integer|exists:roles,id',
            'permissions.*' => 'exists:permissions,name',
        ])->validate();

        $role = Role::findById($request->role_id);;

         if(empty($validatedData['permissions'])){
            $role->syncPermissions();
         }else{
            $role->syncPermissions([$validatedData['permissions']]);
         }
         

         return redirect()->route('manageRoles')->with('status', __('acl.permissions_updated'));
    }
}
