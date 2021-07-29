@extends("administrators.layout")
@section("main")
    @if(session()->has("success"))
        <div class="alert alert-info">
            {{session()->get("success")}}
        </div>
    @elseif(session()->has("error"))
        <div class="alert alert-danger">
            {{session()->get("error")}}
        </div>
    @endif
    <div class="container-fluid">

        <!-- Page Heading -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary" style="float: left">Our Team </h4>
                <button type="submit" class="btn btn-primary" style="float: right"><a href="{{url("admin/teams/add")}}" style="color: white;text-decoration: none">Add Team</a></button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="container">
                        <div class="row">
                            @foreach($teams as $team)
                                <div class="col-md-6 col-lg-4 g-mb-30">
                                    <article class="u-shadow-v18 g-bg-white text-center rounded g-px-20 g-py-40 g-mb-5">
                                        <img class="d-inline-block img-fluid mb-4" src="{{$team->teamImage()}}" alt="Image Description">
                                        <h4 class="h5 g-color-black g-font-weight-600 g-mb-10">{{$team->name}}</h4>
                                        <p>Age: {{$team->age}}</p>
                                        <p>Phone: {{$team->phone}}</p>
                                        <span class="d-block g-color-primary g-font-size-16">Position: {{$team->position}}</span>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="table-responsive abc" style="margin-top: 100px;">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Position</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($team1 as $tm)
                            <tr>
                                <td><img style="width: 70px;height: 70px" src="{{$tm->teamImage()}}"/></td>
                                <td>{{$tm->id}}</td>
                                <td>{{$tm->name}}</td>
                                <td>{{$tm->age}}</td>
                                <td>{{$tm->position}}</td>
                                <td>{{$tm->email}}</td>
                                <td>{{$tm->address}}</td>
                                <td>{{$tm->phone}}</td>
                                <td style="padding: 35px 20px"><a href="{{url("admin/teams/edit",["id"=>$tm->id])}}" style="text-decoration: none"><i class="fa fa-pencil"></i></i>Edit</a></td>
                                <td><a href="{{url('admin/teams/delete',["id"=>$tm->id])}}" style="text-decoration: none"><i class="fa fa-trash-o  fa-fw"></i>Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
