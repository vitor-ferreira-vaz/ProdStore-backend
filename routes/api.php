<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/users/AttemptLogin', [UserController::class, 'Login'])->name('login')/*->middleware(StartSession::class)*/;
Route::post('/users/CheckUser', [UserController::class, 'CheckUser'])->middleware('auth:sanctum');
Route::post('/users/Logout', [UserController::class, 'Logout'])->middleware('auth:sanctum');
//Route::post('/users/SentEmailResetPassword', [UserController::class, 'SentEmailResetPassword']);
Route::post('/users/ResetPassword', [UserController::class, 'ResetPassword']);

Route::apiResource('products', ProductController::class);


