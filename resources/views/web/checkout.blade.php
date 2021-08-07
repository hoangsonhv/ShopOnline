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
    <div class="checkout-wrap ptb--100">
        <div class="container">
            <div class="row">
                @if(count($cart) != null)
                    <div class="col-md-8 ">
                        @if(\Illuminate\Support\Facades\Auth::check())
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
                                                                <input type="text" placeholder="Full Name" name="name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="single-input">
                                                                <input type="email" placeholder="Email Address" name="email">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="single-input">
                                                                <input type="text" placeholder="Street Address" name="address">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="single-input">
                                                                <input type="text" placeholder="Phone Number" name="phone_number">
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
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-check" style="margin-bottom: 10px">
                                                                <input class="form-check-input" type="radio" checked value=1" name="flexRadioDefault" id="flexRadioDefault1">
                                                                <strong data-toggle="collapse" style="cursor: pointer" href="#footwear"> Thanh toán khi nhận hàng</strong>
                                                                <div class="collapse" id="footwear" style="margin-left: 17px">
                                                                    <span>Khi nhận hàng quý khách vui lòng thanh toán đầy đủ tiền cho người giao hàng!</span>
                                                                </div>
                                                            </div>
                                                            <div class="form-check" style="margin-bottom: 10px">
                                                                <input class="form-check-input" type="radio" value="2" name="flexRadioDefault" id="flexRadioDefault2" >
                                                                <strong data-toggle="collapse"style="cursor: pointer"  href="#footwear1"> Thanh toán bằng thẻ ATM</strong>
                                                                <div class="collapse" id="footwear1" style="margin-left: 17px">
                                                                    <span>Quý khách vui lòng chuyển khoản đến số tài khoản sau:</span><br>
                                                                    <span>STK Vietcombank: 0351000920992</span><br>
                                                                    <span>Tên chủ tài khoản: Hoàng văn sơn</span><br>
                                                                </div>
                                                            </div>
                                                            <div class="form-check" style="margin-bottom: 10px">
                                                                <input class="form-check-input" type="radio"  value="0" name="flexRadioDefault" id="flexRadioDefault3">
                                                                <strong data-toggle="collapse" style="cursor: pointer"  href="#footwear2"> Thanh toán bằng VNPAY</strong>
                                                                <div class="collapse" id="footwear2" style="margin-left: 17px">
                                                                    <span>Khi nhận hàng quý khách vui lòng thanh toán đầy đủ tiền cho người giao hàng!</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="accordion__body" style="">
                                <div class="accordion__body__form">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="checkout-method__login">
                                                <form action="{{route("registerCheckOut")}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <h5 class="checkout-method__title">If you do not already have an account!</h5>
                                                    <p class="checkout-method__subtitle">Please register below:</p>
                                                    <div class="form-group row">
                                                        <div class="form-group col-lg-12" style="margin-bottom: 0">
                                                            <label for="user-email">Name</label>
                                                            <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder=" Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                            @error("name")
                                                            <div class="alert alert-danger" style="font-size: 12px">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="user-email">Email Address</label>
                                                        <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
                                                        @error("email")
                                                        <div class="alert alert-danger" style="font-size: 12px">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <label for="user-email">Password</label>
                                                            <input type="password" name="password" required autocomplete="new-password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                                            @error("password")
                                                            <div class="alert alert-danger" style="font-size: 12px">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="user-email">Password Reset</label>
                                                            <input type="password" name="password_confirmation" required autocomplete="new-password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                                                            @error("password_confirmation")
                                                            <div class="alert alert-danger" style="font-size: 12px">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary btn-user btn-block" style="outline: none">
                                                        Register Account
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-5">

                                            <div class="checkout-method__login">
                                                <form action="{{route("postLogin")}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <h5 class="checkout-method__title">If you already have an account!</h5>
                                                    <p class="checkout-method__subtitle">Please login below:</p>
                                                    @if(session()->has('danger'))
                                                        <div class="alert alert-danger" style="font-size: 12px">
                                                            {{ session()->get('danger') }}
                                                        </div>
                                                    @endif
                                                    <div class="single-input">
                                                        <label for="user-email">Email Address</label>
                                                        <input type="email" id="user-email" name="email">
                                                    </div>
                                                    <div class="single-input">
                                                        <label for="user-pass">Password</label>
                                                        <input type="password" id="user-pass" name="password">
                                                    </div>
                                                    <p class="require">* Required fields</p>
                                                    <a href="#">Forgot Passwords?</a>
                                                    <div class="dark-btn">
                                                        <button class="btn alert-success" style="height: 39px" type="submit">LogIn</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <div class="order-details" style="margin-bottom: 20px">
                            <h5 class="order-details__title">Your Order</h5>

                            <div class="order-details__item">
                                @php $total = 0;$checkout=0; @endphp
                                @foreach($cart as $item)
                                    @php $total += $item->cart_qty * $item->__get("unit_price") @endphp
                                    <div class="single-item">
                                        <div class="single-item__thumb">
                                            <img src="{{$item->getImage()}}" alt="ordered item">
                                        </div>
                                        <div class="single-item__content">
                                            <a href="{{url("product-detail",["id"=>$item->id])}}">{{$item->name}}</a>
                                            <span class="price">${{$item->unit_price}}</span>
                                        </div>
                                        <div class="single-item__remove">
                                            <a href="{{url("delete-cart",["id"=>$item->id])}}"><i class="zmdi zmdi-delete"></i></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="ordre-details__total">
                                <h5>Order total</h5>
                                <span class="price">${{$total}}</span>
                            </div>

                        </div>
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <div class="order-details-button">
                                <button class="btn btn-danger" style="width: 100%;border: none">CHECK OUT</button>
                            </div>
                        @endif
                    </div>
                @else
                    <div style="height: 400px">
                        <p style="color: black;text-align: center;font-size: 18px;margin-bottom: 20px">No Product ! You need to add the product you want to your cart!</p>
                        <a href="{{url("/")}}" style="margin-left: 45%"><button type="submit" class="btn btn-danger2">Shopping Now</button></a>
                        <hr>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
