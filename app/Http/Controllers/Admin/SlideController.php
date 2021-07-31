<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Models\Team;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    //

    public function showSlide(){
        $slides = Slide::all();
        return view("administrators/slide/slide_list",[
            "slides"=>$slides
        ]);
    }

    public function addSlide(){
        return view("administrators/slide/slide_add");
    }

    public function saveSlide(Request $request){
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
            Slide::create([
                "content"=>$request->get("content"),
                "title"=>$request->get("title"),
                "image"=>$image
            ]);
        }catch (\Exception $e){
            return back()->with("error","Không thể thêm mới.!");
        }
        return redirect("admin/slides")->with("success","Thêm mới thành công.!");
    }

    public function editSlide($id){
        $slide = Slide::findOrFail($id);
        return view("administrators/slide/slide_edit",[
            "slide"=>$slide
        ]);
    }

    public function updateSlide(Request $request,$id){
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
                            } catch (\Exception $e) {
                            }
                        }
                    }
                }
                $slide = Slide::findOrFail($id);
                $slide->update([
                    "content"=>$request->get("content"),
                    "title"=>$request->get("title"),
                    "image"=>$image
                ]);
            }else{
                $slide = Slide::findOrFail($id);
                $slide->update([
                    "content"=>$request->get("content"),
                    "title"=>$request->get("title")
                ]);
            }
        }catch (\Exception $e){
            return back()->with("error","Không thể cập nhật.Hãy kiểm tra lại.!");
        }
        return redirect("admin/slides")->with("success","Cập nhật thành công.!");
    }

    public function deleteSlide($id){
        try {
            Slide::findOrFail($id)->delete();
        }catch (\Exception $e){
            return back()->with('error',"Không thể xóa.!");
        }
        return redirect()->to("admin/slides")->with('success',"Xóa thành công.!");
    }
}
