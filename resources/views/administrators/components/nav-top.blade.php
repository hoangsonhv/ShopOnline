<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <form class="form-inline">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
    </form>
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - Login Information -->
        <li class="nav-item dropdown no-arrow">
            @if( \Illuminate\Support\Facades\Auth::guard('staff')->check())
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                     aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{url("admin/change-staff")}}">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Setting
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{url("admin/logout")}}" onclick="return confirm('Bạn muốn đăng xuất?')">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400" ></i>
                        Logout
                    </a>
                </div>
            @elseif(\Illuminate\Support\Facades\Auth::guard('admin')->check())
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                     aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{url("admin/admins/add")}}">
                        <i class="fas fa-plus-circle mr-2 text-gray-400"></i>
                        Add
                    </a>
                    @php  $id = \Illuminate\Support\Facades\Auth::id(); @endphp
                    <a class="dropdown-item" href="{{url("admin/admins/edit",["id"=>$id])}}">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Edit
                    </a>
                    <a class="dropdown-item" href="{{url("admin/logout")}}" onclick="return confirm('Bạn muốn đăng xuất?')" >
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>

                </div>
            @endif
        </li>
    </ul>
</nav>
<div class="container-fluid">
    @if(session()->has("success"))
        <div class="alert alert-info">
            {{session()->get("success")}}
        </div>
    @elseif(session()->has("error"))
        <div class="alert alert-danger">
            {{session()->get("error")}}
        </div>
    @endif
</div>
