<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;

Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);

Route::apiResource('/user',UserController::class);

Route::put('/user/update_user/{id}', [UserController::class, 'update']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/auth',function () {
    return response()->json(['message'=>'Please login first']);
})->name('auth');

