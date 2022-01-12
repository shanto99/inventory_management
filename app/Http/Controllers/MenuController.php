<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuSub;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function menu(Request $request)
    {
        if ($request->has('MenuId')) {
            $menu = Menu::find($request->MenuId);
            $menu->update($request->only('Name', 'Title', 'Icon', 'RouteName'));
        } else {
            $menu = Menu::create($request->only('Name', 'Title', 'Icon', 'RouteName'));
        }

        return response()->json([
            'menu' => $menu,
            'status' => 200
        ], 200);
    }

    public function subMenu(Request $request)
    {
        $menu = Menu::find($request->MenuID);

        if ($request->has('MenuSubID')) {
            $subMenu = DB::table('MenuSubs')->where('MenuSubID', $request->MenuSubID)->update([
                'Name' => $request->Name,
                'Title' => $request->Title,
                'MenuID' => $request->MenuID,
                'RouteName' => $request->RouteName,
                'PermissionID' => $request->PermissionID
            ]);

            $subMenu = MenuSub::with('menu')->where('MenuSubID', $request->MenuSubID)->first();
        } else {
            $subMenu = $menu->subMenus()->create($request->only('Name', 'Title', 'RouteName', 'PermissionID'));
            $subMenu = MenuSub::with('menu')->where('MenuSubID', $subMenu->MenuSubID)->first();
        }


        return response()->json([
            'subMenu' => $subMenu,
            'status' => 200
        ], 200);
    }

    public function menuDetails($id)
    {
        $menu = Menu::find($id);
        return response()->json([
            'menu' => $menu,
            'status' => 200
        ], 200);
    }

    public function subMenuDetails($subMenuId)
    {
        $subMenu = MenuSub::find($subMenuId);
        return response()->json([
            'subMenu' => $subMenu,
            'status' => 200
        ], 200);
    }

    public function deleteMenu($id)
    {
        $menu = Menu::find($id);
        if ($menu) {
            $menu->subMenus()->delete();
            $menu->delete();
        }

        return response()->json([
            'message' => 'Menu deleted successfully',
            'status' => 200
        ], 200);
    }

    public function deleteMenuSub($id)
    {
        $subMenu = MenuSub::find($id);
        if ($subMenu) {
            $subMenu->delete();
        }

        return response()->json([
            'message' => 'Sub menu deleted successfully',
            'status' => 200
        ], 200);
    }
}
