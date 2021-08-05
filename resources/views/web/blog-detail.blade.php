@extends("web.layout")
@section("main")
<div class="ht__bradcaump__area" style="background-color: whitesmoke;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="{{url("/")}}">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">News Detail</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="htc__blog__details bg__white ptb--100">
    <div class="container">
        <div class="row">
            @foreach($blogs as $blog)
                <div class="col-xs-12 col-lg-12">
                    <div class="htc__blog__details__wrap">

                        <div class="ht__bl__thumb">
                            <img src="{{$blog->blogImage()}}" alt="blog images">
                        </div>
                        <div class="bl__dtl">
                            <p>{{$blog->content}}</p>
                            <blockquote>
                                {{$blog->outstanding}}
                            </blockquote>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="bl__img">
                                        <img src="{{$blog->aImage()}}" alt="blog images">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="bl__img">
                                        <img src="{{$blog->bImage()}}" alt="blog images">
                                    </div>
                                </div>
                            </div>
                            <p>{{$blog->summary}}</p>
                        </div>
                    </div>
                </div>
                <!-- End Comment Area -->
            @endforeach
        </div>
    </div>
    </div>
    </div>
</section>
@endsection
