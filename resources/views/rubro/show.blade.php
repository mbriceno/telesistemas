@extends('layout.baseadmin')


@section('title')
Rubro: {{$rubro->nombre}}
@stop

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <h1 class="page-header">{{$rubro->nombre}}</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <!-- will be used to show any messages -->
                @if (Session::has('message'))
                    {{ Session::get('message') }}
                @endif

                <div class="well col-xs-12 col-sm-12 col-lg-12" style="margin-top:15px">
                    <h4>Descripción</h4>
                    <p>{{$rubro->descripcion}}</p>
                </div>

                <div class="btn-group box-right" role="group">
                    <a href="{{ URL::route('admin.rubro.index')}}" class="btn btn-outline btn-primary">Volver al listado de rubros</a>
                    <a href="{{ URL::route('admin.rubro.edit',$rubro->id) }}" type="button" class="btn btn-outline btn-primary">Modificar</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@stop
