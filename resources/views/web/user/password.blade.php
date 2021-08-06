@extends("web.layout")
@section("main")
    <div class="container">
        @if(session()->has("success"))
            <div class="alert alert-success">
                {{session()->get("success")}}
            </div>
        @elseif(session()->has("error"))
            <div class="alert alert-danger">
                {{session()->get("error")}}
            </div>
        @endif
    </div>
    <div class="ht__bradcaump__area" style="background-color: whitesmoke;margin-bottom: 50px;height: 150px">
        <div class="container">
            <h3 style="text-align: center;font-weight: 600;margin-top: 66px;color: #000cff">Hello! {{\Illuminate\Support\Facades\Auth::user()->name}}</h3>
        </div>
    </div>
    <div class="w3-container">
        <div class="w3-bar" style="width: 270px;height: 50px;margin: auto;font-size: 17px;color:black;font-weight: 400;margin-bottom: 50px;">
            <button class="btn btn-danger2 tablink " onclick="openCity(event,'Detail')" style="height: 100%">Information Line</button>
            <button class="btn btn-danger2 tablink " onclick="openCity(event,'Passwords')" style="height: 100%">Change Password</button>
        </div>

        <div id="Detail" class="container  city" style="height: 500px">
            <h2 style="text-align: center;color: #001fff;font-weight: 500;padding: 20px">THE ODER</h2>
            <div class="row" style="border: 1px solid silver;border-radius: 5px;box-shadow: 3px 3px 3px silver;">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="Passwords" class="container city" style="display:none;height: 500px">
            <div class="row" style="background-color: whitesmoke;padding: 5% 20%">
                <div class="col-sm-12">
                    <form action="{{url("change-user")}}" method="post" >
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
                        <button type="submit" class="btn btn-danger2">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
