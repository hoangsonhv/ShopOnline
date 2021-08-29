@extends("administrators.layout")
@section("main")
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
                            <tr style="text-align: center">
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
                            <tr style="text-align: center">
                                <td>{{$brand->id}}</td>
                                <td><img style="width: 70px;height: 70px" src="{{$brand->brandImage()}}"/></td>
                                <td>{{$brand->name}}</td>
                                <td>{{formatDate($brand->created_at)}}</td>
                                <td>{{formatDate($brand->updated_at)}}</td>
                                <td style="padding: 35px 20px;overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis;">
                                    <a href="{{url("admin/brands/edit",["id"=>$brand->id])}}" style="text-decoration: none"><i class="fa fa-pencil"></i>Edit</a>
                                </td>
                                <td style="padding: 35px 20px;overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis;">
                                    <a href="{{url('admin/brands/delete',["id"=>$brand->id])}}" style="text-decoration: none" onclick="return confirm('Bạn có chắc muốn xóa không?')">
                                        <i class="fa fa-trash"></i>
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
