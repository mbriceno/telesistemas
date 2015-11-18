@extends('layout.baseadmin')


@section('title')
Registar pago
@stop

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-lg-12">
				<h1 class="page-header">Registrar pago</h1>
			</div>
			<!-- /.col-lg-12 -->
			{!!HTML::ul($errors->all())!!}
			<div class="col-xs-12 col-sm-9 col-lg-9">
				@if (Session::has('message'))
	                {!! Session::get('message') !!}
	            @endif
				{!! Form::open(array("method" => "POST","route" => "admin.pagos-transaccion.store","role" => "form","id"=>"formid")) !!}
				<input type="hidden" name="payment_order_id" value="{{$id}}">
				<div class="row">
					<div class="form-group col-xs-6 col-sm-3 col-lg-6">
						{!!Form::label("*Fecha de Pago:")!!}
						{!!Form::input('date', 'fecha_transaccion', Input::old('fecha_transaccion'), 
							array("class" => "form-control",
									'id'=>'fecha_transaccion', 
									"max" => date('Y-m-d'),
									"min" => date('Y-m-d', strtotime(date("Y-m-d") . " - 2 year") ) ) ) !!}
						@if($errors->has('fecha_transaccion'))
						<div class="error">{{ $errors->first('fecha_transaccion') }}</div>
						@endif
					</div>

					<div class="form-group col-xs-12 col-sm-12 col-lg-6">
						{!! Form::label("*Tipo de pago:") !!}
						{!! Form::select('tipo_pago', $payments_methods, null, array('class' => 'form-control')) !!}
						@if($errors->has('tipo_pago'))
						<div class="error">{{ $errors->first('tipo_pago') }}</div>
						@endif
					</div>
					
					<div class="form-group col-xs-12 col-sm-12 col-lg-6">
						{!! Form::label("*Número de Déposito/Transferencia:") !!}
						{!!Form::text("nro_referencia", Input::old('nro_referencia'), array("class" => "form-control"))!!}
						@if($errors->has('nro_referencia'))
						<div class="error">{{ $errors->first('nro_referencia') }}</div>
						@endif
					</div>

					<div class="form-group col-xs-12 col-sm-12 col-lg-6">
						{!!Form::label("*Monto:")!!}
						{!!Form::input("number", "monto", $to_pay , array("class" => "form-control","value"=>0, "min"=>0, "step"=>"any"))!!}
						@if($errors->has('monto'))
						<div class="error">{{ $errors->first('monto') }}</div>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xs-12 col-sm-6 col-lg-6">
						{!!Form::submit("Registrar Pago", array("class" => "btn btn-lg btn-success btn-block", "id" =>"btnSubmit"))!!}
					</div>
					<div class="form-group col-xs-12 col-sm-6 col-lg-6">
						<a href="{!! URL::route('admin.pagos.listado', Auth::user()->enterprise[0]->id) !!}" class="btn btn-lg btn-danger btn-block">Volver</a>
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

</script>

@stop

