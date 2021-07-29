<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductController extends Controller
{
    //
    public function listProduct(){
        $products = Product::with("category")->get();
        return view("administrators/product/product_list",[
            "products"=>$products
        ]);
    }

    public function addProduct(){
        $category = Category::all();
        return view("administrators/product/product_add",[
            "category"=>$category
        ]);
    }

    public function saveProduct(Request $request){
        $request->validate([
            "name"=>"required",
            "description"=>"required",
            "unit_price"=>"required|min:0",
            "promotion_price"=>"required|min:0",
            "qty"=>"required|min:0",
            "id_category"=>"required|numeric|min:1"
        ],[
            "name.required"=>"Vui lòng nhập tên sản phẩm.!",
            "description.required"=>"Vui lòng nhập thông tin sản phẩm.!",
            "unit_price.required"=>"Vui lòng nhập giá sản phẩm.!",
            "promotion_price.required"=>"Vui lòng nhập số tiền giảm.!",
            "qty.required"=>"Vui lòng nhập số lượng sản phẩm.!",
            "id_category.required"=>"Vui lòng nhập tên loại sản phẩm.!",
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
                "qty"=>$request->get("qty"),
                "unit_price"=>$request->get("unit_price"),
                "promotion_price"=>$request->get("promotion_price"),
                "id_category"=>$request->get("id_category")
            ]);
        }catch (\Exception $e){
            return "Lỗi";
        }
        return redirect("admin/products")->with("success","Thêm thành công.!");
    }

    public function editProduct($id){
        $category = Category::all();
        $item = Product::findOrFail($id);
        return view("administrators/product/product_edit",[
            "category"=>$category,
            "item"=>$item
        ]);
    }

    public function updateProduct(Request $request,$id){

        $request->validate([
            "name"=>"required",
            "description"=>"required",
            "unit_price"=>"required",
            "promotion_price"=>"required",
            "qty"=>"required",
            "id_category"=>"required"
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
                    "qty"=>$request->get("qty"),
                    "unit_price"=>$request->get("unit_price"),
                    "promotion_price"=>$request->get("promotion_price"),
                    "id_category"=>$request->get("id_category")
                ]);
            }else{
                $product = Product::findOrFail($id);
                $product->update([
                    "name"=>$request->get("name"),
                    "description"=>$request->get("description"),
                    "qty"=>$request->get("qty"),
                    "unit_price"=>$request->get("unit_price"),
                    "promotion_price"=>$request->get("promotion_price"),
                    "id_category"=>$request->get("id_category")
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
