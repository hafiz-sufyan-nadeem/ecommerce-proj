<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('admin.layouts.index');
});

Route::get('/tables', function () {
    return view('admin.tables');
});

Route::get('/header', function () {
    return view('admin.layouts.header');
});

Route::get('/footer', function () {
    return view('admin.layouts.footer');
});

Route::get('/main', function () {
    return view('admin.layouts.main');
});

Route::get('/sidebar', function () {
    return view('admin.layouts.sidebar');
});

Route::get('/products', [AuthController::class, 'showProducts']);


Route::get('/auth_layout', function (){
    return view('admin.auth.auth_layout');
});

Route::get('/login', [AuthController::class, 'showLoginForm']);

Route::get('/register', [AuthController::class, 'showRegisterForm']);

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm']);

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/forgot-password', [AuthController::class, 'forgot-Password'])->name('forgot-password');

Route::post('/products', [AuthController::class, 'products'])->name('products');
