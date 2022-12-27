<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        $checkLogin =  Auth::guard('admin')->attempt($request->only('email', 'password'));
        if (!$checkLogin) {
            return redirect()->back()->with('error', 'Email and password dont match!');
        }
        return redirect('/admin')->with('success', 'Welcome Admin');
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect('/admin/login');
    }
}
