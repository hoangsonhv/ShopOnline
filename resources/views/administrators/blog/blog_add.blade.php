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
                <h1 class="page-header" style="margin-bottom: 30px">Blog Add</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-12" style="padding-bottom:120px">
                <form action="{{url("admin/blogs/save")}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Image: 1</label>
                        <input type="file" name="image" required>
                        @error("image")
                        <div class="alert alert-danger" style="width: 100%;">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Image: 2</label>
                        <input type="file" name="img2" required>
                        @error("img2")
                        <div class="alert alert-danger" style="width: 100%;">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Image: 3</label>
                        <input type="file" name="img3" required>
                        @error("img3")
                        <div class="alert alert-danger" style="width: 100%;">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Content:</label>
                        <input type="text" class="form-control" name="content">
                        @error("content")
                        <div class="alert alert-danger" style="width: 100%;">{{$message}}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Title:</label>
                        <input type="text" class="form-control" name="title">
                        @error("title")
                        <div class="alert alert-danger" style="width: 100%;">{{$message}}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Date:</label>
                        <input type="date" class="form-control" name="date">
                        @error("date")
                        <div class="alert alert-danger" style="width: 100%;">{{$message}}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection
