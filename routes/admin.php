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
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\BillDetailController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;


Route::get("/login",[AdminController::class,"getLogin"])->name("admin.login");

Route::post("/login",[AdminController::class,"postLogin"]);

Route::get("/logout", [AdminController::class, "logout"])->name("admin.logout");

Route::middleware('auth:admin,staff')->group(function (){

    Route::get("/",[AdminController::class,"homeAdmin"]);

    Route::get("bills",[BillController::class,"showBill"]);
    Route::get("bills/edit/{id}",[BillController::class,"editBill"]);
    Route::get("bills/update/{id}",[BillController::class,"updateBill"]);
    Route::post("bills/cancel/{id}",[BillController::class,"cancelBill"]);
    Route::get("bills/delete/{id}",[BillController::class,"deleteBill"]);

    Route::get("customers",[CustomerController::class,"showCustomer"]);
    Route::get("customers/delete/{id}",[CustomerController::class,"deleteCustomer"]);

//    Route::get("bill-detail",[BillDetailController::class,"showBillDetail"]);

    Route::get("change-staff",[StaffController::class,"updatePassword"]);
    Route::post("change-staff",[StaffController::class,"saveUpdatePassword"]);

    Route::middleware("admin")->group(function(){
        Route::get("orders",[OrderController::class,"show"]);

        Route::get("admins",[AdminController::class,"showAdmin"]);
        Route::get("admins/add",[AdminController::class,"addAdmin"]);
        Route::post("admins/save",[AdminController::class,"saveAdmin"]);
        Route::get("admins/edit/{id}",[AdminController::class,"editAdmin"]);
        Route::post("admins/update/{id}",[AdminController::class,"updateAdmin"]);

        Route::get("users",[UserController::class,"listUser"]);
        Route::get("users/add",[UserController::class,"addUser"]);
        Route::post("users/save",[UserController::class,"saveUser"]);
        Route::get("users/edit/{id}",[UserController::class,"editUser"]);
        Route::post("users/update/{id}",[UserController::class,"updateUser"]);
        Route::get("users/delete/{id}",[UserController::class,"deleteUser"]);

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

        Route::get("news",[NewController::class,"showNew"]);
        Route::get("news/add",[NewController::class,"addNew"]);
        Route::post("news/save",[NewController::class,"saveNew"]);
        Route::get("news/edit/{id}",[NewController::class,"editNew"]);
        Route::post("news/update/{id}",[NewController::class,"updateNew"]);
        Route::get("news/delete/{id}",[NewController::class,"deleteNew"]);

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

        Route::get("brands",[BrandController::class,"listBrand"]);
        Route::get("brands/add",[BrandController::class,"addBrand"]);
        Route::post("brands/save",[BrandController::class,"saveBrand"]);
        Route::get("brands/edit/{id}",[BrandController::class,"editBrand"]);
        Route::post("brands/update/{id}",[BrandController::class,"updateBrand"]);
        Route::get("brands/delete/{id}",[BrandController::class,"deleteBrand"]);

        Route::get("blogs",[BlogController::class,"showBlog"]);
        Route::get("blogs/add",[BlogController::class,"addBlog"]);
        Route::post("blogs/save",[BlogController::class,"saveBlog"]);
        Route::get("blogs/edit/{id}",[BlogController::class,"editBlog"]);
        Route::post("blogs/update/{id}",[BlogController::class,"updateBlog"]);
        Route::get("blogs/delete/{id}",[BlogController::class,"deleteBlog"]);

        Route::get("messages",[MessageController::class,"showMes"]);
        Route::get("messages/delete/{id}",[MessageController::class,"deleteMes"]);
        Route::get("messages/update/{id}",[MessageController::class,"updateMess"]);

        Route::get("comments",[CommentController::class,"listComment"]);
        Route::get("comments/detail/{id}",[CommentController::class,"detailComment"]);
        Route::get("comments/delete/{id}",[CommentController::class,"deleteComment"]);
        Route::get("comments/update/{id}",[CommentController::class,"updateComment"]);
        Route::get("reply/detail/{id}",[CommentController::class,"Detail_Reply"]);
        Route::get("reply/delete/{id}",[CommentController::class,"deleteReply"]);
    });

});
