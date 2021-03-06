@extends("administrators.layout")
@section("main")
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary" style="float: left">Message</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Content</th>
                            <th>Status</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)
                            <tr style="text-align: center">
                                <td>{{$message->name}}</td>
                                <td>{{$message->email}}</td>
                                <td>{{$message->content}}</td>
                                <td>
                                    <form action="{{url('admin/messages/update',["id"=>$message->id])}}" method="get">
                                        <select name="status" style="border-radius: 5px;height: 30px">
                                            <option hidden>
                                                @if($message->status == 0)
                                                    Hide
                                                @else
                                                    Presently
                                                @endif
                                            </option>
                                            <option  value="0">Hide</option>
                                            <option  value="1">Presently</option>
                                        </select>
                                        <button type="submit" class="btn btn-success" style="width: 70px;height: 30px;padding: 0;margin-bottom: 2px">Browser</button>
                                    </form>
                                </td>
                                <td><a onclick="return confirm('B???n c?? ch???c mu???n x??a kh??ng?')" href="{{url('admin/messages/delete',["id"=>$message->id])}}" style="text-decoration: none"><i class="fa fa-trash-o  fa-fw"></i>Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
