<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    @if(\Illuminate\Support\Facades\Auth::guard("admin")->check())
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url("admin/admins")}}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Arts Admin </div>
        </a>


    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link " href="{{url("admin/")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home</span></a>
    </li>

    <!-- Divider -->
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

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{url("admin/slides")}}" >
                <i class="fas fa-fw fa-folder"></i>
                <span>Slide</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{url("admin/news")}}" >
                <i class="fas fa-fw fa-folder"></i>
                <span>New</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{url("admin/blogs")}}" >
                <i class="fas fa-fw fa-folder"></i>
                <span>Blog</span>
            </a>
        </li>
        <hr class="sidebar-divider">

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{url("admin/messages")}}">
                <i class="fas fa-fw fa-folder"></i>
                <span>Messenger</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{url("admin/comments")}}">
                <i class="fas fa-fw fa-folder"></i>
                <span>Comment</span>
            </a>
        </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{url("admin/bills")}}" >
            <i class="fas fa-fw fa-folder"></i>
            <span>Bill</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{url("admin/bill-detail")}}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Bill Detail</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->


    <!-- Divider -->
    <hr class="sidebar-divider">

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

            <li class="nav-item active">
                <a class="nav-link " href="{{url("admin/")}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Home</span></a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{url("admin/bills")}}" >
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Bill</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{url("admin/bill-detail")}}">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Bill Detail</span>
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
