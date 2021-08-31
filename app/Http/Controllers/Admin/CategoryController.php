<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function listCategory(){
        $category = Category::all();
        return view("administrators/category/category_list",[
            "category"=>$category
        ]);
    }

    public function addCategory(){
        return view("administrators/category/category_add");
    }

    public function saveCategory(Request $request){
        $request->validate([
           "name"=>"required"
        ],[
            "name.required"=>"Vui Lòng nhập tên loại sản phẩm.!"
        ]);
        try {
            Category::create([
                "name"=>$request->get("name")
            ]);
            return redirect("admin/categories")->with("success","Thêm thành công!");
        }catch (\Exception $e){
            return redirect()->back()->with("error","Đã xảy ra lỗi!");
        }
    }

    public function editCategory($id){
        $cate1 = Category::findOrFail($id);
        return view("administrators/category/category_edit",[
            "cate1"=>$cate1
        ]);
    }

    public function updateCategory(Request $request,$id){
        $request->validate([
            "name"=>"required"
        ]);
        try {
            $cate = Category::findOrFail($id);
            $cate->update([
                "name"=>$request->get("name")
            ]);
            return redirect("admin/categories")->with("success","Sửa thành công!");
        }catch (\Exception $e){
            return redirect()->back()->with("error","Đã xảy ra lỗi!");
        }
    }

    public function deleteCategory($id){
        try {
            $category = Category::findOrFail($id);
            $category->delete();
        }catch (\Exception $e){
            return redirect("admin/categories")->with('error',"Không thể xóa.!");
        }
        return redirect()->to("admin/categories")->with('success',"Xóa thành công.!");
    }
}
