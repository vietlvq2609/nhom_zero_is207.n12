<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Models\Address;
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
    // User - forgot password
        // cấu hình email trong laravel: https://www.youtube.com/watch?v=0qcRBik3xnI
Route::get('/forgot-password', [UserController::class, "fogotPassword"])->name('password.request');
Route::post('/forgot-password', [UserController::class, "postFogotPassword"])->name('password.email');
Route::get('/reset-password/{user}/{token}', [UserController::class, "resetPassword"])->name('password.reset');
Route::post('/reset-password/{user}/{token}', [UserController::class, "postResetPassword"])->name('password.update');

    // User - add received addresses
Route::get('/user/address', [UserController::class, "editAddress"])->name('user.address');
Route::get('/user/address/add-new-address', [UserController::class, "addAddressPage"])->name('user.new-address');
Route::post('/user/address/add-new-address', [UserController::class, "addAddress"])->name('user.new-address-post');
Route::post('/user/address', [UserController::class, "updateAddress"])->name('user.updateAddress');

    // User - change password
Route::get('user/changePassword',[UserController::class, "changePasswordView"])->name('user.changePassword');
Route::post('user/changePassword',[UserController::class, "changePassword"])->name('user.postChangePassword');

    // User change infomations
Route::get('user/changeInfomation',[UserController::class, "changeInfoView"])->name('user.changeInfo');
Route::post('user/changeInfomation',[UserController::class, "changeInfo"])->name('user.postChangeInfo');

    // User - add payment methods
        // View
Route::get('user/PaymentMethod',[UserController::class, "paymentMethodView"])->name('user.paymentMethodView');
Route::post('user/PaymentMethod',[UserController::class, "savePaymentMethod"])->name('user.paymentMethod');
        // Action
Route::get('user/addPaymentMethod',[UserController::class, "addPaymentMethodView"])->name('user.addPaymentMethodView');
Route::post('user/addPaymentMethod',[UserController::class, "addPaymentMethod"])->name('user.addPaymentMethod');

    // User - show their reviews
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

Route::prefix('admin')->middleware(['isAdmin'])->group(function() {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/user', [AdminController::class, 'users'])->name('adminUser');
    Route::get('/products', [AdminController::class, 'products'])->name('adminProduct');
    Route::get('/orders', [AdminController::class, 'orders'])->name('adminOrder');
    Route::get('/shoppings', [AdminController::class, 'shoppings'])->name('adminShop');
    Route::get('/createUser', [AdminController::class, 'createUser'])->name('createUser');
    Route::get('/editUser/{id}', [AdminController::class, 'loadEditForm'])->name('loadEditForm');
    Route::get('/destroyUser/{id}', [AdminController::class, 'destroyUser'])->name('destroyUser');
    Route::get('createProduct', [AdminController::class, 'createProduct'])->name('createProduct');
    Route::get('/editProduct/{id}', [AdminController::class, 'loadEditProduct'])->name('editProduct');
    Route::get('destroyProduct/{id}', [AdminController::class, 'destroyProduct'])->name('destroyProduuct');
    Route::get('/editStatus{id}', [AdminController::class, 'editStatus'])->name('editStatus');

    Route::post('/insertUser', [AdminController::class, 'insertUser'])->name('insertUser');
    Route::post('/updateUser/{id}', [AdminController::class, 'updateUser'])->name('updateUser');
    Route::post('/insertProduct', [AdminController::class, 'insertProduct'])->name('insertProduct');
    Route::post('/updateProduct/{id}', [AdminController::class, 'updateProduct'])->name('updateProduct');
});


