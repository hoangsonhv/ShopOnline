@extends("administrators.layout")
@section("main")
    <div class="content-wrapper" style="min-height: 1302.4px;">
        <section class="content">
            <div class="container-fluid" style="position: relative">
                <div class="back" style="position: absolute;top: 13px;right: 40px;z-index: 10">
                    <button class="btn btn-primary" onclick="history.back()"> <i class="far fa-hand-point-left"></i> Back</button>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary" style="width: 50%;float: left">Comment</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr align="center">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Comment</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($read_reply as $reply)
                                    <tr align="center" style="padding-top:50px;" class="odd gradeC">
                                        <td>{{$reply->id}}</td>
                                        <td>{{$reply->user->name}}</td>
                                        <td>{{$reply->content}}</td>
                                        <td>{{formatDate($reply->created_at)}}</td>
                                        <td>{{formatDate($reply->updated_at)}}</td>
                                        <td class="center">
                                            <a href="{{url('admin/reply/delete',["id"=>$reply->id])}}" style="text-decoration: none">
                                                <i class="fa fa-trash-o  fa-fw"></i>
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

