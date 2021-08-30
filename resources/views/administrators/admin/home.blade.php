@extends("administrators.layout")

@section("main")
    <div class="text_top" style="height: 30px;padding: 0 23px;text-align: center">
        <h4 class="m-0 font-weight-bold text-primary" >Statistics</h4>
    </div>
    <hr>
    <div class="container-fluid">
        <div class="" style="margin-bottom: 50px">
            <canvas id="myChart" width="50px" height=""></canvas>
        </div>
        <div class="col-md-12" style="background-color: white;text-align: center;border-radius: 5px">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @php $total_1 = 0; @endphp
                            @foreach($bill1 as $b1)
                                @if ($b1->status == 3)
                                    @php
                                        $total_1 += $b1->__get("total");
                                    @endphp
                                @endif
                            @endforeach
                            @php $total_profit1 = 0; @endphp
                            @foreach($pro_bill1 as $pro1)
                                @php $total_profit1 += $pro1->product->cost; @endphp
                            @endforeach
                            <div>
                                <span style="color: red">Total Monthly Profit : {{number_format($total_1 - $total_profit1)}} VND</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Products
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($product)}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Revenue
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @php $total = 0; @endphp
                                @foreach($bill as $b)
                                        @php $total += $b->__get("total"); @endphp
                                @endforeach
                                   <div>
                                       {{number_format($total)}} VND
                                   </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Profit
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @php $total2 = 0; @endphp
                                    @foreach($bill as $b)
                                        @if ($b->status == 3)
                                            @php
                                                 $total2 += $b->__get("total");
                                            @endphp
                                        @endif
                                    @endforeach
                                    @php $total_profit = 0; @endphp
                                    @foreach($pro_bill as $prob)
                                            @php $total_profit += $prob->cost; @endphp

                                    @endforeach
                                    <div>
                                        {{number_format($total2 - $total_profit)}} VND
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total Orders
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{count($bill)}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Customer Feedback
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($mes)}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Number Of Products Sold
                                </div>
                                @php
                                    $totalPay = 0;
                                    $totalView = 0;
                                    $product = \App\Models\Product::all();
                                    foreach ($product as $pro){
                                        $totalPay += $pro->pro_pay;
                                        $totalView += $pro->pro_view;
                                    }
                                 @endphp
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalPay}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cart-plus fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Views
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalView}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-eye fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="text_top" style="height: 30px;padding: 0 23px;text-align: center">
            <h4 class="m-0 font-weight-bold text-primary">Order Status Statistics</h4>
        </div>
        <hr>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Orders Are Waiting
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($bills)}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Orders Are Being Processed
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($bills1)}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Orders Are Being Sent
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($bills2)}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Orders Sent
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($bills3)}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Number Of Canceled Orders
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($bills4)}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section("scripts")
    <script src="{{asset("https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js")}}"></script>
    <script src="{{asset("https://cdn.jsdelivr.net/npm/chart.js")}}"></script>
    <script src="{{asset("path/to/chartjs/dist/chart.js")}}"></script>
    <script>
        var Chart = require('chart.js');
        var myChart = new Chart(ctx, {...});
    </script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach($pay_month2 as $pay2)
                        '{{$pay2->created_at}}',
                    @endforeach
                ],
                datasets: [{
                    label: 'TOTAL REVENUE',
                    data:[
                        @foreach($pay_month2 as $pay)
                            {{(int)$pay->total}},
                        @endforeach
                        ],
                    backgroundColor: [
                        'rgba(252,80,116,0.2)',
                        'rgba(252,80,116,0.2)',
                        'rgba(252,80,116,0.2)',
                        'rgba(252,80,116,0.2)',
                        'rgba(252,80,116,0.2)',
                        'rgba(252,80,116,0.2)',
                        'rgba(252,80,116,0.2)',
                        'rgba(252,80,116,0.2)',
                        'rgba(252,80,116,0.2)',
                        'rgba(252,80,116,0.2)',
                        'rgba(252,80,116,0.2)',
                        'rgba(252,80,116,0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',

                    ],
                    borderWidth: 1
                },
                    // {
                    //     label: 'TOTAL PROFIT',
                    //     data: [10000, 80000, 30000, 5000, 20000, 3000],
                    //     backgroundColor: [
                    //         'rgba(24,148,227,0.2)',
                    //         'rgba(24,148,227,0.2)',
                    //         'rgba(24,148,227,0.2)',
                    //         'rgba(24,148,227,0.2)',
                    //         'rgba(24,148,227,0.2)',
                    //         'rgba(24,148,227,0.2)',
                    //         'rgba(24,148,227,0.2)',
                    //         'rgba(24,148,227,0.2)',
                    //         'rgba(24,148,227,0.2)',
                    //         'rgba(24,148,227,0.2)',
                    //         'rgba(24,148,227,0.2)',
                    //         'rgba(24,148,227,0.2)',
                    //     ],
                    //     borderColor: [
                    //         'rgba(54, 162, 235, 1)',
                    //         'rgba(54, 162, 235, 1)',
                    //         'rgba(54, 162, 235, 1)',
                    //         'rgba(54, 162, 235, 1)',
                    //         'rgba(54, 162, 235, 1)',
                    //         'rgba(54, 162, 235, 1)',
                    //         'rgba(54, 162, 235, 1)',
                    //         'rgba(54, 162, 235, 1)',
                    //         'rgba(54, 162, 235, 1)',
                    //         'rgba(54, 162, 235, 1)',
                    //         'rgba(54, 162, 235, 1)',
                    //         'rgba(54, 162, 235, 1)',
                    //     ],
                    //     borderWidth: 1
                    // }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@stop
@endsection
