<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashbordController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductRequest;
use App\Http\Controllers\Admin\AddCategoryController;
use App\Http\Controllers\Admin\AddProductController;
use App\Http\Controllers\Admin\OrderController;


Route::get('/', function () {
    return view('login');
});

Route::get('showloginform', [LoginController::class,'showloginform'])->name('login_form');
Route::get('showsgininform', [LoginController::class,'showsgininform'])->name('signin_form');
Route::get('showsgininform', [LoginController::class,'showsgininform'])->name('signin_form');
Route::post('admin_login', [LoginController::class,'login'])->name('admin_login');
Route::post('admin_register', [LoginController::class,'register'])->name('admin_register');
Route::get('logout', [LoginController::class,'logout'])->name('logout');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashbord', function () {
        return view('dashbord'); 
    })->name('admin.dashboard');

    Route::get('showdashbord', [DashbordController::class,'showdashbord'])->name('dashbord');

    Route::get('showcategory', [CategoryController::class,'showcategory'])->name('categoryAdmin');
    Route::get('addcategory', [AddCategoryController::class,'addcategory'])->name('addCategoryAdmin');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::post('createcategory', [AddCategoryController::class,'createcategory'])->name('createCategoryAdmin');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/categories/{id}', [CategoryController::class, 'update'])->name('category.update');

    Route::get('showproduct', [ProductController::class,'showproduct'])->name('productAdmin');
    Route::get('addproduct', [AddProductController::class,'addproduct'])->name('addProductAdmin');
    Route::post('createproduct', [AddProductController::class,'createproduct'])->name('createProductAdmin');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/products/{id}', [ProductController::class, 'update'])->name('product.update');

    Route::get('showorder', [OrderController::class,'showorder'])->name('orderAdmin');
    Route::delete('/order/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');
    Route::post('/orders/{id}', [OrderController::class, 'update'])->name('order.update');

    Route::get('showuser', [UserController::class,'showuser'])->name('userAdmin');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});
