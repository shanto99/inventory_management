<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

use App\Services\PermissionService;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = "UserManager";

    protected $primaryKey = "UserID";
    public $incrementing = false;

    protected $fillable = ['UserID', 'UserName', 'Designation', 'Email', 'Password', 'CreatedBy'];

    protected $hidden = [
        'Password', 'remember_token',
    ];

    public function getPhotoUrlAttribute()
    {
        return url('media-example/no-image.png');
    }

    public function getAuthPassword()
    {
        return $this->Password;
    }

    public function menus()
    {
        $allPermissions = collect([]);
        $roles = $this->roles ?: [];
        $permissions = $this->permissions ?: [];

        foreach ($roles as $role) {
            $allPermissions = $allPermissions->merge($role->permissions);
        }

        foreach ($permissions as $permission) {
            $allPermissions->push($permission);
        }

        $menus = [];

        foreach ($allPermissions as $permission) {
            $permissionMenus = PermissionService::getMenus($permission) ?: [];
            foreach ($permissionMenus as $menu) {
                $parameters = $menu->parameters ?: [];
                $params = [];
                foreach ($parameters as $parameter) {
                    $params[$parameter->ParamKey] = $parameter->ParamValue;
                }
                $menus[$menu->Name] = [
                    'title' => $menu->Title,
                    'icon' => $menu->Icon,
                    'route_name' => $menu->RouteName,
                    'params' => $params
                ];
            }

            $permissionSubMenus = PermissionService::getSubMenus($permission) ?: [];

            foreach ($permissionSubMenus as $subMenu) {
                $menu = $subMenu->menu;
                if (!isset($menus[$menu->Name])) {
                    $menus[$menu->Name] = [
                        'title' => $menu->Title,
                        'icon' => $menu->Icon,
                        'sub_menu' => []
                    ];
                }
                $parameters = $subMenu->parameters ?: [];
                $params = [];
                foreach ($parameters as $parameter) {
                    $params[$parameter->ParamKey] = $parameter->ParamValue;
                }

                $menus[$menu->Name]['sub_menu'][$subMenu->Name] = [
                    'title' => $subMenu->Title,
                    'icon' => $subMenu->Icon,
                    'route_name' => $subMenu->RouteName,
                    'params' => $params
                ];
            }
        }

        return $menus;
    }
}
