<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use function Livewire\str;

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
//            "summary"=>"required",
//            "outstanding"=>"required",
            "date"=>"required"
        ],[
            "content.required"=>"Vui lòng nhập mô tả",
            "title.required"=>"Vui lòng nhập title",
            "date.required"=>"Vui lòng nhập Ngày"
        ]);
        $image = null;
        $image1 = null;
        $image2 = null;
        if ($request->has("image") && $request->has("image2") && $request->has("image3")){
            $file = $request->file("image");
            $file1 = $request->file("image2");
            $file2 = $request->file("image3");
            $exName = $file->getClientOriginalExtension();
            $exName1 = $file1->getClientOriginalExtension();
            $exName2 = $file2->getClientOriginalExtension();
            $fileName = random_int(1,10000).time().".".$exName;
            $fileName1 = random_int(1,10000).time().".".$exName1;
            $fileName2 = random_int(1,10000).time().".".$exName2;
            $fileSize = $file->getSize();
            $fileSize1 = $file1->getSize();
            $fileSize2 = $file2->getSize();
            $allow = ["png","jpeg","jpg","gif"];
            if (in_array($exName && $exName1 && $exName2,$allow)){
                if ($fileSize && $fileSize1 && $fileSize2 < 10000000){
                    $upload = "upload";
                    if (\Illuminate\Support\Facades\File::exists($upload) == true){
                        try {
                            $file->move("upload",$fileName);
                            $file1->move("upload",$fileName1);
                            $file2->move("upload",$fileName2);
                            $image = $fileName;
                            $image1 = $fileName1;
                            $image2 = $fileName2;
                        }catch (\Exception $e){
                        }
                    }else{
                        mkdir(\Illuminate\Support\Facades\File::makeDirectory($upload,0777,true));
                        try {
                            $file->move("upload",$fileName);
                            $file1->move("upload",$fileName1);
                            $file2->move("upload",$fileName2);
                            $image = $fileName;
                            $image1 = $fileName1;
                            $image2 = $fileName2;
                        }catch (\Exception $e){}
                    }

                }
            }
        }

        try{
            Blog::create([
                "content"=>$request->get("content"),
                "title"=>$request->get("title"),
                "summary"=>$request->get("summary"),
                "outstanding"=>$request->get("outstanding"),
                "date"=>$request->get("date"),
                "image"=>$image,
                "image2"=>$image1,
                "image3"=>$image2,
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
            $image1 = request("image2");
            $image2 = request("image3");
            if ($image) {
                $image = null;
                if ($request->has("image")){
                    $file = $request->file("image");
                    $exName = $file->getClientOriginalExtension();
                    $fileName = random_int(1,10000).time().".".$exName;
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
                $blog = Blog::findOrFail($id);
                $blog->update([
                    "content"=>$request->get("content"),
                    "title"=>$request->get("title"),
                    "summary"=>$request->get("summary"),
                    "outstanding"=>$request->get("outstanding"),
                    "date"=>$request->get("date"),
                    "image"=>$image,
                ]);
            }elseif ($image1){
                $image1 = null;
                if ($request->has("image2")){
                    $file = $request->file("image2");
                    $exName = $file->getClientOriginalExtension();
                    $fileName = random_int(1,10000).time().".".$exName;
                    $fileSize = $file->getSize();
                    $allow = ["png","jpeg","jpg","gif"];
                    if (in_array($exName,$allow)){
                        if ($fileSize < 10000000){
                            try {
                                $file->move("upload",$fileName);
                                $image1 = $fileName;
                            }catch (\Exception $e){}
                        }
                    }
                }
                $blog = Blog::findOrFail($id);
                $blog->update([
                    "content"=>$request->get("content"),
                    "title"=>$request->get("title"),
                    "summary"=>$request->get("summary"),
                    "outstanding"=>$request->get("outstanding"),
                    "date"=>$request->get("date"),
                    "image2"=>$image1,
                ]);
            }elseif ($image2){
                $image2 = null;
                if ($request->has("image3")){
                    $file = $request->file("image3");
                    $exName = $file->getClientOriginalExtension();
                    $fileName = random_int(1,10000).time().".".$exName;
                    $fileSize = $file->getSize();
                    $allow = ["png","jpeg","jpg","gif"];
                    if (in_array($exName,$allow)){
                        if ($fileSize < 10000000){
                            try {
                                $file->move("upload",$fileName);
                                $image2 = $fileName;
                            }catch (\Exception $e){}
                        }
                    }
                }
                $blog = Blog::findOrFail($id);
                $blog->update([
                    "content"=>$request->get("content"),
                    "title"=>$request->get("title"),
                    "summary"=>$request->get("summary"),
                    "outstanding"=>$request->get("outstanding"),
                    "date"=>$request->get("date"),
                    "image3"=>$image2,
                ]);
            }else{
                $blog = Blog::findOrFail($id);
                $blog->update([
                    "content"=>$request->get("content"),
                    "title"=>$request->get("title"),
                    "summary"=>$request->get("summary"),
                    "outstanding"=>$request->get("outstanding"),
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
