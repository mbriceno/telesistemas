@extends('layout.baseadmin')

@section('title')
Pagos: {{$enterprise->razon_social}}
@stop

@section('content')

<div id="page-wrapper">
    <div class="row row-centered">
        <div class="col-xs-12 col-sm-12 col-lg-12">
            <h1 class="page-header">Pagos: {{$enterprise->razon_social}}</h1>
        </div>
                
        <div class="col-xs-12 col-sm-12 col-lg-12">
            <div class="bar-buttons-action">
                <a class="btn btn-success" href="{{ URL::route('admin.pagos.create_payment', $enterprise->id) }}">Registrar nuevo pago</a>
            </div>
            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                {!! Session::get('message') !!}
            @endif
            <div class="panel panel-default" style="margin-top:15px">
                <div class="panel-heading">
                    Listado de pagos
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
                                @foreach ($payments as $payment)
                                    <tr class="odd gradeX">
                                        <td><a href="{{ URL::route('admin.pagos.show',$payment->id) }}">{{date('d/m/Y', strtotime($payment->fecha_pago))}}</a></td>
                                        <td>{{$payment->periodo}}</td>
                                        <td>{{$payment->monto}} Bs.</td>
                                        <td>{{$payment_status[$payment->payment_status]}}</td>
                                        <td class="center box-buttons">
                                            {!! Form::open(array('url' => 'admin/pagos/' . $payment->id, 'class' => 'pull-right')) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', array('type'=>'submit', 'class' => 'btn btn-danger')) !!}
                                            {!! Form::close() !!}
                                            <a href="{{ URL::route('admin.pagos.edit',$payment->id) }}" title="Modificar" type="button" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                            
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
            {!! $payments->render() !!}
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

@stop
