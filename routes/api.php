<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/* USUARIO */
Route::get('/users/show/{id}', [UserController::class, 'show'])/*->middleware('auth:sanctum')*/;
Route::post('/users/store', [UserController::class, 'store'])/*->middleware('auth:sanctum')*/;
Route::put('/users/update/{id}', [UserController::class, 'update'])/*->middleware('auth:sanctum')*/;
Route::delete('/users/destroy/{id}', [UserController::class, 'destroy'])/*->middleware('auth:sanctum')*/;

/*-----------------*/

Route::post('/users/AttemptLogin', [AuthController::class, 'Login'])->name('login')/*->middleware(StartSession::class)*/;
//Route::post('/users/CheckUser', [AuthController::class, 'CheckUser'])->middleware('auth:sanctum');
Route::post('/users/Logout/', [AuthController::class, 'Logout'])->middleware('auth:sanctum');
Route::post('/users/SentEmailResetPassword', [AuthController::class, 'sendEmailResetPassword'])->name('password.send_reset')->middleware('auth:sanctum');
Route::post('/users/ResetPassword', [AuthController::class, 'resetPassword'])->middleware('auth:sanctum');

/* PRODUTO */
Route::get('/users/show/{id}', [ProductController::class, 'show'])->middleware('auth:sanctum');
Route::post('/users/store', [ProductController::class, 'store'])->middleware('auth:sanctum');
Route::put('/users/update/{id}', [ProductController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/users/destroy/{id}', [ProductController::class, 'destroy'])->middleware('auth:sanctum');


