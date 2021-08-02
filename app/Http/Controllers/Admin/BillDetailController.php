<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Bill_Detail;
use Illuminate\Http\Request;

class BillDetailController extends Controller
{
    public function showBillDetail(){
        $bill_detail = Bill_Detail::with(['Bill','Product'])->get();
        return view("administrators/bill_detail/bill_detail_list",[
            "bill_detail"=>$bill_detail
        ]);
    }
}
