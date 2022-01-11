<?php

namespace App\Http\Controllers;

use App\Http\Request\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function role(Request $request)
    {
        if ($request->has('RoleId')) {
            $role = Role::find($request->RoleId);
            $role->update([
                'name' => $request->name
            ]);
        } else {
            $role = Role::create($request->only('name'));
        }

        return response()->json([
            'role' => $role,
            'status' => 200
        ], 200);
    }

    public function roleDetails($id)
    {
        $role = Role::find($id);
        return response()->json([
            'role' => $role,
            'status' => 200
        ], 200);
    }

    public function deleteRole($id)
    {
        $role = Role::find($id);
        if ($role) {
            $role->delete();
        }

        return response()->json([
            'message' => 'Role deleted successfully',
            'status' => 200
        ], 200);
    }
}
