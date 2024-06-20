<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashbordController;

Route::get('/', function () {
    return view('login');
});


Route::get('showloginform', [LoginController::class,'showloginform'])->name('login_form');
Route::get('showsgininform', [LoginController::class,'showsgininform'])->name('signin_form');
Route::get('showsgininform', [LoginController::class,'showsgininform'])->name('signin_form');
Route::post('admin_login', [LoginController::class,'login'])->name('admin_login');
Route::post('admin_register', [LoginController::class,'register'])->name('admin_register');
Route::get('logout', [LoginController::class,'logout'])->name('logout');

Route::get('showdashbord', [DashbordController::class,'showdashbord'])->name('dashbord');

Route::get('/', function () {
    return view('welcome');
});
