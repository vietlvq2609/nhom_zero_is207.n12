<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Main routes
Route::get('/', [Controller::class, 'home']);
Route::get('/about', [Controller::class, 'about']);
Route::get('/contact', [Controller::class, 'contact']);


// Product routes
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);


// User routes
Route::get('/login', [UserController::class, "login"]);
Route::get('/register', [UserController::class, "create"]);
Route::get('/user', [UserController::class, "edit"]);

Route::post('/user/authenticate', [UserController::class, "authenticate"]);
Route::post("/logout", [UserController::class, "logout"]);
Route::post('/register', [UserController::class, "store"]);

// 
