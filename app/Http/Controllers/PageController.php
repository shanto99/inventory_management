<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuSub;
use App\Models\User;
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
        $permissions = Permission::all();
        return view('pages/menu', [
            'menus' => $menus,
            'permissions' => $permissions
        ]);
    }

    public function subMenu()
    {
        $subMenus = MenuSub::with('menu')->get();
        $menus = Menu::where('RouteName', NULL)->get();
        $permissions = Permission::all();
        return view('pages/sub-menu', [
            'menus' => $menus,
            'subMenus' => $subMenus,
            'permissions' => $permissions
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

    public function createUser()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('pages/create-user', [
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function getUsers($action = null)
    {
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();

        return view('pages/users', [
            'users' => $users,
            'roles' => $roles,
            'permissions' => $permissions,
            'action' => $action
        ]);
    }

    public function editUser($id)
    {
        $user = User::with('roles', 'permissions')->where('UserID', $id)->first();
        $roles = Role::all();
        $permissions = Permission::all();

        $roleIds = [];
        $permissionIds = [];

        foreach ($user->roles as $role) {
            array_push($roleIds, $role->id);
        }

        $user->roleIds = $roleIds;

        foreach ($user->permissions as $permission) {
            array_push($permissionIds, $permission->id);
        }

        $user->permissionIds = $permissionIds;

        return view('pages/edit-user', [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function parentSub()
    {
    }
}
