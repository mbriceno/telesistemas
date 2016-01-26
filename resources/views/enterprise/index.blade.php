@extends('layout.baseadmin')

@section('title')
Empresas
@stop

@section('content')

<div id="page-wrapper">
    <div class="row row-centered">
        <div class="col-xs-12 col-sm-12 col-lg-12">
            <h1 class="page-header">Empresas</h1>
        </div>
                
        <div class="col-xs-12 col-sm-12 col-lg-12">
            <div class="bar-buttons-action">
                <a class="btn btn-success" href="{{ URL::route('admin.empresa.create') }}">Agregar Empresa</a>
            </div>
            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                {!! Session::get('message') !!}
            @endif
            <div class="panel panel-default" style="margin-top:15px">
                <div class="panel-heading">
                    Listado de Empresas
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Razón Social</th>
                                    <th>Nombre comercial</th>
                                    <th>R.I.F.</th>
                                    <th>E-mail</th>
                                    <th>Estatus</th>
                                    <th class="col-lg-2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enterprises as $enterprise)
                                    <tr class="odd gradeX">
                                        <td><a href="{{ URL::route('admin.empresa.show',$enterprise->id) }}">{{$enterprise->razon_social}}</a></td>
                                        <td>{{$enterprise->nombre_comercial}}</td>
                                        <td>{{$enterprise->rif}}</td>
                                        <td>{{$enterprise->email}}</td>
                                        <td>
                                            @if($enterprise->status == 1)
                                                Activo
                                            @else
                                                Inactivo
                                            @endif
                                        </td>
                                        <td class="center box-buttons box-enterprises">
                                            <a href="{{ URL::route('admin.empresa.staff', $enterprise->id) }}" title="Usuarios de empresas" type="button" class="btn btn-primary">
                                                <span class="fa fa-users" aria-hidden="true"></span>
                                            </a>
                                            <a href="{{ URL::route('admin.pagos.listado',$enterprise->id) }}" title="Ordenes de Pago" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span></a>
                                            <a href="{{ URL::route('admin.pagos-empresas.listado',$enterprise->id) }}" title="Ordenes de débito" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span></a>
                                            <a href="{{ URL::route('admin.cuentas_bancarias.edit', $enterprise->id) }}" title="@if($enterprise->bank_account) Modificar cuenta bancaria @else Agregar datos Bancarios @endif" type="button" class="btn btn-primary">
                                                <span class="fa fa-university" aria-hidden="true"></span>
                                            </a>
                                            <a href="{{ URL::route('admin.empresa.edit',$enterprise->id) }}" title="Modificar" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                            {!! Form::open(array('url' => 'admin/empresa/' . $enterprise->id, 'class' => '')) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                                
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-xs-12 col-sm-12 col-lg-12">
            {!! $enterprises->render() !!}
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

@stop
