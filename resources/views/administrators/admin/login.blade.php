<!DOCTYPE html>
<html lang="en">
@include("administrators.components.head")
<body class="hold-transition sidebar-mini layout-fixed">
<div id="wrapper">
    <div class="container">
        <div class="bg--twitter" style="height: 700px;padding-top: 60px">
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
                                        <h1 class="h4 text-gray-900 mb-4">Welcome To Administration!</h1>
                                        @if(session()->has('danger'))
                                            <div class="alert alert-danger">
                                                {{ session()->get('danger') }}
                                            </div>
                                        @endif
                                    </div>
                                    <form class="user" method="post" action="{{ "login" }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                   placeholder="Enter Email Address..." name="email" required autocomplete="email" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" required autocomplete="current-password" class="form-control form-control-user"
                                                   placeholder="Password">
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" style="outline: none;margin-top: 30px">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </div>
    <!-- Navigation -->
{{--    <div class="container">--}}
{{--        <div class="aaa" style="padding: 10% 30%;">--}}
{{--            <div class="login-panel panel panel-default">--}}
{{--                <div class="panel-heading">--}}
{{--                    <h3 class="panel-title">Please Sign In</h3>--}}
{{--                </div>--}}
{{--                <div class="panel-body">--}}
{{--                    <form role="form" action="{{"login"}}" method="post" >--}}
{{--                        @csrf--}}
{{--                        <fieldset>--}}
{{--                            <div class="form-group">--}}
{{--                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <input class="form-control" placeholder="Password" name="password" type="password" value="">--}}
{{--                            </div>--}}
{{--                            <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>--}}
{{--                        </fieldset>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
    <!-- /#page-wrapper -->
</div>

{{--<x-scripts/>--}}
</body>
</html>
