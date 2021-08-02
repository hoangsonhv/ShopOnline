<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\WebController;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Register\RegisterController;
use App\Http\Controllers\Web\MessageController;
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

//Route::get('/', function () {
//    $config = ['table'=>'categories','length'=>7,'prefix'=>random_int(00,99)];
//
//    $id1 = IdGenerator::generate($config);
//    $config1 = ['table'=>'categories','length'=>15,'prefix'=>$id1];
//    $id = IdGenerator::generate($config1);
//    return $id;
////    return view('welcome');
//});


Route::get("/",[WebController::class,"index"]);

Route::get("search",[WebController::class,"searchItem"]);

Route::get("login",[LoginController::class,"login"]);
Route::post("login",[LoginController::class,"store"])->name("login");
Route::get("products/add-to-cart/{id}",[WebController::class,"addToCart"]);
Route::get("clear-cart",[WebController::class,"clearCart"]);
Route::get("delete-cart/{id}",[WebController::class,"deleteCart"]);
Route::get("register",[RegisterController::class,"register"]);
Route::post('register',[RegisterController::class,"store"])->name('register');
Route::get("product-detail/{id}",[WebController::class,"productDetail"]);

Route::get("contacts",[WebController::class,"getContact"]);

Route::get("shopping-cart",[WebController::class,"shoppingCart"])->name("shoppingCart");
Route::get("update-cart/{id}",[WebController::class,"updateCart"]);


Route::middleware("auth")->group(function (){
    Route::get("logout",[LoginController::class,"logout"])->name("logout");
    Route::post("product-detail/{id}",[WebController::class,"createComment"]);
    Route::post("contacts",[MessageController::class,"sendMessage"]);

    Route::get("checkout",[WebController::class,"checkOut"]);

    Route::post("checkout",[WebController::class,"placeOrder"]);
});
