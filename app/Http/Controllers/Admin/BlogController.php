<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function showBlog(){
        $blogs = Blog::all();
        return view("administrators/blog/blog_list",[
            "blogs"=>$blogs
        ]);
    }

    public function addBlog(){
        return view("administrators/blog/blog_add");
    }

    public function saveBlog(Request $request){
        $request->validate([
            "content"=>"required",
            "title"=>"required",
            "date"=>"required"
        ],[
            "content.required"=>"Vui lòng nhập mô tả",
            "title.required"=>"Vui lòng nhập title",
            "date.required"=>"Vui lòng nhập Ngày"
        ]);
        $image = null;
        if ($request->has("image")){
            $file = $request->file("image");
            $exName = $file->getClientOriginalExtension();
            $fileName = time().".".$exName;
            $fileSize = $file->getSize();
            $allow = ["png","jpeg","jpg","gif"];

            if (in_array($exName,$allow)){
                if ($fileSize < 10000000){
                    try {
                        $file->move("upload",$fileName);
                        $image = $fileName;
                    }catch (\Exception $e){}
                }
            }
        }
        try{
            Blog::create([
                "content"=>$request->get("content"),
                "title"=>$request->get("title"),
                "date"=>$request->get("date"),
                "image"=>$image
            ]);
        }catch (\Exception $e){
            return back()->with("error","Không thể thêm mới.!");
        }
        return redirect("admin/blogs")->with("success","Thêm mới thành công.!");
    }

    public function editBlog($id){
        $blog = Blog::findOrFail($id);
        return view("administrators/blog/blog_edit",[
            "blog"=>$blog
        ]);
    }

    public function updateBlog(Request $request,$id){
        $request->validate([
            "content"=>"required",
            "title"=>"required",
            "date"=>"required",
        ]);
        try {
            $image = request("image");
            if ($image) {
                $image = null;
                if ($request->has("image")) {
                    $file = $request->file("image");
                    $exName = $file->getClientOriginalExtension();
                    $fileName = time() . "." . $exName;
                    $fileSize = $file->getSize();
                    $allow = ["png", "jpeg", "jpg", "gif"];
                    if (in_array($exName, $allow)) {
                        if ($fileSize < 10000000) {
                            try {
                                $file->move("upload", $fileName);
                                $image = $fileName;
                            } catch (\Exception $e) {}
                        }
                    }
                }
                $blog = Blog::findOrFail($id);
                $blog->update([
                    "content"=>$request->get("content"),
                    "title"=>$request->get("title"),
                    "date"=>$request->get("date"),
                    "image"=>$image
                ]);
            }else{
                $blog = Blog::findOrFail($id);
                $blog->update([
                    "content"=>$request->get("content"),
                    "title"=>$request->get("title"),
                    "date"=>$request->get("date"),
                ]);
            }
        }catch (\Exception $e){
            return back()->with("error","Không thể cập nhật.Hãy kiểm tra lại.!");
        }
        return redirect("admin/blogs")->with("success","Cập nhật thành công.!");
    }

    public function deleteBlog($id){
        try {
            Blog::findOrFail($id)->delete();
        }catch (\Exception $e){
            return back()->with('error',"Không thể xóa.!");
        }
        return redirect()->to("admin/blogs")->with('success',"Xóa thành công.!");
    }
}
