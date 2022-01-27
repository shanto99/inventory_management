<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\MenuSub;

class PermissionService
{
    public static function getMenus($permission)
    {
        return Menu::where('PermissionID', $permission->id)->get();
    }

    public static function getSubMenus($permission)
    {
        return MenuSub::where('PermissionID', $permission->id)->get();
    }
}
