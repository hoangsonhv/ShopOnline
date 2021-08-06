<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductController extends Controller
{
    //
    public function listProduct(){
        $products = Product::with(['category','brand'])->get();
        return view("administrators/product/product_list",[
            "products"=>$products
        ]);
    }

    public function addProduct(){
        $category = Category::all();
        $brand = Brand::all();
        return view("administrators/product/product_add",[
            "category"=>$category,
            "brand"=>$brand
        ]);
    }

    public function saveProduct(Request $request){
        $request->validate([
            "name"=>"required",
            "description"=>"required",
            "unit_price"=>"required|min:0",
            "promotion_price"=>"required|min:0",
            "qty"=>"required|min:0",
            "new"=>"required|min:0",
            "color"=>"required",
            "id_category"=>"required|numeric|min:1",
            "id_brand"=>"required|numeric|min:1"
        ],[
            "name.required"=>"Vui lòng nhập tên sản phẩm.!",
            "description.required"=>"Vui lòng nhập thông tin sản phẩm.!",
            "unit_price.required"=>"Vui lòng nhập giá sản phẩm.!",
            "promotion_price.required"=>"Vui lòng nhập số tiền giảm.!",
            "qty.required"=>"Vui lòng nhập số lượng sản phẩm.!",
            "new.required"=>"Vui lòng kiểm tra sản phẩm mới.!",
            "color.required"=>"Vui lòng thêm màu sản phẩm.!",
            "id_category.required"=>"Vui lòng nhập tên loại sản phẩm.!",
            "id_brand.required"=>"Vui lòng nhập tên loại sản phẩm.!",
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
            $config = ['table'=>'products','length'=>7,'prefix'=>random_int(00,99)];
            $id = IdGenerator::generate($config);
            Product::create([
                "id"=>$id,
                "name"=>$request->get("name"),
                "image"=>$image,
                "description"=>$request->get("description"),
                "information"=>$request->get("information"),
                "parameter"=>$request->get("parameter"),
                "qty"=>$request->get("qty"),
                "new"=>$request->get("new"),
                "color"=>$request->get("color"),
                "unit_price"=>$request->get("unit_price"),
                "promotion_price"=>$request->get("promotion_price"),
                "id_category"=>$request->get("id_category"),
                "id_brand"=>$request->get("id_brand")
            ]);
        }catch (\Exception $e){
            return "Lỗi";
        }
        return redirect("admin/products")->with("success","Thêm thành công.!");
    }

    public function editProduct($id){
        $category = Category::all();
        $brand = Brand::all();
        $item = Product::findOrFail($id);
        return view("administrators/product/product_edit",[
            "category"=>$category,
            "item"=>$item,
            "brand"=>$brand
        ]);
    }

    public function updateProduct(Request $request,$id){
        $request->validate([
            "name"=>"required",
            "description"=>"required",
            "unit_price"=>"required",
            "promotion_price"=>"required",
            "qty"=>"required",
            "new"=>"required",
            "color"=>"required",
            "id_category"=>"required",
            "id_brand"=>"required"
        ]);
        try {
            $image = request("image");
            if ($image){
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
                $product = Product::findOrFail($id);
                $product->update([
                    "name"=>$request->get("name"),
                    "image"=>$image,
                    "description"=>$request->get("description"),
                    "information"=>$request->get("information"),
                    "parameter"=>$request->get("parameter"),
                    "qty"=>$request->get("qty"),
                    "new"=>$request->get("new"),
                    "color"=>$request->get("color"),
                    "unit_price"=>$request->get("unit_price"),
                    "promotion_price"=>$request->get("promotion_price"),
                    "id_category"=>$request->get("id_category"),
                    "id_brand"=>$request->get("id_brand")
                ]);
            }else{
                $product = Product::findOrFail($id);
                $product->update([
                    "name"=>$request->get("name"),
                    "description"=>$request->get("description"),
                    "information"=>$request->get("information"),
                    "parameter"=>$request->get("parameter"),
                    "qty"=>$request->get("qty"),
                    "new"=>$request->get("new"),
                    "color"=>$request->get("color"),
                    "unit_price"=>$request->get("unit_price"),
                    "promotion_price"=>$request->get("promotion_price"),
                    "id_category"=>$request->get("id_category"),
                    "id_brand"=>$request->get("id_brand")
                ]);
            }
        }catch (\Exception $e){
            return back()->with("error","Không thể cập nhật.Hãy kiểm tra lại.!");
        }
        return redirect()->to("admin/products")->with("success","Cập nhật thành công.!");
    }

    public function deleteProduct($id){
        try {
            Product::findOrFail($id)->delete();
        }catch (\Exception $e){
            return back()->with('error',"Không thể xóa.!");
        }
        return redirect()->to("admin/products")->with('success',"Xóa thành công.!");
    }
}
