@extends("web.layout")
@section("main")
    <div class="slider__container slider--one bg__cat--3">
        <div class="slide__container slider__activation__wrap owl-carousel">
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
                                    <img src="{{$slide->slideImage()}}" alt="slider images" style="width: 80%;padding-bottom: 101px;padding-top: 50px;float: right">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <section class="htc__category__area ptb--100">
        <div class="container" style="padding: 0">
            <div class="row">
                <div class="col-xs-12" style=" margin-top: 20px;">
                    <div class="section__title--2 text-center">
                        <h2 class="title__line">New Products</h2>
                    </div>
                </div>
            </div>
            <hr>
            <div class="htc__product__container" style="padding-bottom: 20px">
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                            <div class="category">
                                <div class="ht__cat__thumb">
                                    <a href="{{url("product-detail",["id"=>$product->id])}}">
                                        <img src="{{$product->getImage()}}" alt="" style="object-fit: contain">
                                    </a>
                                    @if($product->promotion_price > 0)
                                        <div class="sale pp-sale" style="color: black">Sale {{round(($product->unit_price - $product->promotion_price) / $product->unit_price * 100,1) }} %</div>
                                    @endif
                                </div>
                                <div class="fr__hover__info">
                                    <ul class="product__action">
                                        <li ><a  href="{{url("products/add-to-wish",["id"=>$product->id])}}"><i class="icon-heart icons"></i></a></li>
                                        @if($product->qty > 0)
                                            <li><a href="{{url("products/add-to-cart",["id"=>$product->id])}}"><i class="icon-handbag icons"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="fr__product__inner">
                                    <h4 style="height: 50px"><a href="{{url("product-detail",["id"=>$product->id])}}">{{$product->name}}</a></h4>
                                    <ul style="display: flex;justify-content: center;">
                                        <li style="color: #0300e1;margin-right: 20px">Sold : {{$product->pro_pay}}</li> -
                                        @if($product->qty > 0)
                                            <li style="color: #0300e1;margin-left: 20px">Stocking</li>
                                        @else
                                            <li style="color: #ff0004;margin-left: 20px">Place Order</li>
                                        @endif
                                    </ul>
                                    <ul class="fr__pro__prize" >
                                        @if($product->promotion_price > 0)
                                            <li class="old__prize"><strike>{{number_format($product->unit_price)}} đ</strike></li>
                                            <li style="font-weight: 600">{{number_format($product->promotion_price)}} đ</li>
                                        @else
                                            <li style="font-weight: 600">{{number_format($product->unit_price)}} đ</li>
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
                                    <p>You will get free delivery up to 100% within the inner city of Hanoi./p>
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
                                    <p>All defective products will be exchanged within 15 days.</p>
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
                                    <p>Experienced staff is always ready to assist at all times. Bring you moments of comfort.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="htc__category__area ptb--100">
        <div class="container" style="padding: 0">
            <div class="row">
                <div class="col-xs-12" style=" margin-top: 20px;">
                    <div class="section__title--2 text-center">
                        <h2 class="title__line">Discount Products</h2>
                    </div>
                </div>
            </div>
            <hr>
            <div class="htc__product__container" style="padding-bottom: 20px">
                <div class="row">
                    @foreach($products1 as $prod1)
                        <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                            <div class="category">
                                <div class="ht__cat__thumb">
                                    <a href="{{url("product-detail",["id"=>$prod1->id])}}">
                                        <img src="{{$prod1->getImage()}}" alt="" style="object-fit: contain">
                                    </a>
                                    @if($prod1->promotion_price > 0)
                                        <div class="sale pp-sale" style="color: black">Sale {{round(($prod1->unit_price - $prod1->promotion_price) / $product->unit_price * 100,1) }} %</div>
                                    @endif
                                </div>
                                <div class="fr__hover__info">
                                    <ul class="product__action">
                                        <li ><a  href="{{url("products/add-to-wish",["id"=>$prod1->id])}}"><i class="icon-heart icons"></i></a></li>
                                        @if($prod1->qty > 0)
                                            <li><a href="{{url("products/add-to-cart",["id"=>$prod1->id])}}"><i class="icon-handbag icons"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="fr__product__inner">
                                    <h4 style="height: 50px"><a href="{{url("product-detail",["id"=>$prod1->id])}}">{{$prod1->name}}</a></h4>
                                    <ul style="display: flex;justify-content: center;">
                                        <li style="color: #0300e1;margin-right: 20px">Đã bán: {{$prod1->pro_pay}}</li> -
                                        @if($prod1->qty > 0)
                                            <li style="color: #0300e1;margin-left: 20px">Còn hàng</li>
                                        @else
                                            <li style="color: #ff0004;margin-left: 20px">Đặt hàng</li>
                                        @endif
                                    </ul>
                                    <ul class="fr__pro__prize" >
                                        @if($prod1->promotion_price > 0)
                                            <li class="old__prize"><strike>{{number_format($prod1->unit_price)}} đ</strike></li>
                                            <li style="font-weight: 600">{{number_format($prod1->promotion_price)}} đ</li>
                                        @else
                                            <li style="font-weight: 600">{{number_format($prod1->unit_price)}} đ</li>
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
    <div class="slider__container slider--one testimonial text-center">
        <div style="position: absolute; left: 40%;">
            <div class="heading white-heading ">Product reviews</div>
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
                                                <img src="{{asset("upload/defaul.jpg")}}" style="width: 80px;height: 80px" class="img-circle img-responsive" />
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
    <section class="htc__category__area ptb--100">
        <div class="container" style="padding: 0">
            <div class="row">
                <div class="col-xs-12" style=" margin-top: 20px;">
                    <div class="section__title--2 text-center">
                        <h2 class="title__line">Most Bought Products</h2>
                    </div>
                </div>
            </div>
            <hr>
            <div class="htc__product__container" style="padding-bottom: 20px">
                <div class="row">
                    @foreach($products2 as $prod2)
                        <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                            <div class="category">
                                <div class="ht__cat__thumb">
                                    <a href="{{url("product-detail",["id"=>$prod2->id])}}">
                                        <img src="{{$prod2->getImage()}}" alt="" style="object-fit: contain">
                                    </a>
                                    @if($prod2->promotion_price > 0)
                                        <div class="sale pp-sale" style="color: black">Sale {{round(($prod2->unit_price - $prod2->promotion_price) / $product->unit_price * 100,1) }} %</div>
                                    @endif
                                </div>
                                <div class="fr__hover__info">
                                    <ul class="product__action">
                                        <li ><a  href="{{url("products/add-to-wish",["id"=>$prod2->id])}}"><i class="icon-heart icons"></i></a></li>
                                        @if($prod2->qty > 0)
                                            <li><a href="{{url("products/add-to-cart",["id"=>$prod2->id])}}"><i class="icon-handbag icons"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="fr__product__inner">
                                    <h4 style="height: 50px"><a href="{{url("product-detail",["id"=>$prod2->id])}}">{{$prod2->name}}</a></h4>
                                    <ul style="display: flex;justify-content: center;">
                                        <li style="color: #0300e1;margin-right: 20px">Đã bán: {{$prod2->pro_pay}}</li> -
                                        @if($prod2->qty > 0)
                                            <li style="color: #0300e1;margin-left: 20px">Còn hàng</li>
                                        @else
                                            <li style="color: #ff0004;margin-left: 20px">Đặt hàng</li>
                                        @endif
                                    </ul>
                                    <ul class="fr__pro__prize" >
                                        @if($prod2->promotion_price > 0)
                                            <li class="old__prize"><strike>{{number_format($prod2->unit_price)}} đ</strike></li>
                                            <li style="font-weight: 600">{{number_format($prod2->promotion_price)}} đ</li>
                                        @else
                                            <li style="font-weight: 600">{{number_format($prod2->unit_price)}} đ</li>
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
                        <h2 class="title__line">Most Viewed Products</h2>
                        <p>List of products most viewed by customers!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <ul class="autoplay">
                        @foreach($products3 as $prd)
                            <li style="padding: 15px;margin-bottom: 42px;">
                                <div class="category">
                                    <div class="ht__cat__thumb">
                                        <a href="{{url("product-detail",["id"=>$prd->id])}}">
                                            <img src="{{$prd->getImage()}}" alt="" style="object-fit: contain">
                                        </a>
                                        @if($prd->promotion_price > 0)
                                            <div class="sale pp-sale" style="color: black">Sale {{round(($prd->unit_price - $prd->promotion_price) / $product->unit_price * 100,1) }} %</div>
                                        @endif
                                    </div>
                                    <div class="fr__hover__info">
                                        <ul class="product__action">
                                            <li ><a  href="{{url("products/add-to-wish",["id"=>$prd->id])}}"><i class="icon-heart icons"></i></a></li>
                                            @if($prd->qty > 0)
                                                <li><a href="{{url("products/add-to-cart",["id"=>$prd->id])}}"><i class="icon-handbag icons"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="fr__product__inner">
                                        <h4 style="height: 50px"><a href="{{url("product-detail",["id"=>$prd->id])}}">{{$prd->name}}</a></h4>
                                        <ul style="display: flex;justify-content: center;">
                                            <li style="color: #0300e1;margin-right: 20px">Đã bán: {{$prd->pro_pay}}</li> -
                                            @if($prd->qty > 0)
                                                <li style="color: #0300e1;margin-left: 20px">Còn hàng</li>
                                            @else
                                                <li style="color: #ff0004;margin-left: 20px">Đặt hàng</li>
                                            @endif
                                        </ul>
                                        <ul class="fr__pro__prize" >
                                            @if($prd->promotion_price > 0)
                                                <li class="old__prize"><strike>{{number_format($prd->unit_price)}} đ</strike></li>
                                                <li style="font-weight: 600">{{number_format($prd->promotion_price)}} đ</li>
                                            @else
                                                <li style="font-weight: 600">{{number_format($prd->unit_price)}} đ</li>
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
@endsection
