@extends("web.layout")
@section("main")
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area" style="background-color: whitesmoke;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner">
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{url("/")}}">Home</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                <span class="breadcrumb-item active">Shop</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start Product Grid -->
    <section class="htc__product__grid bg__white " style="margin-bottom: 50px;margin-top: 50px">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-lg-push-3 col-md-9 col-md-push-3 col-sm-12 col-xs-12" >
                    <div class="htc__product__rightidebar">
                        <div class="row">
                            <div class="shop__grid__view__wrap" style="margin-top: -40px;">
                                <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                    @if(count($products) != null)
                                        @foreach($products as $pd)
                                            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                                                <div class="category">
                                                    <div class="ht__cat__thumb" >
                                                        <a href="{{url("product-detail",["id"=>$pd->id])}}">
                                                            <img src="{{$pd->getImage()}}" alt="product images" style="object-fit: contain">
                                                        </a>
                                                    </div>
                                                    <div class="fr__hover__info">
                                                        <ul class="product__action">
                                                            <li><a href="{{url("products/add-to-wish",["id"=>$pd->id])}}"><i class="icon-heart icons"></i></a></li>

                                                            <li><a href="{{url("products/add-to-cart",["id"=>$pd->id])}}"><i class="icon-handbag icons"></i></a></li>

                                                            <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="fr__product__inner">
                                                        <h4 style="height: 40px"><a href="{{url("product-detail",["id"=>$pd->id])}}">{{$pd->name}}</a></h4>
                                                        <ul class="fr__pro__prize" style="padding-top: 22px">
                                                            @if($pd->promotion_price > 0)
                                                                <li class="old__prize" style="font-weight: 500;font-size: 12px"><strike>{{number_format($pd->unit_price)}} VND</strike></li>
                                                                <li style="font-weight: 600">{{number_format($pd->promotion_price)}} VND</li>
                                                            @else
                                                                <li  style="font-weight: 600">{{number_format($pd->unit_price)}} VND</li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <h2 style="text-align: center">No products found...</h2>
                                    @endif
                                    <div class="col-xs-12">
                                        <div>
                                            {!! $products->links("vendor.pagination.default") !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-lg-pull-9 col-md-3 col-md-pull-9 col-sm-12 col-xs-12 smt-40 xmt-40">
                    <div class="htc__product__leftsidebar">
                        <div class="htc-grid-range" style="margin-bottom: 64px;">
                            <form method="GET" action="#">
                                <h4 class="title__line--4">Price</h4>
                                <div id="slider-range"></div>
                                <input type="hidden" name="start_price" id="start_price">
                                <input type="hidden" name="end_price" id="end_price">
                                <div class="content-shopby">
                                    <div class="price_filter s-filter clear">

                                        <div class="slider__range--output">
                                            <div class="price__output--wrap">
                                                <div class="price--output">
                                                    <span>Price : <input type="text" id="amount" readonly style="width: 209px;border:0; color:#C43B68; font-weight:bold;"></span>
                                                </div>
                                                <div class="price--filter">
                                                    <input type="submit" name="filter_price" value="Filter" class="btn btn-sm btn-danger">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="htc-grid-range">
                            <h4 class="title__line--4" >Range Price</h4>
                            <ul>
                                <li style="margin-bottom: 5px"><a class="{{\Illuminate\Support\Facades\Request::get('price') == 0 ? 'active' : ''}}" href="{{ request()->fullUrlWithQuery(['price' => '0']) }}"  style="font-size: 16px">All Product</a></li>
                                <li style="margin-bottom: 5px"><a class="{{\Illuminate\Support\Facades\Request::get('price') == 1 ? 'active' : ''}}" href="{{ request()->fullUrlWithQuery(['price' => '1']) }}"  style="font-size: 16px">Less 1.000.000 VND</a></li>
                                <li style="margin-bottom: 5px"><a class="{{\Illuminate\Support\Facades\Request::get('price') == 2 ? 'active' : ''}}" href="{{ request()->fullUrlWithQuery(['price' => '2']) }}" style="font-size: 16px">1.000.000 - 5.000.000 VND</a></li>
                                <li style="margin-bottom: 5px"><a class="{{\Illuminate\Support\Facades\Request::get('price') == 3 ? 'active' : ''}}" href="{{ request()->fullUrlWithQuery(['price' => '3']) }}" style="font-size: 16px">5.000.000 - 10.000.000 VND</a></li>
                                <li style="margin-bottom: 5px"><a class="{{\Illuminate\Support\Facades\Request::get('price') == 4 ? 'active' : ''}}" href="{{ request()->fullUrlWithQuery(['price' => '4']) }}" style="font-size: 16px">10.000.000 - 15.000.000 VND</a></li>
                                <li style="margin-bottom: 5px"><a class="{{\Illuminate\Support\Facades\Request::get('price') == 5 ? 'active' : ''}}" href="{{ request()->fullUrlWithQuery(['price' => '5']) }}" style="font-size: 16px">15.000.000 - 25.000.000 VND</a></li>
                                <li style="margin-bottom: 5px"><a class="{{\Illuminate\Support\Facades\Request::get('price') == 6 ? 'active' : ''}}" href="{{ request()->fullUrlWithQuery(['price' => '6']) }}" style="font-size: 16px">Over 25.000.000 VND</a></li>
                            </ul>
                        </div>
                        <hr>
                        <div class="htc__category">
                            <h4 class="title__line--4">Categories</h4>
                            <ul class="ht__cat__list">
                                @foreach($cate as $c)
                                    <li class="drop"><a href="{{url("cate",$c->id)}}">{{$c->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="htc__recent__product">
                            <h2 class="title__line--4">Best Seller</h2>
                            <div class="htc__recent__product__inner">
                            @foreach($product1 as $prd)
                                <!-- Start Single Product -->
                                <div class="htc__best__product">
                                    <div class="htc__best__pro__thumb" style="background: #F5F5F5">
                                        <a href="{{url("product-detail",["id"=>$prd->id])}}">
                                            <img src="{{$prd->getImage()}}" alt="small product" style="object-fit: contain">
                                        </a>
                                    </div>
                                    <div class="htc__best__product__details">
                                        <h2><a href="{{url("product-detail",["id"=>$prd->id])}}">{{$prd->name}}</a></h2>
                                        <ul class="pro__prize">
                                            @if($prd->promotion_price > 0)
                                                <li class="old__prize" style="font-weight: 500;font-size: 12px"><strike>{{number_format($prd->unit_price)}} VND</strike></li>
                                                <li style="font-weight: 600">{{number_format($prd->promotion_price)}} VND</li>
                                            @else
                                                <li style="font-weight: 600">{{number_format($prd->unit_price)}} VND</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product Grid -->
    <!-- Start Brand Area -->
    <div class="htc__brand__area bg__cat--4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ht__brand__inner">
                        <ul class="brand__list owl-carousel clearfix">
                            @foreach($brands as $brand)
                                <li><img src="{{$brand->brandImage()}}" alt="brand images" style="padding: 40px;width: 250px;height: 230px; object-fit: contain"></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Brand Area -->
@endsection
@push("scripts")
    <script>
        var slider = document.getElementById('slider');
        noUiSlider.create(slider,{
            start: [1,100],
            connect:true,
            range:{
                'min' : 1,
                'max' : 1000,
            },
            pips:{
                mode: 'steps',
                stepped: true,
                density:4,
            }
        });
    </script>
@endpush
