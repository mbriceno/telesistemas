@if(Auth::check())
<!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                @role('telesistemas')
                <a class="navbar-brand" href="{{ URL::route('admin') }}">
                    Telesistema Web | Administrador
                </a>
                @endrole
                @role('empresas.vendedor')
                <a class="navbar-brand" href="{{ URL::route('admin') }}">
                    {{Auth::user()->enterprise[0]->razon_social}} | Vendedor
                </a>
                @endrole
                @role('empresas.administrador')
                <a class="navbar-brand" href="{{ URL::route('admin') }}">
                    {{Auth::user()->enterprise[0]->razon_social}} | Administrador
                </a>
                @endrole
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                       {{ Auth::user()->name}} <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ URL::route('admin') }}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ URL::route('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            @include('admin.sidebar')
        </nav>
@endif
