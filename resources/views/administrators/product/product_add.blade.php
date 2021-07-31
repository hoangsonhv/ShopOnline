@extends("administrators.layout")
@section("main")
    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Product Add
            </h1>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-7" style="padding-bottom:120px">
            <form action="{{url("admin/products/save")}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" value="{{old("name")}}" class="form-control" name="name" >
                    @error("name")<div class="alert alert-danger" style="width: 100%;" >{{$message}}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Image:</label>
                    <input type="file" value="{{old("image")}}" name="image" required>
                    @error("image")<div class="alert alert-danger" style="width: 100%;" >{{$message}}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Description:</label>
                    <input type="text" value="{{old("description")}}" class="form-control" name="description">
                    @error("description")<div class="alert alert-danger" style="width: 100%;" >{{$message}}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Unit_Price:</label>
                    <input type="number" min="0" value="{{old("unit_price")}}" class="form-control" name="unit_price">
                    @error("unit_price")<div class="alert alert-danger" style="width: 100%;" >{{$message}}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Promotion_Price:</label>
                    <input type="number" min="0" value="{{old("promotion_price")}}" class="form-control" name="promotion_price">
                    @error("promotion_price")<div class="alert alert-danger" style="width: 100%;" >{{$message}}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Qty:</label>
                    <input type="number" min="0" class="form-control" name="qty" >
                    @error("qty")<div class="alert alert-danger" style="width: 100%;" >{{$message}}</div>@enderror
                </div>
                <div class="form-group">
                    <label>New:</label>
                    <input type="number" min="0" class="form-control" name="new" >
                    @error("new")<div class="alert alert-danger" style="width: 100%;" >{{$message}}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Color:</label>
                    <select name="color"  class="form-control">
                        <option value="0">Xanh</option>
                        <option value="1">Đỏ</option>
                        <option value="2">Tím</option>
                        <option value="3">Vàng</option>
                        <option value="4">Trắng</option>
                        <option value="5">Đen</option>
                        <option value="6">Hồng</option>
                        <option value="7">Tím</option>
                        <option value="8">Tổng Hợp</option>
                    </select>
                    @error("color")<div class="alert alert-danger" style="width: 100%;" >{{$message}}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Category Id</label>
                    <select name="id_category" class="form-control" >
                        <option value="0">Select a category</option>
                        @foreach($category as $cat)
                            <option  @if(old("id_category")==$cat->id)selected @endif value="{{$cat->id}}">
                                {{$cat->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Brand Id</label>
                    <select name="id_brand" class="form-control" >
                        <option value="0">Select a Brand</option>
                        @foreach($brand as $br)
                            <option  @if(old("id_brand")==$br->id)selected @endif value="{{$br->id}}">
                                {{$br->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Add</button>
            </form>
        </div>
    </div>
    </div>
@endsection
