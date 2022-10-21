<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
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

Route::get('/', [Controller::class, 'index']);

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/products/{id}', function () {
    return view('products.show');
});

Route::get('/products', function () {
    return view('products.index');
});


// User route
Route::get('/login', function () {
    return view('users.login');
});
Route::post('/login', function () {
    return view('users.login');
});
Route::post("/logout", [UserController::class, "logout"]);

Route::get('/register', [UserController::class, "create"]);
Route::post('/register', [UserController::class, "store"]);

Route::get('/user', [UserController::class, "edit"]);
// 
