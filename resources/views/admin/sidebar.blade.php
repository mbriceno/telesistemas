<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <!--li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
            </li-->
            <li>
                <a href="{{ URL::route('admin') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            @role('superadmin|telesistemas')
            <li>
                <a href="{{ URL::route('admin.empresa.index') }}"><i class="fa fa-dashboard fa-fw"></i> Empresas</a>
            </li>
            <li>
                <a href="{{ URL::route('admin.plan.index') }}"><i class="fa fa-dashboard fa-fw"></i> Planes y servicios</a>
            </li>
            <li>
                <a href="{{ URL::route('admin.rubro.index') }}"><i class="fa fa-dashboard fa-fw"></i> Rubros</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-dashboard fa-fw"></i> Configuración</a>
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="{{ URL::route('admin.bancos.index') }}"><i class="fa fa-dashboard fa-fw"></i> Bancos</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('admin.cuentas_bancarias.index') }}"><i class="fa fa-dashboard fa-fw"></i> Cuetas Bancarias</a>
                    </li>
                </ul>
            </li>
            @endrole
            @role('empresas.vendedor|empresas.administrador')
            <li>
                <a href="{{ URL::route('sale-point.orden-venta.create') }}"><i class="fa fa-dashboard fa-fw"></i> Nueva Venta</a>
            </li>
            @endrole
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->