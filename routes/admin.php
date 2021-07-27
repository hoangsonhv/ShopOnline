<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::get("/",[AdminController::class,"home"]);

Route::get("products",[ProductController::class,"listProduct"]);
Route::get("products/add",[ProductController::class,"addProduct"]);
Route::post("products/save",[ProductController::class,"saveProduct"]);
Route::get("products/edit/{id}",[ProductController::class,"editProduct"]);
Route::post("products/edit/{id}",[ProductController::class,"updateProduct"]);
Route::get("products/delete/{id}",[ProductController::class,"deleteProduct"]);

Route::get("categories",[CategoryController::class,"listCategory"]);
Route::get("categories/add",[CategoryController::class,"addCategory"]);
Route::post("categories/save",[CategoryController::class,"saveCategory"]);
Route::get("categories/edit/{id}",[CategoryController::class,"editCategory"]);
Route::post("categories/edit/{id}",[CategoryController::class,"updateCategory"]);
Route::get("categories/delete/{id}",[CategoryController::class,"deleteCategory"]);
