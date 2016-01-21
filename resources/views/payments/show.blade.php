@extends('layout.baseadmin')


@section('title')
Pagos: {{$payment->enterprise->razon_social}}
@stop

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <h1 class="page-header">{{$payment->enterprise->razon_social}}</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <!-- will be used to show any messages -->
                @if (Session::has('message'))
                    {{ Session::get('message') }}
                @endif

                <div class="btn-group box-right" role="group">
                    <a href="{{ URL::route('admin.pagos.listado', $payment->enterprise->id)}}" class="btn btn-outline btn-primary">Volver al listado de pagos</a>
                    @role('superadmin|telesistemas')
                    <a href="{{ URL::route('admin.pagos.edit',$payment->id) }}" type="button" class="btn btn-outline btn-primary">Modificar</a>
                    @endrole
                </div>

                <div class="well col-xs-12 col-sm-12 col-lg-12" style="margin-top:15px">
                    <dl class="col-lg-9 col-md-9 col-xs-12 col-sm-12 box-detail">
                        <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Fecha de pago:</dt>
                        <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$payment->fecha_pago}}</dd>
                        <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Factura asociada:</dt>
                        <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$payment->factura}}</dd>
                        <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Período:</dt>
                        <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$payment->periodo}}</dd>
                        <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Método de pago:</dt>
                        <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{ $payments_methods[$payment->tipo_pago] }}</dd>
                        <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Monto facturado:</dt>
                        <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$payment->monto}} Bs.</dd>
                        <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Estado de pago:</dt>
                        <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$payment_status[$payment->payment_status]}}</dd>
                    </dl>
                </div>

                <div class="panel panel-default" style="margin-top:15px;overflow:hidden;clear:both">
                    <div class="panel-heading">
                        <h4>Abonos realizados</h4>
                    </div>

                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Tipo de Pago</th>
                                        <th>Número de referencia</th>
                                        <th>Monto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payment->payment_transactions as $transaction)
                                        <tr class="odd gradeX">
                                            <td>{{ date('d/m/Y', strtotime($transaction->fecha_transaccion)) }}</td>
                                            <td>{{ $payments_methods[$transaction->tipo_pago] }}</td>
                                            <td>{{ $transaction->nro_referencia }}</td>
                                            <td>{{ $transaction->monto }} Bs.</td>
                                        </tr>
                                    @endforeach    
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@stop
