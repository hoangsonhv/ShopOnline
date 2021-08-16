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
                            <tr style="text-align: center">
                                <td>{{$bill->id}}</td>
                                <td>{{$bill->total}}</td>
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
                                <td>{{$bill->customer->name}}</td>
                                <td>{{formatDate($bill->created_at)}}</td>
                                <td>
                                    <a href="{{url("admin/bills/edit",["id"=>$bill->id])}}">Detail</a>
                                </td>
                                <td>
                                    @if($bill->status == 4)
                                        <span style="color: red">{{$bill->reason}}</span>
                                    @else
                                        <form action="{{url('admin/bills/update',["id"=>$bill->id])}}" method="get">
                                            <select name="status" style="border-radius: 5px;height: 30px;width: 125px">
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
                                            <button type="submit" class="btn btn-success" style="width: 68px;height: 30px;padding: 0;margin-bottom: 2px">Browser</button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    @if($bill->status == 4)
                                        <span style="color: red">Order canceled</span>
                                    @else
                                        <form action="{{url("admin/bills/cancel",["id"=>$bill->id])}}" method="post">
                                            @csrf
                                            <button  class="btn btn-danger" type="submit">Cancel</button>
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
