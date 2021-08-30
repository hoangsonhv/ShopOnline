@extends("administrators.layout")
@section("main")
    <div class="container-fluid col-lg-8" style="position: relative">
        <div class="back" style="position: absolute;top: 13px;right: 40px;z-index: 10">
            <button class="btn btn-primary" onclick="history.back()"> <i class="far fa-hand-point-left"></i> Back</button>
        </div>
        <div class="col-lg-12">
            <h1 class="page-header">Product Add
            </h1>
        </div>
        <!-- /.col-lg-12 -->
        <div style="padding-bottom:120px">
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
                    <label>Information:</label>
                    <input type="text" value="{{old("information")}}" class="form-control" name="information">
                    @error("information")<div class="alert alert-danger" style="width: 100%;" >{{$message}}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Parameter:</label>
                    <input type="text" value="{{old("parameter")}}" class="form-control" name="parameter">
                    @error("parameter")<div class="alert alert-danger" style="width: 100%;" >{{$message}}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Cost:</label>
                    <input type="number" min="0" value="{{old("cost")}}" class="form-control" name="cost">
                    @error("cost")<div class="alert alert-danger" style="width: 100%;" >{{$message}}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Unit Price:</label>
                    <input type="number" min="0" value="{{old("unit_price")}}" class="form-control" name="unit_price">
                    @error("unit_price")<div class="alert alert-danger" style="width: 100%;" >{{$message}}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Promotion Price:</label>
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
                    <input type="text"  class="form-control" name="color" >
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
@endsection
