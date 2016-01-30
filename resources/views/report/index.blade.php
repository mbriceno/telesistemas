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
                                <select name="tipo_plan" class="form-control">
									<option value="">Tipo de plan</option>
                                @foreach($planes as $plan )
                                    <option value="{{$plan->id}}" @if(isset($filtros['tipo_plan']) && $filtros['tipo_plan']==$plan->id)selected="selected"@endif>{{$plan->nombre}}</option>
                                @endforeach
                                </select>
                            </div>
							<div class="form-group col-lg-4">
								<div class='input-group date' id='datetimepicker6'>
									<input type='text' class="form-control" name="fecha_inic" value="@if(isset($filtros['fecha_inic'])){{$filtros['fecha_inic']}}@endif" />
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
							<div class="form-group col-lg-4">
								<div class='input-group date' id='datetimepicker7'>
									<input type='text' class="form-control" name="fecha_fin" value="@if(isset($filtros['fecha_fin'])){{$filtros['fecha_fin']}}@endif" />
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
                            <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                                <input type="submit" value="Aplicar filtros" class="btn btn-primary">
								<a href="{{ URL::route('admin.reportes.planes') }}" class="btn btn-danger">Limpiar filtros</a>

                            </div>
                            </form>
                            {!! Form::open(array('method' => 'get',"route" => "admin.reportes.planes.excel")) !!}
                            <div class="form-group col-xs-12 col-sm-12 col-lg-6 pull-right" style="text-align:right">
                                <input type="hidden" name="sort" value="{{ Request::input('sort')}}">
                                <input type="hidden" name="order" value="{{ Request::input('order')}}">
                                <input type="hidden" name="tipo_plan" value="@if(isset($filtros['tipo_plan'])){{$filtros['tipo_plan']}}@endif">
                                <input type="hidden" name="fecha_inic" value="@if(isset($filtros['fecha_inic'])){{$filtros['fecha_inic']}}@endif" />
                                <input type="hidden" name="fecha_fin" value="@if(isset($filtros['fecha_fin'])){{$filtros['fecha_fin']}}@endif" />
                                <button type="submit" class="btn btn-primary"><i class="fa fa-cloud-download"></i> Exportar a Excel</button>
                            </div>
                            </form>
                        </div>
                        

                    </div>
                    <div class="dataTable_wrapper table-responsive">
                        @if(isset($filtros['tipo_plan']))
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Plan</th>
                                    <th>Numero de Empresas afiliadas</th>
                                    <th>Ingreso totales</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$planObj->nombre}}</td>
                                    <td>{{count($planObj->enterprises)}}</td>
                                    <td>{{number_format($monto_plan->total_sales, 2, ',', '.')}}</td>
                                </tr>
                            </tbody>
                        </table>
                        @endif
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th><a href="{{ URL::route('admin.reportes.planes', $param_nombre) }}">Nombre</a></th>
                                    <th><a href="{{ URL::route('admin.reportes.planes', $param_date) }}">Activa desde</a></th>
                                    <th><a href="{{ URL::route('admin.reportes.planes', $param_plan) }}">Plan</a></th>
                                    <th><a href="{{ URL::route('admin.reportes.planes', $param_total) }}">Ingreso total</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enterprises as $en)
                                    <tr class="odd gradeX">
                                        <td>{{$en->razon_social}}</td>
                                        <td>{{date("d/m/Y", strtotime($en->created_at))}}</td>
                                        <td>{{$en->plan->nombre}}</td>
                                        <td>{{number_format($en->sale_orders->sum('total'), 2, ',', '.')}}</td>
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
<script type="text/javascript">
    $(function () {
        $('#datetimepicker6').datetimepicker({
			format: 'DD/MM/YYYY'
		});
        $('#datetimepicker7').datetimepicker({
            useCurrent: false, //Important! See issue #1075
			format: 'DD/MM/YYYY'
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
@stop
