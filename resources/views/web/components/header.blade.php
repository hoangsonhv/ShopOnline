<header id="htc__header" class="htc__header__area header--one">
    <!-- Start Mainmenu Area -->
    <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
        <div class="container">
            <div class="row">
                <div class="menumenu__container clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
                        <div class="logo">
                            <a href="index.html"><img src="images/logo/4.png" alt="logo images"></a>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-8 col-sm-5 col-xs-3" style="padding:0">
                        <nav class="main__menu__nav hidden-xs hidden-sm">
                            <ul class="main__menu">
                                <li class="drop"><a href="{{url("/")}}">Home</a></li>
                                <li class="drop"><a href="{{url("gifts")}}">Gifts</a></li>
                                <li class="drop"><a href="{{url("stationeries")}}">Stationeries</a></li>
                                <li class="drop"><a href="{{url("artworks")}}">Artworks</a></li>
                                <li class="drop"><a href="{{url("beauties")}}">Beauty</a></li>
                                <li class="drop"><a href="{{url("blogs")}}">News</a>
                                    <ul class="dropdown">
                                        <li><a href="{{url("contacts")}}">Contact</a></li>
                                        <li><a href="{{url("abouts")}}">About Us</a></li>
                                        <li><a href="{{url("wishlist")}}">Wishlist</a>
                                    </ul>
                                </li>

                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-3 col-lg-2 col-sm-4 col-xs-4">
                        <div class="header__right">
                            <div class="header__search search search__open">
                                <a href="#"><i class="icon-magnifier icons"></i></a>
                            </div>
                            <div class="header__account">
                                <a href="#"><i class="icon-user icons"></i></a>
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
<div class="body__overlay"></div>
<div class="offset__wrapper">
    <!--  Search  -->
    <div class="search__area">
        <div class="container" >
            <div class="row" >
                <div class="col-md-12" >
                    <div class="search__inner">
                        <form action="{{url("search")}}" method="get">
                            <input placeholder="Search here... " type="text">
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
                        @php
                            $total += $item['unit_price'] * $item['cart_qty'];
                        @endphp
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="{{$item->getImage()}}" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="#">{{$item->name}}</a></h2>
                                <span class="quantity">{{$item->cart_qty}}</span>
                                <span class="shp__price">${{number_format($item->unit_price)}}</span>
                            </div>
                            <div class="remove__btn">
                                <a href="{{url("delete-cart",["id"=>$item->id])}}" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <ul class="shoping__total">
                    <li class="subtotal">Subtotal:</li>
                    <li class="total__price">${{number_format($total)}}</li>
                </ul>
                <ul class="shopping__btn">
                    <li><a href="{{url("shopping-cart")}}">View Cart</a></li>
                    <li class="shp__checkout"><a href="{{url("checkout")}}">Checkout</a></li>
                </ul>
            @else
                <h2>Giỏ Hàng Trống !</h2>
            @endif

        </div>
    </div>
    <!-- End Cart -->
</div>
