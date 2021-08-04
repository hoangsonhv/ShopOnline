@extends("web.layout")
@section("main")
    <div class="ht__bradcaump__area"
         style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner">
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="index.html">Home</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                <span class="breadcrumb-item active">Products</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="htc__product__grid bg__white ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-lg-push-3 col-md-9 col-md-push-3 col-sm-12 col-xs-12">
                    <div class="htc__product__rightidebar">
                        <div class="htc__grid__top">
                            <div class="htc__select__option">
                                <select class="ht__select">
                                    <option>Default softing</option>
                                    <option>Sort by popularity</option>
                                    <option>Sort by average rating</option>
                                    <option>Sort by newness</option>
                                </select>
                                <select class="ht__select">
                                    <option>Show by</option>
                                    <option>Sort by popularity</option>
                                    <option>Sort by average rating</option>
                                    <option>Sort by newness</option>
                                </select>
                            </div>
                            <div class="ht__pro__qun">
                                <span>Showing 1-12 of 1033 products</span>
                            </div>
                            <!-- Start List And Grid View -->
                            <ul class="view__mode" role="tablist">
                                <li role="presentation" class="grid-view active"><a href="#grid-view" role="tab"
                                                                                    data-toggle="tab"><i
                                            class="zmdi zmdi-grid"></i></a></li>
                                <li role="presentation" class="list-view"><a href="#list-view" role="tab"
                                                                             data-toggle="tab"><i
                                            class="zmdi zmdi-view-list"></i></a></li>
                            </ul>
                            <!-- End List And Grid View -->
                        </div>
                        <!-- Start Product View -->
                        <div class="row">
                            <div class="shop__grid__view__wrap">
                                <div role="tabpanel" id="grid-view"
                                     class="single-grid-view tab-pane fade in active clearfix">
                                    <!-- Start Single Product -->
                                    <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                                        @foreach($products as $product)
                                            <div class="category">
                                                <div class="ht__cat__thumb">
                                                    <a href="{{url("product-detail",["id"=>$product->id])}}">
                                                        <img src="{{$product->getImage()}}" alt="product images">
                                                    </a>
                                                </div>
                                                <div class="fr__hover__info">
                                                    <ul class="product__action">
                                                        <li><a href="wishlist.html"><i class="icon-heart icons"></i></a>
                                                        </li>

                                                        <li>
                                                            <a href="{{url("products/add-to-cart",["id"=>$product->id])}}"><i
                                                                    class="icon-handbag icons"></i></a>
                                                        </li>

                                                        <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="fr__product__inner">
                                                    <h4>
                                                        <a href="{{url("product-detail",["id"=>$product->id])}}">{{$product->name}}</a>
                                                    </h4>
                                                    <ul class="fr__pro__prize">
                                                        @if($product->promotion_price > 0)
                                                            <li class="old__prize">
                                                                ${{number_format($product->unit_price)}}</li>
                                                            <li>${{number_format($product->promotion_price)}}</li>
                                                        @else
                                                            <li>${{number_format($product->unit_price)}}</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- End Single Product -->
                                </div>
{{--                                <div role="tabpanel" id="list-view" class="single-grid-view tab-pane fade clearfix">--}}
{{--                                    <div class="col-xs-12">--}}
{{--                                        <div class="ht__list__wrap">--}}
{{--                                            <!-- Start List Product -->--}}
{{--                                            <div class="ht__list__product">--}}

{{--                                                <div class="ht__list__thumb">--}}
{{--                                                    <a href="{{url("product-detail",["id"=>$prd->id])}}"><img--}}
{{--                                                            src="{{$prd->getImage()}}" alt="product images"></a>--}}
{{--                                                </div>--}}
{{--                                                <div class="htc__list__details">--}}
{{--                                                    <h2><a href="product-details.html">{{$prd->name}}</a></h2>--}}
{{--                                                    <ul class="pro__prize">--}}
{{--                                                        <li class="old__prize">$82.5</li>--}}
{{--                                                        <li>$75.2</li>--}}
{{--                                                    </ul>--}}
{{--                                                    <ul class="rating">--}}
{{--                                                        <li><i class="icon-star icons"></i></li>--}}
{{--                                                        <li><i class="icon-star icons"></i></li>--}}
{{--                                                        <li><i class="icon-star icons"></i></li>--}}
{{--                                                        <li class="old"><i class="icon-star icons"></i></li>--}}
{{--                                                        <li class="old"><i class="icon-star icons"></i></li>--}}
{{--                                                    </ul>--}}
{{--                                                    <p>{{$prd->name}}</p>--}}
{{--                                                    <div class="fr__list__btn">--}}
{{--                                                        <a class="fr__btn"--}}
{{--                                                           href="{{url("products/add-to-cart",["id"=>$prd->id])}}">Add--}}
{{--                                                            To Cart</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <!-- End List Product -->--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <!-- End Product View -->
                    </div>
                    <!-- Start Pagenation -->
                    <div class="row">
                        <div class="col-xs-12">
                            <ul class="htc__pagenation">
                                <li><a href="#"><i class="zmdi zmdi-chevron-left"></i></a></li>
                                <li><a href="#">1</a></li>
                                <li class="active"><a href="#">3</a></li>
                                <li><a href="#">19</a></li>
                                <li><a href="#"><i class="zmdi zmdi-chevron-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Pagenation -->
                </div>
                <div class="col-lg-3 col-lg-pull-9 col-md-3 col-md-pull-9 col-sm-12 col-xs-12 smt-40 xmt-40">
                    <div class="htc__product__leftsidebar">
                        <!-- Start Prize Range -->
                        <div class="htc-grid-range">
                            <h4 class="title__line--4">Price</h4>
                            <div class="content-shopby">
                                <div class="price_filter s-filter clear">
                                    <form action="#" method="GET">
                                        <div id="slider-range"
                                             class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                            <div class="ui-slider-range ui-widget-header ui-corner-all"
                                                 style="left: 20.4082%; width: 59.1837%;"></div>
                                            <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"
                                                  style="left: 20.4082%;"></span><span
                                                class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"
                                                style="left: 79.5918%;"></span></div>
                                        <div class="slider__range--output">
                                            <div class="price__output--wrap">
                                                <div class="price--output">
                                                    <span>Price :</span><input type="text" id="amount" readonly="">
                                                </div>
                                                <div class="price--filter">
                                                    <a href="#">Filter</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Prize Range -->
                        <!-- Start Category Area -->
                        <div class="htc__category">
                            <h4 class="title__line--4">categories</h4>
                            <ul class="ht__cat__list">
                                @foreach($categories as $cate)
                                <li><a href="#">{{$cate->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End Category Area -->
                        <!-- Start Pro Size -->
                        <div class="ht__pro__size">
                            <h4 class="title__line--4">Size</h4>
                            <ul class="ht__size__list">
                                <li><a href="#">xs</a></li>
                                <li><a href="#">s</a></li>
                                <li><a href="#">m</a></li>
                                <li><a href="#">l</a></li>
                                <li><a href="#">xl</a></li>
                            </ul>
                        </div>
                        <!-- End Pro Size -->

                        <!-- Start Best Sell Area -->
                        <div class="htc__recent__product">
                            <h2 class="title__line--4">best seller</h2>
                            <div class="htc__recent__product__inner">
                                <!-- Start Single Product -->
                                <div class="htc__best__product">
                                    @foreach($product1 as $prd)
                                        <div class="htc__best__pro__thumb">
                                            <a href="{{url("product-detail",["id"=>$prd->id])}}">
                                                <img src="{{$prd->getImage()}}" alt="small product">
                                            </a>
                                        </div>
                                        <div class="htc__best__product__details">
                                            <h2><a href="{{url("product-detail",["id"=>$prd->id])}}">{{$prd->name}}</a></h2>
                                            <ul class="rating">
                                                <li><i class="icon-star icons"></i></li>
                                                <li><i class="icon-star icons"></i></li>
                                                <li><i class="icon-star icons"></i></li>
                                                <li class="old"><i class="icon-star icons"></i></li>
                                                <li class="old"><i class="icon-star icons"></i></li>
                                            </ul>
                                            <ul class="pro__prize">
                                                @if($prd->promotion_price > 0)
                                                    <li class="old__prize">${{number_format($prd->unit_price)}}</li>
                                                    <li>${{number_format($prd->promotion_price)}}</li>
                                                @else
                                                    <li>${{number_format($prd->unit_price)}}</li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- End Single Product -->
                            </div>
                        </div>
                        <!-- End Best Sell Area -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
