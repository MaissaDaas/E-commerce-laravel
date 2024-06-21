<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashbordController;
use App\Http\Controllers\Admin\CategoryController;


Route::get('/', function () {
    return view('login');
});


// Route::prefix('admin')->group(function () {
//     Route::get('/users', function () {
//         // Matches The "/admin/users" URL
//     });
// });

Route::get('showloginform', [LoginController::class,'showloginform'])->name('login_form');
Route::get('showsgininform', [LoginController::class,'showsgininform'])->name('signin_form');
Route::get('showsgininform', [LoginController::class,'showsgininform'])->name('signin_form');
Route::post('admin_login', [LoginController::class,'login'])->name('admin_login');
Route::post('admin_register', [LoginController::class,'register'])->name('admin_register');
Route::get('logout', [LoginController::class,'logout'])->name('logout');

// Route::prefix('admin')->group(function () {
    // Route::get('/users', function () {
        Route::get('showdashbord', [DashbordController::class,'showdashbord'])->name('dashbord');
        Route::get('showcategory', [CategoryController::class,'showcategory'])->name('categoryAdmin');
    // });
// });

Route::get('/', function () {
    return view('welcome');
});
