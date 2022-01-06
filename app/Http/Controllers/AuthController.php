<?php

namespace App\Http\Controllers;

use App\Http\Request\LoginRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('login/main', [
            'layout' => 'login'
        ]);
    }

    public function login(LoginRequest $request)
    {

        if (!\Auth::attempt([
            'UserID' => $request->UserID,
            'password' => $request->Password
        ])) {
            throw new \Exception('Wrong user id or password.');
        }
    }

    public function logout()
    {
        \Auth::logout();
        return redirect('login');
    }
}
