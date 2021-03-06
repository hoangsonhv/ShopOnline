@extends("administrators.layout")
@section("main")
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
                            <th>Delete</th>
                            <th>Edit</th>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Root Price</th>
                            <th>Price</th>
                            <th>Reduced Price</th>
                            <th>Qty</th>
                            <th>Sold</th>
                            <th>New</th>
                            <th>Color</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>information</th>
                            <th>parameter</th>
                            <th>Date</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                           @foreach($products as $product)
                               <tr>
                                   <td style="padding: 35px 20px;overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis;">
                                       <a onclick="return confirm('Bạn có chắc muốn xóa không?')" href="{{url('admin/products/delete',["id"=>$product->id])}}" style="text-decoration: none">
                                           <i class="fa fa-trash"></i>
                                           Delete
                                       </a>
                                   </td>
                                   <td style="padding: 35px 20px;overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis;">
                                       <a href="{{url("admin/products/edit",["id"=>$product->id])}}" style="text-decoration: none"><i class="fa fa-pencil"></i>Edit</a>
                                   </td>
                                   <th>{{$product->id}}</th>
                                   <th><img style="width: 70px;height: 70px" src="{{$product->getImage()}}"/></th>
                                   <th style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis;width: 200px;-webkit-line-clamp:3">{{$product->name}}</th>
                                   <th>{{number_format($product->cost)}}</th>
                                   <th>{{number_format($product->unit_price)}}</th>
                                   <th>{{number_format($product->promotion_price)}}</th>
                                   <th>{{$product->qty}}</th>
                                   <th>{{$product->pro_pay}}</th>
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
                                   <th style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis;width: 500px;">
                                       @if($product->information !=null)
                                           {{$product->information}}
                                       @else
                                           <span>Null</span>
                                       @endif
                                   </th>
                                   <th style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis;width: 500px;">
                                       @if($product->parameter !=null)
                                           {{$product->parameter}}
                                       @else
                                           <span>Null</span>
                                       @endif
                                   </th>
                                   <th>{{formatDate($product->created_at)}}</th>
                                   <th style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis;width: 500px;">{{$product->description}}</th>
                               </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
