<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;

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

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');

Route::middleware('prevent-back')->group(function () {
    Route::middleware('loggedin')->group(function () {
        Route::get('/login', [AuthController::class, 'loginView'])->name('login-view');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('register', [AuthController::class, 'registerView'])->name('register-view');
        Route::post('register', [AuthController::class, 'register'])->name('register');
    });

    Route::middleware('auth')->group(function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [PageController::class, 'dashboardOverview1'])->name('dashboard-overview-1');

        Route::get('menu', [PageController::class, 'menu'])->name('menu-view');
        Route::get('menu/{id}', [MenuController::class, 'menuDetails']);
        Route::post('menu', [MenuController::class, 'menu'])->name('menu');
        Route::get('menu/delete/{id}', [MenuController::class, 'deleteMenu'])->name('delete-menu');

        Route::get('sub-menu', [PageController::class, 'subMenu'])->name('sub-menu-view');
        Route::get('sub-menu/{id}', [MenuController::class, 'subMenuDetails']);
        Route::post('sub-menu', [MenuController::class, 'subMenu'])->name('sub-menu');
        Route::get('sub-menu/delete/{id}', [MenuController::class, 'deleteMenuSub'])->name('delete-menu-sub');

        Route::get('role', [PageController::class, 'role'])->name('role-view');
        Route::get('role/{id}', [RoleController::class, 'roleDetails']);
        Route::post('role', [RoleController::class, 'role'])->name('role');
        Route::get('role/delete/{id}', [RoleController::class, 'deleteRole'])->name('delete-role');

        Route::get('permission', [PageController::class, 'permission'])->name('permission-view');
        Route::get('permission/{id}', [PermissionController::class, 'permissionDetails']);
        Route::post('permission', [PermissionController::class, 'permission'])->name('permission');
        Route::get('permission/delete/{id}', [PermissionController::class, 'deletePermission'])->name('delete-permission');

        Route::get('role-permission', [PageController::class, 'rolePermission'])->name('role-permission');
        Route::post('assign-permission-role', [RolePermissionController::class, 'assignPermissionRole']);

        Route::get('create-user', [PageController::class, 'createUser'])->name('create-user-view');
        Route::post('create-user', [UserController::class, 'createUser'])->name('create-user');

        Route::get('users/{action?}', [PageController::class, 'getUsers'])->name('users-view');

        Route::get('users/{id}', [PageController::class, 'editUser'])->middleware('permission:edit users')->name('edit-user');
        Route::get('users/delete/{id}', [UserController::class, 'deleteUser'])->middleware('permission:delete users')->name('delete-user');

        Route::get('parent-sub', [PageController::class, 'parentSub'])->name('parent-sub');
    });
});
