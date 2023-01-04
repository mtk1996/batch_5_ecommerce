<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PDO;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        //check email
        $emailExist = User::where('email', $email)->first();
        if (!$emailExist) {
            return redirect()->back()->with('error', 'Email Not Found.');
        }
        //check password
        $checkAuth =  Auth::attempt($request->only('email', 'password'));
        if (!$checkAuth) {
            return redirect()->back()->with('error', 'Wrong Password.');
        }

        return redirect('/')->with('success', 'Welcome ' . auth()->user()->name);
    }


    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => "required",
            'email' => 'required|email',
            'password' => "required|min:3",
            'image' => "required|mimes:png,jpg,jpeg,webp|max:1024"
        ]);
        $email = $request->email;
        $emailExist = User::where('email', $email)->first();
        if ($emailExist) {
            return redirect()->back()->with('error', 'Email Already Exist');
        }

        $file = $request->file('image');
        $file_name = uniqid() . $file->getClientOriginalName();
        $file->move(public_path('/images'), $file_name);

        $createdUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->email),
            'image' => $file_name,
        ]);

        auth()->login($createdUser);
        return redirect('/')->with('success', 'Account Created Success.');
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/login')->with('success', 'Logout Success.');
    }
}
