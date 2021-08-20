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
                            <tr>
                                <td style="text-align: center">
                                    <form action="" method="post">
                                        <button class="btn btn-success" style="outline: none">Create</button>
                                    </form>
                                </td>
                                <td>{{$od->id}}</td>
                                <td style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis">{{$od->name}}</td>
                                <td>{{$od->email}}</td>
                                <td style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis">{{$od->address}}</td>
                                <td>{{$od->phone}}</td>
                                <td>
                                    @if($od->gender == 0)
                                        <span>Nam</span>
                                    @else
                                        <span>Nữ</span>
                                    @endif
                                </td>
                                <td style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis">{{$od->total_price}} VND</td>
                                <td>{{$od->id_user}}</td>
                                <td style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis">{{$od->name_product}}</td>
                                <td>{{$od->qty}}</td>
                                <td style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis">{{$od->price}} VND</td>
                                <td style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis">{{number_format($od->paid)}} VND</td>
                                <td style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis">{{number_format($od->unpaid)}} VND</td>
                                <td style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis">
                                    @if($od->status == 0)
                                        <span>Khách hủy thanh toán</span>
                                    @else
                                        <span>Đã thanh toán {{number_format($od->paid)}} VND</span>
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
