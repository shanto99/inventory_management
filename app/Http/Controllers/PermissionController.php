<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function permissionDetails($id)
    {
        $permission = Permission::find($id);
        return response()->json([
            'permission' => $permission,
            'status' => 200
        ], 200);
    }

    public function deletePermission($id)
    {
        $permission = Permission::find($id);
        if ($permission) {
            $permission->delete();
        }

        return response()->json([
            'message' => 'Permission deleted successfully',
            'status' => 200
        ], 200);
    }

    public function permission(Request $request)
    {
        if ($request->has('PermissionId')) {
            $permission = Permission::find($request->PermissionId);
            $permission->update([
                'name' => $request->name
            ]);
        } else {
            $permission = Permission::create($request->only('name'));
        }

        return response()->json([
            'permission' => $permission,
            'status' => 200
        ], 200);
    }
}
