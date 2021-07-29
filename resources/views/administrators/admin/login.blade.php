<!DOCTYPE html>
<html lang="en">
@include("administrators.components.head")
<body class="hold-transition sidebar-mini layout-fixed">
<div id="wrapper">
    <!-- Navigation -->
    <div class="container">
        <div class="aaa" style="padding: 10% 30%;">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="{{"login"}}" method="post" >
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                        </fieldset>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!-- /#page-wrapper -->
</div>

{{--<x-scripts/>--}}
</body>
</html>
