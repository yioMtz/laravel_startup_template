<?php

namespace App\Http\Controllers\Access;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
//         $rolePermissions = $user->getPermissionsViaRoles();
//         $directPermissions = $user->permissions;
//         echo "ROLE PERMISSIONS";
//         foreach($rolePermissions AS $rolePermission){
//             var_dump($rolePermission->name);
//         }
//         echo "DIRECT PERMISSIONS";
//         foreach($directPermissions AS $directPermission){
//             var_dump($directPermission->name);
//         }
        
// die();

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
            $user->syncPermissions();
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
}
