<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Comment;
use App\Models\News;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class WebController extends Controller
{
    public function index(){
        $slides = Slide::all();
        $products = Product::with("category")->paginate(9);
        $news = News::all();
        $product_sale = Product::with("category")->where("promotion_price",'<>','0')->paginate(4);
        $comments = Comment::all();
        $brands = Brand::all();
        $blogs = Blog::all();
        return view("web/home",[
            "slides"=>$slides,
            "products"=>$products,
            "news"=>$news,
            "product_sale"=>$product_sale,
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
}
