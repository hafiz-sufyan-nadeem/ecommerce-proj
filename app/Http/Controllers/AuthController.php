<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin.products')->withSuccess('Successfully logged in');
        }
        return redirect('login')->withErrors('Oops! You have entered invalid credentials');
    }

    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
        $data = $request->all();
        $check = $this->create($data);
        return redirect('admin.products')->withSuccess('Greate!, You have successfully registered');
    }

    public function showForgotPasswordForm()
    {
        return view('admin.auth.forgotpassword');
    }
    public function postForgotPassword()
    {
        return view('admin.auth.forgotpassword');
    }

    public function products()
    {
        return view('admin.products');
    }

    public function postProducts()
    {
        if (Auth::check()){
            return view('admin.products');
        }
        return redirect('login');
    }

    public function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

    }

}
