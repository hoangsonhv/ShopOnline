<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NewController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\MessageController;


Route::get("/login",[AdminController::class,"getLogin"])->name("admin.login");

Route::post("/login",[AdminController::class,"postLogin"]);

Route::get("/logout", [AdminController::class, "logout"])->name("admin.logout");

Route::middleware('admin:auth,auth:staff')->group(function (){

    Route::get("/",[AdminController::class,"homeAdmin"])->middleware("admin");

    Route::get("users",[UserController::class,"listUser"]);
    Route::get("users/add",[UserController::class,"addUser"])->middleware("admin");
    Route::post("users/save",[UserController::class,"saveUser"])->middleware("admin");
    Route::get("users/edit/{id}",[UserController::class,"editUser"])->middleware("admin");
    Route::post("users/update/{id}",[UserController::class,"updateUser"])->middleware("admin");
    Route::get("users/delete/{id}",[UserController::class,"deleteUser"])->middleware("admin");

    Route::get("staffs",[StaffController::class,"showStaff"]);
    Route::get("staffs/add",[StaffController::class,"addStaff"])->middleware("admin");
    Route::post("staffs/save",[StaffController::class,"saveStaff"])->middleware("admin");
    Route::get("staffs/edit/{id}",[StaffController::class,"editStaff"]);
    Route::post("staffs/update/{id}",[StaffController::class,"updateStaff"]);
    Route::get("staffs/delete/{id}",[StaffController::class,"deleteStaff"])->middleware("admin");

    Route::get("teams",[TeamController::class,"showTeam"]);
    Route::get("teams/add",[TeamController::class,"addTeam"])->middleware("admin");
    Route::post("teams/save",[TeamController::class,"saveTeam"])->middleware("admin");
    Route::get("teams/edit/{id}",[TeamController::class,"editTeam"])->middleware("admin");
    Route::post("teams/update/{id}",[TeamController::class,"updateTeam"])->middleware("admin");
    Route::get("teams/delete/{id}",[TeamController::class,"deleteTeam"])->middleware("admin");

    Route::get("slides",[SlideController::class,"showSlide"]);
    Route::get("slides/add",[SlideController::class,"addSlide"])->middleware("admin");
    Route::post("slides/save",[SlideController::class,"saveSlide"])->middleware("admin");
    Route::get("slides/edit/{id}",[SlideController::class,"editSlide"])->middleware("admin");
    Route::post("slides/update/{id}",[SlideController::class,"updateSlide"])->middleware("admin");
    Route::get("slides/delete/{id}",[SlideController::class,"deleteSlide"])->middleware("admin");

    Route::get("news",[NewController::class,"showNew"]);
    Route::get("news/add",[NewController::class,"addNew"])->middleware("admin");
    Route::post("news/save",[NewController::class,"saveNew"])->middleware("admin");
    Route::get("news/edit/{id}",[NewController::class,"editNew"])->middleware("admin");
    Route::post("news/update/{id}",[NewController::class,"updateNew"])->middleware("admin");
    Route::get("news/delete/{id}",[NewController::class,"deleteNew"])->middleware("admin");

    Route::get("products",[ProductController::class,"listProduct"]);
    Route::get("products/add",[ProductController::class,"addProduct"])->middleware("admin");
    Route::post("products/save",[ProductController::class,"saveProduct"])->middleware("admin");
    Route::get("products/edit/{id}",[ProductController::class,"editProduct"]);
    Route::post("products/update/{id}",[ProductController::class,"updateProduct"]);
    Route::get("products/delete/{id}",[ProductController::class,"deleteProduct"])->middleware("admin");

    Route::get("categories",[CategoryController::class,"listCategory"]);
    Route::get("categories/add",[CategoryController::class,"addCategory"])->middleware("admin");
    Route::post("categories/save",[CategoryController::class,"saveCategory"])->middleware("admin");
    Route::get("categories/edit/{id}",[CategoryController::class,"editCategory"])->middleware("admin");
    Route::post("categories/update/{id}",[CategoryController::class,"updateCategory"])->middleware("admin");
    Route::get("categories/delete/{id}",[CategoryController::class,"deleteCategory"])->middleware("admin");

    Route::get("brands",[BrandController::class,"listBrand"]);
    Route::get("brands/add",[BrandController::class,"addBrand"])->middleware("admin");
    Route::post("brands/save",[BrandController::class,"saveBrand"])->middleware("admin");
    Route::get("brands/edit/{id}",[BrandController::class,"editBrand"])->middleware("admin");
    Route::post("brands/update/{id}",[BrandController::class,"updateBrand"])->middleware("admin");
    Route::get("brands/delete/{id}",[BrandController::class,"deleteBrand"])->middleware("admin");

    Route::get("blogs",[BlogController::class,"showBlog"]);
    Route::get("blogs/add",[BlogController::class,"addBlog"])->middleware("admin");
    Route::post("blogs/save",[BlogController::class,"saveBlog"])->middleware("admin");
    Route::get("blogs/edit/{id}",[BlogController::class,"editBlog"])->middleware("admin");
    Route::post("blogs/update/{id}",[BlogController::class,"updateBlog"])->middleware("admin");
    Route::get("blogs/delete/{id}",[BlogController::class,"deleteBlog"])->middleware("admin");

    Route::get("messages",[MessageController::class,"showMes"]);
    Route::get("messages/delete/{id}",[MessageController::class,"deleteMes"])->middleware("admin");

    Route::get("comments",[CommentController::class,"listComment"]);
    Route::get("comments/delete/{id}",[CommentController::class,"deleteComment"]);
});
