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
                    <a href="{{ URL::route('admin.pagos.listado', $payment->enterprise->id)}}" class="btn btn-outline btn-primary">Volver al listado de planes</a>
                    <a href="{{ URL::route('admin.pagos.edit',$payment->id) }}" type="button" class="btn btn-outline btn-primary">Modificar</a>
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
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@stop
