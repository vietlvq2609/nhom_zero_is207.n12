<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
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

Route::get('/forgot-password', [UserController::class, "fogotPassword"])->name('password.request');
Route::post('/forgot-password', [UserController::class, "postFogotPassword"])->name('password.email');
Route::get('/reset-password/{token}', [UserController::class, "resetPassword"])->name('password.reset');
Route::post('/reset-password', [UserController::class, "postResetPassword"])->name('password.update');

Route::get('/user/address', [UserController::class, "editAddress"])->name('user.address');
Route::get('/user/address/add-new-address', [UserController::class, "addAddressPage"])->name('user.new-address');
Route::post('/user/address/add-new-address', [UserController::class, "addAddress"])->name('user.new-address-post');
Route::post('/user/address', [UserController::class, "updateAddress"])->name('user.updateAddress');

Route::get('user/changePassword',[UserController::class, "changePasswordView"])->name('user.changePassword');
Route::post('user/changePassword',[UserController::class, "changePassword"])->name('user.postChangePassword');

Route::get('user/changeInfomation',[UserController::class, "changeInfoView"])->name('user.changeInfo');
Route::post('user/changeInfomation',[UserController::class, "changeInfo"])->name('user.postChangeInfo');

Route::get('user/PaymentMethod',[UserController::class, "paymentMethodView"])->name('user.paymentMethodView');
Route::post('user/PaymentMethod',[UserController::class, "savePaymentMethod"])->name('user.paymentMethod');

Route::get('user/addPaymentMethod',[UserController::class, "addPaymentMethodView"])->name('user.addPaymentMethodView');
Route::post('user/addPaymentMethod',[UserController::class, "addPaymentMethod"])->name('user.addPaymentMethod');

Route::get('user/review',[UserController::class, "reviewView"])->name('user.reviewView');

// Cart routes
Route::get('/cart/delete/{id}/{qty}', [CartController::class, 'destroy'])->name('cart.delete{id}/{qty}');
Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart', [CartController::class, 'store']);

Route::get('/cart/prepare', [CartController::class, 'prepareView'])->name('cart.prepareView');
Route::post('/cart/prepare', [CartController::class, 'postPrepare'])->name('cart.postPrepare');

Route::get('/cart/shipping', [CartController::class, 'shippingView'])->name('cart.shippingView');
Route::post('/cart/shipping', [CartController::class, 'postShipping'])->name('cart.postShipping');

Route::get('/cart/receive', [CartController::class, 'receiveView'])->name('cart.receiveView');
Route::get('/cart/receive/{id}', [CartController::class, 'postReceive'])->name('cart.postReceive');

Route::get('/cart/bought', [CartController::class, 'boughtView'])->name('cart.boughtView');

Route::get('/cart/cancle', [CartController::class, 'cancleView'])->name('cart.cancleView');
Route::get('/cart/cancle/{id}', [CartController::class, 'postCancle'])->name('cart.postCancle_{id}');

Route::get('/cart/buyAgain/{id}', [CartController::class, 'buyAgain']);

Route::get('/review/{id}',[CartController::class, 'reviewView'])->name('cart.reviewView');
Route::get('/review/delete/{id}',[CartController::class, 'deleteReview']);
Route::post('/review',[CartController::class, 'postReview'])->name('cart.postReview');

// Admin routes
Route::get('/admin', [AdminController::class, 'index']);
