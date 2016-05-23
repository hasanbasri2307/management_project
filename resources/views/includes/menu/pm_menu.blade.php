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
           
            <li class="{{ $controller == "ProjectController" ? 'active' : '' }} treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Projects</span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $controller == "ProjectController" && $action == "index" ? 'active' : '' }}"><a href="{{ url('project') }}"><i class="fa fa-circle-o"></i>List Projects</a></li>
                </ul>
            </li>
             <li class="{{ $controller == "RabController" ? 'active' : '' }} treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>RAB</span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $controller == "RabController" && $action == "index" ? 'active' : '' }}"><a href="{{ url('rab') }}"><i class="fa fa-circle-o"></i>RAB</a></li>
                    <li class="{{ $controller == "RabController" && $action == "create" ? 'active' : '' }}"><a href="{{ url('rab/create') }}"><i class="fa fa-circle-o"></i>Create RAB</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>