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
{{--                                    Login--}}
{{--                                    </span>--}}
{{--                            </nav>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="bg--twitter" style="height: 700px;padding-top: 60px">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <img style="width: 100%;height: 100%" src="{{asset("./images/anhlogin.jpg")}}"/>
                                </div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome !</h1>
                                            @if(session()->has('danger'))
                                                <div class="alert alert-danger">
                                                    {{ session()->get('danger') }}
                                                </div>
                                            @endif
                                        </div>
                                        <form class="user" method="post" action="{{ route('login') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <input type="email" value="{{ old('email') }}" class="form-control form-control-user"
                                                       id="exampleInputEmail" aria-describedby="emailHelp"
                                                       placeholder="Enter Email Address..." name="email" required autocomplete="email" autofocus>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" required autocomplete="current-password" class="form-control form-control-user"
                                                       id="exampleInputPassword" placeholder="Password">
                                            </div>
                                            <div class="block mt-4">
                                                <label for="remember_me" class="flex items-center" style="margin-bottom: 1.5rem">
                                                    <x-jet-checkbox id="remember_me" name="remember" />
                                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                                </label>
                                            </div>
                                            <button class="btn btn-primary btn-user btn-block" style="outline: none">
                                                Login
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
                                            <a class="small" href="{{url("register")}}">Create an Account!</a>
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
@endsection
