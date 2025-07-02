<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/users/AttemptLogin', [AuthController::class, 'Login'])->name('login')/*->middleware(StartSession::class)*/;
Route::post('/users/CheckUser', [AuthController::class, 'CheckUser'])->middleware('auth:sanctum');
Route::post('/users/Logout', [AuthController::class, 'Logout'])->middleware('auth:sanctum');
Route::post('/users/SentEmailResetPassword', [AuthController::class, 'SentEmailResetPassword']);
Route::post('/users/ResetPassword', [AuthController::class, 'ResetPassword']);
