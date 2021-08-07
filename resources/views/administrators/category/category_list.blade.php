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
                            <tr>
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
                            <tr>
                                <td>{{$cat->id}}</td>
                                <td>{{$cat->name}}</td>
                                <td>{{formatDate($cat->created_at)}}</td>
                                <td>{{formatDate($cat->updated_at)}}</td>
                                <td ><i class="fa fa-pencil fa-fw"></i>
                                    <a href="{{url("admin/categories/edit",["id"=>$cat->id])}}" style="text-decoration: none"><i class="fa fa-pencil"></i>Edit</a>
                                </td>
                                <td>
                                    <a href="{{url('admin/categories/delete',["id"=>$cat->id])}}" style="text-decoration: none">
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
