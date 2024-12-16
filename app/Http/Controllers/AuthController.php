<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;
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
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard')->with('success', 'Successfully logged in');
        }

        return redirect()->back()->withErrors(['error' => 'Oops! You have entered invalid credentials']);
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
    public function postForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        return redirect()->back()->with('success', 'Password reset link sent to your email.');
    }


    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function postDashboard()
    {
        if (Auth::check()){
            return view('admin.dashboard');
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

    public function logout() {
        Session::flush();

        Auth::logout();

        return Redirect('login');

    }


}
