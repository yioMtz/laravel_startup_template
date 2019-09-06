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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| Access Control
|--------------------------------------------------------------------------
| Manager roles & permissions.
|
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/acl','AclController@index')->name('admin.acl');
    Route::get('admin/manage-roles','AclController@manageRoles')->name('manageRoles');
    Route::get('admin/create-role'
                , [
                    'uses' => 'AclController@createRole',
                    'middleware' => 'permission:create-role',
                ])->name('newRole');
    Route::get('admin/role-permissions'
                , [
                    'uses' => 'AclController@editRolePermissions',
                    'middleware' => 'permission:assign-permission',
                ])->name('editRolePermissions');
    Route::post('admin/store-role','AclController@storeRole')->name('createRole');
    Route::get('admin/manage-Permissions','AclController@managePermissions')->name('managePermissions');
    Route::get('admin/create-Permission','AclController@createPermission')->name('newPermission');
    Route::post('admin/store-Permission','AclController@storePermission')->name('createPermission');
    Route::get('admin/access-control/{id}','AclController@edit')->name('edit.permissions');
    Route::post('admin/access-control','AclController@update')->name('update.permissions');
});
