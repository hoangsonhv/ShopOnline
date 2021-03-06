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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bill_detail as $bill_dt)
                            <tr>
                                <td>{{$bill_dt->id}}</td>
                                <td>{{$bill_dt->quantity}}</td>
                                <td>{{$bill_dt->price}}</td>
                                <td>{{$bill_dt->bill->id}}</td>
                                <td>{{$bill_dt->product->name}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
