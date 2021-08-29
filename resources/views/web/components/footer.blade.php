
<footer class="footer_dark" id="section-footer">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <h6 class="widget_title">ABOUT US</h6>
                        <p>Our services always meet the requirements of quality and reputation is always on top</p>
                    </div>
                    <div class="widget">
                        <ul class="social_icons social_white">
                            <li><a href="https://www.facebook.com/"><i class="fab fa-facebook-square"></i></a></li>
                            <li><a href="https://twitter.com/login?lang=vi"><i class="fab fa-twitter-square"></i></a></li>
                            <li><a href="https://accounts.google.com/"><i class="fab fa-google-plus-square"></i></a></li>
                            <li><a href="https://www.instagram.com/accounts/login/"><i class="fab fa-instagram-square"></i></a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="widget">
                        <h6 class="widget_title">Useful Links</h6>
                        <ul class="widget_links">
                            <li><a href="{{url("login")}}">Login</a></li>
                            <li><a href="{{url("register")}}">Register</a></li>
                            <li><a href="{{url("checkout")}}">Checkout</a></li>
                            <li><a href="{{url("contacts")}}">About Us</a></li>
                            <li><a href="{{url("abouts")}}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="widget">
                        <h6 class="widget_title">Category</h6>
                        <ul class="widget_links">
                            @foreach($cate as $c)
                                <li><a href="{{url("cate",$c->id)}}">{{$c->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>





                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="widget">

                        <h6 class="widget_title">My Account</h6>

                        <ul class="widget_links">

                            <li><a href="{{url("change-user")}}">My Account</a></li>
                            <li><a href="{{url("shopping-cart")}}">My Cart</a></li>
                            <li><a href="{{url("wishlist")}}">Wishlist</a></li>

                        </ul>
                    </div>
                </div>





                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="widget">

                        <h6 class="widget_title">Contact Info</h6>

                        <ul class="contact_info contact_info_light">
                            <li>
                                <i class="fal fa-map-marker-alt"></i>
                                <p>Số 8, Tôn Thất Thuyết, Mỹ Đình 2, Nam Từ Liêm, Hà Nội</p>
                            </li>
                            <li>
                                <i class="fal fa-envelope-open-text"></i>
                                <a href="mailto:arts8888@gmail.com">arts8888@gmail.com</a>
                            </li>
                            <li>
                                <i class="fal fa-phone"></i>
                                <p>0968-555-197</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="htc__copyright bg__cat--5">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="copyright__inner">
                        <p>Copyright© <a href="#">Group One</a> 2021. All right reserved.</p>
                        <a href="#"><img src="{{asset("images/others/shape/paypol.png")}}" alt="payment images"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>
