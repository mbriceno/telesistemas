@extends('layout.baseadmin')

@section('title')
Ventas
@stop

@section('content')

<div id="page-wrapper">
    <div class="row row-centered">
        <div class="col-xs-12 col-sm-12 col-lg-12">
            <h1 class="page-header">Ventas</h1>
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
                    Ventas
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row box-filters">
                        <div class="col-md-12">
                            {!! Form::open(array('method' => 'get')) !!}
                            <input type="hidden" name="sort" value="{{ Request::input('sort')}}">
                            <input type="hidden" name="order" value="{{ Request::input('order')}}">
                            <div class="form-group col-xs-12 col-sm-12 col-lg-4">
                                <select name="empresa_id" class="form-control">
									<option value="">Empresas</option>
                                @foreach($empresas as $emp )
                                    <option value="{{$emp->id}}" @if(isset($filtros['empresa_id']) && $filtros['empresa_id']==$emp->id)selected="selected"@endif>{{$emp->razon_social}} @if($emp->trashed())(Eliminada)@endif</option>
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
								<a href="{{ URL::route('admin.reportes.ventas') }}" class="btn btn-danger">Limpiar filtros</a>
                            </div>
                            </form>
                            {!! Form::open(array('method' => 'get',"route" => "admin.reportes.ventas.excel")) !!}
                            <div class="form-group col-xs-12 col-sm-12 col-lg-6" style="text-align:right">
                                <input type="hidden" name="sort" value="{{ Request::input('sort')}}">
                                <input type="hidden" name="order" value="{{ Request::input('order')}}">
                                <input type="hidden" name="empresa_id" value="@if(isset($filtros['empresa_id'])){{$filtros['empresa_id']}}@endif">
                                <input type="hidden" name="fecha_inic" value="@if(isset($filtros['fecha_inic'])){{$filtros['fecha_inic']}}@endif" />
                                <input type="hidden" name="fecha_fin" value="@if(isset($filtros['fecha_fin'])){{$filtros['fecha_fin']}}@endif" />
                                <button type="submit" class="btn btn-primary"><i class="fa fa-cloud-download"></i> Exportar a Excel</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="dataTable_wrapper table-responsive">
                        @if(isset($filtros['empresa_id']))
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Razón Social</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$empresa->razon_social}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        @endif
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th><a href="{{ URL::route('admin.reportes.ventas', $param_nombre) }}">Cliente</a></th>
                                    <th>Empresa</th>
                                    <th><a href="{{ URL::route('admin.reportes.ventas', $param_date) }}">Fecha</a></th>
                                    <th><a href="{{ URL::route('admin.reportes.ventas', $param_orden) }}">Nro. Orden</a></th>
                                    <th>Monto</th>
                                    <th>IVA</th>
                                    <th><a href="{{ URL::route('admin.reportes.ventas', $param_total) }}">Total</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $acum = 0; ?>
                                @foreach ($ordenes as $or)
                                    <?php $acum+=$or->total; ?>
                                    <tr class="odd gradeX">
                                        <td>{{$or->razon_social}}</td>
                                        <td>{{$or->enterprise->razon_social}}</td>
                                        <td>{{date("d/m/Y h:i:s A", strtotime($or->created_at))}}</td>
                                        <td>{{$or->nro_orden}}</td>
                                        <td>{{number_format($or->monto, 2, ',', '.')}}</td>
                                        <td>{{number_format($or->iva, 2, ',', '.')}}</td>
                                        <td>{{number_format($or->total, 2, ',', '.')}}</td>
                                    </tr>
                                @endforeach
                                    <tr class="odd gradeX">
                                        <td colspan="5"></td>
                                        <td><b>Total parcial</b></td>
                                        <td>{{number_format($acum, 2, ',', '.')}}</td>
                                    </tr>
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
            {!! $ordenes->render() !!}
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
