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
             <li @if($controller == "ClientController") class="active" @endif>
                <a href="{{ url('client') }}">
                    <i class="fa fa-user"></i> <span>Client</span>
                </a>
            </li>
           
            <li class="{{ $controller == "ProjectController" ? 'active' : '' }} treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Projects</span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $controller == "ProjectController" && $action == "index" ? 'active' : '' }}"><a href="{{ url('project') }}"><i class="fa fa-circle-o"></i>List Projects</a></li>
                    <li class="{{ $controller == "ProjectController" && $action == "create" ? 'active' : '' }}"><a href="{{ url('project/create') }}"><i class="fa fa-circle-o"></i> Create Project</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>