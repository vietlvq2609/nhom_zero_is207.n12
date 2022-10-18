<?php

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

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/products/{id}', function () {
    return view('products.show');
});

Route::get('/products', function () {
    return view('products.index');
});

Route::get('/login', function () {
    return view('users.login');
});
Route::get('/register', function () {
    return view('users.register');
});
