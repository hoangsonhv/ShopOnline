@extends("web.layout")
@section("detail")
    <script>
        var btnContainer = document.getElementById("active_button");
        var btns = btnContainer.getElementsByClassName('btn');
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
                var current = document.getElementsByClassName('active2');
                current[0].className = current[0].className.replace(' active2', '');
                this.className += " active2";
            });
        }
    </script>
@stop
@section("main")
    <div class="ht__bradcaump__area" style="background-color: whitesmoke;margin-bottom: 50px;height: 150px">
        <div class="container">
            <h2 style="text-align: center;font-weight: 600;margin-top: 66px;color: #000cff">Hello ! {{\Illuminate\Support\Facades\Auth::user()->name}}</h2>
        </div>
    </div>
    <div class="w3-container">
        <div  id="active_button" class="w3-bar" style="width: 270px;height: 50px;margin: auto;font-size: 17px;color:black;font-weight: 400;margin-bottom: 50px;">
            <button class="btn btn-danger2 tablink active2" onclick="openCity(event,'Detail')" style="height: 100%">Information Line</button>
            <button class="btn btn-danger2 tablink " onclick="openCity(event,'Passwords')" style="height: 100%">Change Password</button>
        </div>

        <div id="Detail" class="container  city" style="height: auto;padding-bottom: 100px">
            <h2 style="text-align: center;color: #001fff;font-weight: 500;padding: 20px">THE ORDERS</h2>
            <div class="row  d-none d-lg-block" style="border: 1px solid silver;padding: 25px;border-radius: 5px;box-shadow: 3px 3px 3px silver;">
                <h2 style="text-align: center;padding: 20px 0">Orders Bill </h2>
                <hr>
                @if(count($bills) != null)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="text-align: center">Code Oder</th>
                        <th style="text-align: center">Total</th>
                        <th style="text-align: center">Payment</th>
                        <th style="text-align: center">Status</th>
                        <th style="text-align: center">Details</th>
                        <th style="text-align: center">Canceled</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bills as $bill)
                        <tr style="text-align: center">
                            <td>{{$bill->id}}</td>
                            <td>{{number_format($bill->total)}} VND</td>
                            <td>
                                @if($bill->payment == 3)
                                    <span style="text-align: center">Pay by VNPAY</span>
                                @elseif($bill->payment == 1)
                                    <span style="text-align: center">Payment on delivery</span>
                                @elseif($bill->payment == 2)
                                    <span style="text-align: center">Payment by bank transfer</span>
                                @endif
                            </td>
                            <td>
                                @if($bill->status == 0)
                                    <span style="color: #44f144">Pending</span>
                                @elseif($bill->status == 1)
                                    <span style="color: #024cca">Processed</span>
                                @elseif($bill->status == 2)
                                    <span style="color: #fc51e1">Sending</span>
                                @elseif($bill->status == 3)
                                    <span style="color: #8f05eb">Done Sending</span>
                                @elseif($bill->status == 4)
                                    <span style="color: red">Cancelled</span>
                                @endif
                            </td>
                            <td><a href="{{url("detail-bill",["id"=>$bill->id])}}">Details</a></td>
                            <td>
                                @if($bill->status == 0)
                                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deldill">Cancel</button>
                                    <form method="post" action="{{url("detail-bill/cancel",["id"=>$bill->id])}}">
                                        @csrf
                                        {{--                                        <button  class="btn btn-danger" type="submit">Cancel</button>--}}

                                        <div id="deldill" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 style="font-size: 20px" class="modal-title">Reason for cancellation..</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="color: black"><textarea rows="3" name="reason" placeholder="Reason for cancellation..."></textarea> </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" onclick="{{url("detail-bill/cancel",["id"=>$bill->id])}}">Send</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @elseif($bill->status == 1)
                                    <span style="color: #024cca">Processed</span>
                                @elseif($bill->status == 2)
                                    <span style="color: #fc51e1">Sending</span>
                                @elseif($bill->status == 3)
                                    <span style="color: #8f05eb">Done Sending</span>
                                @elseif($bill->status == 4)
                                    <span style="color: red">Order canceled</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                    <p style="text-align: center;color: black;margin-bottom: 50px">No Bills.!</p>
                @endif

                <h2 style="text-align: center;padding: 20px 0">Your Orders</h2>
                <hr>
                @if(count($orders)!= null)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="text-align: center">ID</th>
                        <th style="text-align: center">Total Money</th>
                        <th style="text-align: center">Id Bill</th>
                        <th style="text-align: center">Id Product</th>
                        <th style="text-align: center">Name Product</th>
                        <th style="text-align: center">Qty Order</th>
                        <th style="text-align: center">Price Product</th>
                        <th style="text-align: center">The Amount Paid</th>
                        <th style="text-align: center">Amount Still To Be Paid</th>
                        <th style="text-align: center">Status Order</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr style="text-align: center">
                            <td>{{$order->id}}</td>
                            <td>{{number_format($order->total_order)}} VND</td>
                            <td>
                                @if($order->id_bill == 0)
                                    <span style="font-size: 15px;color: #ff4e00">Chưa có hàng</span>
                                @else
                                    {{$order->id_bill}}
                                @endif
                            </td>
                            <td>{{$order->id_product}}</td>
                            <td>{{$order->name_product}}</td>
                            <td>{{$order->qty}}</td>
                            <td>{{number_format($order->price)}} VND</td>
                            <td>{{number_format($order->paid)}} VND</td>
                            <td>{{number_format($order->unpaid)}} VND</td>
                            <td>
                                @if($order->status == 0 || $order->status == 1)
                                    <span style="font-size: 17px;color: #ff4e00">Chưa có hàng!</span>
                                @else
                                    <span style="font-size: 17px;color: #000cff">Giao dịch đã được xử lý.Vui lòng kiểm tra đơn hàng!</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                    <p style="text-align: center;color: black;margin-bottom: 50px">No Order.!</p>
                @endif
            </div>
        </div>
        <div id="Passwords" class="container city" style="display:none;height: 500px">
            <div class="row" style="background-color: whitesmoke;padding: 5% 20%">
                <div class="col-sm-12">
                    <form action="{{url("change-user")}}" method="post" >
                        @csrf
                        <div class="form-group" style="position: relative">
                            <label for="password">Old Password: </label>
                            <input type="password" class="form-control" required name="password_old" placeholder="********" value="">
                            @error("password_old")<div class="alert alert-danger" style="width: 100%;" >{{$message}}</div>@enderror
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="password">New Password: </label>
                            <input type="password" class="form-control" required name="password" placeholder="********" value="">
                            @error("password")<div class="alert alert-danger" style="width: 100%;" >{{$message}}</div>@enderror
                        </div>
                        <div class="form-group" style="position: relative">
                            <label for="password">Enter the password: </label>
                            <input type="password" class="form-control" required name="password_confirm" placeholder="********" value="">
                            @error("password_confirm")<div class="alert alert-danger" style="width: 100%;" >{{$message}}</div>@enderror
                        </div>
                        <button type="submit" class="btn btn-danger2 active2">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
