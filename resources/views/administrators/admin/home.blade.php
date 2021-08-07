@extends("administrators.layout")
@section("main")
    <div class="container-fluid">
        @if(\Illuminate\Support\Facades\Auth::guard("admin")->check())
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary" style="float: left">Our Team </h4>
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
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teams as $tm)
                                <tr>
                                    <td><img style="width: 70px;height: 70px" src="{{$tm->teamImage()}}"/></td>
                                    <td>{{$tm->id}}</td>
                                    <td>{{$tm->name}}</td>
                                    <td>{{$tm->age}}</td>
                                    <td>{{$tm->position}}</td>
                                    <td>{{$tm->email}}</td>
                                    <td>{{$tm->address}}</td>
                                    <td>{{$tm->phone}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @elseif(\Illuminate\Support\Facades\Auth::guard("staff")->check())
            <h1>Đây là Staff</h1>
        @endif
    </div>
@endsection
