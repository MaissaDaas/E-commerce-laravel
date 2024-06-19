<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Admin_loginController;

Route::get('/', function () {
    return view('login');
});


Route::get('showloginform', [Admin_loginController::class,'showloginform'])->name('login_form');
Route::post('admin_login', [Admin_loginController::class,'login'])->name('admin_login');
Route::get('admin_register', [Admin_loginController::class,'register'])->name('admin_register');
Route::get('logout', [Admin_loginController::class,'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
});
