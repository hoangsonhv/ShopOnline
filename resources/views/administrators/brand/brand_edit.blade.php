@extends("administrators.layout")
@section("main")
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Categpry Edit
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="{{url("admin/categories/update",["id"=>$cate->id])}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" value="{{$cate->name}}" class="form-control" name="name" >
                    </div>
                    <div class="form-group">
                        <label>Image:</label>
                        <input type="file" value="{{$item->brandImage()}}" name="image" >
                        <img style="width: 70px;height: 70px" src="{{$item->brandImage()}}"/>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
