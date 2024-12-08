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

//Route::get('/products', [AuthController::class, 'showProducts']);

Route::get('/products', function () {
    return view('admin.products');
});

Route::get('/auth_layout', function (){
    return view('admin.auth.auth_layout');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');

Route::get('/forgotpassword', [AuthController::class, 'showForgotPasswordForm'])->name('forgotpassword.form');

Route::post('/login', [AuthController::class, 'postLogin'])->name('login');

Route::post('/register', [AuthController::class, 'postRegister'])->name('register');

Route::post('/forgotpassword', [AuthController::class, 'postForgotPassword'])->name('forgotpassword');

Route::post('/products', [AuthController::class, 'postProducts'])->name('products');
