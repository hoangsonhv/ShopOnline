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
                                    About Us
                                    </span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="about-section">
            <h1>Who We Are</h1>
            <p>We are the ones who bring you the best benefits through good products. Our services always meet the requirements of quality and reputation is always on top</p>
            <p>We want everyone to know our products. Because our products always meet all the standards of customers.</p>
        </div>
    <div class="container">
        <h2 style="text-align:center;padding: 20px" >Our Team Members</h2>
        <div class="row" style="margin-bottom: 50px">
            @foreach($teams as $team)
                <div class="col-md-4" style="height: 520px;margin-bottom: 30px">
                    <div class="card" style="text-align: center">
                        <img src="{{$team->teamImage()}}" alt="Jane" style="width:100%;height: 370px">
                        <h3 style="padding: 10px 0">{{$team->name}}</h3>
                        <p class="title">{{$team->position}}</p>
                        <h3 style="padding: 10px 0;background-color: #0c84ff">{{$team->phone}}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
