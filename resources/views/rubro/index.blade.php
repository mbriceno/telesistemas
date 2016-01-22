@extends('layout.baseadmin')

@section('title')
Rubros
@stop

@section('content')

<div id="page-wrapper">
    <div class="row row-centered">
        <div class="col-xs-12 col-sm-12 col-lg-12">
            <h1 class="page-header">Rubros</h1>
        </div>
                
        <div class="col-xs-12 col-sm-12 col-lg-12">
            <div class="bar-buttons-action">
                <a class="btn btn-success" href="{{ URL::route('admin.rubro.create') }}">Agregar Rubro</a>
            </div>
            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                {!! Session::get('message') !!}
            @endif
            <div class="panel panel-default" style="margin-top:15px">
                <div class="panel-heading">
                    Listado de Rubros
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th class="col-lg-3">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rubros as $rubro)
                                    <tr class="odd gradeX">
                                        <td><a href="{{ URL::route('admin.rubro.show',$rubro->id) }}">{{$rubro->nombre}}</a></td>
                                        <td>{{$rubro->descripcion}}</td>
                                        <td>
                                            @if($rubro->status == 1)
                                                Activo
                                            @else
                                                Inactivo
                                            @endif

                                        </td>
                                        <td class="center box-buttons">
                                            {!! Form::open(array('url' => 'admin/rubro/' . $rubro->id, 'class' => 'pull-right')) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', array('type'=>'submit', 'class' => 'btn btn-danger')) !!}
                                            {!! Form::close() !!}
                                            <a href="{{ URL::route('admin.rubro.edit',$rubro->id) }}" title="Modificar" type="button" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                            
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
            {!! $rubros->render() !!}
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

@stop
