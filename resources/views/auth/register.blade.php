
@extends("web.layout")
<link href="{{asset("css/sb-admin-2.min.css")}}" rel="stylesheet">
@section("main")
{{--    <div class="ht__bradcaump__area" style="background-color: whitesmoke;">--}}
{{--        <div class="ht__bradcaump__wrap">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-xs-12">--}}
{{--                        <div class="bradcaump__inner">--}}
{{--                            <nav class="bradcaump-inner">--}}
{{--                                <a class="breadcrumb-item" href="{{url("/")}}">Home</a>--}}
{{--                                <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>--}}
{{--                                <span class="breadcrumb-item active">--}}
{{--                                    Register--}}
{{--                                    </span>--}}
{{--                            </nav>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
<div class="bg-gradient-primary" style="height: 700px;padding-top: 60px">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block">
                        <img src="{{asset("./images/anhlogin1.jpg")}}" style="width: 100%;height: 100%"/>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome !</h1>
                                    @if(session()->has('danger'))
                                        <div class="alert alert-danger">
                                            {{ session()->get('danger') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <form class="user" action="{{ url("register") }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="form-group row">
                                    <div class="form-group col-lg-12" style="margin-bottom: 0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error("name")
                                        <div class="alert alert-danger" style="width: 100%;">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
                                    @error("email")
                                    <div class="alert alert-danger" style="width: 100%;">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" required autocomplete="new-password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                        @error("password")
                                        <div class="alert alert-danger" style="width: 100%;">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="password_confirmation" required autocomplete="new-password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                                        @error("password_confirmation")
                                        <div class="alert alert-danger" style="width: 100%;">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-user btn-block" style="outline: none">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                @if (Route::has('password.request'))
                                    <a  class="small" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{url("login")}}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
