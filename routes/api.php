<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Admin_loginController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('admin')->group(function () {
    Route::apiResource('/user',UserController::class);
});

Route::put('/user/update_user/{id}', [UserController::class, 'update']);

Route::get('/auth',function () {
    return response()->json(['message'=>'Please login first']);
})->name('auth');


// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('service',ServiceController::class);
// });

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
