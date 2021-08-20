<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show(){
        $order = Order::all();
        return view("administrators/order/order",[
            "order"=>$order,
        ]);
    }
}
