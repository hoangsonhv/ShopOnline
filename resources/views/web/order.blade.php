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
    @if(count($order) != null)
        <div class="container">
            <h2 style="color: #2434ef;text-align: center">Order At ARTS Shop</h2>
            <p style="text-align: center;margin-top: 10px"><i style="color: red;">Our staff will contact you as soon as the product is available!</i></p>
            <hr>
        </div>
    @endif
    <div class="checkout-wrap ptb--100" style="margin-bottom: 50px">
        <div class="container">

            <div class="row">
                <div class="cart-main-area ptb--100 bg__white" style="padding: 0">
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
                                            $total = 0;
                                        @endphp
                                        @foreach($order as $crt)
                                            @if($crt->promotion_price > 0)
                                                @php
                                                    $total += $crt->__get("promotion_price") * $crt->order_qty;
                                                @endphp
                                            @else
                                                @php
                                                    $total += $crt->__get("unit_price") * $crt->order_qty;
                                                @endphp
                                            @endif
                                            <tr>
                                                <td class="product-thumbnail"><a href="{{url("product-detail",["id"=>$crt->id])}}"><img src="{{$crt->getImage()}}" alt="product img"></a></td>
                                                <td class="product-name">
                                                    <span style="font-size: 18px;color:black;font-weight: 600;font-family: 'Poppins', sans-serif;">{{$crt->name}}</span>
                                                </td>
                                                <td class="product-price">
                                                    @if($crt->promotion_price > 0)
                                                        <span class="amount">{{number_format($crt['promotion_price'])}} VND</span>
                                                    @else
                                                        <span class="amount">{{number_format($crt['unit_price'])}} VND</span>
                                                    @endif
                                                </td>
                                                <td class="product-quantity">
                                                    <form action="{{url("update-order",["id"=>$crt->id])}}" method="get">
                                                        <input type="number" min="1"  name="order_qty" value="{{$crt->order_qty}}">
                                                        <button type="submit" class="btn btn-success" style="width: 60px;height: 40px;padding: 0;margin-bottom: 2px">Update</button>
                                                    </form>
                                                </td>
                                                <td class="product-subtotal itotal" >
                                                    @if($crt->promotion_price > 0)
                                                        {{ number_format($crt['promotion_price'] * $crt['order_qty']) }} VND
                                                    @else
                                                        {{ number_format($crt['unit_price'] * $crt['order_qty']) }} VND
                                                    @endif
                                                </td>
                                                <td class="product-remove"><a href="{{url("delete-order",["id"=>$crt->id])}}"><i class="far fa-trash-alt"></i></a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{"check-order"}}" method="post">
                    @csrf
                    <div class="">
                        <div class="col-md-12 ">
                            <div class="border_shipping1">
                                <div class="checkout__inner">
                                    <div class="accordion-list">
                                        <div class="accordion">
                                            <div class="shipinfo">
                                                <h3 class="shipinfo__title">Information Order</h3>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="single-input">
                                                                <input type="text" placeholder="Full Name"  name="name" required>
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
                                                                        <option value="">Tỉnh / Thành phố</option>
                                                                    </select>
                                                                    <input class="billing_address_1" name="city" type="hidden" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4" style="padding: 0">
                                                                <div class="single-input">
                                                                    <select name="calc_shipping_district" required=""  style="padding: 0 15px">
                                                                        <option value="">Quận / Huyện</option>
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
                                                                    <option value="1">Nữ</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="buttons-cart--inner ">
                                    <div class="buttons-cart col-md-5" >
                                        <a href="{{url("/")}}" style="width: 100%;text-align: center;font-size: 16px">Continue Shopping</a>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-5" style="height: 62px">
                                        <button class="btn btn-danger" type="submit" name="payment" value="3" style="width: 100%;font-family: 'Poppins', sans-serif;font-weight: 500;height:100%;border-radius:0;font-size: 16px;border: none">ORDER NOW</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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
                $this.html('<option value="">Tỉnh / Thành phố</option>' + stc)
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
                            $('select[name="calc_shipping_district"]').html('<option value="">Quận / Huyện</option>' + str)
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
                        $('select[name="calc_shipping_district"]').html('<option value="">Quận / Huyện</option>')
                        district = $('select[name="calc_shipping_district"]').html()
                        localStorage.setItem('district', district)
                        localStorage.removeItem('address_1_saved', address_1)
                    }
                })
            })
        })
    </script>
@endsection



