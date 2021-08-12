@extends("administrators.layout")
@section("main")
    <div class="container">
        <h2 style="text-align: center;margin-bottom: 50px;color: red">Change Password</h2>
        <div class="row" >
            <div class="col-sm-12">
                <form action="{{url("admin/change-staff")}}" method="post" >
                    @csrf
                    <div class="form-group" style="position: relative">
                        <label for="password">Old Password: </label>
                        <input type="password" class="form-control" name="password_old" placeholder="********" value="">
                        @error("password_old")<div class="alert alert-danger" style="width: 100%;" >{{$message}}</div>@enderror
                    </div>
                    <div class="form-group" style="position: relative">
                        <label for="password">New Password: </label>
                        <input type="password" class="form-control" name="password" placeholder="********" value="">
                        @error("password")<div class="alert alert-danger" style="width: 100%;" >{{$message}}</div>@enderror
                    </div>
                    <div class="form-group" style="position: relative">
                        <label for="password">Enter the password: </label>
                        <input type="password" class="form-control" name="password_confirm" placeholder="********" value="">
                        @error("password_confirm")<div class="alert alert-danger" style="width: 100%;" >{{$message}}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-success">Cập Nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection
