<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;



class AclController extends Controller
{

     //Private variable to store the user object.
     private $user;

     //Inject the $user module and store it in our private variable.
     public function __construct(User $user)
     {
         $this->user = $user;
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Collection of all our users.
        $users = $this->user::paginate(10);
        
        $pageVars = [
        //This is the title of my custom view.
            'pageTitle'=>'Access Control List',
        //My list of users
            'users' => $users

        ];
        return view('acl/index')->with($pageVars);
    }


    /**
     * Show the form for editing user roles & permissions.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = \Spatie\Permission\Models\Role::all();
        $permissions = \Spatie\Permission\Models\Permission::all();
        $pageVars = [
            //This is the title of my custom view.
                'pageTitle'=> __('acl.editRoles'),
                'user' => $user,
                'roles' => $roles,
                'permissions' => $permissions
            ];
        return view('acl/edit')->with($pageVars);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'roles.*' => 'exists:roles,name',
            'permissions.*' => 'exists:permissions,name',
        ])->validate();

         $user = User::find($request->user_id);
         if(empty($validatedData['roles'])){
            $user->syncRoles();
         }else{
             $user->syncRoles([$validatedData['roles']]);
         }
         if(empty($validatedData['permissions'])){
            $user->syncPermissions();
         }else{
            $user->syncPermissions([$validatedData['permissions']]);
         }
         

         return redirect()->route('edit.permissions', [$user->id])->with('status', __('acl.permissions_updated'));
    }


    /**
     * Display all roles available
     *
     * @return \Illuminate\Http\Response
     */
    public function manageRoles()
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
     * Display all permissions available
     *
     * @return \Illuminate\Http\Response
     */
    public function managePermissions()
    {
        $permissions = \Spatie\Permission\Models\Permission::all();
        $pageVars = [
            //This is the title of my custom view.
                'pageTitle'=> __('acl.permissionsBtn'),
            //My list of roles
                'permissions' => $permissions
    
            ];
        return view('acl/permissions')->with($pageVars);

    }

    /**
     * Show form for creating a new permission
     *
     * @return \Illuminate\Http\Response
     */
    public function createPermission()
    {
        $pageVars = [
            //This is the title of my custom view.
                'pageTitle'=> __('acl.createPermission'),    
            ];
        return view('acl/createpermissionForm')->with($pageVars);
    }

    /**
     * Store a newly created permission in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePermission(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:permissions|max:200',
            'description' => 'string',
        ]);
        Permission::create([
            'name' => filter_var(str_replace(' ', '-', strtolower($request->name)),FILTER_SANITIZE_STRING),
            'description' => filter_var($request->description,FILTER_SANITIZE_STRING)
            ]);
        return redirect()->route('managePermissions');
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
