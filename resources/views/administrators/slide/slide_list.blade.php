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
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary" style="float: left">Slide</h4>
                <button type="submit" class="btn btn-primary" style="float: right"><a href="{{url("admin/slides/add")}}" style="color: white;text-decoration: none">Add Slide</a></button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Content</th>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($slides as $slide)
                            <tr>
                                <td>{{$slide->id}}</td>
                                <td><img style="width: 70px;height: 70px" src="{{$slide->slideImage()}}"/></td>
                                <td>{{$slide->content}}</td>
                                <td>{{$slide->title}}</td>
                                <td style="padding: 35px 20px"><a href="{{url("admin/slides/edit",["id"=>$slide->id])}}" style="text-decoration: none"><i class="fa fa-pencil"></i>Edit</a></td>
                                <td style="padding-top: 35px"><a href="{{url('admin/slides/delete',["id"=>$slide->id])}}" style="text-decoration: none"><i class="fa fa-trash-o  fa-fw"></i>Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
