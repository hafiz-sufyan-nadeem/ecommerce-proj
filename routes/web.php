<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('admin.layouts.index');
});

Route::get('/tables', function () {
    return view('admin.layouts.tables');
});
