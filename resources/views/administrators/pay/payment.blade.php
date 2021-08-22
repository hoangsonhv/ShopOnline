@extends("administrators.layout")
@section("main")
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary" style="float: left">Payment List</h4>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center">
                            <th>Delete</th>
                            <th>ID</th>
                            <th>Transaction Code</th>
                            <th>Total Money</th>
                            <th>Note</th>
                            <th>Code VNPAY</th>
                            <th>Bank Code</th>
                            <th>Id User</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $payment)
                            <tr style="text-align: center;overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis;width: 200px;">
                                <td>
                                    <a style="text-decoration: none" href="{{url("admin/payments/delete",["id"=>$payment->id])}}">Delete</a>
                                </td>
                                <td>{{$payment->id}}</td>
                                <td>{{$payment->transaction_code}}</td>
                                <td>{{number_format($payment->money)}} VND</td>
                                <td>{{$payment->note}}</td>
                                <td>{{$payment->code_vnpay}}</td>
                                <td>{{$payment->code_bank}}</td>
                                <td>{{$payment->id_user}}</td>
                                <td>{{$payment->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
