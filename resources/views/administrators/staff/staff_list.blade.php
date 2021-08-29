@extends("administrators.layout")
@section("main")
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary" style="float: left">Staff</h4>
                <button type="submit" class="btn btn-primary" style="float: right"><a href="{{url("admin/staffs/add")}}" style="color: white;text-decoration: none">Add Staff</a></button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Gender</th>
                            <th>Password</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($staffs as $staff)
                            <tr style="text-align: center">
                                <td>{{$staff->id}}</td>
                                <td>{{$staff->name}}</td>
                                <td>{{$staff->email}}</td>
                                <td style="overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis;">{{$staff->address}}</td>
                                <td>{{$staff->phone_number}}</td>
                                <td>
                                    @if($staff->gender == 0)
                                        <span>Nam</span>
                                    @else
                                        <span>Nữ</span>
                                    @endif
                                </td>
                                <td>{{$staff->password}}</td>
                                <td style="padding: 35px 20px;overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis;"><a href="{{url("admin/staffs/edit",["id"=>$staff->id])}}" style="text-decoration: none"><i class="fa fa-pencil"></i>Edit</a></td>
                                <td style="padding: 35px 20px;overflow: hidden; border-collapse: collapse;white-space: nowrap;text-overflow: ellipsis;"><a onclick="return confirm('Bạn có chắc muốn xóa không?')" href="{{url('admin/staffs/delete',["id"=>$staff->id])}}" style="text-decoration: none"><i class="fa fa-trash"></i>Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
