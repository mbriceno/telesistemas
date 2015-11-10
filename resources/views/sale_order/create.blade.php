@extends('layout.baseadmin')

@section('title')
Nueva venta
@stop

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-lg-12">
				<h1 class="page-header">Caja</h1>
			</div>
			<!-- /.col-lg-12 -->
			<div class="col-xs-12 col-sm-9 col-lg-9">
				{!! Form::open(array("method" => "POST","route" => "sale-point.orden-venta.store","role" => "form","id"=>"formid")) !!}
				<div class="row">
					<div class="form-group col-xs-12 col-sm-12 col-lg-6">
						{!! Form::label("*Nombre del cliente o Razón Social:") !!}
						{!!Form::text("razon_social", Input::old('razon_social'), array("class" => "form-control"))!!}
						@if($errors->has('nombre'))
						<div class="error">{{ $errors->first('razon_social') }}</div>
						@endif
					</div>

					<div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*C.I./R.I.F.:") !!}
                        {!!Form::text("ci_rif", Input::old('ci_rif'), array("class" => "form-control"))!!}
                        @if($errors->has('ci_rif'))
                        <div class="error">{{ $errors->first('ci_rif') }}</div>
                        @endif
                    </div>
										
					<div class="form-group col-xs-12 col-sm-12 col-lg-12">
						{!!Form::label("*Dirección:")!!}
						{!!Form::textarea("direccion", Input::old('direccion'), array("class" => "form-control"))!!}
						@if($errors->has('direccion'))
						<div class="error">{{ $errors->first('direccion') }}</div>
						@endif
					</div>

					<div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!!Form::label("*Teléfono:")!!}
                        {!!Form::text("telefono", Input::old('telefono'), array("class" => "form-control"))!!}
                        @if($errors->has('telefono'))
                        <div class="error">{{ $errors->first('telefono') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-6 col-sm-3 col-lg-6">
						{!!Form::label("*Fecha:")!!}
						{!!Form::input('date', 'fecha_emision', Input::old('fecha_emision'), array("class" => "form-control",'id'=>'fecha_inicio'))!!}
						@if($errors->has('fecha_emision'))
						<div class="error">{{ $errors->first('fecha_emision') }}</div>
						@endif
					</div>

					<div class="form-group col-xs-12 col-sm-12 col-lg-6">
						{!! Form::label("*Forma de Pago:") !!}
						{!! Form::select('forma_pago',array( 'tdc' => 'Tarjeta de Crédito', 'tdd' => 'Tarjeta de débito', 'efc' => 'Efectivo', 'chq' => 'Cheque', 'trf' => 'Transferencia'), null, array('class' => 'form-control')) !!}
						@if($errors->has('forma_pago'))
						<div class="error">{{ $errors->first('forma_pago') }}</div>
						@endif
					</div>

					<div class="form-group col-xs-12 col-sm-12 col-lg-6">
						{!!Form::label("*I.V.A:")!!}
						{!!Form::input("number", "iva", '12.00', array("class" => "form-control","value"=>0, "min"=>0, "step"=>"any"))!!}
						@if($errors->has('iva'))
						<div class="error">{{ $errors->first('iva') }}</div>
						@endif
					</div>

					<div class="form-group col-xs-12 col-sm-12 col-lg-6">
						{!!Form::label("*Monto:")!!}
						{!!Form::input("number", "monto", Input::old('monto'), array("class" => "form-control","value"=>0, "min"=>0, "step"=>"any"))!!}
						@if($errors->has('monto'))
						<div class="error">{{ $errors->first('monto') }}</div>
						@endif
					</div>

					<div class="form-group col-xs-12 col-sm-12 col-lg-6">
						{!!Form::label("*Total:")!!}
						{!!Form::input("number", "total", Input::old('total'), array("class" => "form-control","value"=>0, "min"=>0, "step"=>"any"))!!}
						@if($errors->has('total'))
						<div class="error">{{ $errors->first('total') }}</div>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="form-group col-xs-12 col-sm-6 col-lg-6">
						{!!Form::submit("Comprar", array("class" => "btn btn-lg btn-success btn-block", "id" =>"btnSubmit"))!!}
					</div>
					<div class="form-group col-xs-12 col-sm-6 col-lg-6">
						<a href="{!!URL::route('admin.plan.index')!!}" class="btn btn-lg btn-danger btn-block">Volver</a>
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
$.mask.definitions['~']='[VvJjEePp]';
$('input[name="ci_rif"]').mask("~-9999999?999",{placeholder:" "});
</script>

@stop

