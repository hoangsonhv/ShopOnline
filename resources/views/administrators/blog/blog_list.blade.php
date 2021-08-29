@extends("administrators.layout")
@section("main")
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary" style="float: left">Blog</h4>
                <button type="submit" class="btn btn-primary" style="float: right"><a href="{{url("admin/blogs/add")}}" style="color: white;text-decoration: none">Add Blog</a></button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="col-md-6">
                        <h1>aaa</h1>
                    </div>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center">
                            <th>ID</th>
                            <th>Image</th>
                            <th>Image 2</th>
                            <th>Image 3</th>
                            <th>Content</th>
                            <th>Summary</th>
                            <th>Outstanding</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($blogs as $blog)
                            <tr style="text-align: center">
                                <td>{{$blog->id}}</td>
                                <td><img style="width: 70px;height: 70px" src="{{$blog->blogImage()}}"/></td>
                                <td><img style="width: 70px;height: 70px" src="{{$blog->aImage()}}"/></td>
                                <td><img style="width: 70px;height: 70px" src="{{$blog->bImage()}}"/></td>
                                <td>{{$blog->content}}</td>
                                <td>{{$blog->summary}}</td>
                                <td>{{$blog->outstanding}}</td>
                                <td>{{$blog->title}}</td>
                                <td>{{$blog->date}}</td>
                                <td style="padding: 35px 20px;overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis;"><a href="{{url("admin/blogs/edit",["id"=>$blog->id])}}" style="text-decoration: none"><i class="fa fa-pencil"></i>Edit</a></td>
                                <td style="padding: 35px 20px;overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis;"><a onclick="return confirm('Bạn có chắc muốn xóa không?')" href="{{url('admin/blogs/delete',["id"=>$blog->id])}}" style="text-decoration: none"><i class="fa fa-trash"></i>Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
