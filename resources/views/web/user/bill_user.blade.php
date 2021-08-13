
@extends("web.layout")
@section("main")
    <div class="ht__bradcaump__area" style="background-color: whitesmoke;margin-bottom: 50px;height: 150px">
        <div class="container">
            <h3 style="text-align: center;font-weight: 600;margin-top: 66px;color: #000cff">Hello! {{\Illuminate\Support\Facades\Auth::user()->name}}</h3>
        </div>
    </div>
    <div class="w3-container">
        <div id="active_button" class="w3-bar" style="width: 270px;height: 50px;margin: auto;font-size: 17px;color:black;font-weight: 400;margin-bottom: 50px;">
            <button class="btn btn-danger2 tablink active2" onclick="openCity(event,'Detail')" style="height: 100%"><a href="{{url("change-user")}}" style="text-decoration: none;">Information Line</a></button>
            <button class="btn btn-danger2 tablink " onclick="openCity(event,'Passwords')" style="height: 100%">Change Password</button>
        </div>

        <div id="Detail" class="container  city" style="height: auto;padding-bottom: 100px">
            <div class="row" style="border: 1px solid silver;padding: 25px;border-radius: 5px;box-shadow: 3px 3px 3px silver;">
                <h2 style="text-align: center;padding: 20px 0">Detail Code Bill @foreach($bills as $bill){{$bill->id}}@endforeach</h2>
                <span style="margin:20px 0;font-size: 20px">Customer Information</span>
                <table class="table table-bordered" style="margin-bottom: 50px">
                    <thead>
                    <tr>
                        <th style="text-align: center">Name</th>
                        <th style="text-align: center">Gender</th>
                        <th style="text-align: center">Email</th>
                        <th style="text-align: center">Address</th>
                        <th style="text-align: center">Phone Number</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bills as $bill)
                        <tr >
                            <td style="text-align: center">{{$bill->customer->name}}</td>
                            <td style="text-align: center">
                                @if($bill->customer->gender == 0)
                                    Men
                                @else
                                    Women
                                @endif
                            </td>
                            <td style="text-align: center">{{$bill->customer->email}}</td>
                            <td style="text-align: center">{{$bill->customer->address}}</td>
                            <td style="text-align: center">{{$bill->customer->phone_number}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <span style="margin:20px 0;font-size: 20px">Product Information</span>
                <table class="table table-bordered">
                    <thead>
                    <tr style="text-align: center">
                        <th style="text-align: center">Code Oder</th>
                        <th style="text-align: center">Product</th>
                        <th style="text-align: center">Quantity</th>
                        <th style="text-align: center">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bill_detail as $bdt)
                        <tr style="text-align: center">
                            <td>{{$bdt->bill->id}}</td>
                            <td>{{$bdt->product->name}}</td>
                            <td>{{$bdt->quantity}}</td>
                            <td>{{number_format($bdt->price)}}$</td>
                        </tr>
                    @endforeach
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
                        <button type="submit" class="btn btn-danger2 active2">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
