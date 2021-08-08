<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Custommer;
use App\Models\News;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Team;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\Intersection;
use function Livewire\str;
use function PHPUnit\Framework\stringContains;

class WebController extends Controller
{
    public function index(){
        $products = Product::with(['category','brand']) ->limit(6)->get();
        $product1 = Product::with("category")->where("promotion_price",'>','0') ->limit(4)->get();
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

    public function checkout(){
        $cart = [];
        if (Session::has("cart")){
            $cart = Session::get("cart");
        }
        if (Auth::check()){
            return view("web/checkout",["cart"=>$cart]);
        }
        return redirect()->back()->with('error',"Bạn cần đăng nhập để mua hàng!");
    }

    public function placeOrder(Request $request){

        $request->validate([
            "name"=>"required",
            "email"=>"required",
            "address"=>"required",
            "phone_number"=>"required",
            "gender"=>"required",
        ]);
        try {
            $cart = Session::get("cart");
            if(count($cart) == 0) return redirect("/");
            $grandTotal = 0;

            foreach ($cart as $item){
                $id_bills = $item->id;
                if ($item->promotion_price > 0)
                    $grandTotal += $item->promotion_price * $item->cart_qty;
                else{
                    $grandTotal += $item->unit_price * $item->cart_qty;
                }
            }

            $payment_status = (int)$request->get("payment");
            $payment = (int)$request->get("payment").$id_bills;
            $config = ['table'=>'bills','length'=>8,'prefix'=>date('ym')];
            $code = IdGenerator::generate($config);
            $code_bill = (int)$payment.(int)$code;
//            dd($code_bill);
            $customer = Custommer::create([
                "name"=>$request->get("name"),
                "email"=>$request->get("email"),
                "address"=>$request->get("address"),
                "phone_number"=>$request->get("phone_number"),
                "gender"=>$request->get("gender"),
            ]);

            $bill = Bill::create([
                'id'=>$code_bill,
                'total'=>$grandTotal,
                'payment'=>$payment_status,
                'id_customer'=>$customer->id,
            ]);
            foreach ($cart as $item){
               if ($item->promotion_price > 0){
                   DB::table("bill_details")->insert([
                       'quantity'=>$item->cart_qty,
                       'unit_price'=>$item->promotion_price,
                       'id_bill'=>$bill->id,
                       'id_product'=>$item->id,
                   ]);
                   $p = Product::find($item->id);
                   $p->qty -= $item->cart_qty;
                   $p->save();
               }else{
                   DB::table("bill_details")->insert([
                       'quantity'=>$item->cart_qty,
                       'unit_price'=>$item->unit_price,
                       'id_bill'=>$bill->id,
                       'id_product'=>$item->id,
                   ]);
                   $p = Product::find($item->id);
                   $p->qty -= $item->cart_qty;
                   $p->save();
               }
            }
            Session::forget("cart");
            return redirect("/")->with('success',"Mua hàng thành công. Vui long kiểm tra đơn hàng tại chi tiết đơn hàng của bạn!");
        }catch (\Exception $e){
            return back()->with('error',"Mua hàng không thành công.Bạn vui lòng kiểm tra lại!");
        }
    }

    public function searchItem(Request $request){
        $search = $request->input('search');
        $products = Product::with("category")->where("name",'LIKE',"{$search}%")
            ->orWhere("description",'LIKE',"%{$search}%")
            ->orWhere("unit_price","$search")->paginate(9);
        $product1 = Product::with("category")->where("promotion_price",'>','0')->paginate(4);
        $category = Category::all();
        $brands = Brand::all();
        if($products->isNotEmpty()){
            return view("web/search",[
                "products"=>$products,
                "product1"=>$product1,
                "category"=>$category,
                "brands"=>$brands
            ]);
        }else{
            return redirect("/")->with("success2","khong tim thay sp");
        }
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
            if (Auth::check()){
                $user = Auth::id();
                Comment::create([
                    "id_user"=> $user,
                    "id_product"=> $id,
                    "content"=>$request->get("content")
                ]);
            }
        }catch (\Exception $e){
            return redirect()->back()->with('error',"Hãy đăng nhập để gửi ý kiến.!");
        }
        return redirect()->back()->with('success',"Cảm ơn bạn đã đóng góp ý kiến!");
    }

    public function getContact(){
        return view("web/contact");
    }

    public function blog(){
        $blogs = Blog::all();
        return view("web/blog",[
            "blogs"=>$blogs,
        ]);
    }

    public function blogs_detail(Request $request,$id){
        $auth = Auth::id();
        $blogs = Blog::on()->where("id",$id)->get();
        return view("web/blog-detail",[
            "blogs"=>$blogs,
            "auth"=>$auth
        ]);
}

    public function shop(Request $request){
        $products = Product::with(['category','brand']);
        if ($request->price){
            $price = $request->price;
            switch ($price){
                case '0':$products->where('unit_price','>',0);
                    break;
                case '1':$products->where('unit_price','<',100);
                    break;
                case '2':$products->whereBetween('unit_price',[100,500]);
                    break;
                case '3':$products->whereBetween('unit_price',[500,1000]);
                    break;
                case '4':$products->whereBetween('unit_price',[1000,1500]);
                    break;
                case '5':$products->whereBetween('unit_price',[1500,3000]);
                    break;
                case '6':$products->where('unit_price','>',3000);
                    break;
            }
        }
        $products = $products->orderBy('unit_price',"DESC")->paginate(9);
        $product1 = Product::with("category")->where("promotion_price",'>','0')->paginate(4);
        $slides = Slide::all();
        $brands = Brand::all();
//        $categories = Category::all();
        return view("web/shop",[
            "slides"=>$slides,
            "brands"=>$brands,
            "products"=>$products,
            "product1"=>$product1,
//            "categories"=>$categories
        ]);
    }

    public function getCate(Request $request,$id){
        $category = Product::with("category")->where("id_category",$id);
        if ($request->price){
            $price = $request->price;
            switch ($price){
                case '0':$category->where('unit_price','>',0);
                    break;
                case '1':$category->where('unit_price','<',100);
                    break;
                case '2':$category->whereBetween('unit_price',[100,500]);
                    break;
                case '3':$category->whereBetween('unit_price',[500,1000]);
                    break;
                case '4':$category->whereBetween('unit_price',[1000,1500]);
                    break;
                case '5':$category->whereBetween('unit_price',[1500,3000]);
                    break;
                case '6':$category->where('unit_price','>',3000);
                    break;
            }
        }
        $category = $category->orderBy('unit_price',"DESC")->paginate(9);
        $cat = Product::with("category")->where("id_category",$id)->first();
        $product1 = Product::with("category")->where("promotion_price",'>','0') ->limit(4)->get();
        $brands = Brand::all();
        return view("web/cate",[
            "category"=>$category,
            "cat"=>$cat,
            "product1"=>$product1,
            "brands"=>$brands
        ]);
    }

    public function addToWishList($id){
        try {
            $product = Product::findOrFail($id);
            $cart2 = [];
            if (Session::has("cart2")) {
                $cart2 = Session::get("cart2");
            }
            if (!$this->checkCart($cart2, $product)) {
                $cart2[] = $product;
            }
            Session::put("cart2", $cart2);
            return redirect()->back()->with('success',"Đã thêm vào mục yêu thích.!");
        }catch (\Exception $e){
            return back()->with('error',"Không thể thêm!");
        }
    }

    public function getWishList(){
        $cart = [];
        $brands = Brand::all();
        if (Session::has("cart2")){
            $cart = Session::get("cart2");
        }
        return view("web/wishlist",[
            "cart2"=>$cart,
            "brands"=>$brands,
        ]);
    }

    public function deleteWish($id){
        if(Session::has("cart2")){
            $cart = Session::get("cart2");
            for($i=0;$i<count($cart);$i++){
                if($cart[$i]->id == $id){
                    unset($cart[$i]);
                    break;
                }
            }
            $cart = array_values($cart);
            Session::put("cart2",$cart);
            if (count($cart) == 0){
                Session::forget("cart2");
            }
        }
        return redirect()->back();
    }

    public function about(){
        $teams = Team::all();
        return view("web/about",[
            "teams"=>$teams
        ]);
    }
}
