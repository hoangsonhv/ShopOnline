<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\WebController;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Register\RegisterController;
use App\Http\Controllers\Web\MessageController;
use App\Http\Controllers\User\UserController;

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


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
    return redirect("/");
})->name('dashboard');

Route::get("/",[WebController::class,"index"]);

Route::get("search",[WebController::class,"searchItem"]);

Route::get("login",[LoginController::class,"login"]);

Route::post("login",[LoginController::class,"store"])->name("login");

Route::post("login-checkout",[LoginController::class,"loginCheck"])->name("postLogin");

Route::get("products/add-to-cart/{id}",[WebController::class,"addToCart"]);

Route::get("products/add-to-wish/{id}",[WebController::class,"addToWishList"]);

Route::get("products/add-to-wish/{id}",[WebController::class,"addToWishList"]);

Route::get("delete-wish/{id}",[WebController::class,"deleteWish"]);

Route::get("wishlist",[WebController::class,"getWishList"]);

Route::get("clear-cart",[WebController::class,"clearCart"]);

Route::get("delete-cart/{id}",[WebController::class,"deleteCart"]);

Route::get("delete-wish/{id}",[WebController::class,"deleteWish"]);

Route::get("delete-order/{id}",[WebController::class,"deleteOrder"]);

Route::get("register",[RegisterController::class,"register"]);

Route::post('register',[RegisterController::class,"store"])->name('register');

Route::post('register-checkout',[RegisterController::class,"CheckOut"])->name('reCheckout');

Route::get("product-detail/{id}",[WebController::class,"productDetail"]);

Route::get('blogs',[WebController::class,"blog"]);

Route::get('blogs-detail/{id}',[WebController::class,"blogs_detail"]);

Route::get("contacts",[WebController::class,"getContact"]);

Route::get("wishlist",[WebController::class,"getWishList"]);

Route::get("cate/{id}",[WebController::class,"getCate"]);

Route::get("shopping-cart",[WebController::class,"shoppingCart"])->name("shoppingCart");

Route::get("update-cart/{id}",[WebController::class,"updateCart"]);

Route::get("update-order/{id}",[WebController::class,"updateOrder"]);

Route::get('shop',[WebController::class,'shop']);

Route::post("contacts",[MessageController::class,"sendMessage"]);

Route::get("change-user",[UserController::class,"showBillList"]);

Route::get("detail-bill/{id}",[UserController::class,"showDetailBill"]);

Route::post("detail-bill/cancel/{id}",[UserController::class,"cancelBillUser"]);

Route::get("abouts",[WebController::class,"about"]);

Route::post("product-detail/{id}",[WebController::class,"createComment"]);

Route::post("reply-comments/{id}",[WebController::class,"createReply"]);

Route::get("checkout",[WebController::class,"checkOut"]);

Route::post("payment_online",[WebController::class,"payment_online"])->name("payment_online");

Route::get("return",[WebController::class,"return"])->name("vnpay.return");

Route::get("returnOrder",[WebController::class,"returnOrder"])->name("order.return");

Route::middleware("auth")->group(function (){

    Route::get("logout",[LoginController::class,"logout"])->name("logout");

    Route::post("rating",[WebController::class,"rating"])->name("rating");

    Route::post("checkout",[WebController::class,"placeOrder"]);

    Route::post("change-user",[UserController::class,"saveUpdatePassword"]);

    Route::get("orders/{id}",[WebController::class,"orderProduct"]);

    Route::post("orders/{id}",[WebController::class,"orderCheckout"]);

});
