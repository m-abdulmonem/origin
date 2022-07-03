<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
{{--            <img src="{{ auth()->user()->picture ?? admin_assets("user2-160x160.jpg") }}" class="img-circle elevation-2" alt="User Image">--}}
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            {!! get_dashboard_menu() !!}
            {{-- <li class="nav-item">
                <a href="{{ route("orders.index") }}" class="nav-link">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>
                        Orders
                        <span class="badge badge-info right">{{ \App\Models\Dashboard\Orders\Order::where("is_read",false)->count() }}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route("settings.index") }}" class="nav-link @menu('settings',1)">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>@lang("Settings")</p>
                </a>
            </li> --}}
            {{--          <li class="nav-header">EXAMPLES</li>--}}

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->



