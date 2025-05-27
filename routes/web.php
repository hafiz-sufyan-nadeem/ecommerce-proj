<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\OrderController;




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

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');





// Dashboard,Product,Category,Blog Routes

Route::prefix('admin')->group(function () {

    //middleware group
    Route::group(['middleware'=>['admin-access','custom-auth']], function () {
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

        Route::get('/products', [ProductController::class, 'index'])->name('products');

        Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products');
        Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');

        Route::get('/products/show', [ProductController::class, 'show'])->name('admin.products.show');

        Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');

        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

        //catgeory
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');

        Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');

        Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])->name('admin.categories.edit');

        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');

        Route::get('/categories/show/{category}', [CategoryController::class, 'show'])->name('admin.categories.show');

        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

        Route::post('/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');

        //blogs
        Route::get('/blogs',[BlogController::class, 'index'])->name('admin.blogs');

        Route::get('/blogs/create', [BlogController::class, 'create'])->name('admin.blogs.create');

        Route::get('/blogs/edit/{blog}', [BlogController::class, 'edit'])->name('admin.blogs.edit');

        Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('admin.blogs.update');

        Route::get('/blogs/show/{blog}', [BlogController::class, 'show'])->name('admin.blogs.show');

        Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('admin.blogs.destroy');

        Route::post('/blogs/store', [BlogController::class, 'store'])->name('admin.blogs.store');

    });

});

//checkout-Auth
Route::group(['middleware'=>['checkout-auth']], function () {
    Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

});

//  WEBSITE FOLDER ROUTES Home
Route::get('/', [HomeController::class, 'index'])->name('home');


// ADD TO CART ROUTES
Route::get('cartitems', [CartItemController::class, 'index'])->name('cartitems');
Route::post('add-to-cart', [CartItemController::class, 'addToCart'])->name('add.to.cart')->middleware('auth');
Route::get('get-cart-items', [CartItemController::class, 'getCartItems'])->name('get.cart.items');
Route::post('update-quantity', [CartItemController::class, 'updateQuantity'])->name('update.quantity');
Route::post('delete-item', [CartItemController::class, 'deleteItem'])->name('delete.item');

Route::post('apply-promo-code', [PromoController::class, 'applyPromoCode'])->name('apply.promo.code');

