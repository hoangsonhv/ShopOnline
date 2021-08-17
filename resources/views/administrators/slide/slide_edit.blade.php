@extends("administrators.layout")
@section("main")
    <div class="container-fluid col-lg-8" style="position: relative">
        <div class="back" style="position: absolute;top: 13px;right: 40px;z-index: 10">
            <button class="btn btn-primary" onclick="history.back()"> <i class="far fa-hand-point-left"></i> Back</button>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="margin-bottom: 30px">Slide Update</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12" style="padding-bottom:120px">
                <form action="{{url("admin/slides/update",["id"=>$slide->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Image:</label>
                        <input type="file" name="image">
                        <img style="width: 70px;height: 70px" src="{{$slide->slideImage()}}"/>
                    </div>
                    <div class="form-group">
                        <label>Content:</label>
                        <input type="text" class="form-control" value="{{$slide->content}}" name="content">
                    </div>
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text" class="form-control" value="{{$slide->tittle}}" name="title">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
