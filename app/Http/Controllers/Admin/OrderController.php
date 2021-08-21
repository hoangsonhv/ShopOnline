<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Bill_Detail;
use App\Models\Custommer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function show(){
        $order = Order::all();
        return view("administrators/order/order",[
            "order"=>$order,
        ]);
    }

    public function createOrder($id){
        try {
            $order = Order::findOrFail($id);
            $id_product = $order->id_product;
            $products = DB::table("products")->where("id",$id_product)->get();

            if ($order->qty > 0) {
                foreach ($products as $product) {
                    if ($product->qty > 0) {
                        $customer = Custommer::create([
                            "name" => $order->name,
                            "email" => $order->email,
                            "address" => $order->address,
                            "phone_number" => $order->phone,
                            "gender" => $order->gender,
                        ]);
                        $pay = 3;
                        $payment = $pay . $id_product;
                        $config = ['table' => 'bills', 'length' => 8, 'prefix' => date('ym')];
                        $code = IdGenerator::generate($config);
                        $code_bill = (int)$code . (int)$payment;

                        Bill::create([
                            "id" => $code_bill,
                            "total" => $order->unpaid,
                            "payment" => 3,
                            "status" => 1,
                            "id_customer" => $customer->id,
                            "id_user" => $order->id_user,
                        ]);

                        DB::table("bill_details")->insert([
                            "quantity" => $order->qty,
                            "price" => $order->price,
                            "id_bill" => $code_bill,
                            "id_product" => $id_product,
                        ]);
                        DB::table("orders")->update([
                            "id_customer" => $customer->id,
                            "id_bill" => $code_bill,
                            "status" => 2,
                            "qty" => 0,
                        ]);

                        $p = Product::find($id_product);
                        $p->qty -= $order->qty;
                        $p->save();
                        return redirect()->back()->with("success", "Tạo đơn hàng thành công!");
                    }
                }
            }
            return back()->with("error", "Không thể tạo đơn hàng. Kiểm tra số lượng sản phẩm!");
        }catch (\Exception $e) {
            return back()->with("error", "Không thể tạo đơn hàng. Kiểm tra số lượng sản phẩm!");
        }
    }

    public function delete($id){
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->back()->with("success","Xóa thành công!");
    }
}
