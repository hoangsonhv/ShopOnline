@extends("web.layout")
@section("main")
    <div class="ht__bradcaump__area" style="background-color: whitesmoke;margin-bottom: 60px">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner">
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{url("/")}}">Home</a>
                                <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                <span class="breadcrumb-item active">Shopping Cart</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <p style="color: black;text-align: center">Please check for updates before checkout!!</p>
        <hr>
    </div>
    <div class="cart-main-area ptb--100 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Name</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total = 0;$checkout=0;
                            @endphp
                            @foreach($cart as $crt)
                                @if($crt->promotion_price > 0)
                                    @php
                                        $total += $crt->__get("promotion_price") * $crt->cart_qty;
                                    @endphp
                                @else
                                    @php
                                        $total += $crt->__get("unit_price") * $crt->cart_qty;
                                    @endphp
                                @endif

                                <tr>
                                    <td class="product-thumbnail"><a href="{{url("product-detail",["id"=>$crt->id])}}"><img src="{{$crt->getImage()}}" alt="product img"></a></td>
                                    <td class="product-name">
                                        <span style="font-size: 18px;color:black;font-weight: 600;font-family: 'Poppins', sans-serif;">{{$crt->name}}</span>
                                        @if($crt->qty < $crt->cart_qty)
                                            <p class="text-danger"><i>Sản phẩm đã hết vui lòng đặt hàng</i></p>
                                            @php $checkout++ @endphp
                                        @endif
                                    </td>
                                    <td class="product-price">
                                        @if($crt->promotion_price > 0)
                                            <span class="amount">{{number_format($crt['promotion_price'])}} VND</span>
                                        @else
                                            <span class="amount">{{number_format($crt['unit_price'])}} VND</span>
                                        @endif
                                    </td>
                                    <td class="product-quantity">
                                        <form action="{{url("update-cart",["id"=>$crt->id])}}" method="get">
                                            <input type="number" min="1"  name="cart_qty" value="{{$crt->cart_qty}}">
                                            <button type="submit" class="btn btn-success" style="width: 60px;height: 40px;padding: 0;margin-bottom: 2px">Update</button>
                                        </form>
                                    </td>
                                    <td class="product-subtotal itotal" >
                                        @if($crt->promotion_price > 0)
                                            {{ number_format($crt['promotion_price'] * $crt['cart_qty']) }} VND
                                        @else
                                            {{ number_format($crt['unit_price'] * $crt['cart_qty']) }} VND
                                        @endif
                                    </td>
                                    <td class="product-remove"><a href="{{url("delete-cart",["id"=>$crt->id])}}"><i class="far fa-trash-alt"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="buttons-cart--inner ">
                                <div class="buttons-cart col-md-7" style="padding: 0">
                                    <a href="{{url("/")}}">Continue Shopping</a>
                                </div>
                                <div class="col-md-5" style="float: right;padding-right: 0">
                                    <div class="htc__cart__total" >
                                        <h6>cart total</h6>
                                        <div class="cart__total">
                                            @if(session()->has("cart")?session()->get("cart"):null) @endif
                                            <span> total qty</span>
                                            <span>{{count($cart)}}</span>
                                        </div>
                                        <div class="cart__total">
                                            <span>total money</span>
                                            <span>{{number_format($total)}} VND</span>
                                        </div>
                                        @if($checkout == 0)
                                            <ul class="payment__btn">
                                                <li><a href="{{url("checkout")}}">Check out</a></li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
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
