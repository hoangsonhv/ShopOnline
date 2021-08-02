<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use App\Models\Product;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class WebController extends Controller
{
    public function index(){
        $products = Product::with(['category','brand'])->paginate(9);
        $product1 = Product::with("category")->where("promotion_price",'>','0')->paginate(4);
        $comments = Comment::with("user")->get();
        $brands = Brand::all();
        $blogs = Blog::all();
        $slides = Slide::all();
        $news = News::all();
        return view("web/home",[
            "slides"=>$slides,
            "products"=>$products,
            "news"=>$news,
            "product1"=>$product1,
            "comments"=>$comments,
            "blogs"=>$blogs,
            "brands"=>$brands
        ]);
    }

    public function addToCart($id){
        $product = Product::findOrFail($id);
        $cart = [];
        if (Session::has("cart")) {
            $cart = Session::get("cart");
        }
        if (!$this->checkCart($cart, $product)) {
            $product->cart_qty = 1;
            $cart[] = $product;
        } else {
            for($i=0;$i<count($cart);$i++){
                if($cart[$i]->id == $product->id){
                    $cart[$i]->cart_qty = $cart[$i]->cart_qty+1;
                }
            }
        }
        Session::put("cart", $cart);
        return redirect()->back()->with('success',"Thêm vào giỏ hàng thành công.!");
    }

    private function checkCart($cart,$p){
        foreach ($cart as $item){
            if ($item->id == $p->id){
                return true;
            }
        }
        return false;
    }

    public function deleteCart($id){
        if(Session::has("cart")){
            $cart = Session::get("cart");
            for($i=0;$i<count($cart);$i++){

                if($cart[$i]->id == $id){
                    unset($cart[$i]);
                    break;
                }
            }
            $cart = array_values($cart);
            Session::put("cart",$cart);
            if (count($cart) == 0){
                Session::forget("cart");
            }
        }
        return redirect()->back();
    }

    public function clearCart(){
        Session::forget("cart");
        return redirect()->back();
    }

    public function searchItem(Request $request){
        $search = $request->input('search');
        $products = Product::with("category")->where("name",'LIKE',"{$search}%")
                                                    ->orWhere("description",'LIKE',"%{$search}%")
                                                    ->orWhere("unit_price","$search")->paginate(9);
        return view("web/search",[
            "products"=>$products
        ]);
    }

    public function productDetail($id){
        $auth = Auth::id();
        $brands = Brand::all();
        $products = Product::with("category")->where("id",$id)->get();
        $product1 = Product::with("category")->where("new",'1')
                                                    ->limit(4)->get();
        $comments = Comment::with("user")->where("id_product",$id)->get();
        return view("web/product_detail",[
            "brands"=>$brands,
            "products"=>$products,
            "product1"=>$product1,
            "comments"=>$comments,
            "auth"=>$auth
        ]);
    }

    public function createComment(Request $request,$id){
        $request->validate([
            "content"=>"required",
        ]);
        try {
            $user = Auth::id();
            Comment::create([
                "id_user"=> $user,
                "id_product"=> $id,
                "content"=>$request->get("content")
            ]);
        }catch (\Exception $e){
            return back()->with('error',"Hãy đăng nhập để comment.!");
        }
        return redirect()->back()->with('success',"Cảm ơn bạn đã đóng góp ý kiến!");
    }

    public function getContact(){
        return view("web/contact");
    }

    public function shoppingCart(){
        $cart = [];
        $brands = Brand::all();
        if (Session::has("cart")){
            $cart = Session::get("cart");
        }
        return view("web/shopping-cart",[
            "cart"=>$cart,
            "brands"=>$brands,
        ]);
    }

//    public function cartQty($id){
//        $cart = Session::get("cart")->get($id);
//    }

    public function updateCart($id,Request $request){
        if(Session::has("cart")){
            $cart = Session::get("cart");
            for($i=0;$i<count($cart);$i++){
                if($cart[$i]->id == $id){
                    $cart[$i]->cart_qty = $request->get("cart_qty");
                    if($cart[$i]->cart_qty == 0){
                        unset($cart[$i]);
                    }
                    break;
                }
            }
            Session::put("cart",$cart);
        }
        return back()->with("success","Cập nhật thành công!");
    }
    public function getGifts(){
        $category = Category::all();
        $product = Product::with("category")->where( "id_category" ,"1")->paginate(9);
        $product1 = Product::with("category")->where("promotion_price",'>','0')->paginate(4);
        $brands = Brand::all();
        return view("web/gifts",[
            "category"=>$category,
            "product1"=>$product1,
            "product"=>$product,
            "brands"=>$brands
        ]);
    }
    public function getStationeries(){
        $category = Category::all();
        $product = Product::with("category")->where( "id_category" ,"3")->paginate(9);
        $product1 = Product::with("category")->where("promotion_price",'>','0')->paginate(4);
        $brands = Brand::all();
        return view("web/stationeries",[
            "category"=>$category,
            "product1"=>$product1,
            "product"=>$product,
            "brands"=>$brands
        ]);
    }
    public function getArtworks(){
        $category = Category::all();
        $product = Product::with("category")->where( "id_category" ,"2")->paginate(9);
        $product1 = Product::with("category")->where("promotion_price",'>','0')->paginate(4);
        $brands = Brand::all();
        return view("web/artworks",[
            "category"=>$category,
            "product1"=>$product1,
            "product"=>$product,
            "brands"=>$brands
        ]);
    }
    public function getBeauty(){
        $category = Category::all();
        $product = Product::with("category")->where( "id_category" ,"2")->paginate(9);
        $product1 = Product::with("category")->where("promotion_price",'>','0')->paginate(4);
        $brands = Brand::all();
        return view("web/beauty",[
            "category"=>$category,
            "product1"=>$product1,
            "product"=>$product,
            "brands"=>$brands
        ]);
    }

}
