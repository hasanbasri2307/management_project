<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
       @include("includes.menu.head_menu")

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li @if($controller == "HomeController") class="active" @endif>
                <a href="{{ url('home') }}">
                    <i class="fa fa-th"></i> <span>Home</span>
                </a>
            </li>
            <li class="{{ $controller == 'UserController' ? 'active' : '' }} treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Users</span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $controller = "UserController" && $action == "index" ? 'active' : '' }}"><a href="{{ url('user') }}"><i class="fa fa-circle-o"></i>List User</a></li>
                    <li class="{{ $controller = "UserController" && $action == "create" ? 'active' : '' }}"><a href="{{ url('user/create') }}"><i class="fa fa-circle-o"></i> Create User</a></li>
                </ul>
            </li>
            <li @if($controller == "ClientController") class="active" @endif>
                <a href="{{ url('client') }}">
                    <i class="fa fa-user"></i> <span>Client</span>
                </a>
            </li>
            <li class="{{ $controller == "MpController" ? 'active' : '' }} treeview">
                <a href="#">
                    <i class="fa fa-cube"></i>
                    <span>Master Job</span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $controller == "MpController" && $action == "index" ? 'active' : '' }}"><a href="{{ url('master-job') }}"><i class="fa fa-circle-o"></i>List Master Job</a></li>
                    <li class="{{ $controller == "MpController" && $action == "create" ? 'active' : '' }}"><a href="{{ url('master-job/create') }}"><i class="fa fa-circle-o"></i> Create Master Job</a></li>
                </ul>
            </li>
           
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Projects</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i>List Projects</a></li>
                    <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Create Project</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>