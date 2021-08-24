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
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Team;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\Intersection;
use function Livewire\str;
use function PHPUnit\Framework\stringContains;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\MockObject\Builder\Identity;

class WebController extends Controller
{
    public function index(){
        $products = Product::with(['category','brand'])->where("new",'>',0)->limit(8)->get();
        $product1 = Product::with("category")->where("promotion_price",'>','0') ->limit(8)->get();
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
                return redirect("/");
            }
        }
        return redirect()->back();
    }

    public function clearCart(){
        Session::forget("cart");
        return redirect()->back();
    }
//checkout
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
            "payment"=>"required",
        ]);
        $data = $request->except("_token",'payment');
        if ($request->payment == 3){
            $request->validate([
                "order_type"=>"required",
                "amount"=>"required",
                "bank_code"=>"required",
                "order_desc"=>"required",
                "language"=>"required",
            ]);
            $cart = Session::get("cart");
            $grandTotal = 0;

            foreach ($cart as $item){
                $id_bills = $item->id;
                if ($item->promotion_price > 0)
                    $grandTotal += $item->promotion_price * $item->cart_qty;
                else{
                    $grandTotal += $item->unit_price * $item->cart_qty;
                }
            }
            $payment = (int)$request->get("payment").$id_bills;
            $config = ['table'=>'bills','length'=>8,'prefix'=>date('ym')];
            $code = IdGenerator::generate($config);
            $code_bill = (int)$code.(int)$payment;
            $total = $grandTotal;
            session(['data_customer'=>$data]);

            $vnp_TmnCode = "IHH7E7S0";
            $vnp_HashSecret = "PBCSCNRNCIMCSMEODPOOFSBCGMEPWLGW";
            $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_TxnRef = (string)$code_bill;
            $vnp_OrderInfo = (string)$request->get('order_desc');
            $vnp_OrderType =(string)$request->get('order_type');
            $vnp_Amount = (string)$request->get('amount') * 100;
            $vnp_Locale = (string)$request->get('language');
            $vnp_IpAddr = request()->ip();

            $inputData = array(
                "vnp_Version" => "2.0.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => route("vnpay.return"),
                "vnp_TxnRef" => $vnp_TxnRef,
            );
            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . $key . "=" . $value;
                } else {
                    $hashdata .= $key . "=" . $value;
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
                $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
            }
            return redirect($vnp_Url);

        }else{
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
                $code_bill = (int)$code.(int)$payment;

                $address = $request->get("address")."-".$request->get("district")."-".$request->get("city");
                $customer = Custommer::create([
                    "name"=>$request->get("name"),
                    "email"=>$request->get("email"),
                    "address"=>$address,
                    "phone_number"=>$request->get("phone_number"),
                    "gender"=>$request->get("gender"),
                ]);
                $user = Auth::id();
                $bill = Bill::create([
                    'id'=>$code_bill,
                    'total'=>$grandTotal,
                    'paid'=>0,
                    'unpaid'=>$grandTotal,
                    'payment'=>$payment_status,
                    'id_user'=>$user,
                    'id_customer'=>$customer->id,
                ]);

                foreach($cart as $item){
                    if ($item->promotion_price > 0){
                        DB::table("bill_details")->insert([
                            'quantity'=>$item->cart_qty,
                            'price'=>$item->promotion_price,
                            'id_bill'=>$bill->id,
                            'id_product'=>$item->id,
                        ]);
                        $p = Product::find($item->id);
                        $p->qty -= $item->cart_qty;
                        $p->save();
                    }else{
                        DB::table("bill_details")->insert([
                            'quantity'=>$item->cart_qty,
                            'price'=>$item->unit_price,
                            'id_bill'=>$bill->id,
                            'id_product'=>$item->id,
                        ]);
                        $p = Product::find($item->id);
                        $p->qty -= $item->cart_qty;
                        $p->save();
                    }
                }

                $users = Auth::user()->email;
                $mail_user = $request->email;
                $user_name = Auth::user()->name;
                Mail::send('web.email.contact',[
                    'user_name'=>$user_name,
                    'bill'=>$bill,
                    'cart'=>$cart,
                ],function ($mail) use($users,$user_name,$mail_user){
                    $mail->to($users,$user_name);
                    $mail->to($mail_user,$user_name);
                    $mail->from("son070697@gmail.com");
                    $mail->subject("Email Order by Arts Shop");
                });
                Session::forget("cart");
                return redirect("/")->with('success',"Mua hàng thành công. Vui lòng kiểm tra đơn hàng tại địa chỉ Email đã đăng ký và chi tiết đơn hàng của bạn!");
            }catch (\Exception $e){
                return back()->with('error',"Mua hàng không thành công.Bạn vui lòng kiểm tra lại thông tin của bạn!");
            }
        }
    }


    public function return(Request $request)
    {
        if (\session()->has("data_customer") && $request->vnp_ResponseCode == "00" ){
            DB::beginTransaction();
            try {
                $vnpayData = $request->all();
                $data = \session()->get("data_customer");
                $cart = Session::get("cart");
                if(count($cart) == 0) return redirect("/");
                $grandTotal = 0;

                foreach ($cart as $item){
                    if ($item->promotion_price > 0)
                        $grandTotal += $item->promotion_price * $item->cart_qty;
                    else{
                        $grandTotal += $item->unit_price * $item->cart_qty;
                    }
                }

                $address = $data['address']."-".$data['district']."-".$data['city'];

                $customer = [
                    "name"=>$data["name"],
                    "email"=>$data["email"],
                    "address"=> $address,
                    "phone_number"=>$data["phone_number"],
                    "gender"=>$data["gender"],
                ];

                $cus = Custommer::create($customer);
                $user = Auth::id();
                $carbon = Carbon::now()->toDateTimeString();

                $bill = Bill::create([
                    'id'=>(int)$vnpayData['vnp_TxnRef'],
                    'payment'=>3,
                    'status'=>1,
                    'total'=>$grandTotal,
                    'paid'=>$vnpayData['vnp_Amount'] / 100,
                    'unpaid'=>$grandTotal - $vnpayData['vnp_Amount'] / 100,
                    'id_user'=>$user,
                    'id_customer'=>$cus->id,
                    'created_at'=>$carbon,
                    'updated_at'=>$carbon,
                ]);
                foreach($cart as $item){
                    if ($item->promotion_price > 0){
                        DB::table("bill_details")->insert([
                            'quantity'=>$item->cart_qty,
                            'price'=>$item->promotion_price,
                            'id_bill'=>$bill->id,
                            'id_product'=>$item->id,
                        ]);
                        $p = Product::find($item->id);
                        $p->qty -= $item->cart_qty;
                        $p->save();
                    }else{
                        DB::table("bill_details")->insert([
                            'quantity'=>$item->cart_qty,
                            'price'=>$item->unit_price,
                            'id_bill'=>$bill->id,
                            'id_product'=>$item->id,
                        ]);
                        $p = Product::find($item->id);
                        $p->qty -= $item->cart_qty;
                        $p->save();
                    }
                }

                Payment::insert([
                    "transaction_code"=>$vnpayData['vnp_TxnRef'],
                    "money"=>$vnpayData['vnp_Amount'] / 100,
                    "note"=>$vnpayData['vnp_OrderInfo'],
                    "respone_code"=>$vnpayData['vnp_ResponseCode'],
                    "code_vnpay"=>$vnpayData['vnp_TransactionNo'],
                    "code_bank"=>$vnpayData['vnp_BankCode'],
                    "id_user"=>$user,
                    "created_at"=>$vnpayData['vnp_PayDate'],
                ]);

                $users = Auth::user()->email;
                $mail_user = $data['email'];
                $user_name = Auth::user()->name;
                Mail::send('web.email.contact',[
                    'user_name'=>$user_name,
                    'bill'=>$bill,
                    'cart'=>$cart,
                ],function ($mail) use($users,$user_name,$mail_user){
                    $mail->to($users,$user_name);
                    $mail->to($mail_user,$user_name);
                    $mail->from("son070697@gmail.com");
                    $mail->subject("Email Order by Arts Shop");
                });
                Session::forget("cart");
                DB::commit();
                return view("vnpay/vnpay_return",[
                    "vnpayData"=>$vnpayData,
                ]);
            }catch (\Exception $e){
                DB::rollBack();
                return redirect("/")->with('error','Đã sảy ra lỗi không thể thanh toán đơn hàng!');
            }
        }else{
            $vnpayData = $request->all();
            $vnpayData = [];
            Session::forget("cart");
            return redirect("/")->with('error','Đã sảy ra lỗi không thể thanh toán đơn hàng!');
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

    public function createReply(Request $request,$id){
        $comments = Comment::findOrFail($id);
        $id1 = $comments->id_product;
        $id_reply = $comments->id;
        $request->validate([
            "content"=>"required",
        ]);
        try {
            if (Auth::check()){
                $user = Auth::id();
                $reply1 = ReplyComment::create([
                    "id_user"=> $user,
                    "id_comments"=> $id_reply,
                    "id_product"=> $id1,
                    "content"=>$request->get("content")
                ]);
                return redirect()->back()->with('success',"Cảm ơn bạn đã đóng góp ý kiến!");
            }
        }catch (\Exception $e){
            return redirect()->back()->with('error',"Hãy đăng nhập để gửi ý kiến.!");
        }
        return back()->with("error","Bạn cần đăng nhập để comment!");
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

    public function searchItem(Request $request){
        $search = $request->input('search');
        $products = Product::with(['category','brand'])->where("name",'LIKE',"%{$search}%")
            ->orWhere("unit_price","$search");
        if ($request->price){
            $price = $request->price;
            switch ($price){
                case '0':$products->where('unit_price','>',0);
                    break;
                case '1':$products->where('unit_price','<',1000000);
                    break;
                case '2':$products->whereBetween('unit_price',[1000000,5000000]);
                    break;
                case '3':$products->whereBetween('unit_price',[5000000,10000000]);
                    break;
                case '4':$products->whereBetween('unit_price',[10000000,15000000]);
                    break;
                case '5':$products->whereBetween('unit_price',[15000000,25000000]);
                    break;
                case '6':$products->where('unit_price','>',25000000);
                    break;
            }
        }
        $products = $products->orderBy('unit_price',"DESC")->paginate(9);
        $product1 = Product::with("category")->where("promotion_price",'>','0')->limit(4)->get();
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
            return back()->with("success2","No products found");
        }
    }

    public function shop(Request $request){
        $products = Product::with(['category','brand']);
        if ($request->price){
            $price = $request->price;
            switch ($price){
                case '0':$products->where('unit_price','>',0);
                    break;
                case '1':$products->where('unit_price','<',1000000);
                    break;
                case '2':$products->whereBetween('unit_price',[1000000,5000000]);
                    break;
                case '3':$products->whereBetween('unit_price',[5000000,10000000]);
                    break;
                case '4':$products->whereBetween('unit_price',[10000000,15000000]);
                    break;
                case '5':$products->whereBetween('unit_price',[15000000,25000000]);
                    break;
                case '6':$products->where('unit_price','>',25000000);
                    break;
            }
        }
        if(isset($_GET['start_price']) || isset($_GET['end_price'])){
            $min_price = $_GET['start_price'];
            $max_price = $_GET['end_price'];
            $products = $products->whereBetween('unit_price',[$min_price,$max_price])
                ->orderBy('unit_price','DESC')->paginate(9);
        }else{
            $products = $products->orderBy('unit_price',"DESC")->paginate(9);
        }
        $product1 = Product::with("category")->where("promotion_price",'>','0')->limit(4)->get();
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
        $search = $request->input('search');
        $min_price = Product::min('promotion_price');
        $max_price = Product::max('promotion_price');
        $category = Product::with("category")->where("id_category",$id);

        if ($request->price){
            $price = $request->price;
            switch ($price){
                case '0':$category->where('unit_price','>',0);
                    break;
                case '1':$category->where('unit_price','<',1000000);
                    break;
                case '2':$category->whereBetween('unit_price',[1000000,5000000]);
                    break;
                case '3':$category->whereBetween('unit_price',[5000000,10000000]);
                    break;
                case '4':$category->whereBetween('unit_price',[10000000,15000000]);
                    break;
                case '5':$category->whereBetween('unit_price',[15000000,25000000]);
                    break;
                case '6':$category->where('unit_price','>',25000000);
                    break;
            }
        }
        if(isset($_GET['start_price']) || isset($_GET['end_price'])){
            $min_price = $_GET['start_price'];
            $max_price = $_GET['end_price'];
            $category = $category->whereBetween('unit_price',[$min_price,$max_price])
                ->orderBy('unit_price','ASC')->paginate(9);
        }else{
            $category = $category->where("name",'LIKE',"%{$search}%")
                ->orderBy('unit_price',"ASC")->paginate(9);
        }
        $cat = Product::with("category")->where("id_category",$id)->first();

        $product1 = Product::with("category")->where("promotion_price",'>','0') ->limit(4)->get();
        $brands = Brand::all();
        return view("web/cate",[
            "category"=>$category,
            "cat"=>$cat,
            "product1"=>$product1,
            "brands"=>$brands,
            "min_price" => $min_price,
            "max_price" => $max_price,
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

// create order

    public function orderProduct($id){
            $product = Product::findOrFail($id);
            $order = [];
            if (Session::has("order")) {
                $order = Session::get("order");
            }
            if (!$this->checkOrder($order, $product)) {
                $product->order_qty = 1;
                $order[] = $product;
            }
            Session::put("order", $order);
            return view("web/order",[
                "product"=>$product,
                "order"=>$order,
            ]);
    }

    private function checkOrder($order,$p){
        foreach ($order as $item){
            if ($item->id == $p->id){
                return true;
            }
        }
        return false;
    }

    public function updateOrder($id,Request $request){
        if(Session::has("order")){
            $order = Session::get("order");
            for($i=0;$i<count($order);$i++){
                if($order[$i]->id == $id){
                    $order[$i]->order_qty = $request->get("order_qty");
                    if($order[$i]->order_qty == 0){
                        unset($order[$i]);
                    }
                    break;
                }
            }
            Session::put("order",$order);
        }
        return back()->with("success","Cập nhật thành công!");
    }

    public function deleteOrder($id){
        if(Session::has("order")){
            $order = Session::get("order");
            for($i=0;$i<count($order);$i++){
                if($order[$i]->id == $id){
                    unset($order[$i]);
                    break;
                }
            }
            $order = array_values($order);
            Session::put("order",$order);
            if (count($order) == 0){
                Session::forget("order");
                return redirect("/");
            }
        }
        return redirect()->back();
    }

    public function orderCheckout(Request $request){
        $data = $request->except("_token",'payment');
        if ($request->payment == 3){
            $order = Session::get("order");
            $grandTotal = 0;

            foreach ($order as $item){
                $id_bills = $item->id;
                if ($item->promotion_price > 0)
                    $grandTotal += $item->promotion_price * $item->order_qty;
                else{
                    $grandTotal += $item->unit_price * $item->order_qty;
                }
            }
            session(['data_customer'=>$data]);
            $vnp_TmnCode = "IHH7E7S0";
            $vnp_HashSecret = "PBCSCNRNCIMCSMEODPOOFSBCGMEPWLGW";
            $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_TxnRef = uniqid();
            $vnp_OrderInfo = (string)$request->get('order_desc');
            $vnp_OrderType =(string)$request->get('order_type');
            $vnp_Amount = (string)$request->get('amount') * 100;
            $vnp_Locale = (string)$request->get('language');
            $vnp_IpAddr = request()->ip();

            $inputData = array(
                "vnp_Version" => "2.0.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => route("order.return"),
                "vnp_TxnRef" => $vnp_TxnRef,
            );
            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . $key . "=" . $value;
                } else {
                    $hashdata .= $key . "=" . $value;
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
                $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
            }
            return redirect($vnp_Url);
        }
        return $this->about();
    }

    public function returnOrder(Request $request)
    {
        if (\session()->has("data_customer") && $request->vnp_ResponseCode == "00") {
            DB::beginTransaction();
            try {
                $vnpayData = $request->all();
                $data = \session()->get("data_customer");
                $order = Session::get("order");
                if (count($order) == 0) return redirect("/");

                $address = $data['address'] . "-" . $data['district'] . "-" . $data['city'];

                foreach ($order as $item) {
                    $name = $item->name;
                    $qty = $item->order_qty;
                    $id_product = $item->id;
                    if ($item->promotion_price > 0) {
                        $total = $item->promotion_price * $item->order_qty;
                        $price = $item->promotion_price;
                    } else {
                        $total = $item->unit_price * $item->order_qty;
                        $price = $item->unit_price;
                    }
                }
                $user = Auth::id();
                if ($total > ($vnpayData['vnp_Amount'] / 100) ){
                    $orders = Order::create([
                        "name" => $data['name'],
                        "email" => $data['email'],
                        "address" => $address,
                        "phone" => $data['phone_number'],
                        "gender" => $data['gender'],
                        "total_order" => $total,
                        "id_user" => $user,
                        "id_product" => $id_product,
                        "name_product" => $name,
                        "qty" => $qty,
                        "price" => $price,
                        "paid" => (int)($vnpayData['vnp_Amount'] / 100),
                        "unpaid" => (int)($total - ($vnpayData['vnp_Amount'] / 100)),
                        "status" => 0,
                    ]);
                }else{
                    $orders = Order::create([
                        "name" => $data['name'],
                        "email" => $data['email'],
                        "address" => $address,
                        "phone" => $data['phone_number'],
                        "gender" => $data['gender'],
                        "total_order" => $total,
                        "id_user" => $user,
                        "id_product" => $id_product,
                        "name_product" => $name,
                        "qty" => $qty,
                        "price" => $price,
                        "paid" => (int)($vnpayData['vnp_Amount'] / 100),
                        "unpaid" => (int)($total - ($vnpayData['vnp_Amount'] / 100)),
                        "status" => 1,
                    ]);
                }

                Payment::insert([
                    "transaction_code"=>$vnpayData['vnp_TxnRef'],
                    "money"=>$vnpayData['vnp_Amount'] / 100,
                    "note"=>$vnpayData['vnp_OrderInfo'],
                    "respone_code"=>$vnpayData['vnp_ResponseCode'],
                    "code_vnpay"=>$vnpayData['vnp_TransactionNo'],
                    "code_bank"=>$vnpayData['vnp_BankCode'],
                    "id_user"=>$user,
                    "created_at"=>$vnpayData['vnp_PayDate'],
                ]);

                $dayorder = $orders->created_at;
                $users = Auth::user()->email;
                $mail_user = $data['email'];
                $user_name = Auth::user()->name;
                $paid = $vnpayData['vnp_Amount'] / 100;
                $unpaid = $total - ($vnpayData['vnp_Amount'] / 100);
                Mail::send('web.email.order', [
                    'user_name' => $user_name,
                    'paid' => $paid,
                    'unpaid' => $unpaid,
                    'order' => $order,
                    'dayorder' => $dayorder,
                ], function ($mail) use ($users, $user_name, $mail_user) {
                    $mail->to($users, $user_name);
                    $mail->to($mail_user, $user_name);
                    $mail->from("son070697@gmail.com");
                    $mail->subject("Email Order by Arts Shop");
                });
                Session::forget("order");
                DB::commit();
                return view("vnpay2/vnpay_return", [
                    "vnpayData" => $vnpayData,
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect("/")->with('error', 'Đã sảy ra lỗi không thể thanh toán đơn hàng!');
            }
        }
        Session::forget("order");
        return redirect("/")->with('error', 'Đã sảy ra lỗi không thể thanh toán đơn hàng!');
    }

//end order
}
