@extends("administrators.layout")
@section("main")
    <div class="container-fluid col-lg-8" style="position: relative">
        <div class="back" style="position: absolute;top: 13px;right: 40px;z-index: 10">
            <button class="btn btn-primary" onclick="history.back()"> <i class="far fa-hand-point-left"></i> Back</button>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="margin-bottom: 30px">Blog Update</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12" style="padding-bottom:120px">
                <form action="{{url("admin/blogs/update",["id"=>$blog->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Image:</label>
                        <input type="file" name="image">
                        <img style="width: 70px;height: 70px" src="{{$blog->blogImage()}}"/>
                    </div>
                    <div class="form-group">
                        <label>Image 2:</label>
                        <input type="file" name="image2">
                        <img style="width: 70px;height: 70px" src="{{$blog->aImage()}}"/>
                    </div>
                    <div class="form-group">
                        <label>Image 3:</label>
                        <input type="file" name="image3">
                        <img style="width: 70px;height: 70px" src="{{$blog->bImage()}}"/>
                    </div>
                    <div class="form-group">
                        <label>Content:</label>
                        <input type="text" class="form-control" value="{{$blog->content}}" name="content">
                    </div>
                    <div class="form-group">
                        <label>Summary:</label>
                        <input type="text" class="form-control" value="{{$blog->summary}}" name="summary">
                    </div>
                    <div class="form-group">
                        <label>Outstanding:</label>
                        <input type="text" class="form-control" value="{{$blog->outstanding}}" name="outstanding">
                    </div>
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text" class="form-control" value="{{$blog->title}}" name="title">
                    </div>
                    <div class="form-group">
                        <label>Date:</label>
                        <input type="date" class="form-control" value="{{$blog->date}}" name="date">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
