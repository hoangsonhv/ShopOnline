@extends("administrators.layout")
@section("main")
    <div class="container-fluid col-lg-8" style="position: relative">
        <div class="back" style="position: absolute;top: 13px;right: 40px;z-index: 10">
            <button class="btn btn-primary" onclick="history.back()"> <i class="far fa-hand-point-left"></i> Back</button>
        </div>
        <div class="col-lg-12">
            <h1 class="page-header">Categopry Edit
            </h1>
        </div>
        <!-- /.col-lg-12 -->
        <div style="padding-bottom:120px">
            <form action="{{url("admin/categories/update",["id"=>$cate1->id])}}" method="post">
                @csrf
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" value="{{$cate1->name}}" class="form-control" name="name" >
                </div>
                <button type="submit" class="btn btn-primary btn-block">Update</button>
            </form>
        </div>
    </div>
@endsection
