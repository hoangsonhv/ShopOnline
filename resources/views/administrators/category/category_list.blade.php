@extends("administrators.layout")
@section("main")
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary" style="float: left">Category Table</h4>
                <button type="submit" class="btn btn-primary" style="float: right"><a href="{{url("admin/categories/add")}}" style="color: white;text-decoration: none">Add Category</a></button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="text-align: center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($category as $cat)
                            <tr style="text-align: center">
                                <td>{{$cat->id}}</td>
                                <td>{{$cat->name}}</td>
                                <td>{{formatDate($cat->created_at)}}</td>
                                <td>{{formatDate($cat->updated_at)}}</td>
                                <td style="padding: 35px 20px;overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis;"></i>
                                    <a href="{{url("admin/categories/edit",["id"=>$cat->id])}}" style="text-decoration: none"><i class="fa fa-pencil"></i>Edit</a>
                                </td>
                                <td style="padding: 35px 20px;overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis;">
                                    <a href="{{url('admin/categories/delete',["id"=>$cat->id])}}" style="text-decoration: none" onclick="return confirm('Bạn có chắc muốn xóa không?')">
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
