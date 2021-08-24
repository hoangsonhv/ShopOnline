@extends("administrators.layout")
@section("main")
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary" style="float: left">Order Detail</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis">Create Order</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis">Total Price</th>
                            <th style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis">Id User</th>
                            <th style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis">Nam Of Product</th>
                            <th>Quantity</th>
                            <th style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis">Price Product</th>
                            <th style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis">Amount Paid</th>
                            <th style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis">Amount Left To Pay</th>
                            <th>Status</th>
                            <th>Date Order</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis">
                                <td style="text-align: center">
                                    @if($order->qty > 0)
                                        <form action="{{url("admin/orders/create",["id"=>$order->id])}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <button class="btn btn-success" type="submit" style="outline: none">Create</button>
                                        </form>
                                    @else
                                        <p style="color: #0c00ff;font-size: 17px;background-color: greenyellow;width: 100%;margin: 0;padding: 0 5px">Order Created</p>
                                    @endif
                                </td>
                                <td>{{$order->id}}</td>
                                <td >{{$order->name}}</td>
                                <td>{{$order->email}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->phone}}</td>
                                <td>
                                    @if($order->gender == 0)
                                        <span>Nam</span>
                                    @else
                                        <span>Nữ</span>
                                    @endif
                                </td>
                                <td>{{number_format($order->total_order)}} VND</td>
                                <td>{{$order->id_user}}</td>
                                <td>{{$order->name_product}}</td>
                                <td>{{$order->qty}}</td>
                                <td>{{number_format($order->price)}} VND</td>
                                <td>{{number_format($order->paid)}} VND</td>
                                <td>{{number_format($order->unpaid)}} VND</td>
                                <td>
                                    @if($order->status == 0)
                                        <span>Đã thanh toán {{number_format($order->paid)}} VND</span>
                                    @elseif($order->status == 1)
                                        <span>Đã thanh toán toàn bộ số tiền</span>
                                    @elseif($order->status == 2)
                                        <span>Đã tạo đơn hàng thành công</span>
                                    @endif
                                </td>
                                <td>{{$order->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
