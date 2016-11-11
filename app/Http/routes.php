<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::auth();


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/home', 'HomeController@index');

// Route::get('/home', 'HomeController@index');

/*******************************************************/
//**********************PERMISSIONS*********************
/********************************************************/
Route::get('/permissions', 'PermissionsCtrl@index');
Route::get('/permissions/create', 'PermissionsCtrl@create');
Route::get('/permissions/edit/{IdPermission}', 'PermissionsCtrl@edit');

// AjaxCalls
Route::post('/permissions', 'PermissionsCtrl@store');
Route::put('/permissions/{IdPermission}', 'PermissionsCtrl@update');
Route::delete('/permissions/{IdPermission}', 'PermissionsCtrl@remove');


/*******************************************************/
//**********************ROLES*****************************
/********************************************************/
Route::get('/roles', 'RolesCtrl@index');
Route::get('/roles/create', 'RolesCtrl@create');
Route::get('/roles/edit/{idRole}', 'RolesCtrl@edit');
Route::get('/roles/permissions/{idRole}', 'RolesCtrl@rolePermissions');

// AjaxCalls
Route::post('/roles', 'RolesCtrl@store');
Route::put('/roles/{idRole}', 'RolesCtrl@update');
Route::delete('/roles/{idRole}', 'RolesCtrl@remove');

//assign
Route::post('/assignpermission/{idRole}', 'RolesCtrl@assignRolePermissions');

//revoke
Route::delete('/revokePermissions/{idRole}/{idpermission}', 'RolesCtrl@revokeRolePermissions');
Route::delete('/revoleallpermissions/{idRole}', 'RolesCtrl@revokeAllPermissions');

/*******************************************************/
//**********************USERS*****************************
/********************************************************/
Route::get('/users', 'UsersCtrl@index');
Route::get('/users/create', 'UsersCtrl@create');
Route::get('/users/edit/{idUsers}', 'UsersCtrl@edit');
Route::get('/users/roles/{idUsers}', 'UsersCtrl@rolePermissions');

// AjaxCalls
Route::post('/users', 'UsersCtrl@store');
Route::put('/users/{idUsers}', 'UsersCtrl@update');
Route::delete('/users/{idUsers}', 'UsersCtrl@remove');

//assign
Route::post('/assignrole/{idUsers}', 'RolesCtrl@assignRolePermissions');

//revoke
Route::delete('/revokeRole/{idUser}/{idrole}', 'RolesCtrl@revokeRolePermissions');
Route::delete('/revoleallroles/{idUser}', 'RolesCtrl@revokeAllPermissions');
