<?php

namespace App\Http\Controllers;

use App\Http\Request\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function role(Request $request)
    {
        Role::create($request->only('Name'));
        return back()->with('success', 'Role created successfully');
    }
}
