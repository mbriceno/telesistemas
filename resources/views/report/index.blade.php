@extends('layout.baseadmin')

@section('title')
Planes y Servicios
@stop

@section('content')

<div id="page-wrapper">
    <div class="row row-centered">
        <div class="col-xs-12 col-sm-12 col-lg-12">
            <h1 class="page-header">Planes y Servicios</h1>
        </div>
                
        <div class="col-xs-12 col-sm-12 col-lg-12">
            <!--div class="bar-buttons-action">
                <a class="btn btn-success" href="{{ URL::route('admin.plan.create') }}">Descargar consulta</a>
            </div-->
            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                {!! Session::get('message') !!}
            @endif
            <div class="panel panel-default" style="margin-top:15px">
                <div class="panel-heading">
                    Listado de Planes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row box-filters">
                        {!! Form::open(array('method' => 'get')) !!}
                        <div class="col-md-12">
                            <input type="hidden" name="sort" value="{{ Request::input('sort')}}">
                            <input type="hidden" name="order" value="{{ Request::input('order')}}">
                            <div class="form-group col-xs-12 col-sm-12 col-lg-4">
                                <label>Tipo de plan</label>
                                <select name="tipo_plan" class="form-control">
                                @foreach($planes as $plan )
                                    <option value="{{$plan->id}}">{{$plan->nombre}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group col-xs-12 col-sm-12 col-lg-4">
                                <input type="submit" value="filtrar" class="btn btn-default">
                            </div>
                        </div>
                        
                        </form>
                    </div>
                    <div class="dataTable_wrapper table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th><a href="{{ URL::route('admin.reportes.planes', $param_nombre) }}">Nombre</a></th>
                                    <th><a href="{{ URL::route('admin.reportes.planes', $param_date) }}">Activa desde</a></th>
                                    <th><a href="{{ URL::route('admin.reportes.planes', $param_plan) }}">Plan</a></th>
                                    <th>Ingreso total</th>
                                    <th class="col-lg-3">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enterprises as $en)
                                    <tr class="odd gradeX">
                                        <td>{{$en->razon_social}}</td>
                                        <td>{{date("d/m/Y", strtotime($en->created_at))}}</td>
                                        <td>{{$en->plan->nombre}}</td>
                                        <td>{{number_format($en->sale_orders->sum('total'), 2, ',', '.')}}</td>
                                        <td class="center box-buttons"></td>
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
