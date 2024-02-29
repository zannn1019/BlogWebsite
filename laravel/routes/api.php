<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//? Route Auth
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post("/logout", [UserController::class, 'logout']);

//? Rute untuk PostController
Route::resource('post', PostController::class)->only(['index', 'show']);

//? Rute untuk yang memerlukan autentikasi
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('category', CategoryController::class)->only(['store', 'update', 'destroy']);
    Route::resource('post', PostController::class)->only(['store', 'update', 'destroy']);
});

//? Rute untuk yang tidak memerlukan autentikasi
Route::resource('category', CategoryController::class)->only(['index', 'show']);
Route::resource('post', PostController::class)->only(['index', 'show']);


//? Rute tanpa middleware
// Route::resource('post', PostController::class);
// Route::resource('category', CategoryController::class);
