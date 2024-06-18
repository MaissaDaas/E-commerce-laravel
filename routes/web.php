<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Admin_loginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});


Route::get('showloginform', [Admin_loginController::class,'showloginform'])->name('login_form');
Route::post('admin_login', [Admin_loginController::class,'login'])->name('admin_login');
Route::get('logout', [Admin_loginController::class,'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
});
