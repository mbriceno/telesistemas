@extends('layout.baseadmin')

@section('title')
Pagos a: {{$enterprise->razon_social}}
@stop

@section('content')

<div id="page-wrapper">
    <div class="row row-centered">
        <div class="col-xs-12 col-sm-12 col-lg-12">
            <h1 class="page-header">Débitos: {{$enterprise->razon_social}}</h1>
        </div>
                
        <div class="col-xs-12 col-sm-12 col-lg-12">
            <div class="bar-buttons-action">
                @role('superadmin|telesistemas')
                <a class="btn btn-success" href="{{ URL::route('admin.pagos-empresas.create_debit', $enterprise->id) }}">Nueva orden de débito</a>
                @endrole
            </div>
            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                {!! Session::get('message') !!}
            @endif
            <div class="panel panel-default" style="margin-top:15px">
                <div class="panel-heading">
                    Listado de debitos
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Periodo</th>
                                    <th>Monto</th>
                                    <th>Estatus</th>
                                    <th class="col-lg-3">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($debits as $debit)
                                    <tr class="odd gradeX">
                                        <td><a href="{{ URL::route('admin.pagos-empresas.show', $debit->id) }}">{{date('d/m/Y', strtotime($debit->fecha_debito))}}</a></td>
                                        <td>{{$debit->periodo}}</td>
                                        <td>{{$debit->monto}} Bs.</td>
                                        <td>{{$status[$debit->status]}}</td>
                                        <td class="center box-buttons">
                                            @role('superadmin|telesistemas')
                                            <a href="{{ URL::route('admin.pagos-empresas.edit',$debit->id) }}" title="Modificar" type="button" class="btn btn-primary pull-right">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Modificar
                                            </a>
                                            @endrole
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
            {!! $debits->render() !!}
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

@stop
