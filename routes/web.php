<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;


// Default / Layout Routes
Route::get('/', function () {
    return view('welcome');
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

Route::get('/auth_layout', function () {
    return view('admin.auth.auth_layout');
});


// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'postRegister'])->name('register');

Route::get('/forgotpassword', [AuthController::class, 'showForgotPasswordForm'])->name('forgotpassword.form');
Route::post('/forgotpassword', [AuthController::class, 'postForgotPassword'])->name('forgotpassword');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products');
Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');

Route::get('/admin/products/show', [ProductController::class, 'show'])->name('admin.products.show');

Route::get('/admin/products/edit/{product}', [ProductController::class, 'edit'])->name('admin.products.edit');
Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');

Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
