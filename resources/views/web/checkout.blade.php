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
    <div class="container">
        <p style="color: black;text-align: center;font-size: 18px">Please enter full information!</p>
        <hr>
    </div>
    <div class="checkout-wrap ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ">
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <div class="border_shipping">
                            <div class="checkout__inner">
                                <div class="accordion-list">
                                    <div class="accordion">
                                        @if(\Illuminate\Support\Facades\Auth::check())
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
                                        @else
                                            <div class="accordion__title active">
                                                Checkout Method
                                            </div>
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
                                        {{--                                <div class="accordion__title">--}}
                                        {{--                                    Billing Information--}}
                                        {{--                                </div>--}}
                                        {{--                                <div class="accordion__body" style="display: none;">--}}
                                        {{--                                    <div class="bilinfo">--}}
                                        {{--                                        <form action="#">--}}
                                        {{--                                            <div class="row">--}}
                                        {{--                                                <div class="col-md-12">--}}
                                        {{--                                                    <div class="single-input mt-0">--}}
                                        {{--                                                        <select name="bil-country" id="bil-country">--}}
                                        {{--                                                            <option value="select">Select your country</option>--}}
                                        {{--                                                            <option value="arb">Arab Emirates</option>--}}
                                        {{--                                                            <option value="ban">Bangladesh</option>--}}
                                        {{--                                                            <option value="ind">India</option>--}}
                                        {{--                                                            <option value="uk">United Kingdom</option>--}}
                                        {{--                                                            <option value="usa">United States</option>--}}
                                        {{--                                                        </select>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="col-md-6">--}}
                                        {{--                                                    <div class="single-input">--}}
                                        {{--                                                        <input type="text" placeholder="First name">--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="col-md-6">--}}
                                        {{--                                                    <div class="single-input">--}}
                                        {{--                                                        <input type="text" placeholder="Last name">--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="col-md-12">--}}
                                        {{--                                                    <div class="single-input">--}}
                                        {{--                                                        <input type="text" placeholder="Company name">--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="col-md-12">--}}
                                        {{--                                                    <div class="single-input">--}}
                                        {{--                                                        <input type="text" placeholder="Street Address">--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="col-md-12">--}}
                                        {{--                                                    <div class="single-input">--}}
                                        {{--                                                        <input type="text" placeholder="Apartment/Block/House (optional)">--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="col-md-6">--}}
                                        {{--                                                    <div class="single-input">--}}
                                        {{--                                                        <input type="text" placeholder="City/State">--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="col-md-6">--}}
                                        {{--                                                    <div class="single-input">--}}
                                        {{--                                                        <input type="text" placeholder="Post code/ zip">--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="col-md-6">--}}
                                        {{--                                                    <div class="single-input">--}}
                                        {{--                                                        <input type="email" placeholder="Email address">--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="col-md-6">--}}
                                        {{--                                                    <div class="single-input">--}}
                                        {{--                                                        <input type="text" placeholder="Phone number">--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </form>--}}
                                        {{--                                    </div>--}}
                                        {{--                                </div>--}}
                                        {{--                                <div class="accordion__title">--}}
                                        {{--                                    shipping information--}}
                                        {{--                                </div>--}}
                                        {{--                                <div class="accordion__body" style="display: none;">--}}
                                        {{--                                    <div class="shipinfo">--}}
                                        {{--                                        <h3 class="shipinfo__title">Shipping Address</h3>--}}
                                        {{--                                        <p><b>Address:</b> Bootexperts, Banasree D-Block, Dhaka 1219, Bangladesh</p>--}}
                                        {{--                                        <a href="#" class="ship-to-another-trigger"><i class="zmdi zmdi-long-arrow-right"></i>Ship to another address</a>--}}
                                        {{--                                        <div class="ship-to-another-content">--}}
                                        {{--                                            <form action="#">--}}
                                        {{--                                                <div class="row">--}}
                                        {{--                                                    <div class="col-md-12">--}}
                                        {{--                                                        <div class="single-input mt-0">--}}
                                        {{--                                                            <select name="bil-country" id="another-bil-country">--}}
                                        {{--                                                                <option value="select">Select your country</option>--}}
                                        {{--                                                                <option value="arb">Arab Emirates</option>--}}
                                        {{--                                                                <option value="ban">Bangladesh</option>--}}
                                        {{--                                                                <option value="ind">India</option>--}}
                                        {{--                                                                <option value="uk">United Kingdom</option>--}}
                                        {{--                                                                <option value="usa">United States</option>--}}
                                        {{--                                                            </select>--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="col-md-6">--}}
                                        {{--                                                        <div class="single-input">--}}
                                        {{--                                                            <input type="text" placeholder="First name">--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="col-md-6">--}}
                                        {{--                                                        <div class="single-input">--}}
                                        {{--                                                            <input type="text" placeholder="Last name">--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="col-md-12">--}}
                                        {{--                                                        <div class="single-input">--}}
                                        {{--                                                            <input type="text" placeholder="Company name">--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="col-md-12">--}}
                                        {{--                                                        <div class="single-input">--}}
                                        {{--                                                            <input type="text" placeholder="Street Address">--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="col-md-12">--}}
                                        {{--                                                        <div class="single-input">--}}
                                        {{--                                                            <input type="text" placeholder="Apartment/Block/House (optional)">--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="col-md-6">--}}
                                        {{--                                                        <div class="single-input">--}}
                                        {{--                                                            <input type="text" placeholder="City/State">--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="col-md-6">--}}
                                        {{--                                                        <div class="single-input">--}}
                                        {{--                                                            <input type="text" placeholder="Post code/ zip">--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="col-md-6">--}}
                                        {{--                                                        <div class="single-input">--}}
                                        {{--                                                            <input type="email" placeholder="Email address">--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="col-md-6">--}}
                                        {{--                                                        <div class="single-input">--}}
                                        {{--                                                            <input type="text" placeholder="Phone number">--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </form>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                </div>--}}
                                        {{--                                <div class="accordion__title">--}}
                                        {{--                                    shipping method--}}
                                        {{--                                </div>--}}
                                        {{--                                <div class="accordion__body" style="display: none;">--}}
                                        {{--                                    <div class="shipmethod">--}}
                                        {{--                                        <form action="#">--}}
                                        {{--                                            <div class="single-input">--}}
                                        {{--                                                <p>--}}
                                        {{--                                                    <input type="radio" name="ship-method" id="ship-fast">--}}
                                        {{--                                                    <label for="ship-fast">First shipping</label>--}}
                                        {{--                                                </p>--}}
                                        {{--                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid voluptatum quaerat totam hic suscipit quam repellat debitis ad sed aperiam quisquam quibusdam enim labore, ipsa illo, natus ipsam temporibus officia.</p>--}}
                                        {{--                                            </div>--}}
                                        {{--                                            <div class="single-input">--}}
                                        {{--                                                <p>--}}
                                        {{--                                                    <input type="radio" name="ship-method" id="ship-normal">--}}
                                        {{--                                                    <label for="ship-normal">Normal shipping</label>--}}
                                        {{--                                                </p>--}}
                                        {{--                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam maxime, eaque eos! Quidem officia similique, fuga consequatur vero? Quis autem dicta voluptatibus veniam temporibus rem reprehenderit placeat quaerat sunt ducimus.</p>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </form>--}}
                                        {{--                                    </div>--}}
                                        {{--                                </div>--}}
                                        {{--                                <div class="accordion__title">--}}
                                        {{--                                    payment information--}}
                                        {{--                                </div>--}}
                                        {{--                                <div class="accordion__body" style="display: none;">--}}
                                        {{--                                    <div class="paymentinfo">--}}
                                        {{--                                        <div class="single-method">--}}
                                        {{--                                            <a href="#"><i class="zmdi zmdi-long-arrow-right"></i>Check/ Money Order</a>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="single-method">--}}
                                        {{--                                            <a href="#" class="paymentinfo-credit-trigger"><i class="zmdi zmdi-long-arrow-right"></i>Credit Card</a>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="paymentinfo-credit-content">--}}
                                        {{--                                            <form action="#">--}}
                                        {{--                                                <div class="row">--}}
                                        {{--                                                    <div class="col-md-12">--}}
                                        {{--                                                        <div class="single-input mt-0">--}}
                                        {{--                                                            <input type="text" placeholder="Name on card">--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="col-md-12">--}}
                                        {{--                                                        <div class="single-input">--}}
                                        {{--                                                            <select name="bil-country" id="payment-info-type">--}}
                                        {{--                                                                <option value="select">Card type</option>--}}
                                        {{--                                                                <option value="card-1">Card type 1</option>--}}
                                        {{--                                                                <option value="card-2">Card type 2</option>--}}
                                        {{--                                                                <option value="card-3">Card type 3</option>--}}
                                        {{--                                                            </select>--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="col-md-12">--}}
                                        {{--                                                        <div class="single-input">--}}
                                        {{--                                                            <input type="text" placeholder="Credit Card Number*">--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="col-md-6">--}}
                                        {{--                                                        <div class="single-input">--}}
                                        {{--                                                            <select>--}}
                                        {{--                                                                <option>Select Month</option>--}}
                                        {{--                                                                <option>Jan</option>--}}
                                        {{--                                                                <option>Feb</option>--}}
                                        {{--                                                                <option>Mar</option>--}}
                                        {{--                                                                <option>Apr</option>--}}
                                        {{--                                                                <option>May</option>--}}
                                        {{--                                                                <option>Jun</option>--}}
                                        {{--                                                                <option>Jul</option>--}}
                                        {{--                                                                <option>Aug</option>--}}
                                        {{--                                                                <option>Sep</option>--}}
                                        {{--                                                                <option>Oct</option>--}}
                                        {{--                                                                <option>Nov</option>--}}
                                        {{--                                                                <option>Dec</option>--}}
                                        {{--                                                            </select>--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="col-md-6">--}}
                                        {{--                                                        <div class="single-input">--}}
                                        {{--                                                            <select>--}}
                                        {{--                                                                <option>Select Year</option>--}}
                                        {{--                                                                <option>2015</option>--}}
                                        {{--                                                                <option>2016</option>--}}
                                        {{--                                                                <option>2017</option>--}}
                                        {{--                                                                <option>2018</option>--}}
                                        {{--                                                                <option>2019</option>--}}
                                        {{--                                                                <option>2020</option>--}}
                                        {{--                                                                <option>2021</option>--}}
                                        {{--                                                                <option>2022</option>--}}
                                        {{--                                                                <option>2023</option>--}}
                                        {{--                                                            </select>--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                    <div class="col-md-12">--}}
                                        {{--                                                        <div class="single-input">--}}
                                        {{--                                                            <input type="text" placeholder="Card verification number*">--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </form>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                </div>--}}
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
                                                    <div class="form-check" style="margin-bottom: 20px">
                                                        <input class="form-check-input" type="radio" checked value="0" name="flexRadioDefault" id="flexRadioDefault1">
                                                        <strong data-toggle="collapse"  href="#footwear"> Thanh toán khi nhận hàng</strong>
                                                        <div class="collapse" id="footwear" style="margin-left: 17px">
                                                            <span>Khi nhận hàng quý khách vui lòng thanh toán đầy đủ tiền cho người giao hàng!</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="1" name="flexRadioDefault" id="flexRadioDefault2" >
                                                        <strong data-toggle="collapse"  href="#footwear1"> Thanh toán bằng thẻ ATM</strong>
                                                        <div class="collapse" id="footwear1" style="margin-left: 17px">
                                                            <span>Quý khách vui lòng chuyển khoản đến số tài khoản sau:</span><br>
                                                            <span>STK Vietcombank: 0351000920992</span><br>
                                                            <span>Tên chủ tài khoản: Hoàng văn sơn</span><br>
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
                    <div class="order-details" style="margin-bottom: 30px">
                        <h5 class="order-details__title">Your Order</h5>
                        <div class="order-details__item">
                            <div class="single-item">
                                <div class="single-item__thumb">
                                    <img src="images/cart/1.png" alt="ordered item">
                                </div>
                                <div class="single-item__content">
                                    <a href="#">Santa fe jacket for men</a>
                                    <span class="price">$128</span>
                                </div>
                                <div class="single-item__remove">
                                    <a href="#"><i class="zmdi zmdi-delete"></i></a>
                                </div>
                            </div>
                            <div class="single-item">
                                <div class="single-item__thumb">
                                    <img src="images/cart/2.png" alt="ordered item">
                                </div>
                                <div class="single-item__content">
                                    <a href="#">Santa fe jacket for men</a>
                                    <span class="price">$128</span>
                                </div>
                                <div class="single-item__remove">
                                    <a href="#"><i class="zmdi zmdi-delete"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="order-details__count">
                            <div class="order-details__count__single">
                                <h5>sub total</h5>
                                <span class="price">$909.00</span>
                            </div>
                            <div class="order-details__count__single">
                                <h5>Shipping</h5>
                                <span class="price">0</span>
                            </div>
                        </div>
                        <div class="ordre-details__total">
                            <h5>Order total</h5>
                            <span class="price">$918.00</span>
                        </div>
                    </div>
                    <button class="btn btn-default">CHECK OUT</button>
                    <div class="order-details">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
