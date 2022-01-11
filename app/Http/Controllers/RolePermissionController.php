<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolePermissionController extends Controller
{
    public function assignPermissionRole(Request $request)
    {

        if ($request->isRemove) {
            DB::table('RoleHasPermissions')
                ->where('role_id', $request->roleId)
                ->where('permission_id', $request->permissionId)->delete();
        } else {
            DB::table('RoleHasPermissions')->insert([
                'permission_id' => $request->permissionId,
                'role_id' => $request->roleId
            ]);
        }

        return response()->json([
            'message' => 'Permission assigned to role',
            'status' => 200
        ], 200);
    }
}
