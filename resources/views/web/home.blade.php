@extends("web.layout")
@section("main")
    <div class="slider__container slider--one bg__cat--3">
        <div class="slide__container slider__activation__wrap owl-carousel">
            <!-- Start Single Slide -->

            @foreach($slides as $slide)
                <div class="single__slide animation__style01 slider__fixed--height">
                    <div class="container">
                        <div class="row align-items__center">
                            <div class="col-md-7 col-sm-7 col-xs-12 col-lg-6">
                                <div class="slide">
                                    <div class="slider__inner">
                                        <h2>{{$slide->title}}</h2>
                                        <h1>{{$slide->content}}</h1>
                                        <a class="btn_hover" href="{{url("/shop")}}"><button class="btn-5">Shop Now</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                                <div class="slide__thumb">
                                    <img src="{{$slide->slideImage()}}" alt="slider images" style="width: 80%;padding-bottom: 101px;padding-top: 50px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Start Slider Area -->
    <!-- Start Category Area -->
    <section class="htc__category__area ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-xs-12" style=" margin-top: 50px;">
                    <div class="section__title--2 text-center">
                        <h2 class="title__line">New Products</h2>
                        <p>All our newest products</p>
                    </div>
                </div>
            </div>
            <div class="htc__product__container">
                <div class="row">

                        @foreach($products as $product)
                            <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                <div class="category">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <div class="ht__cat__thumb">
                                        <a href="{{url("product-detail",["id"=>$product->id])}}">
                                            <img src="{{$product->getImage()}}" alt="" style="object-fit: contain">
                                        </a>
                                    </div>
                                    <div class="fr__hover__info">
                                        <ul class="product__action">
                                            <li ><a  href="{{url("products/add-to-wish",["id"=>$product->id])}}"><i class="icon-heart icons"></i></a></li>
                                            <li><a href="{{url("products/add-to-cart",["id"=>$product->id])}}"><i class="icon-handbag icons"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="fr__product__inner">
                                        <h4 style="height: 60px"><a href="{{url("product-detail",["id"=>$product->id])}}">{{$product->name}}</a></h4>
                                        <ul class="fr__pro__prize" >
                                            @if($product->promotion_price > 0)
                                                <li class="old__prize" style="font-weight: 500;font-size: 12px"><strike>{{number_format($product->unit_price)}} VND</strike></li>
                                                <li style="font-weight: 600">{{number_format($product->promotion_price)}} VND</li>
                                            @else
                                                <li style="font-weight: 600">{{number_format($product->unit_price)}} VND</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- End Category Area -->
    <!-- Start Prize Good Area -->
    <section class="htc__good__sale bg__cat--3">
        <div class="container">
            <div class="row">
                @foreach($news as $new)
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">

                        <div class="fr__prize__inner">
                            <h2>{{$new->title}}</h2>
                            <h3>{{$new->content}}</h3>
                            <a class="btn_hover" href="{{url("/blogs")}}"> <button class="btn-5" >Read More</button></a>
                        </div>

                </div>
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                    <div class="prize__inner">
                        <div class="prize__thumb">
                            <img src="{{$new->getNewImage()}}" alt="banner images" style="object-fit: contain">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Prize Good Area -->
    <!-- Start Product Area -->
    <section class="ftr__product__area ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section__title--2 text-center">
                        <h2 class="title__line">Discount products</h2>
                        <p>You will know about our discounted products!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="product__wrap clearfix">
                    <!-- Start Single Category -->
                    @foreach($product1 as $prd)
                        <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                            <div class="category">
                                <div class="ht__cat__thumb">
                                    <a href="{{url("product-detail",["id"=>$prd->id])}}">
                                        <img src="{{$prd->getImage()}}" alt="" style="object-fit: contain">
                                    </a>
                                </div>
                                <div class="fr__hover__info">
                                    <ul class="product__action">
                                        <li><a href="{{url("products/add-to-wish",["id"=>$prd->id])}}"><i class="icon-heart icons"></i></a></li>

                                        <li><a href="{{url("products/add-to-cart",["id"=>$prd->id])}}"><i class="icon-handbag icons"></i></a></li>

                                    </ul>
                                </div>
                                <div class="fr__product__inner">
                                    <h4 style="height: 60px"><a href="{{url("product-detail",["id"=>$prd->id])}}">{{$prd->name}}</a></h4>

                                    <ul class="fr__pro__prize">
                                        @if($prd->promotion_price > 0)
                                            <li class="old__prize" style="font-weight: 500;font-size: 12px"><strike>{{number_format($prd->unit_price)}} VND</strike></li>
                                            <li style="font-weight: 600">{{number_format($prd->promotion_price)}} VND</li>
                                        @else
                                            <li style="font-weight: 600">{{number_format($prd->unit_price)}} VND</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End Product Area -->
    <!-- Start Testimonial Area -->
        <div class="slider__container slider--one testimonial text-center">
            <div style="position: absolute; left: 42%;">
                <div class="heading white-heading ">Testimonial</div>
            </div>
              <div class="container">
                  <div class="slide__container slider__activation__wrap owl-carousel">
                      @foreach($comments as $comment)
                          @if($comment->status == 1)
                              <div class="single__slide animation__style01 slider__fixed--height2 ">
                                  <div class="container">
                                      <div class="carousel-inner" role="listbox">
                                          <div class="carousel-item">
                                              <div class="testimonial4_slide">
                                                  <img src="{{asset("upload/200519452.jpg")}}" class="img-circle img-responsive" />
                                                  <p>{{$comment->content}}</p>
                                                  <h4>{{$comment->user->name}}</h4>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          @endif
                      @endforeach
                  </div>
              </div>
        </div>
    <section class="ftr__product__area ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section__title--2 text-center">
                        <h2 class="title__line">Most viewed products</h2>
                        <p>But I must explain to you how all this mistaken idea</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="product__wrap clearfix">
                    <!-- Start Single Category -->
                    @foreach($product1 as $prd)
                        <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                            <div class="category">
                                <div class="ht__cat__thumb">
                                    <a href="{{url("product-detail",["id"=>$prd->id])}}">
                                        <img src="{{$prd->getImage()}}" alt="" style="object-fit: contain">
                                    </a>
                                </div>
                                <div class="fr__hover__info">
                                    <ul class="product__action">
                                        <li><a href="{{url("products/add-to-wish",["id"=>$prd->id])}}"><i class="icon-heart icons"></i></a></li>

                                        <li><a href="{{url("products/add-to-cart",["id"=>$prd->id])}}"><i class="icon-handbag icons"></i></a></li>

                                    </ul>
                                </div>
                                <div class="fr__product__inner">
                                    <h4 style="height: 60px"><a href="{{url("product-detail",["id"=>$prd->id])}}">{{$prd->name}}</a></h4>

                                    <ul class="fr__pro__prize">
                                        @if($prd->promotion_price > 0)
                                            <li class="old__prize" style="font-weight: 500;font-size: 12px"><strike>{{number_format($prd->unit_price)}} VND</strike></li>
                                            <li style="font-weight: 600">{{number_format($prd->promotion_price)}} VND</li>
                                        @else
                                            <li style="font-weight: 600">{{number_format($prd->unit_price)}} VND</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <div class="htc__brand__area bg__cat--4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ht__brand__inner">
                        <ul class="brand__list owl-carousel clearfix">
                            @foreach($brands as $brand)
                                <li><img src="{{$brand->brandImage()}}" alt="brand images" style="padding: 40px;width: 250px;height: 230px;object-fit: contain"></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="htc__blog__area bg__white ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section__title--2 text-center">
                        <h2 class="title__line">Top selling products</h2>
                        <p>You will know about our most viewed products by our users!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <ul class="autoplay">
                        @foreach($product1 as $prd)
                            <li style="padding: 15px;margin-bottom: 42px;">
                                <div class="category">
                                        <div class="ht__cat__thumb">
                                            <a href="{{url("product-detail",["id"=>$prd->id])}}">
                                                <img src="{{$prd->getImage()}}" alt="" style="object-fit: contain">
                                            </a>
                                        </div>
                                        <div class="fr__hover__info">
                                            <ul class="product__action">
                                                <li><a href="{{url("products/add-to-wish",["id"=>$prd->id])}}"><i class="icon-heart icons"></i></a></li>

                                                <li><a href="{{url("products/add-to-cart",["id"=>$prd->id])}}"><i class="icon-handbag icons"></i></a></li>

                                            </ul>
                                        </div>
                                        <div class="fr__product__inner">
                                            <h4 style="height: 60px"><a href="{{url("product-detail",["id"=>$prd->id])}}">{{$prd->name}}</a></h4>

                                            <ul class="fr__pro__prize">
                                                @if($prd->promotion_price > 0)
                                                    <li class="old__prize" style="font-weight: 500;font-size: 12px"><strike>{{number_format($prd->unit_price)}} VND</strike></li>
                                                    <li style="font-weight: 600">{{number_format($prd->promotion_price)}} VND</li>
                                                @else
                                                    <li style="font-weight: 600">{{number_format($prd->unit_price)}} VND</li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="htc__brand__area bg__cat--4" style="padding: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row no-gutters">
                        <div class="col-lg-4">
                            <div class="icon_box icon_box_style1">
                                <div class="icon">
                                    <i class="fal fa-shipping-fast"></i>
                                </div>
                                <div class="icon_box_content">
                                    <h5>Free Delivery</h5>
                                    <p>If you are going to use of Lorem, you need to be sure there anything</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="icon_box icon_box_style1">
                                <div class="icon">
                                    <i class="fal fa-hand-holding-usd"></i>
                                </div>
                                <div class="icon_box_content">
                                    <h5>30 Day Return</h5>
                                    <p>If you are going to use of Lorem, you need to be sure there anything</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="icon_box icon_box_style2">
                                <div class="icon">
                                    <i class="fal fa-user-headset"></i>
                                </div>
                                <div class="icon_box_content">
                                    <h5>27/4 Support</h5>
                                    <p>If you are going to use of Lorem, you need to be sure there anything</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
