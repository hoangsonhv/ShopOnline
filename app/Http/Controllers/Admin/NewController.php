<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Slide;
use Illuminate\Http\Request;

class NewController extends Controller
{
    public function showNew(){
        $news = News::all();
        return view("administrators/new/new_list",[
            "news"=>$news
        ]);
    }

    public function addNew(){
        return view("administrators/new/new_add");
    }

    public function saveNew(Request $request){
        $request->validate([
            "content"=>"required",
            "title"=>"required"
        ],[
            "content.required"=>"Vui lòng nhập mô tả",
            "title.required"=>"Vui lòng nhập title"
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
            News::create([
                "content"=>$request->get("content"),
                "title"=>$request->get("title"),
                "image"=>$image
            ]);
        }catch (\Exception $e){
            return back()->with("error","Không thể thêm mới.!");
        }
        return redirect("admin/news")->with("success","Thêm mới thành công.!");
    }

    public function editNew($id){
        $new = News::findOrFail($id);
        return view("administrators/new/new_edit",[
            "new"=>$new
        ]);
    }

    public function updateNew(Request $request,$id){
        $request->validate([
            "content"=>"required",
            "title"=>"required"
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
                $new = News::findOrFail($id);
                $new->update([
                    "content"=>$request->get("content"),
                    "title"=>$request->get("title"),
                    "image"=>$image
                ]);
            }else{
                $new = News::findOrFail($id);
                $new->update([
                    "content"=>$request->get("content"),
                    "title"=>$request->get("title")
                ]);
            }
        }catch (\Exception $e){
            return back()->with("error","Không thể cập nhật.Hãy kiểm tra lại.!");
        }
        return redirect("admin/news")->with("success","Cập nhật thành công.!");
    }

    public function deleteNew($id){
        try {
            News::findOrFail($id)->delete();
        }catch (\Exception $e){
            return back()->with('error',"Không thể xóa.!");
        }
        return redirect()->to("admin/news")->with('success',"Xóa thành công.!");
    }
}
