@extends('layout.baseadmin')


@section('title')
Empresa: {{$empresa->razon_social}}
@stop

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <h1 class="page-header">{{$empresa->razon_social}}</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <!-- will be used to show any messages -->
                @if (Session::has('message'))
                    {!! Session::get('message') !!}
                @endif

                <div class="btn-group box-right" role="group">
                    <a href="{{ URL::route('admin.empresa.index')}}" class="btn btn-outline btn-primary">Volver al listado de empresas</a>
                    <a href="{{ URL::route('admin.empresa.edit',$empresa->id) }}" type="button" class="btn btn-outline btn-primary">Modificar</a>
                </div>

                <div class="well col-xs-12 col-sm-12 col-lg-12" style="margin-top:15px">
                    <dl class="col-lg-9 col-md-9 col-xs-12 col-sm-12 box-detail">
                        <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Nombre comercial:</dt>
                        <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$empresa->nombre_comercial}}</dd>
                        <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">R.I.F:</dt>
                        <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$empresa->rif}}</dd>
                        <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Dirección:</dt>
                        <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{ $empresa->direccion }}</dd>
                        <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Teléfono:</dt>
                        <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$empresa->telefono}}</dd>
                        <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">E-mail:</dt>
                        <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$empresa->email}}</dd>
                        <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Web:</dt>
                        <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$empresa->web}}</dd>
                    </dl>
                </div>
                <div class="row box-info-show">
                    @foreach($empresa->representatives as $representante)
                    <h3>@if($representante->tipo == 'legal') Representante Legal @else Persona de contacto @endif</h3>
                    <div class="well col-xs-12 col-sm-12 col-lg-12" style="margin-top:15px">
                        <dl class="col-lg-9 col-md-9 col-xs-12 col-sm-12 box-detail">
                            <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Nombre y Apellido:</dt>
                            <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$representante->nombre}} {{$representante->apellido}}</dd>
                            <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">C.I:</dt>
                            <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$representante->ci}}</dd>
                            <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">R.I.F:</dt>
                            <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$representante->rif}}</dd>
                            <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Teléfono:</dt>
                            <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$representante->telefono}}</dd>
                            <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">E-mail:</dt>
                            <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$representante->email}}</dd>
                            <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Dirección:</dt>
                            <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{ $representante->direccion }}</dd>
                        </dl>
                        <div class="btn-group" role="group">
                            <a href="{{ URL::route('admin.representante.edit',$representante->id) }}" type="button" class="btn btn-outline btn-primary">Modificar información</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row box-info-show">
                    <h3>Información bancaria</h3>
                    <div class="well col-xs-12 col-sm-12 col-lg-12" style="margin-top:15px">
                        <dl class="col-lg-9 col-md-9 col-xs-12 col-sm-12 box-detail">
                            <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Banco:</dt>
                            <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$empresa->bank_account->bank->nombre}}</dd>
                            <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Titular:</dt>
                            <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$empresa->bank_account->titular}}</dd>
                            <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">C.I/R.I.F:</dt>
                            <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$empresa->bank_account->rif_ci}}</dd>
                            <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Número de cuenta:</dt>
                            <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$empresa->bank_account->nro_cuenta}}</dd>
                            <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Tipo:</dt>
                            <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$tipo[$empresa->bank_account->tipo]}}</dd>
                        </dl>
                        <div class="btn-group" role="group">
                            <a href="{{ URL::route('admin.cuentas_bancarias.edit', $empresa->id) }}" type="button" class="btn btn-outline btn-primary">Modificar datos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@stop
