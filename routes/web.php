<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Gestion de usuarios
|--------------------------------------------------------------------------
|
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/users','Users\UsersController@index')->name('admin.users');
});

/*
|--------------------------------------------------------------------------
| Access Control
|--------------------------------------------------------------------------
| Manager roles & permissions.
|
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    //access control list
    Route::get('admin/acl','Access\AclController@index')->name('admin.acl');

    Route::middleware(['permission:assign-permissions-to-user'])->group(function () {
        Route::get('admin/access-control/{id}','Access\AclController@edit')->name('edit.permissions');
        Route::post('admin/access-control','Access\AclController@update')->name('update.permissions');
    });
    
    //Roles management
    Route::get('admin/manage-roles','Access\Roles@index')->name('manageRoles');
    Route::middleware(['permission:create-role'])->group(function () {
        Route::get('admin/create-role','Access\Roles@createRole')->name('newRole');
        Route::post('admin/store-role','Access\Roles@storeRole')->name('createRole');
    });

    Route::middleware(['permission:assign-permissions-to-role'])->group(function () {
        Route::post('admin/access-control/set-role-permissions','Access\Roles@setPermissionsToRole')->name('setPermissionsToRole');
        Route::get('admin/role-permissions/{id}','Access\Roles@editRolePermissions')->name('editRolePermissions');
    });

    //Permissions management
    Route::get('admin/manage-Permissions','Access\Permissions@managePermissions')->name('managePermissions');
    Route::middleware(['permission:create-permissions'])->group(function () {
        Route::get('admin/create-Permission','Access\Permissions@createPermission')->name('newPermission');
        Route::post('admin/store-Permission','Access\Permissions@storePermission')->name('createPermission');
    });   
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
