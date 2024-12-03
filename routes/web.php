<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/products', function (){
    return view('admin.products');
});
