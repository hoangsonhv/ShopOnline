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
                                                        <span class="amount">Price: {{number_format($item['unit_price'])}} VND</span>
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
                                <div class="">
                                    <button class="btn btn-danger" type="submit" style="width: 100%;height: 50px;font-size: 18px;box-shadow: 1px 1px 5px 5px #cecece;">ORDER NOW</button>
                                </div>
                            @endif
                        </div>
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
                                                            <div class="col-md-4" style="padding-left: 0">
                                                                <div class="single-input">
                                                                    <select name="calc_shipping_provinces" required="">
                                                                        <option value="">T???nh / Th??nh ph???</option>
                                                                    </select>
                                                                    <input class="billing_address_1" name="city" type="hidden" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4" style="padding: 0">
                                                                <div class="single-input">
                                                                    <select name="calc_shipping_district" required=""  style="padding: 0 15px">
                                                                        <option value="">Qu???n / Huy???n</option>
                                                                    </select>
                                                                    <input class="billing_address_2" name="district" type="hidden" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4" style="padding-right: 0">
                                                                <div class="single-input">
                                                                    <input type="text" placeholder="Details Address" name="address" required >
                                                                </div>
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
                                                                    <option value="1">N???</option>
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
                                                            <input class="form-check-input"  type="radio" value=1" name="payment" id="flexRadioDefault1" required>
                                                            <label data-toggle="collapse" class="form-check-label" style="cursor: pointer" href="#footwear" for="flexRadioDefault1"> Thanh to??n khi nh???n h??ng</label>
                                                            <div class="collapse" id="footwear" style="margin-left: 17px">
                                                                <span>Khi nh???n h??ng qu?? kh??ch vui l??ng thanh to??n ?????y ????? ti???n cho ng?????i giao h??ng!</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-check" style="margin-bottom: 10px">
                                                            <input class="form-check-input" type="radio" value="2" name="payment" id="flexRadioDefault2" required>
                                                            <label data-toggle="collapse" style="cursor: pointer"  href="#footwear1" for="flexRadioDefault2"> Thanh to??n b???ng th??? ATM</label>
                                                            <div class="collapse" id="footwear1" style="margin-left: 17px">
                                                                <span>Qu?? kh??ch vui l??ng chuy???n kho???n ?????n s??? t??i kho???n sau:</span><br>
                                                                <span>STK Vietcombank: 0351000920992</span><br>
                                                                <span>T??n ch??? t??i kho???n: Ho??ng v??n s??n</span><br>
                                                            </div>
                                                        </div>
                                                        <div class="form-check" style="margin-bottom: 10px">
                                                            <input class="form-check-input" type="radio" value="3" name="payment" id="flexRadioDefault3" required>
                                                            <label data-toggle="collapse" style="cursor: pointer"  href="#footwear2" for="flexRadioDefault3"> Thanh to??n b???ng VNPAY</label>
                                                            <div class="collapse" id="footwear2" style="margin-left: 17px">
                                                                <div class="form-group">
                                                                    <label for="language" style="padding-top: 7px">Lo???i h??ng h??a&emsp;&emsp;&emsp;&emsp;: </label>
                                                                    <select name="order_type" style="float: right;width: 75%" id="order_type" class="form-control" >
                                                                        <option value="billpayment">Thanh to??n h??a ????n</option>
                                                                        <option value="topup">N???p ti???n ??i???n tho???i</option>
                                                                        <option value="fashion">Th???i trang</option>
                                                                        <option value="other">Kh??c - Xem th??m t???i VNPAY</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="amount" style="padding-top: 7px">S??? ti???n &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:</label>
                                                                    <input  class="form-control" min="{{$total*35/100}}" style="float: right;width: 75%" id="amount" name="amount" type="number" placeholder="VND" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="bank_code" style="padding-top: 7px">Ng??n h??ng  &emsp;&emsp;&emsp;&emsp;&emsp; :</label>
                                                                    <select name="bank_code" style="float: right;width: 75%" id="bank_code" class="form-control">
                                                                        <option value="" hidden>Ch???n m???t ng??n h??ng.</option>
                                                                        <option value="NCB"> Ngan hang NCB</option>
                                                                        <option value="AGRIBANK"> Ngan hang Agribank</option>
                                                                        <option value="SCB"> Ngan hang SCB</option>
                                                                        <option value="SACOMBANK">Ngan hang SacomBank</option>
                                                                        <option value="EXIMBANK"> Ngan hang EximBank</option>
                                                                        <option value="MSBANK"> Ngan hang MSBANK</option>
                                                                        <option value="NAMABANK"> Ngan hang NamABank</option>
                                                                        <option value="VNMART"> Vi dien tu VnMart</option>
                                                                        <option value="VIETINBANK">Ngan hang Vietinbank</option>
                                                                        <option value="VIETCOMBANK"> Ngan hang VCB</option>
                                                                        <option value="HDBANK">Ngan hang HDBank</option>
                                                                        <option value="DONGABANK"> Ngan hang Dong A</option>
                                                                        <option value="TPBANK"> Ng??n h??ng TPBank</option>
                                                                        <option value="OJB"> Ng??n h??ng OceanBank</option>
                                                                        <option value="BIDV"> Ng??n h??ng BIDV</option>
                                                                        <option value="TECHCOMBANK"> Ng??n h??ng Techcombank</option>
                                                                        <option value="VPBANK"> Ngan hang VPBank</option>
                                                                        <option value="MBBANK"> Ngan hang MBBank</option>
                                                                        <option value="ACB"> Ngan hang ACB</option>
                                                                        <option value="OCB"> Ngan hang OCB</option>
                                                                        <option value="IVB"> Ngan hang IVB</option>
                                                                        <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="order_desc" style="padding-top: 7px">N???i dung thanh to??n &emsp;:</label>
                                                                    <textarea  class="form-control" style="float: right;width: 75%" cols="20" id="order_desc" name="order_desc" rows="2" placeholder="N???i dung..."></textarea>
                                                                </div>
                                                                <div class="form-group" style="margin-top: 30px">
                                                                    <label for="language" style="padding-top: 7px">Ng??n ng???&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:</label>
                                                                    <select  name="language" style="float: right;width: 75%" id="language" class="form-control">
                                                                        <option value="vn">Ti???ng Vi???t</option>
                                                                        <option value="en">English</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group" style="margin-top: 20px">
                                                                    <label style="padding-top: 7px;color: red">L??u ??&emsp;:</label>
                                                                    <i style="color: red">S??? ti???n thanh to??n th???p nh???t l?? 35% theo gi?? ????n h??ng. Qu?? kh??ch c?? th??? thanh to??n 100% s??? ti???n!</i>
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
                        </div>

                    @else
                        <div style="height: 400px">
                            <p style="color: black;text-align: center;font-size: 18px;margin-bottom: 20px">No Product ! You need to add the product you want to your cart!</p>
                            <a class="btn_hover" href="{{url("/")}}"><button class="btn-5"  style="margin-left: 42%">Shopping Now</button></a>
                            <hr>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <script src="{{asset("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js")}}"></script>
    <script src="{{asset("https://cdn.jsdelivr.net/gh/vietblogdao/js/districts.min.js")}}"></script>
    <script>
        if (address_2 = localStorage.getItem('address_2_saved')) {
            $('select[name="calc_shipping_district"] option').each(function() {
                if ($(this).text() == address_2) {
                    $(this).attr('selected', '')
                }
            })
            $('input.billing_address_2').attr('value', address_2)
        }
        if (district = localStorage.getItem('district')) {
            $('select[name="calc_shipping_district"]').html(district)
            $('select[name="calc_shipping_district"]').on('change', function() {
                var target = $(this).children('option:selected')
                target.attr('selected', '')
                $('select[name="calc_shipping_district"] option').not(target).removeAttr('selected')
                address_2 = target.text()
                $('input.billing_address_2').attr('value', address_2)
                district = $('select[name="calc_shipping_district"]').html()
                localStorage.setItem('district', district)
                localStorage.setItem('address_2_saved', address_2)
            })
        }
        $('select[name="calc_shipping_provinces"]').each(function() {
            var $this = $(this),
                stc = ''
            c.forEach(function(i, e) {
                e += +1
                stc += '<option value=' + e + '>' + i + '</option>'
                $this.html('<option value="">T???nh / Th??nh ph???</option>' + stc)
                if (address_1 = localStorage.getItem('address_1_saved')) {
                    $('select[name="calc_shipping_provinces"] option').each(function() {
                        if ($(this).text() == address_1) {
                            $(this).attr('selected', '')
                        }
                    })
                    $('input.billing_address_1').attr('value', address_1)
                }
                $this.on('change', function(i) {
                    i = $this.children('option:selected').index() - 1
                    var str = '',
                        r = $this.val()
                    if (r != '') {
                        arr[i].forEach(function(el) {
                            str += '<option value="' + el + '">' + el + '</option>'
                            $('select[name="calc_shipping_district"]').html('<option value="">Qu???n / Huy???n</option>' + str)
                        })
                        var address_1 = $this.children('option:selected').text()
                        var district = $('select[name="calc_shipping_district"]').html()
                        localStorage.setItem('address_1_saved', address_1)
                        localStorage.setItem('district', district)
                        $('select[name="calc_shipping_district"]').on('change', function() {
                            var target = $(this).children('option:selected')
                            target.attr('selected', '')
                            $('select[name="calc_shipping_district"] option').not(target).removeAttr('selected')
                            var address_2 = target.text()
                            $('input.billing_address_2').attr('value', address_2)
                            district = $('select[name="calc_shipping_district"]').html()
                            localStorage.setItem('district', district)
                            localStorage.setItem('address_2_saved', address_2)
                        })
                    } else {
                        $('select[name="calc_shipping_district"]').html('<option value="">Qu???n / Huy???n</option>')
                        district = $('select[name="calc_shipping_district"]').html()
                        localStorage.setItem('district', district)
                        localStorage.removeItem('address_1_saved', address_1)
                    }
                })
            })
        })
    </script>
@endsection



