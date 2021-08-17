@extends("administrators.layout")
@section("main")
    <div class="container-fluid col-lg-8" style="position: relative">
        <div class="back" style="position: absolute;top: 13px;right: 40px;z-index: 10">
            <button class="btn btn-primary" onclick="history.back()"> <i class="far fa-hand-point-left"></i> Back</button>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="margin-bottom: 30px">User Update</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12" style="padding-bottom:120px">
                <form action="{{url("admin/users/update",["id"=>$user->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" value="{{$user->name}}" name="name">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" value="{{$user->email}}" name="email">
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" value="{{$user->password}}" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
