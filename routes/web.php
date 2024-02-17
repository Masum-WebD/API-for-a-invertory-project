<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

//web Api route
Route::post('/user_registration', [UserController::class, 'UserRegistration']);
Route::post('login', [UserController::class, 'UserLogin']);
Route::get('/userProfile', [UserController::class, 'UserProfile'])->middleware('auth:sanctum');
Route::get('/userLogout', [UserController::class, 'UserLogout'])->middleware('auth:sanctum');
Route::post('userUpdate', [UserController::class, 'UserUpdate'])->middleware('auth:sanctum');
Route::post('/sendOTP', [UserController::class, 'SendOTP']);
Route::post('/verifyOTP', [UserController::class, 'VerifyOTP']);
Route::post('/resetPassword', [UserController::class, 'ResetPassword'])->middleware('auth:sanctum');

//Category Related Api
Route::get('category', [CategoryController::class, 'index'])->middleware('auth:sanctum');
Route::post('category/store', [CategoryController::class, 'store'])->middleware('auth:sanctum');
Route::post('category/update/{id}', [CategoryController::class, 'update'])->middleware('auth:sanctum');
Route::delete('category/delete/{id}', [CategoryController::class, 'delete'])->middleware('auth:sanctum');

