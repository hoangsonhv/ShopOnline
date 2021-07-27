@extends("administrators.layout")
@section("main")
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
                        <input type="file" value="{{$item->getImage()}}" name="image" required>
                        <img style="width: 70px;height: 70px" src="{{$item->getImage()}}"/>
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <input type="text" value="{{$item->description}}" class="form-control" name="description">
                    </div>
                    <div class="form-group">
                        <label>Unit Price:</label>
                        <input type="number" min="0" value="{{$item->unit_price}}" class="form-control" name="unit_price">
                    </div>
                    <div class="form-group">
                        <label>Promotion Price:</label>
                        <input type="number" min="0" value="{{$item->promotion_price}}" class="form-control" name="promotion_price">
                    </div>
                    <div class="form-group">
                        <label>Qty:</label>
                        <input type="number" value="{{$item->qty}}" class="form-control" name="qty" >
                    </div>
                    <div class="form-group">
                        <label>Category_id</label>
                        <select name="id_category" class="form-control" >
                            <option value="0">Select a category</option>
                            @foreach($category as $cat)
                                <option  @if(old("id_category")==$cat->id)selected @endif value="{{$cat->id}}">
                                    {{$cat->name}}
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
