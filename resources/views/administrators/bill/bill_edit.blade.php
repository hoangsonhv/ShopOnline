@extends("administrators.layout")
@section("main")
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary" style="float: left">Customer</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center">
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bills as $bill)
                            <tr style="text-align: center">
                                <td>{{$bill->customer->name}}</td>
                                <td>
                                    @if($bill->customer->gender == 0)
                                        Men
                                    @else
                                        Women
                                    @endif
                                </td>
                                <td>{{$bill->customer->email}}</td>
                                <td>{{$bill->customer->address}}</td>
                                <td>{{$bill->customer->phone_number}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary" style="float: left">Bill Detail</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center">
                            <th>Code Oder</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bill_detail as $bdt)
                            <tr style="text-align: center">
                                <td>{{$bdt->bill->id}}</td>
                                <td>{{$bdt->product->name}}</td>
                                <td>{{$bdt->quantity}}</td>
                                <td>{{number_format($bdt->price)}}$</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
