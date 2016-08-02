<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        @include("includes.menu.head_menu")
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li @if($controller == "HomeController") class="active" @endif>
                <a href="{{ url('home') }}">
                    <i class="fa fa-th"></i> <span>Dashboard</span>

                </a>
            </li>
            <li class="{{ $controller == "ProjectController" ? 'active' : '' }} treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Projects</span>

                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url("project/client/".Auth::user()->id) }}"><i class="fa fa-circle-o"></i> List Projects</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>