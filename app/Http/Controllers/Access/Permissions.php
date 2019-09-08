<?php

namespace App\Http\Controllers\Access;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class Permissions extends Controller
{
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
}
