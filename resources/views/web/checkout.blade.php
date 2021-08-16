
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
                                <span class="breadcrumb-item active">Check Out</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(count($cart) != null)
        <div class="container">
            <p style="color: black;text-align: center;font-size: 18px">Please enter full information!</p>
            <hr>
        </div>
    @endif
    <div class="checkout-wrap ptb--100" style="margin-bottom: 50px">
        <div class="container">
            <form id="Form" action="{{url("checkout")}}" method="post">
                @csrf
                <div class="row">
                    @if(count($cart) != null)
                        <div class="col-md-8 ">
                            <div class="border_shipping">
                                <div class="checkout__inner">
                                    <div class="accordion-list">
                                        <div class="accordion">
                                            <div class="shipinfo">
                                                <h3 class="shipinfo__title">Shipping Address</h3>
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="single-input">
                                                                <input type="text" id="name1" placeholder="Full Name" form="Form"  name="name" required>
                                                                <input type="text" placeholder="Full Name" form="Form1" value="name1" hidden name="name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="single-input">
                                                                <input type="email" placeholder="Email Address" name="email" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="single-input">
                                                                <input type="text" placeholder="Street Address" name="address" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="single-input">
                                                                <input type="text" placeholder="Phone Number" name="phone_number" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="single-input">
                                                                <select name="gender">
                                                                    <option value="0">Nam</option>
                                                                    <option value="1">Nữ</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border_shipping">
                                <div class="checkout__inner">
                                    <div class="accordion-list">
                                        <div class="accordion">
                                            <div class="shipinfo">
                                                <h3 class="shipinfo__title">Payment</h3>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check" style="margin-bottom: 10px">
                                                            <input class="form-check-input"  type="radio" value=1" name="payment" id="flexRadioDefault1">
                                                            <label data-toggle="collapse" class="form-check-label" style="cursor: pointer" href="#footwear" for="flexRadioDefault1"> Thanh toán khi nhận hàng</label>
                                                            <div class="collapse" id="footwear" style="margin-left: 17px">
                                                                <span>Khi nhận hàng quý khách vui lòng thanh toán đầy đủ tiền cho người giao hàng!</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check" style="margin-bottom: 10px">
                                                            <input class="form-check-input" type="radio" value="2" name="payment" id="flexRadioDefault2" >
                                                            <label data-toggle="collapse"style="cursor: pointer"  href="#footwear1" for="flexRadioDefault2"> Thanh toán bằng thẻ ATM</label>
                                                            <div class="collapse" id="footwear1" style="margin-left: 17px">
                                                                <span>Quý khách vui lòng chuyển khoản đến số tài khoản sau:</span><br>
                                                                <span>STK Vietcombank: 0351000920992</span><br>
                                                                <span>Tên chủ tài khoản: Hoàng văn sơn</span><br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="order-details" style="margin-bottom: 20px">
                                <h5 class="order-details__title">Your Order</h5>
                                <div class="order-details__item">
                                    @php $total = 0;$checkout=0; @endphp
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
                                        <div class="single-item">
                                            <div class="single-item__thumb">
                                                <img src="{{$item->getImage()}}" alt="ordered item">
                                            </div>
                                            <div class="single-item__content">
                                                <a href="{{url("product-detail",["id"=>$item->id])}}" style="font-size: 10px">{{$item->name}}</a>
                                                <span class="quantity">Qty: {{$item->cart_qty}}</span>
                                                <span class="price">
                                                    @if($item->promotion_price > 0)
                                                        <span class="amount">Price: {{number_format($item['promotion_price'])}} VND</span>
                                                    @else
                                                        <span class="amount">{Price: {number_format($item['unit_price'])}} VND</span>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="single-item__remove">
                                                <a href="{{url("delete-cart",["id"=>$item->id])}}"><i class="zmdi zmdi-delete"></i></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="ordre-details__total">
                                    <h5>Order total</h5>
                                    <span class="price">{{number_format($total)}} VND</span>
                                </div>
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <div class="order-details-button">
                                    <button class="btn btn-danger" type="submit" style="width: 100%;border: none">CHECK OUT</button>
                                </div>

                                <div class="order-details-button">
                                    <button class="btn btn-danger" type="submit" name="payment" value="3" style="width: 100%;border: none">CHECK OUT ONLINE</button>
                                </div>
                            @endif
                        </div>
                    @else
                        <div style="height: 400px">
                            <p style="color: black;text-align: center;font-size: 18px;margin-bottom: 20px">No Product ! You need to add the product you want to your cart!</p>
                            <a class="btn btn-info" href="{{url("/")}}" style="margin-left: 45%">Shopping Now</a>
                            <hr>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
