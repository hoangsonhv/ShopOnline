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
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Id Bill</th>
                            <th>Product</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bill_detail as $bill_dt)
                            <tr>
                                <td>{{$bill_dt->id}}</td>
                                <td>{{$bill_dt->quantity}}</td>
                                <td>{{$bill_dt->unit_price}}</td>
                                <td>{{$bill_dt->bill->id}}</td>
                                <td>{{$bill_dt->product->name}}</td>
                                <td>{{$bill_dt->created_at}}</td>
                                <td>{{$bill_dt->updated_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
