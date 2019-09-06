<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $pageVars = [
            //This is the title of my custom view.
                'pageTitle'=> __('acl.editRoles'),
                'user' => $user
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
    public function update(Request $request, $id)
    {
        //
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

        Role::create(['name' => filter_var($request->name,FILTER_SANITIZE_STRING)]);
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
            'name' => filter_var($request->name,FILTER_SANITIZE_STRING),
            'description' => filter_var($request->description,FILTER_SANITIZE_STRING)
            ]);
        return redirect()->route('managePermissions');
    }
}
