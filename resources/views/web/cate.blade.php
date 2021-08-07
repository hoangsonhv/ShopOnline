@extends("web.layout")
@section("main")
        <div class="ht__bradcaump__area" style="background-color: whitesmoke;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                    @if(count($category) != null)
                                        <a class="breadcrumb-item" href="{{url("/")}}">Home</a>
                                        <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                        <span class="breadcrumb-item active">
                                        {{$cat->category->name}}
                                    </span>
                                    @else
                                        <a class="breadcrumb-item" href="{{url("/")}}">Home</a>
                                    @endif
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="htc__product__grid bg__white "  style="margin-bottom: 50px">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-lg-push-3 col-md-9 col-md-push-3 col-sm-12 col-xs-12" >
                        <div class="htc__product__rightidebar">
                            <div class="row">
                                <div class="shop__grid__view__wrap">
                                    <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                        @if(count($category) != null)
                                            <p style="text-align: center">Find {{count($category)}} Product</p>
                                            @foreach($category as $pd)
                                                <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                                                    <div class="category">
                                                        <div class="ht__cat__thumb" style="background: #F5F5F5;width: 290px;height: 385px;padding-top: 50px">
                                                            <a href="{{url("product-detail",["id"=>$pd->id])}}">
                                                                <img src="{{$pd->getImage()}}" alt="product images" >
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
                                                            <h4><a href="{{url("product-detail",["id"=>$pd->id])}}">{{$pd->name}}</a></h4>
                                                            <ul class="fr__pro__prize">
                                                                @if($pd->promotion_price > 0)
                                                                    <li class="old__prize">${{number_format($pd->unit_price)}}</li>
                                                                    <li>${{number_format($pd->promotion_price)}}</li>
                                                                @else
                                                                    <li>${{number_format($pd->unit_price)}}</li>
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
                                                    {!! $category->links("vendor.pagination.default") !!}
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- End Pagenation -->
                    </div>
                    <div class="col-lg-3 col-lg-pull-9 col-md-3 col-md-pull-9 col-sm-12 col-xs-12 smt-40 xmt-40">
                        <div class="htc__product__leftsidebar">
                            <div class="htc-grid-range">
                                <h4 class="title__line--4" >Range Price</h4>
                                <ul>
                                    <li style="margin-bottom: 5px"><a class="{{\Illuminate\Support\Facades\Request::get('price') == 1 ? 'active' : ''}}" href="{{ request()->fullUrlWithQuery(['price' => '1']) }}"  style="font-size: 16px">Less 100$</a></li>
                                    <li style="margin-bottom: 5px"><a class="{{\Illuminate\Support\Facades\Request::get('price') == 2 ? 'active' : ''}}" href="{{ request()->fullUrlWithQuery(['price' => '2']) }}" style="font-size: 16px">100$ - 500$</a></li>
                                    <li style="margin-bottom: 5px"><a class="{{\Illuminate\Support\Facades\Request::get('price') == 3 ? 'active' : ''}}" href="{{ request()->fullUrlWithQuery(['price' => '3']) }}" style="font-size: 16px">500$ - 1000$</a></li>
                                    <li style="margin-bottom: 5px"><a class="{{\Illuminate\Support\Facades\Request::get('price') == 4 ? 'active' : ''}}" href="{{ request()->fullUrlWithQuery(['price' => '4']) }}" style="font-size: 16px">1000$ - 1500$</a></li>
                                    <li style="margin-bottom: 5px"><a class="{{\Illuminate\Support\Facades\Request::get('price') == 5 ? 'active' : ''}}" href="{{ request()->fullUrlWithQuery(['price' => '5']) }}" style="font-size: 16px">1500$ - 3000$</a></li>
                                    <li style="margin-bottom: 5px"><a class="{{\Illuminate\Support\Facades\Request::get('price') == 6 ? 'active' : ''}}" href="{{ request()->fullUrlWithQuery(['price' => '6']) }}" style="font-size: 16px">Over 3000$</a></li>
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
                            <!-- End Category Area -->

                            <!-- Start Tag Area -->
                            <!-- End Tag Area -->
                            <!-- Start Best Sell Area -->
                            <div class="htc__recent__product">
                                <h2 class="title__line--4">best seller</h2>
                                <div class="htc__recent__product__inner">
                                @foreach($product1 as $prd)
                                    <!-- Start Single Product -->
                                    <div class="htc__best__product">
                                        <div class="htc__best__pro__thumb" style="background: #F5F5F5">
                                            <a href="{{url("product-detail",["id"=>$prd->id])}}">
                                                <img src="{{$prd->getImage()}}" alt="small product">
                                            </a>
                                        </div>
                                        <div class="htc__best__product__details">
                                            <h2><a href="{{url("product-detail",["id"=>$prd->id])}}">{{$prd->name}}</a></h2>
                                            <ul  class="pro__prize">
                                                @if($prd->promotion_price > 0)
                                                    <li class="old__prize">${{number_format($prd->unit_price)}}</li>
                                                    <li>${{number_format($prd->promotion_price)}}</li>
                                                @else
                                                    <li>${{number_format($prd->unit_price)}}</li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- End Single Product -->
                                @endforeach
                                </div>
                            </div>
                            <!-- End Best Sell Area -->
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
                                    <li><img src="{{$brand->brandImage()}}" alt="brand images" style="padding: 40px;width: 250px;height: 230px"></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Brand Area -->
@endsection
