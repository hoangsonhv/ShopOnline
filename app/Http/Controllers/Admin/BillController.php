<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function showBill(){
        $bills = Bill::with(['customer','bill_detail'])->get();
        return view("administrators/bill/bill_list",[
            "bills"=>$bills
        ]);
    }

    public function editBill($id){
        $bills = Bill::all();
        return view("administrators/bill/bill_edit");
    }
}
