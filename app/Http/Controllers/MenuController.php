<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function menu(Request $request)
    {
        if ($request->has('MenuId')) {
            $menu = Menu::find($request->MenuId);
            $menu->update([
                'Name' => $request->name
            ]);
        } else {
            $menu = Menu::create($request->only('name'));
        }

        return response()->json([
            'menu' => $menu,
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

    public function deleteMenu($id)
    {
        $menu = Menu::find($id);
        if ($menu) {
            $menu->delete();
        }

        return response()->json([
            'message' => 'Menu deleted successfully',
            'status' => 200
        ], 200);
    }
}
