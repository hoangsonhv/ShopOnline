@extends("administrators.layout")
@section("main")
    @if(session()->has("error"))
        <div class="alert alert-danger">
            {{session()->get("error")}}
        </div>
    @endif
    <div class="container-fluid col-lg-8">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Team Edit
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12" style="padding-bottom:120px">
                <form action="{{url("admin/teams/update",["id"=>$teams->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" value="{{$teams->name}}" class="form-control" name="name" >
                    </div>
                    <div class="form-group">
                        <label>Image:</label>
                        <input type="file" value="{{$teams->teamImage()}}" name="image" >
                        <img style="width: 70px;height: 70px" src="{{$teams->teamImage()}}"/>
                    </div>
                    <div class="form-group">
                        <label>Position:</label>
                        <input type="text" value="{{$teams->position}}" class="form-control" name="position">
                    </div>
                    <div class="form-group">
                        <label>Address:</label>
                        <input type="text" value="{{$teams->address}}" class="form-control" name="address">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" value="{{$teams->email}}" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label>Age:</label>
                        <input type="number" value="{{$teams->age}}" class="form-control" name="age">
                    </div>
                    <div class="form-group">
                        <label>Phone Number:</label>
                        <input type="number" value="{{$teams->phone}}"  class="form-control" name="phone" >
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
