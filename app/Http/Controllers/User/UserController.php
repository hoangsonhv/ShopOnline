<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Bill_Detail;
use App\Models\Custommer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{

    public function showBillList(){
        if (Auth::check()){
            $bills = Bill::with(['user','bill_detail','customer'])->where("id_user",Auth::id())->orderBy("id","DESC")->get();
            $bill_id = Bill::with(['user','bill_detail','customer'])->where("id_user",Auth::id())
                                                                ->join("bill_details",'id_bill','bills.id')
                                                                ->join("products",'id_product','products.id')
                                                                ->get();
            return view("web/user/password",[
                'bills'=>$bills,
                'bill_id'=>$bill_id,
            ]);
        }
        return redirect()->back()->with('success',"Bạn chưa đăng nhập.Hãy đăng nhập!");
    }

    public function showDetailBill($id){
        $bills = Bill::with("customer")->where("id",$id)->orderBy("id","DESC")->get();
        $bill_detail = Bill_Detail::with(["bill","product"])->where("id_bill",$id)->get();
        return view("web/user/bill_user",[
            "bills"=>$bills,
            "bill_detail"=>$bill_detail,
        ]);
    }

    public function cancelBillUser(Request $request,$id){
        $bill_dt = Bill_Detail::with("bill")->where('id_bill',$id)->get();
        foreach ($bill_dt as $bdt){
            $product = Product::find($bdt->id_product);
            $product->qty += $bdt->quantity;
            $product->save();
        }
        $bill = Bill::findOrFail($id);
        $bill->update([
            'status'=>4,
            'reason'=>$request->get("reason"),
        ]);
        return redirect()->back()->with("success","Hủy đơn hàng thành công!");
    }

    public function saveUpdatePassword(Request $request){
        $request->validate([
            'password_old'     => 'required',
            'password'         => 'required|min:8',
            'password_confirm' => 'required|same:password',
        ],[
            'password_old.required'     => 'Trường này không được để trống',
            'password.required'         => 'Trường này không được để trống',
            'password.min'              => 'Mật khẩu phải chứa từ 8 ký tự',
            'password_confirm.required' => 'Trường này không được để trống',
            'password_confirm.same' => 'Mật khẩu xác nhận không đúng',
        ]);
        $user = Auth::user();
        if (Hash::check($request->password_old , $user->password)) {
            $user->password = bcrypt($request->get("password"));
            $user->save();
            return redirect()->back()->with('success',"Cập nhật thành công!");
        }
        return redirect()->back()->with('error',"Mật khẩu cũ không đúng!");
    }
}
