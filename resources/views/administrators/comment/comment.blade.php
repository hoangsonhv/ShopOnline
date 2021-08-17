@extends("administrators.layout")
@section("main")
    <div class="content-wrapper" style="min-height: 1302.4px;">
        <section class="content">
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary" style="width: 50%;float: left">List Product</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr style="text-align: center">
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Detail Comment</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr style="text-align: center">
                                        <th>{{$product->id}}</th>
                                        <th><img style="width: 70px;height: 70px" src="{{$product->getImage()}}"/></th>
                                        <th style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis;width: 200px;-webkit-line-clamp:3">{{$product->name}}</th>
                                        <th><a href="{{url("admin/comments/detail",["id"=>$product->id])}}">Detail</a></th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary" style="width: 50%;float: left">All Comment</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Comment</th>
                            <th>Product</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($comment as $cmt)
                            <tr align="center" style="padding-top:50px;" class="odd gradeC">
                                <td>{{$cmt->id}}</td>
                                <td>{{$cmt->user->name}}</td>
                                <td>{{$cmt->content}}</td>
                                <td>{{$cmt->product->name}}</td>
                                <td>{{formatDate($cmt->updated_at)}}</td>
                                <td>
                                    <form action="{{url('admin/comments/update',["id"=>$cmt->id])}}" method="get">
                                        <select name="up_status" style="border-radius: 5px;height: 30px">
                                            <option hidden>
                                                @if($cmt->status == 0)
                                                    Hide
                                                @else
                                                    Presently
                                                @endif
                                            </option>
                                            <option  value="0">Hide</option>
                                            <option  value="1">Presently</option>
                                        </select>
                                        <button type="submit" class="btn btn-success" style="width: 70px;height: 30px;padding: 0;margin-bottom: 2px">Browser</button>
                                    </form>
                                </td>
                                <td class="center">
                                    <a href="{{url('admin/comments/delete',["id"=>$cmt->id])}}" style="text-decoration: none" onclick="return confirm('Bạn có chắc muốn xóa không?')">
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
        </section>
    </div>
@endsection
