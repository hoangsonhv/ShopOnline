@extends("web.layout")
@section("main")
    <div class="ht__bradcaump__area" style="background-color: whitesmoke;margin-bottom: 100px">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner">
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{url("/")}}">Home</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                <span class="breadcrumb-item" >
                                    @foreach($products as $p)
                                        {{$p->category->name}}
                                    @endforeach
                                </span>
                                <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                <span class="breadcrumb-item active">Products Detail</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="htc__product__details__top">
        <div class="container">
            <div class="row">
                @foreach($products as $pro)
                    <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                        <div class="htc__product__details__tab__content">
                            <!-- Start Product Big Images -->
                            <div class="product__big__images">
                                <div class="portfolio-full-image tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                        <img src="{{$pro->getImage()}}" alt="full-image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                        <div class="ht__product__dtl" style="padding-left: 50px">
                            <h2>{{$pro->name}}</h2>
                            <h6>Brand: <span>{{$pro->brand->name}}</span></h6>
                            <ul class="pro__prize">
                                @if($pro->promotion_price > 0)
                                    <li class="old__prize">${{number_format($pro->unit_price)}}</li>
                                    <li>${{number_format($pro->promotion_price)}}</li>
                                @else
                                    <li>${{number_format($pro->unit_price)}}</li>
                                @endif
                            </ul>
                            <p class="pro__info">{{$pro->description}}</p>
                            <div class="ht__pro__desc">
                                <div class="sin__desc">
                                    <p><span>Availability:</span>
                                        @if($pro->qty > 0)
                                            <span style="color: #1cc88a">In Stock</span>
                                        @else
                                            <span>Out Of Stock</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="sin__desc align--left">
                                    <p><span>Color: {{$pro->color}}</span></p>
                                </div>

                                <div class="sin__desc align--left">
                                    <p><span>Categories:</span></p>
                                    <ul class="pro__cat__list">
                                        <p style="color: deeppink">{{$pro->category->name}}</p>
                                    </ul>
                                </div>
                                <div class="sin__desc product__share__link">
                                    <p><span>Share this:</span></p>
                                    <ul class="pro__share">
                                        <li><a href="{{url("https://twitter.com/login?lang=en")}}" target="_blank"><i class="icon-social-twitter icons"></i></a></li>

                                        <li><a href="{{url("https://www.instagram.com/accounts/login/")}}" target="_blank"><i class="icon-social-instagram icons"></i></a></li>

                                        <li><a href="{{url("https://facebook.com/login")}}" target="_blank"><i class="icon-social-facebook icons"></i></a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <section class="htc__produc__decription bg__white">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <!-- Start List And Grid View -->
                    <ul class="pro__details__tab" role="tablist">
                        <li role="presentation" class="description active"><a href="#description" role="tab" data-toggle="tab">description</a></li>
                        <li role="presentation" class="review"><a href="#review" role="tab" data-toggle="tab">review</a></li>
                    </ul>
                    <!-- End List And Grid View -->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="ht__pro__details__content">
                        <!-- Start Single Content -->
                        @foreach($products as $pro1)
                            <div role="tabpanel" id="description" class="pro__single__content tab-pane fade in active">
                                <div class="pro__tab__content__inner">
                                    <p>{{$pro1->description}}</p>
                                </div>
                            </div>
                            <div role="tabpanel" id="review" class="pro__single__content tab-pane fade">
                                @if(session()->has("success"))
                                    <div class="alert alert-success">
                                        {{session()->get("success")}}
                                    </div>
                                @elseif(session()->has("error"))
                                    <div class="alert alert-danger">
                                        {{session()->get("error")}}
                                    </div>
                                @endif
                                <form class="review-form" action="{{url("product-detail",["id"=>$pro1->id])}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Your comment</label>
                                        <textarea name="content" class="form-control" rows="3"></textarea>
                                    </div>
                                    <button class="round-black-btn btn">Submit Comment</button>
                                </form>
                                <div class="comment-comment" style="margin-top: 50px;border-top: 1px solid #E1E1E1">
                                    @foreach($comments as $comment)
                                        <div class="comment-1" style="margin-top: 30px">
                                            <img src="{{asset("upload/defaul.jpg")}}" style="width: 50px;float:left;margin-right: 15px" />
                                            <span>{{$comment->user->name}}</span>
                                            <span>{{formatDate($comment->created_at)}}</span>
                                            <span></span>
                                            <p>{{$comment->content}}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- End Single Content -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="htc__product__area--2 pb--100 product-details-res">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section__title--2 text-center">
                        <h2 class="title__line">New Products</h2>
                        <p>The latest products</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="product__wrap clearfix">
                    @foreach($product1 as $p)
                        <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
                            <div class="category">
                                <div class="ht__cat__thumb">
                                    <a href="{{url("product-detail",["id"=>$p->id])}}">
                                        <img src="{{$p->getImage()}}" alt="product images">
                                    </a>
                                </div>
                                <div class="fr__hover__info">
                                    <ul class="product__action">
                                        <li><a href="{{url("wishlist")}}"><i class="icon-heart icons"></i></a></li>

                                        <li><a href="{{url("products/add-to-cart",["id"=>$p->id])}}"><i class="icon-handbag icons"></i></a></li>

                                        <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                                    </ul>
                                </div>
                                <div class="fr__product__inner">
                                    <h4><a href="{{url("product-detail",["id"=>$p->id])}}">{{$p->name}}</a></h4>
                                    <ul class="fr__pro__prize">
                                        @if($p->promotion_price > 0)
                                            <li class="old__prize">${{number_format($p->unit_price)}}</li>
                                            <li>${{number_format($p->promotion_price)}}</li>
                                        @else
                                            <li>${{number_format($p->unit_price)}}</li>
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
                                <li><a href="#"><img src="{{$brand->brandImage()}}" alt="brand images" style="padding: 40px;width: 250px;height: 230px"></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
