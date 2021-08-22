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
    <div class="htc__product__details__top" style="margin-bottom: 50px">
        <div class="container">
            <div class="row">
                @foreach($products as $pro)
                    <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                        <div class="htc__product__details__tab__content">
                            <!-- Start Product Big Images -->
                            <div class="product__big__images">
                                <div class="portfolio-full-image tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                        <img src="{{$pro->getImage()}}" alt="full-image" style="width: 100%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                        <div class="row">
                            <div class="ht__product__dtl col-md-8" style="padding-left: 50px">
                                <h2>{{$pro->name}}</h2>
                                <h6><b>Brand</b>: <b style="color: palevioletred;font-weight: 600">{{$pro->brand->name}}</b></h6>
                                <ul class="pro__prize">
                                    @if($pro->promotion_price > 0)
                                        <li class="old__prize">Old Price: <strike>{{number_format($pro->unit_price)}}
                                                VND</strike></li>
                                        <li><b>New Price</b>: {{number_format($pro->promotion_price)}} VND</li>
                                    @else
                                        <li><b>New Price</b>: {{number_format($pro->unit_price)}} VND</li>
                                    @endif
                                </ul>
                                @if($pro->information != null)
                                    <p style="color: #100d13;font-size: 16px;font-family: 'Poppins', sans-serif;"><b>Information</b>
                                        : <span>{{$pro->information}}</span></p>
                                @endif
                                @if($pro->parameter != null)
                                    <p style="color: #100d13;font-size: 16px;font-family: 'Poppins', sans-serif;"><b>Parameter </b>:
                                        <span>{{$pro->parameter}}</span></p>
                                @endif
                                <div class="ht__pro__desc">
                                    <div class="sin__desc">
                                        <p><span style="font-weight: 600">Condition:</span>
                                            @if($pro->qty > 0)
                                                <span style="color: palevioletred;font-weight: 600">In Stock</span>
                                            @else
                                                <span>Out Of Stock</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="sin__desc align--left">
                                        <p ><span style="font-weight: 600;">Color:<span style="color: palevioletred;font-weight: 600"> {{$pro->color}}</span></span></p>
                                    </div>

                                    <div class="sin__desc align--left">
                                        <p><span style="font-weight: 600">Categories:</span></p>
                                        <ul class="pro__cat__list">
                                            <p style="color: palevioletred;font-weight: 600">{{$pro->category->name}}</p>
                                        </ul>
                                    </div>
                                    <div class="sin__desc product__share__link">
                                        <a href="{{url("products/add-to-cart",["id"=>$pro->id])}}"
                                           style="font-size: 20px">
                                            <button type="submit" class="btn btn-danger2"
                                                    style="width: 170px;height: 50px"><i class="fas fa-cart-plus"></i>
                                                Add To Cart
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="border: 1px solid black;height: 100px;padding: 10px;color: black;">
                                <div class="mb-4 text-sm service text-dark-gray">
                                    <div>
                                        <div>
                                            <ul>
                                                <li>Bảo hành <strong>12 tháng tại ARTS Shop</strong></li>
                                                <li>Đổi mới trong <strong>15 ngày đầu tiên</strong></li>
                                            </ul>
                                        </div> <!----></div>
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
                                <form class="review-form" action="{{url("product-detail",["id"=>$pro1->id])}}" method="post">
                                    @csrf
{{--                                    @if(isset($user))--}}
                                    <div class="form-group">
                                        <label>Your comment</label>
                                        <textarea name="content" class="form-control" rows="3"></textarea>
                                    </div>
                                    <button class="round-black-btn btn">Comment</button>
{{--                                    @endif--}}
                                </form>
                                <div class="comment-comment" style="margin-top: 50px;border-top: 1px solid #E1E1E1">
                                    @foreach($comments as $comment)
                                        @if($comment->status == 1 )
                                        <div class="comment-1" style="margin-top: 30px">
                                            <img src="{{asset("upload/defaul.jpg")}}" style="width: 50px;float:left;margin-right: 15px" />
                                            <span style="font-size: 17px">{{$comment->user->name}} -</span>
                                            <span>{{formatDate($comment->created_at)}}</span>
                                            <span></span>
                                            <p style="color: black">{{$comment->content}}</p>
                                        </div>
                                        @else
                                            <span>No comment.</span>
                                        @endif
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
                                        <li><a href="{{url("products/add-to-wish",["id"=>$p->id])}}"><i class="icon-heart icons"></i></a></li>

                                        <li><a href="{{url("products/add-to-cart",["id"=>$p->id])}}"><i class="icon-handbag icons"></i></a></li>

                                        <li><a href="#"><i class="icon-shuffle icons"></i></a></li>
                                    </ul>
                                </div>
                                <div class="fr__product__inner">
                                    <h4 style="height: 45px"><a href="{{url("product-detail",["id"=>$p->id])}}">{{$p->name}}</a></h4>
                                    <ul class="fr__pro__prize">
                                        @if($p->promotion_price > 0)
                                            <li class="old__prize"><strike>{{number_format($p->unit_price)}} VND</strike></li>
                                            <li>{{number_format($p->promotion_price)}} VND</li>
                                        @else
                                            <li>{{number_format($p->unit_price)}} VND</li>
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
                                <li><img src="{{$brand->brandImage()}}" alt="brand images" style="padding: 40px;width: 250px;height: 230px"></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "100558045692227");
        chatbox.setAttribute("attribution", "biz_inbox");

        window.fbAsyncInit = function() {
            FB.init({
                xfbml            : true,
                version          : 'v11.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_GB/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
@endsection
