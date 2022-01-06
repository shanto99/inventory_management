<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Permission Manager']);
    }
    public function index(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        //return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'Name' => 'required|unique:Permissions,name',
            'Active' => 'required'
        ]);

        $permission = new Permission();
        $permission->name = $request->Name;
        $permission->guard_name = 'web';
        $permission->active = $request->Active;

        if ($permission->save() == true) {
            Toastr::success('Permission created successfully', 'GoodJob!', ["positionClass" => "toast-top-right"]);
        } else {
            Toastr::error('Premission creation failed', 'Opps!', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sample  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sample  $permission
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sample  $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, [
            'Name' => 'required|unique:roles,name',
            'Active' => 'required'
        ]);

        $permission = Permission::find($permission->id);
        $permission->name = $request->Name;
        $permission->guard_name = 'web';
        if ($request->Active) {
            $permission->active = $request->Active;
        } else {
            $permission->active = 'N';
        }
        if ($permission->save() == true) {
            Toastr::success('Permission updated successfully', 'GoodJob!', ["positionClass" => "toast-top-right"]);
        } else {
            Toastr::error('Permisssion update failed', 'Opps!', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sample  $permission
     * @return array
     */
    public function destroy(Permission $permission)
    {
        if ($permission->delete()) {
            $data = array(
                'success' => true,
                'message' => 'Permission deleted successfully.'
            );
        } else {
            $data = array(

                'success' => false,
                'message' => 'Permission delete unsuccessful.'
            );
        }
        return $data;
    }
}
