
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
                                <div id="rateYo" style="padding: 8px"></div>
                                <form action="{{url("rating")}}" method="post" id="formRating">
                                    @csrf
                                    <div>
                                        <label>
                                            <input  name="rating_star" id="rating_star">
                                            <input  name="product_id" id="rating_star" value="{{$pro->id}}">
                                            <input  name="user_id" id="rating_star" value="{{\Illuminate\Support\Facades\Auth::id()}}">
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
                                    <div class="sin__desc product__share__link">
                                        @if($pro->qty > 0)
                                            <a class="btn_hover" href="{{url("products/add-to-cart",["id"=>$pro->id])}}" style="font-size: 20px">
                                                <button type="submit" class="btn-5"><i style="font-size: 20px" class="fas fa-cart-plus"></i><span style="font-size: 18px;margin-left: 10px">Add To Cart</span></button>
                                            </a>
                                        @else
                                            <a href="{{url("orders",["id"=>$pro->id])}}" style="font-size: 20px">
                                                <button type="submit" class="btn btn-danger2" style="width: 170px;height: 50px"><i style="font-size: 20px" class="fas fa-cart-plus"></i><span style="font-size: 18px;margin-left: 10px">Order Now</span></button>
                                            </a>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4" style="border: 1px solid black;padding: 10px;color: black;text-align: center">
                                <div class="mb-4 text-sm service text-dark-gray" >
                                    <div>
                                        <div>
                                            <ul>
                                                <li>Bảo hành <strong>12 tháng</strong></li>
                                                <li>tại <strong>ARTS Shop</strong></li>
                                                <li style="padding-left: 5px">Đổi mới trong <strong>15 ngày đầu tiên</strong></li>
                                            </ul>
                                        </div> <!----></div>
                                </div>
                            </div>
                            <div class="col-md-4" style="border: 1px solid black;padding: 10px;color: black;text-align: center;margin-top: 40px">
                                <div class="mb-4 text-sm service text-dark-gray" >
                                    <div>
                                        <div>
                                            <ul>
                                                <li><strong>SẢN PHẨM CÓ TẠI</strong></li>
                                                <li>8 Tôn Thất Thuyết</li>
                                                <li>129 Lạc Long Quân</li>
                                                <li>139 Nguyễn Văn Cừ</li>
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
                                                <img src="{{asset("upload/defaul.jpg")}}"
                                                     style="width: 50px;float:left;margin-right: 15px"/>
                                                <span style="font-size: 17px">{{$comment->user->name}}</span>
                                                <span>{{formatDate($comment->created_at)}}</span>
                                                <span></span>
                                                <p style="color: black">{{$comment->content}}</p>
                                                <form method="post" action="{{url("reply-comments",["id"=>$comment->id])}}" style="margin-left: 60px">
                                                    @csrf
                                                    <button class="form-group" type="button" id="demo2" onclick="myFunction({{$comment->id}})" style="background-color: white;color: #000000;border: none;display: flex;margin-top: 10px">
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
                                                            <input style="position: absolute;left: 789px;border: none;padding-top: 7px;" id="demo3" type="submit" class="btn btn-warning"
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
                                                        <img src="{{asset("upload/defaul.jpg")}}"
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

