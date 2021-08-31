<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    @if(\Illuminate\Support\Facades\Auth::guard("admin")->check())
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url("admin/")}}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Arts Admin </div>
        </a>


    <!-- Divider -->
{{--    <hr class="sidebar-divider my-0">--}}

{{--    <!-- Nav Item - Dashboard -->--}}
{{--    <li class="nav-item active">--}}
{{--        <a class="nav-link " href="{{url("admin/")}}">--}}
{{--            <i class="fas fa-fw fa-tachometer-alt"></i>--}}
{{--            <span>Home</span></a>--}}
{{--    </li>--}}

    <!-- Divider -->
    <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link collapsed" style="a:active{color: yellow;}" onclick="class Class {active}" href="{{url("admin/bills")}}" >
                <i class="fas fa-fw fa-folder"></i>
                <span>Orders</span>
                @php $bill = \App\Models\Bill::where("status",0)->orwhere("status",1)->get() @endphp
                @if(count($bill) > 0)
                    <span class="badge badge-danger navbar-badge">{{count($bill)}}</span>
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" style="a:active{color: yellow;}" onclick="class Class {active}" href="{{url("admin/orders")}}" >
                <i class="fas fa-fw fa-folder"></i>
                <span>Pending Order</span>
                @php $order = \App\Models\Order::where("status",0)->orwhere("status",1)->get() @endphp
                @if(count($order) > 0)
                    <span class="badge badge-danger navbar-badge">{{count($order)}}</span>
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" style="a:active{color: yellow;}" onclick="class Class {active}" href="{{url("admin/payments")}}" >
                <i class="fas fa-fw fa-folder"></i>
                <span>Payment VNPAY</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{url("admin/messages")}}">
                <i class="fas fa-fw fa-folder"></i>
                <span>Messenger</span>
                @php $mes = \App\Models\Messenger::where("status",0)->get() @endphp
                @if(count($mes) > 0)
                    <span class="badge badge-danger navbar-badge">{{count($mes)}}</span>
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{url("admin/comments")}}">
                <i class="fas fa-fw fa-folder"></i>
                <span>Comment</span>
                @php $cmt = \App\Models\Comment::where("status",0)->get() @endphp
                @if(count($cmt) > 0)
                    <span class="badge badge-danger navbar-badge">{{count($cmt)}}</span>
                @endif
            </a>
        </li>

        <hr class="sidebar-divider">
    <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{url("admin/products")}}"  >
                <i class="fas fa-fw fa-folder"></i>
                <span>Product</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{url("admin/categories")}}" >
                <i class="fas fa-fw fa-folder"></i>
                <span>Category</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{url("admin/brands")}}" >
                <i class="fas fa-fw fa-folder"></i>
                <span>Brand</span>
            </a>
        </li>

{{--        <li class="nav-item">--}}
{{--            <a class="nav-link collapsed" href="{{url("admin/slides")}}" >--}}
{{--                <i class="fas fa-fw fa-folder"></i>--}}
{{--                <span>Slide</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link collapsed" href="{{url("admin/news")}}" >--}}
{{--                <i class="fas fa-fw fa-folder"></i>--}}
{{--                <span>New</span>--}}
{{--            </a>--}}
{{--        </li>--}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{url("admin/blogs")}}" >
                <i class="fas fa-fw fa-folder"></i>
                <span>Blog</span>
            </a>
        </li>
        <hr class="sidebar-divider">


    <!-- Nav Item - Utilities Collapse Menu -->


    <!-- Divider -->


    <!-- Heading -->
    <div class="sidebar-heading">

    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{url("admin/teams")}}" >
            <i class="fas fa-fw fa-folder"></i>
            <span>Team</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{url("admin/staffs")}}" >
            <i class="fas fa-fw fa-folder"></i>
            <span>Staff</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{url("admin/users")}}" >
            <i class="fas fa-fw fa-folder"></i>
            <span>User</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{url("admin/customers")}}" >
            <i class="fas fa-fw fa-folder"></i>
            <span>Customer</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{url("admin/logout")}}" >
            <i class="fas fa-fw fa-cog"></i>
            <span>Logout</span>
        </a>
    </li>

    <!-- Nav Item - Tables -->
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    @elseif(\Illuminate\Support\Facades\Auth::guard("staff")->check()){
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url("admin/staffs")}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Arts Staff </div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{url("admin/bills")}}" >
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Bill</span>
                    @php $bill = \App\Models\Bill::where("status",0)->get() @endphp
                    @if(count($bill) > 0)
                        <span class="badge badge-danger navbar-badge">{{count($bill)}}</span>
                    @endif
                </a>
            </li>
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{url("admin/logout")}}" >
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    @endif
</ul>
