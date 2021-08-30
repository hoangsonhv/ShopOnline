<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Bill_Detail;
use App\Models\Custommer;
use App\Models\Messenger;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function showBill(Request $request){
        $bills = Bill::with(['customer','bill_detail'])->orderBy("id","DESC")->get();
        if ($request->get("date_from") && $request->get("date_to")){
            $bills = Bill::with(['customer','bill_detail'])
                ->whereBetween("created_at",[$request->get("date_from"),$request->get("date_to")])
                ->orderBy("id","DESC")
                ->get();
        }
        return view("administrators/bill/bill_list",[
            "bills"=>$bills,
        ]);
    }

    public function editBill($id){
        $bills = Bill::with("customer")->where("id",$id)->get();
        $bill_detail = Bill_Detail::with(["bill","product"])->where("id_bill",$id)->get();
        return view("administrators/bill/bill_edit",[
            "bills"=>$bills,
            "bill_detail"=>$bill_detail,
        ]);
    }

    public function updateBill(Request $request,$id){
//        try {
            $bill = Bill::findOrFail($id);
            $bill_detail = DB::table("bill_details")->where("id_bill",$id)->get();
            if ($request->get("status") == 3){
                DB::table("bill_details")->where("id_bill",$id)->update([
                    "status"=>1
                ]);
                $bill->update([
                    'status'=>$request->get("status"),
                    'paid'=>$bill->total,
                    'unpaid'=>0,
                ]);
                foreach ($bill_detail as $bill_dt){
                    $pro = DB::table("products")->where("id",$bill_dt->id_product)->first();
                    $pros = DB::table("products")->where("id",$bill_dt->id_product)->update([
                        "pro_pay"=>$pro->pro_pay + $bill_dt->quantity,
                    ]);
                }
            }else{
                $bill->update([
                    'status'=>$request->get("status"),
                ]);
            }
//        }catch (\Exception $e){
//            return redirect()->back()->with('error',"Update không thành công!");
//        }
        return redirect()->back()->with('success',"Update thành công!");
    }

    public function cancelBill($id){
        $bill_detail = Bill_Detail::with("bill")->where('id_bill',$id)->get();
        foreach ($bill_detail as $bdt){
            $product = Product::find($bdt->id_product);
            $product->qty += $bdt->quantity;
            $product->save();
        }
        $bill = Bill::findOrFail($id);
        $bill->update([
            'status'=>4,
        ]);
        return redirect()->back()->with("success","Hủy đơn hàng thành công!");
    }

    public function deleteBill($id){
        try {
            $bill = Bill::findOrFail($id);
            $bill->delete();
            return redirect()->back()->with("success","Xóa đơn hàng thành công!");
        }catch (\Exception $e){
            return back()->with("error","Không xóa được !");
        }
    }
}
