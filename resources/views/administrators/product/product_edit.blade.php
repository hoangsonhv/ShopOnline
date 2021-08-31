@extends("administrators.layout")
@section("main")
    <div class="container-fluid col-lg-8" style="position: relative">
        <div class="back" style="position: absolute;top: 13px;right: 40px;z-index: 10">
            <button class="btn btn-primary" onclick="history.back()"> <i class="far fa-hand-point-left"></i> Back</button>
        </div>
        <div class="col-lg-12">
            <h1 class="page-header">Product Edit
            </h1>
        </div>
        <!-- /.col-lg-12 -->
        <div style="padding-bottom:120px">
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
                    <label>Information:</label>
                    <input type="text" value="{{$item->information}}" class="form-control" name="information">
                </div>
                <div class="form-group">
                    <label>Parameter:</label>
                    <input type="text" value="{{$item->parameter}}" class="form-control" name="parameter">
                </div>
                <div class="form-group">
                    <label>Cost:</label>
                    <input type="number" value="{{$item->cost}}" class="form-control" name="cost">
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
                    <input type="text" value="{{$item->color}}" class="form-control" name="color" >
                </div>
                <div class="form-group">
                    <label>Category Id</label>
                    <select name="id_category" class="form-control">
                        @foreach($category as $cate)
                            <option value="{{$cate->id}}" hidden>{{$item->category->name}}</option>
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
                            <option value="{{$br->id}}" hidden>{{$item->brand->name}}</option>
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
@endsection
