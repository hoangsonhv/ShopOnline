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
                                <span class="breadcrumb-item active">Contact</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="htc__contact__area ptb--100 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                    <div class="map-contacts--2">
                        <div class="aaa">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.0971290298526!2d105.78051161493269!3d21.02879928599834!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454b32ecb92db%3A0x3964e6238a3bd088!2zOCBUw7RuIFRo4bqldCBUaHV54bq_dCwgTeG7uSDEkMOsbmgsIEPhuqd1IEdp4bqleSwgSMOgIE7hu5lp!5e0!3m2!1sen!2s!4v1627807393014!5m2!1sen!2s" width="600" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                    <h2 class="title__line--6">CONTACT US</h2>
                    <div class="address">
                        <div class="address__icon">
                            <i class="icon-location-pin icons"></i>
                        </div>
                        <div class="address__details">
                            <h2 class="ct__title">Our address</h2>
                            <p>Số 8, Tôn Thất Thuyết, Mỹ Đình 2, Nam Từ Liêm, Hà Nội</p>
                        </div>
                    </div>
                    <div class="address">
                        <div class="address__icon">
                            <i class="icon-envelope icons"></i>
                        </div>
                        <div class="address__details">
                            <h2 class="ct__title">Email Address</h2>
                            <p>arts8888@gmail.com</p>
                        </div>
                    </div>

                    <div class="address">
                        <div class="address__icon">
                            <i class="icon-phone icons"></i>
                        </div>
                        <div class="address__details">
                            <h2 class="ct__title">Phone Number</h2>
                            <p>0968-555-197</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="contact-form-wrap mt--60">
                    <div class="col-xs-12">
                        <div class="contact-title">
                            <h2 class="title__line--6">SEND A MAIL</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <form id="contact-form" action="{{url("contacts")}}" method="post">
                            @csrf
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="text" name="name" placeholder="Your Name*">
                                    <input type="email" name="email" placeholder="Mail*">
                                </div>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box message">
                                    <textarea name="content" placeholder="Your Message"></textarea>
                                </div>
                            </div>
                            <div class="contact-btn">
                                <button type="submit" class="fv-btn">Send MESSAGE</button>
                            </div>
                        </form>
                        <div class="form-output">
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
