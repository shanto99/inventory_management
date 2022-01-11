<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PageController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dashboardOverview1()
    {
        return view('pages/dashboard-overview-1', [
            // Specify the base layout.
            // Eg: 'side-menu', 'simple-menu', 'top-menu', 'login'
            // The default value is 'side-menu'

            // 'layout' => 'side-menu'
        ]);
    }



    public function permission()
    {
        $permissions = Permission::all();
        return view('pages/permission', [
            'permissions' => $permissions
        ]);
    }

    public function editPermission($id)
    {
        $permissions = Permission::all();
        $permission = Permission::find($id);
        return view('pages/permission', [
            'permissions' => $permissions,
            'permission' => $permission
        ]);
    }

    public function menu()
    {
        $menus = Menu::all();
        return view('pages/menu', [
            'menus' => $menus
        ]);
    }

    public function role()
    {
        $roles = Role::all();
        return view('pages/role', [
            'roles' => $roles
        ]);
    }

    public function rolePermission()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        $roles = $roles->toArray();
        $roles = array_map(function ($role) {
            $permissionIds = [];

            foreach ($role['permissions'] as $permission) {
                array_push($permissionIds, $permission['id']);
            }
            $role['permissionIdChecked'] = $permissionIds;
            return $role;
        }, $roles);

        return view('pages/role-permission', [
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }
}
