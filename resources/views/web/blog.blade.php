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
                                <span class="breadcrumb-item active">
                                    News
                                    </span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="htc__blog__area bg__white ptb--100">
    <div class="container">
        <div class="row">
            <div class="ht__blog__wrap clearfix">
                @foreach($blogs as $blog)
                    <div class="col-md-6 col-lg-4 col-sm-6 col-xs-12">
                        <div class="blog">
                            <div class="blog__thumb">
                                <a href="">
                                    <img src="{{$blog->blogImage()}}" alt="blog images" style="height: 350px">
                                </a>
                            </div>
                            <div class="blog__details">
                                <div class="bl__date">
                                    <span>{{$blog->date}}</span>
                                </div>
                                <h2><a href="#">{{$blog->title}}</a></h2>
                                <span class="textFlow">{{$blog->content}}</span>
                                <div class="blog__btn">
                                        <a href="{{url("blogs-detail",["id"=>$blog->id])}}">Read More</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
