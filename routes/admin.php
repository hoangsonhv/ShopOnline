<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\StaffController;

Route::get("/login",[AdminController::class,"getLogin"]);

Route::post("/login",[AdminController::class,"postLogin"]);

Route::get("/logout", [AdminController::class, "logout"])->name("admin.logout");

Route::middleware("auth:staff,admin")->group(function (){
//    Route::get('/', function () {
//        return view('administrators/admin/home');
//    });
    Route::get("/",[AdminController::class,"home"]);

    Route::get("staffs",[StaffController::class,"showStaff"]);
    Route::get("staffs/add",[StaffController::class,"addStaff"]);
    Route::post("staffs/save",[StaffController::class,"saveStaff"]);
    Route::get("staffs/edit/{id}",[StaffController::class,"editStaff"]);
    Route::post("staffs/update/{id}",[StaffController::class,"updateStaff"]);
    Route::get("staffs/delete/{id}",[StaffController::class,"deleteStaff"]);

    Route::get("teams",[TeamController::class,"showTeam"]);
    Route::get("teams/add",[TeamController::class,"addTeam"]);
    Route::post("teams/save",[TeamController::class,"saveTeam"]);
    Route::get("teams/edit/{id}",[TeamController::class,"editTeam"]);
    Route::post("teams/update/{id}",[TeamController::class,"updateTeam"]);
    Route::get("teams/delete/{id}",[TeamController::class,"deleteTeam"]);

    Route::get("slides",[SlideController::class,"showSlide"]);
    Route::get("slides/add",[SlideController::class,"addSlide"]);
    Route::post("slides/save",[SlideController::class,"saveSlide"]);
    Route::get("slides/edit/{id}",[SlideController::class,"editSlide"]);
    Route::post("slides/update/{id}",[SlideController::class,"updateSlide"]);
    Route::get("slides/delete/{id}",[SlideController::class,"deleteSlide"]);

    Route::get("products",[ProductController::class,"listProduct"]);
    Route::get("products/add",[ProductController::class,"addProduct"]);
    Route::post("products/save",[ProductController::class,"saveProduct"]);
    Route::get("products/edit/{id}",[ProductController::class,"editProduct"]);
    Route::post("products/update/{id}",[ProductController::class,"updateProduct"]);
    Route::get("products/delete/{id}",[ProductController::class,"deleteProduct"]);

    Route::get("categories",[CategoryController::class,"listCategory"]);
    Route::get("categories/add",[CategoryController::class,"addCategory"]);
    Route::post("categories/save",[CategoryController::class,"saveCategory"]);
    Route::get("categories/edit/{id}",[CategoryController::class,"editCategory"]);
    Route::post("categories/update/{id}",[CategoryController::class,"updateCategory"]);
    Route::get("categories/delete/{id}",[CategoryController::class,"deleteCategory"]);
});
