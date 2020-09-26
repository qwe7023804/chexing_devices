<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('app')->namespace('App')->group(function () {
    Route::post('members', 'MemberController@login')->name('members.login');
    Route::get('versions', 'MemberController@login')->name('version');
    Route::post('/devices/sp100', 'DeviceController@sp100devices');
});

Route::prefix('produce_')->namespace('App\Produce')->group(function () {
    Route::post('/operators/login', 'OperatorController@login');
    Route::post('/devices/sp100store', 'DeviceController@sp100store');
});


Route::prefix('Sp110')->namespace('Sp110')->group(function () {

    //后台权限、列表
    Route::get('/users/get_permission_menus', 'UserController@get_permission_menus');
    Route::resource('permissions', 'PermissionController');
    //账号操作
    Route::post('/login', 'LoginController@login');
    Route::get('/check_user_login', 'LoginController@check_user_login');
    Route::post('/logout', 'LoginController@logout');

    //获取目录
    Route::resource('menus', 'MenuController');
    Route::post('/menus/sortmenus', 'MenuController@sortmenus');
    Route::post('/menus/updatesortmenus', 'MenuController@updatesortmenus');

    //后台用户
    Route::get('/user/get_user_info', 'UserController@get_user_info');
    Route::post('/users/password', 'UserController@changepassword');
    Route::resource('users', 'UserController', ['only' => ['index', 'show', 'store', 'edit', 'update', 'destroy']]);
    Route::get('/users/edit_user_role/{id}', 'UserController@edit_user_role');
    Route::patch('/users/update_user_role/{id}', 'UserController@update_user_role');

    //后台角色
    Route::resource('roles', 'RoleController', ['only' => ['index', 'store', 'destroy', 'edit', 'update']]);

    //会员管理
    Route::resource('members', 'MemberController', ['only' => ['index']]);
    Route::resource('identity', 'IdentityController', ['only' => ['index', 'store', 'update', 'destroy']]);
});


Route::prefix('Tools')->namespace('Tools')->group(function () {

    //后台权限、列表
    Route::get('/users/get_permission_menus', 'UserController@get_permission_menus');

    //账号操作
    Route::post('/login', 'LoginController@login');
    Route::get('/check_user_login', 'LoginController@check_user_login');
    Route::post('/logout', 'LoginController@logout');

    //获取目录
    Route::resource('menus', 'MenuController');
    Route::post('/menus/sortmenus', 'MenuController@sortmenus');
    Route::post('/menus/updatesortmenus', 'MenuController@updatesortmenus');
    //后台用户
    Route::get('/user/get_user_info', 'UserController@get_user_info');
    Route::post('/users/password', 'UserController@changepassword');
    Route::resource('users', 'UserController', ['only' => ['index', 'show', 'store', 'edit', 'update', 'destroy']]);
    //后台角色
    Route::resource('roles', 'RoleController');
});

Route::prefix('Produce')->namespace('Produce')->group(function () {

    //后台权限、列表
    Route::get('/users/get_permission_menus', 'UserController@get_permission_menus');

    //账号操作
    Route::post('/login', 'LoginController@login');
    Route::get('/check_user_login', 'LoginController@check_user_login');
    Route::post('/logout', 'LoginController@logout');

    //获取目录
    Route::resource('menus', 'MenuController');
    Route::post('/menus/sortmenus', 'MenuController@sortmenus');
    Route::post('/menus/updatesortmenus', 'MenuController@updatesortmenus');
    //后台用户
    Route::get('/user/get_user_info', 'UserController@get_user_info');
    Route::post('/users/password', 'UserController@changepassword');
    Route::resource('users', 'UserController', ['only' => ['index', 'show', 'store', 'edit', 'update', 'destroy']]);
    Route::get('/users/edit_user_role/{id}', 'UserController@edit_user_role');
    Route::patch('/users/update_user_role/{id}', 'UserController@update_user_role');
    //后台角色
    Route::resource('roles', 'RoleController');

    //操作员管理
    Route::resource('operators', 'OperatorController', ['only' => ['index']]);


    //库存
    Route::resource('stocks', 'StockController', ['only' => ['index']]);
});