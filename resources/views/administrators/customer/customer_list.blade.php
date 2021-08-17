@extends("administrators.layout")
@section("main")
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary" style="float: left">List Customer</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Created At</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customer as $ctm)
                            <tr>
                                <td>{{$ctm->name}}</td>
                                <td>
                                    @if($ctm->gender == 0)
                                        <span style="text-align: center">Nam</span>
                                    @elseif($ctm->gender == 1)
                                        <span style="text-align: center">Nữ</span>
                                    @endif
                                </td>
                                <td>{{$ctm->email}}</td>
                                <td>{{$ctm->address}}</td>
                                <td>{{$ctm->phone_number}}</td>
                                <td>{{formatDate($ctm->created_at)}}</td>
                                <td style="padding-left: 0"><a onclick="return confirm('Bạn có chắc muốn xóa không?')" href="{{url('admin/customers/delete',["id"=>$ctm->id])}}" style="text-decoration: none"><i class="fa fa-trash-o  fa-fw"></i>Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
