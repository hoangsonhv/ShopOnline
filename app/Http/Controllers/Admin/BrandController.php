<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Team;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function listBrand(){
        $brands = Brand::all();
        return view("administrators/brand/brand_list",[
            "brands"=>$brands
        ]);
    }

    public function addBrand(){
        return view("administrators/brand/brand_add");
    }

    public function saveBrand(Request $request){
        $request->validate([
            "name"=>"required"
        ],[
            "name.required"=>"Vui Lòng nhập tên loại sản phẩm.!"
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
                    $upload = "upload";
                    if (\Illuminate\Support\Facades\File::exists($upload) == true){
                        try {
                            $file->move("upload",$fileName);
                            $image = $fileName;
                        }catch (\Exception $e){}
                    }else{
                        mkdir(\Illuminate\Support\Facades\File::makeDirectory($upload,0777,true));
                        try {
                            $file->move("upload",$fileName);
                            $image = $fileName;
                        }catch (\Exception $e){}
                    }
                }
            }
        }
        try {
            Brand::create([
                "name"=>$request->get("name"),
                "image"=>$image
            ]);
        }catch (\Exception $e){
            return back()->with("error","Đã xảy ra lỗi. Không thể thêm mới!");
        }
        return redirect("admin/brands")->with("success","Thêm thành công!");
    }

    public function editBrand($id){
        $brand = Brand::findOrFail($id);
        return view("administrators/brand/brand_edit",[
            "brand"=>$brand
        ]);
    }

    public function updateBrand(Request $request,$id){
        $request->validate([
            "name"=>"required",
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
                $brand = Brand::findOrFail($id);
                $brand->update([
                    "name"=>$request->get("name"),
                    "image"=>$image
                ]);
            }else{
                $brand = Brand::findOrFail($id);
                $brand->update([
                    "name"=>$request->get("name")
                ]);
            }
        }catch (\Exception $e){
            return back()->with("error","Không thể cập nhật.Hãy kiểm tra lại.!");
        }
        return redirect("admin/brands")->with("success","Cập nhật thành công!");
    }

    public function deleteBrand($id){
        try {
            $brand = Brand::findOrFail($id);
            $brand->delete();
        }catch (\Exception $e){
            return redirect("admin/brands")->with('error',"Không thể xóa.!");
        }
        return redirect()->to("admin/brands")->with('success',"Xóa thành công.!");
    }
}
