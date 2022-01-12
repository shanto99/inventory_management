<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        // DB::beginTransaction();
        // try {
        $userData = $request->only('UserID', 'UserName', 'Email', 'Designation');
        $userData['Password'] = Hash::make($request->Password);

        if ($request->has('UserID')) {
            $user = User::find($request->UserID);

            DB::table('ModelHasRoles')->where('UserID', $request->UserID)->delete();
            DB::table('ModelHasPermissions')->where('UserID', $request->UserID)->delete();

            $user->update([
                'UserName' => $request->UserName,
                'Email' => $request->Email,
                'Designation' => $request->Designation
            ]);
        } else {
            User::create($userData);
        }

        $roles = $request->Roles ?: [];
        $permissions = $request->Permissions ?: [];

        foreach ($roles as $role) {
            DB::table('ModelHasRoles')->insert([
                'role_id' => $role,
                'UserID' => $request->UserID
            ]);
        }

        foreach ($permissions as $permission) {
            DB::table('ModelHasPermissions')->insert([
                'permission_id' => $permission,
                'UserID' => $request->UserID
            ]);
        }


        //     DB::commit();
        // } catch (Exception $e) {
        //     DB::rollBack();
        // }

        return redirect()->back();
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        DB::table('ModelHasRoles')->where('UserID', $user->UserID)->delete();
        DB::table('ModelHasPermissions')->where('UserID', $user->UserID)->delete();
        if ($user) {
            $user->delete();
        }
        return response()->json([
            'message' => 'User deleted successfully',
            'status' => 200
        ], 200);
    }
}
