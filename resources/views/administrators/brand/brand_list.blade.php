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
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary" style="float: left">Brand Table</h4>
                <button type="submit" class="btn btn-primary" style="float: right"><a href="{{url("admin/brands/add")}}" style="color: white;text-decoration: none">Add Brand</a></button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($brands as $brand)
                            <tr>
                                <td>{{$brand->id}}</td>
                                <td><img style="width: 70px;height: 70px" src="{{$brand->brandImage()}}"/></td>
                                <td>{{$brand->name}}</td>
                                <td>{{formatDate($brand->created_at)}}</td>
                                <td>{{formatDate($brand->updated_at)}}</td>
                                <td ><i class="fa fa-pencil fa-fw"></i>
                                    <a href="{{url("admin/brands/edit",["id"=>$brand->id])}}" style="text-decoration: none"><i class="fa fa-pencil"></i>Edit</a>
                                </td>
                                <td>
                                    <a href="{{url('admin/brands/delete',["id"=>$brand->id])}}" style="text-decoration: none">
                                        <i class="fa fa-trash-o  fa-fw"></i>
                                        Delete
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
