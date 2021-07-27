@extends("administrators.layout")
@section("main")
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Product Table</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr align="center">
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
                            <tr class="odd gradeX" align="center">
                                <td>{{$cat->id}}</td>
                                <td>{{$cat->name}}</td>
                                <td>{{formatDate($cat->created_at)}}</td>
                                <td>{{formatDate($cat->updated_at)}}</td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{url("admin/categories/edit",["id"=>$cat->id])}}">Edit</a></td>
                                <td class="center">
                                    <a href="{{url("admin/categories/delete",["id"=>$cat->id])}}" style="text-decoration: none">
                                        <form method="post" action="{{url("admin/categories/delete",["id"=>$cat->id])}}">
                                            @method('DELETE')
                                            @csrf
                                            <i class="fa fa-trash-o  fa-fw"></i>
                                            Delete
                                        </form>
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
