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
                                        <div class="cr__btn">
                                            <a href="{{url("/shop")}}">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-5 col-xs-12 col-md-5">
                                <div class="slide__thumb">
                                    <img src="{{$slide->slideImage()}}" alt="slider images">
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
                <div class="col-xs-12">
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
                                    <div class="ht__cat__thumb">
                                        <a href="{{url("product-detail",["id"=>$product->id])}}">
                                            <img src="{{$product->getImage()}}" alt="">
                                        </a>
                                    </div>
                                    <div class="fr__hover__info">
                                        <ul class="product__action">
                                            <li><a href="{{url("products/add-to-wish",["id"=>$product->id])}}"><i class="icon-heart icons"></i></a></li>

                                            <li><a href="{{url("products/add-to-cart",["id"=>$product->id])}}"><i class="icon-handbag icons"></i></a></li>

                                            <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="fr__product__inner">
                                        <h4 style="height: 60px"><a href="{{url("product-detail",["id"=>$product->id])}}">{{$product->name}}</a></h4>
                                        <ul class="fr__pro__prize">
                                            @if($product->promotion_price > 0)
                                                <li class="old__prize"><strike>{{number_format($product->unit_price)}} VND</strike></li>
                                                <li>{{number_format($product->promotion_price)}} VND</li>
                                            @else
                                                <li>{{number_format($product->unit_price)}} VND</li>
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
                            <span>{{$new->content}}</span>
                            <a class="fr__btn" href="{{url("/blogs")}}">Read More</a>
                        </div>

                </div>
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                    <div class="prize__inner">
                        <div class="prize__thumb">
                            <img src="{{$new->getNewImage()}}" alt="banner images">
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
                        <h2 class="title__line">Best Seller</h2>
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
                                        <img src="{{$prd->getImage()}}" alt="">
                                    </a>
                                </div>
                                <div class="fr__hover__info">
                                    <ul class="product__action">
                                        <li><a href="{{url("products/add-to-wish",["id"=>$prd->id])}}"><i class="icon-heart icons"></i></a></li>

                                        <li><a href="{{url("products/add-to-cart",["id"=>$prd->id])}}"><i class="icon-handbag icons"></i></a></li>

                                        <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                                    </ul>
                                </div>
                                <div class="fr__product__inner">
                                    <h4 style="height: 60px"><a href="{{url("product-detail",["id"=>$prd->id])}}">{{$prd->name}}</a></h4>
                                    <ul class="fr__pro__prize">
                                        @if($prd->promotion_price > 0)
                                            <li class="old__prize"><strike>{{number_format($prd->unit_price)}} VND</strike></li>
                                            <li>{{number_format($prd->promotion_price)}} VND</li>
                                        @else
                                            <li>{{number_format($prd->unit_price)}} VND</li>
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
    <section class="htc__testimonial__area bg__cat--4">
        <div class="container">
            <div class="row">
                <div class="ht__testimonial__activation clearfix">
                    @foreach($comments as $comment)
                        @if($comment->status == 1)
                            <div class="col-lg-6 col-md-6 single__tes">
                                <div class="testimonial">
                                    <div class="testimonial__thumb">
                                        <img src="{{asset("upload/defaul.jpg")}}" style="width: 100px;" alt="testimonial images">
                                    </div>
                                    <div class="testimonial__details">
                                        <h4><span>{{$comment->user->name}}</span></h4>
                                        <p>{{$comment->content}}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="htc__blog__area bg__white ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section__title--2 text-center">
                        <h2 class="title__line">Our Blog</h2>
                        <p>You will get to know the origin of our great products!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="ht__blog__wrap clearfix">
                    @foreach($blogs as $blog)
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <div class="blog">
                                <div class="blog__thumb">
                                    <a href="">
                                        <img src="{{$blog->blogImage()}}" alt="blog images" style="height: 350px">
                                    </a>
                                </div>
                                <div class="blog__details">
                                    <div class="bl__date">
                                        <span>{{$blog->date}}</span>
                                    </div>
                                    <h2><a href="#">{{$blog->title}}</a></h2>
                                    <span class="textFlow">{{$blog->content}}</span>
                                    <div class="blog__btn">
                                        <a href="{{url("blogs-detail",["id"=>$blog->id])}}">Read More</a>
                                    </div>
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
                                <li><img src="{{$brand->brandImage()}}" alt="brand images" style="padding: 40px;width: 250px;height: 230px"></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
