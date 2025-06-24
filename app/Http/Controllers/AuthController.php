<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;
use App\Models\Order;
use Carbon\Carbon;
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
            $user = Auth::user();

            if ($user->is_admin == 1) {
                return redirect()->route('dashboard');
            } else return redirect()->route('home');
        }

        return redirect()->back()->withErrors([
            'email' => 'Invalid email or password',
            'password' => 'Invalid email or password',
        ])->withInput($request->only('email'));
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
        $this->create($data);
        return redirect('login')->withSuccess('Greate!, You have successfully registered');
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
        $monthlyEarnings = Order::whereMonth('created_at', now()->month)
            ->sum('total_price');

        $annualEarnings = Order::whereYear('created_at', now()->year)
            ->sum('total_price');

        $pendingOrders = Order::where('status', 'pending')->count();

        return view('admin.dashboard', [
            'monthlyEarnings' => $monthlyEarnings,
            'annualEarnings' => $annualEarnings,
            'pendingOrders' => $pendingOrders
        ]);
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
