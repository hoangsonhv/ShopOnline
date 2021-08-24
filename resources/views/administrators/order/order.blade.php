@extends("administrators.layout")
@section("main")
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary" style="float: left">Order List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Delete</th>
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
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order as $od)
                            <tr style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis">
                                <td style="text-align: center">
                                    <button class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa không?')" type="submit"><a href="{{url("admin/orders/delete",["id"=>$od->id])}}" style="text-decoration: none;color: white">Delete</a></button>
                                </td>
                                <td style="text-align: center">
                                    @if($od->status == 0 || $od->status == 1)
                                        <button class="btn btn-success" type="submit" style="outline: none">
                                            <a style="text-decoration: none;color: white" href="{{url("admin/orders/create",["id"=>$od->id])}}">Create</a>
                                        </button>
                                    @else
                                        <p style="color: #0c00ff;font-size: 17px;background-color: greenyellow;width: 100%;margin: 0;padding: 0 5px">Order Created</p>
                                    @endif
                                </td>
                                <td>{{$od->id}}</td>
                                <td >{{$od->name}}</td>
                                <td>{{$od->email}}</td>
                                <td>{{$od->address}}</td>
                                <td>{{$od->phone}}</td>
                                <td>
                                    @if($od->gender == 0)
                                        <span>Nam</span>
                                    @else
                                        <span>Nữ</span>
                                    @endif
                                </td>
                                <td>{{number_format($od->total_order)}} VND</td>
                                <td>{{$od->id_user}}</td>
                                <td>{{$od->name_product}}</td>
                                <td>{{$od->qty}}</td>
                                <td>{{number_format($od->price)}} VND</td>
                                <td>{{number_format($od->paid)}} VND</td>
                                <td>{{number_format($od->unpaid)}} VND</td>
                                <td>
                                    @if($od->status == 0)
                                        <span>Đã thanh toán {{number_format($od->paid)}} VND</span>
                                    @elseif($od->status == 1)
                                        <span>Đã thanh toán toàn bộ số tiền</span>
                                    @elseif($od->status == 2)
                                        <span>Đã tạo đơn hàng thành công</span>
                                    @endif
                                </td>
                                <td>{{formatDate($od->created_at)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
