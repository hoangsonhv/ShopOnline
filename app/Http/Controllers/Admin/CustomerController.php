<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Custommer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function showCustomer(){
        $customer = Custommer::all();
        return view("administrators/customer/customer_list",[
            "customer"=>$customer
        ]);
    }

    public function deleteCustomer($id){
        $cus = Custommer::findOrFail($id);
        $cus->delete();
        return redirect()->back()->with("success","Xóa thành công!");
    }
}
