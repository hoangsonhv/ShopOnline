@extends("administrators.layout")
@section("main")
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary" style="float: left">Bill Detail</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code 0rders</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Customer</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bills as $bill)
                        <tr>
                            <td>{{$bill->id}}</td>
                            <td>{{$bill->code_orders}}</td>
                            <td>{{$bill->total}}</td>
                            <td>{{$bill->payment}}</td>
                            <td>{{$bill->status}}</td>
                            <td>{{$bill->customer->name}}</td>
                            <td>{{$bill->created_at}}</td>
                            <td>{{$bill->updated_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
