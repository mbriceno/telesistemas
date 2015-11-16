@extends('layout.baseadmin')


@section('title')
Plan: {{$plan->nombre}}
@stop

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <h1 class="page-header">{{$plan->nombre}}</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <!-- will be used to show any messages -->
                @if (Session::has('message'))
                    {{ Session::get('message') }}
                @endif

                <div class="btn-group box-right" role="group">
                    <a href="{{ URL::route('admin.plan.index')}}" class="btn btn-outline btn-primary">Volver al listado de planes</a>
                    <a href="{{ URL::route('admin.plan.edit',$plan->id) }}" type="button" class="btn btn-outline btn-primary">Modificar</a>
                </div>

                <div class="well col-xs-12 col-sm-12 col-lg-12" style="margin-top:15px">
                    <dl class="col-lg-9 col-md-9 col-xs-12 col-sm-12 box-detail">
                        <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Descripción:</dt>
                        <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$plan->descripcion}}</dd>
                        <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Duración de la membresía:</dt>
                        <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$plan->tiempo_membresia}} {{$tiempo[$plan->unidad_tiempo]}}</dd>
                        <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Período de Pago:</dt>
                        <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$plan->periodo->nombre}}</dd>
                        <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Tipo:</dt>
                        <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{ strtoupper($plan->tipo) }}</dd>
                        <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Rubro:</dt>
                        <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$plan->rubro->nombre}}</dd>
                        @if($plan->costo > 0)
                        <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Costo:</dt>
                        <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$plan->costo}} Bs.</dd>
                        @else
                        <dt class="col-lg-6 col-md-6 col-xs-12 col-sm-6">Porcentaje a cobrar:</dt>
                        <dd class="col-lg-6 col-md-6 col-xs-12 col-sm-6">{{$plan->porcentaje}}%</dd>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@stop
