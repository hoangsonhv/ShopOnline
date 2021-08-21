@extends("administrators.layout")
@section("main")
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary" style="float: left">Bill List</h4>
            </div>
            <div class="card-body">
                <div class="filter col-md-6 col-lg-5" style="padding: 0;margin-bottom: 20px; margin-left: -13px;">
                    <form action="#" class="form-inline" role="form" method="get">
                        @csrf
                        <div class="form-group col-md-5">
                            <input name="date_from" class="form-control" placeholder="Input field" type="date" />
                        </div>
                        <div class="form-group col-md-5">
                            <input name="date_to" class="form-control" placeholder="Input field" type="date" />
                        </div>
                        <button type="submit" class="btn btn-facebook">Filter</button>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center">
                            <th>ID</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Detail</th>
                            <th style="width: 200px">Approve</th>
                            <th>Cancel</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bills as $bill)
                            <tr style="text-align: center;overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis;width: 200px;">
                                <td>{{$bill->id}}</td>
                                <td>{{number_format($bill->total)}} VND</td>
                                <td>
                                    @if($bill->payment == 3)
                                        Payment by VNPAY
                                    @elseif($bill->payment == 1)
                                        Payment on delivery
                                    @elseif($bill->payment == 2)
                                        Payment by bank transfer
                                    @endif
                                </td>
                                <td>
                                    @if($bill->status == 0)
                                        <p style="background-color: #44f144;color: white;width: 100%;margin: 0;padding: 0 5px">Pending</p>
                                    @elseif($bill->status == 1)
                                        <p style="background-color: #024cca;color: white;width: 100%;margin: 0;padding: 0 5px">Processed</p>
                                    @elseif($bill->status == 2)
                                        <p style="background-color: #fc51e1;color: white;width: 100%;margin: 0;padding: 0 5px">Sending</p>
                                    @elseif($bill->status == 3)
                                        <p style="background-color: #fe00ff;color: white;width: 100%;margin: 0;padding: 0 5px">Done Sending</p>
                                    @elseif($bill->status == 4)
                                        <p style="background-color: red;color: white">Cancelled</p>
                                    @endif
                                </td>
                                <td>{{$bill->customer->name}}</td>
                                <td>{{formatDate($bill->created_at)}}</td>
                                <td>
                                    <a style="text-decoration: none" href="{{url("admin/bills/edit",["id"=>$bill->id])}}">Detail</a>
                                </td>
                                <td style="padding: 20px">
                                    @if($bill->status == 4)
                                        @if($bill->reason != null)
                                            <span style="color: red">{{$bill->reason}}</span>
                                        @else
                                            <span style="color: red">Cancelled</span>
                                        @endif
                                    @else
                                        <form action="{{url('admin/bills/update',["id"=>$bill->id])}}" method="get">
                                            <select name="status" style="border-radius: 5px;height: 30px;width: 115px">
                                                <option hidden>
                                                    @if($bill->status == 0)
                                                        Pending
                                                    @elseif($bill->status == 1)
                                                        Processed
                                                    @elseif($bill->status == 2)
                                                        Sending
                                                    @elseif($bill->status == 3)
                                                        Done Sending
                                                    @endif
                                                </option>
                                                <option value="0">Pending</option>
                                                <option value="1">Processed</option>
                                                <option value="2">Sending</option>
                                                <option value="3" >Done Sending</option>
                                            </select>
                                            <button type="submit" class="btn btn-success" style="width: 65px;height: 30px;padding: 0;margin-bottom: 2px">Browser</button>
                                        </form>
                                    @endif
                                </td>
                                <td style="padding: 20px">
                                    @if($bill->status == 4)
                                        <span style="color: red">Order canceled</span>
                                    @else
                                        <form action="{{url("admin/bills/cancel",["id"=>$bill->id])}}" method="post">
                                            @csrf
                                            <button style="height: 32px;margin-top: 7px;padding: 3px 10px;" class="btn btn-danger" onclick="return confirm('Hủy đơn hàng')" type="submit">Cancel</button>
                                        </form>
                                    @endif
                                </td>
                                <td><a style="text-decoration: none" href="{{url("admin/bills/delete",["id"=>$bill->id])}}" onclick="return confirm('Bạn có chắc muốn xóa không?')">Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
