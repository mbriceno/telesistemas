@extends('layout.baseadmin')

@section('title')
Auditorias
@stop

@section('content')

<div id="page-wrapper">
	<div class="row row-centered">
		<div class="col-xs-12 col-sm-12 col-lg-12">
			<h1 class="page-header">Auditorias</h1>
		</div>
				
		<div class="col-xs-12 col-sm-12 col-lg-12">
			<!-- will be used to show any messages -->
			@if (Session::has('message'))
				{!! Session::get('message') !!}
			@endif
			<div class="panel panel-default" style="margin-top:15px">
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="row box-filters">
						<div class="col-md-12">
							{!! Form::open(array('method' => 'get')) !!}
							<div class="form-group col-xs-12 col-sm-12 col-lg-4">
								<select name="tipo" class="form-control">
									<option value="">Tipos</option>
									<option value="created" @if(isset($filtros['tipo']) && $filtros['tipo']=='created')selected="selected"@endif>Creados</option>
									<option value="updated" @if(isset($filtros['tipo']) && $filtros['tipo']=='updated')selected="selected"@endif>Actualizados</option>
									<option value="deleted" @if(isset($filtros['tipo']) && $filtros['tipo']=='deleted')selected="selected"@endif>Eliminados</option>
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
								<a href="{{ URL::route('admin.auditorias.index') }}" class="btn btn-danger">Limpiar filtros</a>
							</div>
							</form>
						</div>
					</div>
					<div class="dataTable_wrapper table-responsive">
						<div class="panel-group log-accordion" id="accordion" role="tablist" aria-multiselectable="true">
							@foreach ($logs as $log)
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="heading{{$log->id}}">
									<h5 class="panel-title">
										<a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$log->id}}" aria-expanded="@if($log->id==1)true @else false @endif" aria-controls="collapse{{$log->id}}">
											{!!$log->customMessage!!}
										</a>
									</h5>
								</div>
								<div id="collapse{{$log->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
									<div class="panel-body">
										<ul>
											@forelse($log->customFields as $custom)
											<li>{{$custom}}</li>
											@empty
											<li>Sin detalles</li>
											@endforelse
										</ul>
									</div>
								</div>
							</div>
							@endforeach
						</div>  
					</div>
					<!-- /.table-responsive -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
		<div class="col-xs-12 col-sm-12 col-lg-12">
			{!! $logs->appends($filtros)->render() !!}
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
