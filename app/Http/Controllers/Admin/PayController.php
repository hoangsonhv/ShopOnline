<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayController extends Controller
{
    public function show(Request $request){
        $payments = Payment::all();
        if ($request->get("date_from") && $request->get("date_to")){
            $payments = DB::table("payment")->whereBetween("created_at",[$request->get("date_from"),$request->get("date_to")])
                ->orderBy("id","DESC")
                ->get();
        }
        return view("administrators/pay/payment",[
            "payments"=>$payments
        ]);
    }

    public function deletePay($id){
        try {
            $pay = Payment::findOrFail($id);
            $pay->delete();
            return back()->with("success","Xóa thành công!");
        }catch (\Exception $e){
            return back()->with("error","Không xóa được!");
        }
    }

}
