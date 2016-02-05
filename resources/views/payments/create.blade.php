@extends('layout.baseadmin')


@section('title')
Nuevo pago: {{$enterprise->razon_social}}
@stop

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-lg-12">
				<h1 class="page-header">Registrar pago: {{$enterprise->razon_social}}</h1>
			</div>
			<!-- /.col-lg-12 -->
			<div class="col-xs-12 col-sm-9 col-lg-9">
				{!! Form::open(array("method" => "POST","route" => "admin.pagos.store","role" => "form","id"=>"formid")) !!}
				<input type="hidden" name="enterprise_id" value="{{$enterprise->id}}">
				<input type="hidden" name="ultimo_corte" value="@if(isset($last_order->created_at)){{$last_order->created_at}}@else{{$last_order}}@endif">
				<div class="row">
					<div class="form-group col-xs-6 col-sm-3 col-lg-6">
						{!!Form::label("*Fecha de Pago:")!!}
						{!!Form::text('fecha_pago', Input::old('fecha_pago'), 
							array("class" => "form-control",
									'id'=>'fecha_pago', 
									"max" => date('Y-m-d'),
									"min" => date('Y-m-d', strtotime(date("Y-m-d") . " - 2 year") ) ) ) !!}
						@if($errors->has('fecha_pago'))
						<div class="error">{{ $errors->first('fecha_pago') }}</div>
						@endif
					</div>

					<div class="form-group col-xs-12 col-sm-12 col-lg-6">
						{!! Form::label("*Tipo de pago:") !!}
						{!! Form::select('tipo_pago', $payments_methods, null, array('class' => 'form-control')) !!}
						@if($errors->has('tipo_pago'))
						<div class="error">{{ $errors->first('tipo_pago') }}</div>
						@endif
					</div>

					<div class="form-group col-xs-12 col-sm-12 col-lg-12">
						{!! Form::label("*Período:") !!}
						{!! Form::text("periodo", $period , array("class" => "form-control"))!!}
						@if($errors->has('periodo'))
						<div class="error">{{ $errors->first('periodo') }}</div>
						@endif
					</div> 
										
					<div class="form-group col-xs-12 col-sm-12 col-lg-6">
						{!!Form::label("*Descripción:")!!}
						{!!Form::textarea("descripcion", $description, array("class" => "form-control"))!!}
						@if($errors->has('descripcion'))
						<div class="error">{{ $errors->first('descripcion') }}</div>
						@endif
					</div>
					
					<div class="form-group col-xs-12 col-sm-12 col-lg-6">
						{!! Form::label("*Factura:") !!}
						{!!Form::text("factura", Input::old('factura'), array("class" => "form-control"))!!}
						@if($errors->has('factura'))
						<div class="error">{{ $errors->first('factura') }}</div>
						@endif
					</div>

					<div class="form-group col-xs-12 col-sm-12 col-lg-6">
						{!!Form::label("*Monto:")!!}
						{!!Form::input("number", "monto", $to_pay , array("class" => "form-control","value"=>0, "min"=>0, "step"=>"any"))!!}
						@if($errors->has('monto'))
						<div class="error">{{ $errors->first('monto') }}</div>
						@endif
					</div>

					<div class="form-group col-xs-12 col-sm-12 col-lg-6">
						{!! Form::label("*Estatus:") !!}
						{!! Form::select('payment_status', $payment_status, null, array('class' => 'form-control')) !!}
						@if($errors->has('payment_status'))
						<div class="error">{{ $errors->first('payment_status') }}</div>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xs-12 col-sm-6 col-lg-6">
						{!!Form::submit("Registrar Pago", array("class" => "btn btn-lg btn-success btn-block", "id" =>"btnSubmit"))!!}
					</div>
					<div class="form-group col-xs-12 col-sm-6 col-lg-6">
						<a href="{!!URL::route('admin.pagos.listado', $enterprise->id)!!}" class="btn btn-lg btn-danger btn-block">Volver</a>
					</div>
				</div>
				{!!Form::close()!!}
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<script type="text/javascript">
$('#fecha_pago').datetimepicker({
    format: 'YYYY-MM-DD'
});
</script>

@stop

