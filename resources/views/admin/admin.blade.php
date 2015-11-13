@extends('layout.baseadmin')

@section('title')
Administrador
@stop

@section('additional-class')
@role('empresas.vendedor|empresas.administrador')
wrapper-ventas
@endrole
@stop

@section('content')

<div id="page-wrapper">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
        </div>
        <!-- /#page-wrapper -->

@stop
