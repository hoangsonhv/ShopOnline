<header id="htc__header" class="htc__header__area header--one">
    <!-- Start Mainmenu Area -->
    <div class="header-fixed">
        <div class="container header-limiter" style="padding: 0">
            <div class="header-limiter-1">
                <span style="border-right: 2px solid"><i class="fas fa-mobile-alt"></i> 0866666888 </span>
                <span style="margin-left: 5px"><i class="far fa-envelope"></i> artsshop@gmail.com</span>
            </div>
            <nav>
                @if(\Illuminate\Support\Facades\Auth::check())
                    <span style="margin-right: 1px">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                    <span  style="border-left: 2px solid;padding-left: 5px;"><a href="{{url("logout")}}">Logout</a></span>
                @else
                    <span  style="border-right: 2px solid;padding: 0 5px"><a href="{{url("login")}}">Login</a></span>
                    <a href="{{url("register")}}">Register</a>
                @endif
            </nav>
        </div>

    </div>
    <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
        <div class="container" style="padding: 0">
            <div class="row">
                <div class="menumenu__container clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5" style="padding: 0">
                        <div class="logo">
                            <a href="{{url("/")}}"><img src="{{asset("images/LOGO.png")}}" alt="logo images"></a>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-8 col-sm-5 col-xs-3" style="padding:0">
                        <nav class="main__menu__nav hidden-xs hidden-sm">
                            <ul class="main__menu">
                                <li class="drop"><a class="underline-right_1" href="{{url("/")}}">Home</a></li>
                                <li class="drop"><a class="underline-right_1" href="{{url("shop")}}">Shop</a>
                                <li class="drop"><a class="underline-right_1" style="cursor: pointer">Product</a>
                                    <ul class="dropdown">
                                        @foreach($cate as $c)
                                            <li class="drop"><a href="{{url("cate",$c->id)}}">{{$c->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a class="underline-right_1" href="{{url("wishlist")}}">Wishlist</a>
                                <li><a class="underline-right_1" href="{{url("contacts")}}">Contact</a></li>
                                <li><a class="underline-right_1" href="{{url("abouts")}}">About Us</a></li>

                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-3 col-lg-2 col-sm-4 col-xs-4">
                        <div class="header__right">
                            <div class="header__search search search__open">
                                <a href="#"><i class="icon-magnifier icons"></i></a>
                            </div>
                            <div class="header__account">
                                <a href="{{url("change-user")}}"><i class="icon-user icons"></i></a>

                            </div>
                            <div class="htc__shopping__cart">
                                <a class="cart__menu" href="#"><i class="icon-handbag icons"></i></a>
                                @php $cart = session()->has("cart")?session()->get("cart"):[] @endphp
                                <a href="#"><span class="htc__qua">{{count($cart)}}</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-area"></div>
        </div>
    </div>
</header>
<div class="container" style="text-align: center">
    @if(session()->has("success"))
        <div class="alert alert-success">
            {{session()->get("success")}}
        </div>
    @elseif(session()->has("error"))
        <div class="alert alert-danger">
            {{session()->get("error")}}
        </div>
    @endif
</div>
@if(session()->has("success2"))
    <script>
        Swal.fire('Không tìm thấy sản phẩm')
    </script>
@endif

<div class="body__overlay"></div>
<div class="offset__wrapper">
    <!--  Search  -->
    <div class="search__area">
        <div class="container" >
            <div class="row" >
                <div class="col-md-12" >
                    <div class="search__inner">
                        <form action="{{url("search")}}" method="GET">
                            <input placeholder="Search here... " type="text" name="search">
                            <button type="submit"></button>
                        </form>
                        <div class="search__close__btn">
                            <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Search -->
    <!--  Cart  -->
    <div class="shopping__cart">
        <div class="shopping__cart__inner">
            @if(session()->has("cart"))
                <div class="offsetmenu__close__btn">
                    <a href="#"><i class="zmdi zmdi-close"></i></a>
                </div>
                <div class="shp__cart__wrap">
                    @php
                        $total = 0;
                    @endphp
                    @foreach($cart as $item)
                        @if($item->promotion_price > 0)
                            @php
                                $total += $item->__get("promotion_price") * $item->cart_qty;
                            @endphp
                        @else
                            @php
                                $total += $item->__get("unit_price") * $item->cart_qty;
                            @endphp
                        @endif
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="{{$item->getImage()}}" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="#">Name: {{$item->name}}</a></h2>
                                <span class="quantity">Qty: {{$item->cart_qty}}</span>
                                <span class="shp__price">Price:
                                    @if($item->promotion_price > 0)
                                        {{number_format($item->promotion_price)}} VND
                                    @else
                                        {{number_format($item->unit_price)}} VND
                                    @endif
                                </span>
                            </div>
                            <div class="remove__btn">
                                <a href="{{url("delete-cart",["id"=>$item->id])}}" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <ul class="shoping__total">
                    <li class="subtotal">Subtotal:</li>
                    <li class="total__price">{{number_format($total)}} VND</li>
                </ul>
                <ul class="shopping__btn">
                    <li><a href="{{url("shopping-cart")}}">View Cart</a></li>
                    <li class="shp__checkout"><a href="{{url("checkout")}}">Checkout</a></li>
                </ul>
            @else
                <h2>Cart Is Empty !</h2>
            @endif

        </div>
    </div>
    <!-- End Cart -->
</div>
