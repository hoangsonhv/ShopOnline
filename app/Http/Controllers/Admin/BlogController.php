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
        $image1 = null;
        $image2 = null;
        if ($request->has("image") && $request->has("img2") && $request->has("img3")){
            $file = $request->file("image");
            $file1 = $request->file("img2");
            $file2 = $request->file("img3");
            $exName = $file->getClientOriginalExtension();
            $exName1 = $file1->getClientOriginalExtension();
            $exName2 = $file2->getClientOriginalExtension();
            $fileName = time().".".$exName;
            $fileName1 = time().".".$exName1;
            $fileName2 = time().".".$exName2;
            $fileSize = $file->getSize();
            $fileSize1 = $file1->getSize();
            $fileSize2 = $file2->getSize();
            $allow = ["png","jpeg","jpg","gif"];
            if (in_array($exName && $exName1 && $exName2,$allow)){
                if ($fileSize && $fileSize1 && $fileSize2 < 10000000){
                    try {
                        $file->move("upload",$fileName);
                        $file1->move("upload",$fileName1);
                        $file2->move("upload",$fileName2);
                        $image = $fileName;
                        $image1 = $fileName1;
                        $image2 = $fileName2;
                    }catch (\Exception $e){
                    }
                }
            }

        }
        try{
            Blog::create([
                "content"=>$request->get("content"),
                "title"=>$request->get("title"),
                "date"=>$request->get("date"),
                "image"=>$image,
                "img2"=>$image1,
                "img3"=>$image2,
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
