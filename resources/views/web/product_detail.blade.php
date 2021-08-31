@extends("web.layout")
@section("detail")
    <script>
        $(function () {
            let ratingAvg = '{{$ratingAvg}}'
            if (!ratingAvg){
                ratingAvg = 0;
                $("#rateYo").rateYo({
                    rating: ratingAvg,
                    starWidth: "18px"
                }).on("rateyo.set", function (e, data) {
                    $('#rating_star').val(data.rating);
                    $('#formRating').submit();
                })
            }else{
                $("#rateYo").rateYo({
                    rating: ratingAvg,
                    starWidth: "18px"
                }).on("rateyo.set", function (e, data) {
                    $('#rating_star').val(data.rating);
                    $('#formRating').submit();
                })
            }
        });
    </script>
@stop
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

                                <form action="{{url("rating")}}" method="post" id="formRating">
                                    @csrf
                                    <div id="rateYo" style="padding: 8px"></div>
                                    <div hidden>
                                        <label>
                                            <input hidden name="rating_star" id="rating_star">
                                            <input hidden name="product_id" id="rating_star" value="{{$pro->id}}">
                                            <input hidden name="user_id" id="rating_star" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                                        </label>
                                    </div>
                                </form>
                                <h6><b>Brand</b>: <b style="color: palevioletred;font-weight: 600">{{$pro->brand->name}}</b></h6>
                                <ul class="pro__prize">
                                    @if($pro->promotion_price > 0)
                                        <li class="old__prize">Old Price: <strike>{{number_format($pro->unit_price)}}
                                                VND</strike></li>
                                        <li><b>New Price</b>: <span style="color: palevioletred;font-weight: 600">{{number_format($pro->promotion_price)}} VND</span> </li>
                                    @else
                                        <li><b>New Price</b>: <span style="color: palevioletred;font-weight: 600;font-size: 15px">{{number_format($pro->unit_price)}} VND</span> </li>
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
                                    <div class="sin__desc align--left">
                                        <p ><span style="font-weight: 600;">Sold:<span style="color: palevioletred;font-weight: 600"> {{$pro->pro_pay}}</span></span></p>
                                    </div>
                                    <div class="sin__desc product__share__link">
                                        @if($pro->qty > 0)
                                            <a class="btn_hover_2" href="{{url("products/add-to-cart",["id"=>$pro->id])}}" style="font-size: 20px">
                                                <button type="submit" class="btn-5"><i style="font-size: 20px" class="fas fa-cart-plus"></i><span style="font-size: 18px;margin-left: 10px">Add To Cart</span></button>
                                            </a>
                                        @else
                                            <a href="{{url("orders",["id"=>$pro->id])}}" style="font-size: 20px">
                                                <button type="submit" class="btn btn-danger2" style="width: 170px;height: 50px"><i style="font-size: 20px" class="fas fa-cart-plus"></i><span style="font-size: 18px;margin-left: 10px">Place Order</span></button>
                                            </a>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4" style="border: 1px solid black;padding:30px 20px 0 20px;color: black">
                                <div class="mb-4 text-sm service text-dark-gray" >
                                    <ul style="color: #DB7093">
                                        <li style="height: 60px">
                                            <i class="fal fa-shipping-fast" style="font-size: 30px;float:left;width:20%;color: black;margin-bottom: 20px"></i>
                                            <div style="width: 80%;float: right"><span style="float: left;padding-left: 10px"> <strong>Free ship Hanoi Inside</strong></span></div>
                                        </li>
                                        <li style="height: 60px">
                                            <i class="fal fa-tools" style="font-size: 30px;float:left;width:20%;color: black;margin-bottom: 20px"></i>
                                            <div style="width: 80%;float: right"><span style="float: left;padding-left: 10px">  <strong>Insurance 12 Month</strong></span></div>
                                        </li>
                                        <li style="height: 60px">
                                            <i class="fal fa-map-marker-alt" style="font-size: 30px;float:left;width:20%;color: black;margin-bottom: 20px"></i>
                                            <div style="width: 80%;float: right"><span style="float: left;padding-left: 10px"><strong>8 Ton That Thuyet</strong></span></div>
                                        </li>
                                        <li style="height: 60px">
                                            <i class="fal fa-headset" style="font-size: 30px;float:left;width:20%;color: black;margin-bottom: 20px"></i>
                                            <div style="width: 80%;float: right"><span style="float: left;padding-left: 10px"><strong>Quick reply</strong></span></div>
                                        </li>
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
                                <form class="review-form" action="{{url("product-detail",["id"=>$pro1->id])}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Your comment</label>
                                        <textarea name="content" class="form-control" rows="3" required></textarea>
                                    </div>
                                    <button class="round-black-btn btn" style="background-color:#f0ad4e;color: white">Send</button>
                                </form>
                                <div class="comment-comment" style="margin-top: 50px;border-top: 1px solid #E1E1E1">
                                    @foreach($comments as $comment)
                                        @if($comment->status == 1 )
                                            <div class="comment-1" style="margin-top: 30px">
                                                <img src="{{asset("upload/default.jpg")}}"
                                                     style="width: 50px;float:left;margin-right: 15px"/>
                                                <span style="font-size: 17px">{{$comment->user->name}}</span>
                                                <span>{{formatDate($comment->created_at)}}</span>
                                                <span></span>
                                                <p style="color: black">{{$comment->content}}</p>
                                                <form method="post" action="{{url("reply-comments",["id"=>$comment->id])}}" style="margin-left: 60px">
                                                    @csrf
                                                    <button class="form-group" type="button"  onclick="myFunction({{$comment->id}})" style="background-color: white;color: #000000;border: none;display: flex;margin-top: 10px">
{{--                                                        <input style="padding: 10px 24px;" id="demo2" onclick="myFunction({{$comment->id}})"--}}
{{--                                                               type="button" class="btn btn-warning" value="Reply"/>--}}
                                                        <span><box-icon name='message-dots' animation='tada' color='#000000' ></box-icon></span>
                                                        <span style="margin-left: 6px">Reply</span>
                                                    </button>
                                                    <div class="form-group" style="margin-left: 23px">
                                                        <div id="demo{{$comment->id}}" class="row" style="display: none;margin-top: -15px">
                                                            <input  type="text" name="content"
                                                                    class="form-control col-md-10"
                                                                    style="width: 700px;"
                                                                    required/>
                                                            <input style="position: absolute;left: 789px;border: none;padding-top: 7px;"  type="submit" class="btn btn-warning"
                                                                   value="Send"/>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            @php
                                                $id_cm = $comment->id;
                                                $reply_comments  = \App\Models\ReplyComment::with("comment")->where("id_comments",$id_cm)->get();
                                            @endphp
                                            @if($reply_comments != null)
                                                @foreach($reply_comments as $reply)
                                                    <div class="comment-1" style="padding-left: 65px;margin-top: 15px">
                                                        <img src="{{asset("upload/default.jpg")}}"
                                                             style="width: 50px;float:left;margin-right: 15px"/>
                                                        <span style="font-size: 17px">{{$reply->user->name}} -</span>
                                                        <span>{{formatDate($reply->created_at)}}</span>
                                                        <span></span>
                                                        <p style="color: black;">{{$reply->content}}</p>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @elseif($comment == null)
                                            <span>No comment.</span>
                                            @break;
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
                                        <img src="{{$p->getImage()}}" alt="" style="object-fit: contain">
                                    </a>
                                    @if($p->promotion_price > 0)
                                        <div class="sale pp-sale" style="color: black">Sale {{round(($p->unit_price - $p->promotion_price) / $p->unit_price * 100,1) }} %</div>
                                    @endif
                                </div>
                                <div class="fr__hover__info">
                                    <ul class="product__action">
                                        <li ><a  href="{{url("products/add-to-wish",["id"=>$p->id])}}"><i class="icon-heart icons"></i></a></li>
                                        @if($p->qty > 0)
                                            <li><a href="{{url("products/add-to-cart",["id"=>$p->id])}}"><i class="icon-handbag icons"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="fr__product__inner">
                                    <h4 style="height: 50px"><a href="{{url("product-detail",["id"=>$p->id])}}">{{$p->name}}</a></h4>
                                    <ul style="display: flex;justify-content: center;">
                                        <li style="color: #0300e1;margin-right: 20px">Sold : {{$p->pro_pay}}</li> -
                                        @if($p->qty > 0)
                                            <li style="color: #0300e1;margin-left: 20px">Stocking</li>
                                        @else
                                            <li style="color: #ff0004;margin-left: 20px">Place Order</li>
                                        @endif
                                    </ul>
                                    <ul class="fr__pro__prize" >
                                        @if($p->promotion_price > 0)
                                            <li class="old__prize"><strike>{{number_format($p->unit_price)}} đ</strike></li>
                                            <li style="font-weight: 600">{{number_format($p->promotion_price)}} đ</li>
                                        @else
                                            <li style="font-weight: 600">{{number_format($p->unit_price)}} đ</li>
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

@endsection

