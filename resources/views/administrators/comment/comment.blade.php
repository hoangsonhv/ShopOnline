@extends("administrators.layout")
@section("main")
    <div class="content-wrapper" style="min-height: 1302.4px;">
        <section class="content">
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary" style="width: 50%;float: left">Product Table</h4>
                        <button type="submit" class="btn btn-primary" style="float: right"><a href="{{url("admin/products/add")}}" style="color: white;text-decoration: none">Add Product</a></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>description</th>
                                    <th>unit_price</th>
                                    <th>promotion_price</th>
                                    <th>Qty</th>
                                    <th>New</th>
                                    <th>Color</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Created_at</th>
                                    <th>Updated_at</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <th>{{$product->id}}</th>
                                        <th><img style="width: 70px;height: 70px" src="{{$product->getImage()}}"/></th>
                                        <th>{{$product->name}}</th>
                                        <th>{{$product->description}}</th>
                                        <th>{{number_format($product->unit_price)}}</th>
                                        <th>{{number_format($product->promotion_price)}}</th>
                                        <th>{{$product->qty}}</th>
                                        <th>
                                            @if($product->new == 0)
                                                <span>SP Thường</span>
                                            @else
                                                <span>SP Mới</span>
                                            @endif
                                        </th>
                                        <th>
                                            {{$product->color}}
                                        </th>
                                        <th>{{$product->category->name}}</th>
                                        <th>{{$product->brand->name}}</th>
                                        <th>{{formatDate($product->created_at)}}</th>
                                        <th>{{formatDate($product->updated_at)}}</th>
                                        <td style="padding: 35px 20px">
                                            <a href="{{url("admin/products/edit",["id"=>$product->id])}}" style="text-decoration: none"><i class="fa fa-pencil"></i>Edit</a>
                                        </td>
                                        <td>
                                            <a href="{{url('admin/products/delete',["id"=>$product->id])}}" style="text-decoration: none">
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
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary" style="width: 50%;float: left">Comment</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Comment</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($comment as $cmt)
                            <tr align="center" style="padding-top:50px;" class="odd gradeC">
                                <td>{{$cmt->id}}</td>
                                <td>{{$cmt->user->name}}</td>
                                <td>{{$cmt->content}}</td>
                                <td>{{formatDate($cmt->created_at)}}</td>
                                <td>{{formatDate($cmt->updated_at)}}</td>
                                <td class="center">
                                    <a href="{{url('admin/comments/delete',["id"=>$cmt->id])}}" style="text-decoration: none">
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
