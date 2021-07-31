@extends("administrators.layout")
@section("main")
    @if(session()->has("error"))
        <div class="alert alert-danger">
            {{session()->get("error")}}
        </div>
    @endif
    <div class="container-fluid col-lg-8">
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
