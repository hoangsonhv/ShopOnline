<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Staff;
use App\Models\Admin;
use App\Models\Bill;
use App\Models\Bill_Detail;
use App\Models\Custommer;
use App\Models\Messenger;
use App\Models\Product;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function showAdmin(){
        $admins = Admin::all();
        return view("administrators/admin/admin_list",[
            "admins"=>$admins
        ]);
    }

    public function addAdmin(){
        return view("administrators/admin/admin_add");
    }

    public function saveAdmin(Request $request){
        $request->validate([
            "name"=>"required",
            "email"=>"required",
            "password"=>"required"
        ]);
        try {
            Admin::create([
                "name"=>$request->get("name"),
                "email"=>$request->get("email"),
                "password"=>bcrypt($request->get("password")),
            ]);
        }catch (\Exception $e){
            return back()->with('error','Không thể thêm mới.!');
        }
        return redirect("admin/admins")->with('success',"Thêm mới thành công.!");
    }

    public function editAdmin($id){
        $admin = Admin::findOrFail($id);
        return view("administrators/admin/admin_edit",[
            "admin"=>$admin
        ]);
    }

    public function updateAdmin(Request $request,$id){
        $request->validate([
            "name"=>"required",
            "email"=>"required",
            "password"=>"required"
        ]);
        try {
            $admins = Admin::findOrFail($id);
            $admins->update([
                "name" => $request->get("name"),
                "email" => $request->get("email"),
                "password" => bcrypt($request->get("password"))
            ]);
        }catch (\Exception $e){
            return back()->with('error','Cập nhật lỗi. Hãy kiểm tra lại.!');
        }
        return redirect("admin/admins")->with('success',"Cập nhật thành công.!");
    }

//    public function deleteAdmin($id){
//        User::findOrFail($id)->delete();
//        return redirect("admin/users");
//    }


    public function homeAdmin()
    {
        if (Auth::guard("admin")->check() ){
            $totalPay = 0;
            $product = Product::all();
            foreach ($product as $pro){
                $totalPay += $pro->pro_pay;
            }
            $bill = Bill::all()->where("status","=",3);

            $pro_bill = Bill_Detail::with("bill")->where("status","=",1)->join("products","products.id", "=" ,"bill_details.id_product")
                ->select("products.cost")->get();

            $nows = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
            $pay_month2 = DB::table("bills")->whereBetween("created_at",[$month,$nows])->where("status","=",3)->get()->toArray();

            $bill1 = Bill::all()->where("status","=",3)->whereBetween("created_at",[$month,$nows]);
            $pro_bill1 = Bill_Detail::with("product")->where("status","=",1)
                ->whereBetween("created_at",[$month,$nows])->get();
//            dd($pro_bill);
//            $totals = 0;
//            foreach ($pro_bill1 as $total1){
//                $totals += $total1->product->cost;
//            }
//            dd($totals);
            $mes = Messenger::all();
            $user = User::all();
            $customer = Custommer::all();
            $bills =DB::table("bills")->where('status',0)->get();
            $bills1 =DB::table("bills")->where('status',1)->get();
            $bills2 =DB::table("bills")->where('status',2)->get();
            $bills3 =DB::table("bills")->where('status',3)->get();
            $bills4 =DB::table("bills")->where('status',4)->get();
            return view("administrators/admin/home", [
                "product" => $product,
                "bill" => $bill,
                "bill1" => $bill1,
                "pro_bill" => $pro_bill,
                "pro_bill1" => $pro_bill1,
                "mes" => $mes,
                "user" => $user,
                "customer" => $customer,
                "bills4" => $bills4,
                "bills" => $bills,
                "bills1" => $bills1,
                "bills2" => $bills2,
                "bills3" => $bills3,
//                "totals" => $totals,
                "pay_month2" => $pay_month2,
            ]);
        }elseif(Auth::guard("staff")->check()){
            return redirect("admin/bills");
        }
        else{
            return redirect("admin/login");
        }
    }


    public function getLogin()
    {
        if (Auth::guard('admin')->check() || Auth::guard('staff')->check()) {
            return redirect("admin");
        } else {
            return view("administrators/admin/login");
        }
    }

    public function postLogin(Request $request){
        $credentials = $request->only("email","password");
        if (Auth::guard('admin')->attempt($credentials) || Auth::guard('staff')->attempt($credentials)) {
            return redirect("admin");
        }else{
            return redirect("admin/login");
        }
    }

    public function logout(){
        Auth::guard("admin")->logout();
        Auth::guard("staff")->logout();
        return redirect("admin/login");
    }
}
