@extends("administrators.layout")
@section("main")
    @if(session()->has("error"))
        <div class="alert alert-danger">
            {{session()->get("error")}}
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Product Edit
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="{{url("admin/products/update",["id"=>$item->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" value="{{$item->name}}" class="form-control" name="name" >
                    </div>
                    <div class="form-group">
                        <label>Image:</label>
                        <input type="file" value="{{$item->getImage()}}" name="image" >
                        <img style="width: 70px;height: 70px" src="{{$item->getImage()}}"/>
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <input type="text" value="{{$item->description}}" class="form-control" name="description">
                    </div>
                    <div class="form-group">
                        <label>Unit Price:</label>
                        <input type="number" value="{{$item->unit_price}}" class="form-control" name="unit_price">
                    </div>
                    <div class="form-group">
                        <label>Promotion Price:</label>
                        <input type="number"value="{{$item->promotion_price}}" class="form-control" name="promotion_price">
                    </div>
                    <div class="form-group">
                        <label>Qty:</label>
                        <input type="number" value="{{$item->qty}}" class="form-control" name="qty" >
                    </div>
                    <div class="form-group">
                        <label>New:</label>
                        <input type="number" value="{{$item->new}}" class="form-control" name="new" >
                    </div>
                    <div class="form-group">
                        <label>Color:</label>
                        <select name="color" class="form-control">
                            <option value="{{$item->color}}" hidden>
                                @if($item->color == 0)
                                    <span>Xanh</span>
                                @elseif($item->color == 1)
                                    <span>Đỏ</span>
                                @elseif($item->color == 2)
                                    <span>Tím</span>
                                @elseif($item->color == 3)
                                    <span>Vàng</span>
                                @elseif($item->color == 4)
                                    <span>Trắn</span>
                                @elseif($item->color == 5)
                                    <span>Đen</span>
                                @elseif($item->color == 6)
                                    <span>Hồng</span>
                                @elseif($item->color == 7)
                                    <span>Tím</span>
                                @elseif($item->color == 8)
                                    <span>Tổng Hợp</span>
                                @endif
                            </option>
                            <option value="0">Xanh</option>
                            <option value="1">Đỏ</option>
                            <option value="2">Tím</option>
                            <option value="3">Vàng</option>
                            <option value="4">Lục</option>
                            <option value="5">Cam</option>
                            <option value="6">Hồng</option>
                            <option value="7">Tím</option>
                            <option value="8">Tổng Hợp</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Category Id</label>
                        <select name="id_category" class="form-control" >
                            @foreach($category as $cate)
                                <option value="{{$cate->id}}">
                                    {{$cate->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Brand Id</label>
                        <select name="id_brand" class="form-control" >
                            @foreach($brand as $br)
                                <option value="{{$br->id}}">
                                    {{$br->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
