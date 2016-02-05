@extends('layout.baseadmin')

@section('title')
Nueva venta
@stop

@section('additional-class')
wrapper-ventas
@stop

@section('content')

<!-- Page Content -->
<div id="page-wrapper" class="@role('empresas.vendedor|empresas.administrador') content-ventas @endrole">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-lg-12">
				<h1 class="page-header">Registrar Venta</h1>
			</div>
			<!--{!! HTML::ul($errors->all()) !!}-->
			<!-- /.col-lg-12 -->
			<div class="col-xs-12 col-sm-12 col-lg-12">
				{!! Form::open(array("method" => "POST","route" => "sale-point.orden-venta.store","role" => "form","id"=>"formid")) !!}
				<div class="row">
					<div class="form-group col-xs-12 col-sm-12 col-lg-8">
						{!! Form::label("*Nombre del cliente o Razón Social:") !!}
						{!!Form::text("razon_social", Input::old('razon_social'), array("class" => "form-control"))!!}
						@if($errors->has('razon_social'))
						<div class="error">{{ $errors->first('razon_social') }}</div>
						@endif
					</div>

					<div class="form-group col-xs-12 col-sm-12 col-lg-4">
                        {!! Form::label("*C.I./R.I.F.:") !!}
                        {!!Form::text("ci_rif", Input::old('ci_rif'), array("class" => "form-control"))!!}
                        @if($errors->has('ci_rif'))
                        <div class="error">{{ $errors->first('ci_rif') }}</div>
                        @endif
                        <small>Ej.:V-XXXXXXXX</small>
                    </div>
										
					<div class="form-group col-xs-12 col-sm-12 col-lg-12">
						{!!Form::label("*Dirección:")!!}
						{!!Form::textarea("direccion", Input::old('direccion'), array("class" => "form-control", "rows" => "2"))!!}
						@if($errors->has('direccion'))
						<div class="error">{{ $errors->first('direccion') }}</div>
						@endif
					</div>

					<div class="form-group col-xs-12 col-sm-12 col-lg-4">
                        {!!Form::label("*Teléfono:")!!}
                        {!!Form::text("telefono", Input::old('telefono'), array("class" => "form-control"))!!}
                        @if($errors->has('telefono'))
                        <div class="error">{{ $errors->first('telefono') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-4">
						{!! Form::label("*Forma de Pago:") !!}
						{!! Form::select('forma_pago',array( 'tdc' => 'Tarjeta de Crédito', 'tdd' => 'Tarjeta de débito', 'efc' => 'Efectivo', 'chq' => 'Cheque', 'trf' => 'Transferencia'), null, array('class' => 'form-control')) !!}
						@if($errors->has('forma_pago'))
						<div class="error">{{ $errors->first('forma_pago') }}</div>
						@endif
					</div>
					<div class="row" style="padding: 0 15px;clear:both">
					<div class="form-group col-xs-12 col-sm-12 col-lg-7 box-list-products">
						<table class="table table-striped" id="tableListProducts">
							<thead>
								<tr>
									<th>Producto</th>
									<th>Cantidad</th>
									<th>Monto</th>
									<th>Total</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@if(Input::old('products'))
								@foreach(Input::old('products') as $k => $prd)
								<tr id="prd_">
									<td>
										{{$prd['nombre']}}
										<input type="hidden" value="{{$prd['nombre']}}" name="products[{{$k}}][nombre]">
									</td>
									<td class="box-cantidad">
								 		<input type="number" min="1" step="any" class="col-lg-6" name="products[{{$k}}][cantidad]" value="{{$prd['cantidad']}}" placeholder="Cantidad">
									</td>
									<td class="box-monto">
								 		<span>{{$prd['monto']}}</span> Bs. <input type="hidden" value="{{$prd['monto']}}" name="products[{{$k}}][monto]">
									</td>
									<td class="box-monto-total">
								 		<span>{{$prd['total']}}</span> Bs. <input type="hidden" value="{{$prd['total']}}" name="products[{{$k}}][total]">
									</td>
									<td class="">
										<button type="button" class="btn btn-danger del-btn"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
									</td>
								</tr>
								@endforeach
								@endif
							</tbody>
						</table>
					</div>

					<div class="col-xs-12 col-sm-12 col-lg-5 box-product-description">
						<div class="form-group col-xs-12 col-sm-12 col-lg-12">
							{!! Form::text("producto", Input::old('producto'), array("class" => "form-control", "placeholder" => "*Nombre del producto") ) !!}
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-lg-12">
							{!! Form::input("number", "cantidad", "1", array("placeholder" => "*Cantidad", "class" => "form-control","value"=>0, "min"=>0, "step"=>"any") )!!}
						</div>
						<div class="form-group col-xs-12 col-sm-12 col-lg-12">
							{!!Form::input("number", "monto", Input::old('monto'), array("placeholder" => "*Monto", "class" => "form-control","value"=>0, "min"=>0, "step"=>"any"))!!}
						</div>
						<div class="form-group col-xs-12 col-sm-6 col-lg-12">
							<button class="btn btn-lg btn-success btn-add-product">Agregar</button>
						</div>
					</div>
					</div>

					<div class="form-group col-xs-12 col-sm-12 col-lg-7 total-box">
						<div class="col-xs-12 col-sm-12 col-lg-6 pull-right box-sub-total">
							<div class="form-group col-xs-12 col-sm-12 col-lg-12">
								{!!Form::label("Sub-total:")!!}
								{!!Form::input("number", "monto", Input::old('monto'), array("class" => "form-control","value"=>0, "min"=>0, "step"=>"any", "readonly"=>"readonly"))!!}
								@if($errors->has('monto'))
								<div class="error">{{ $errors->first('monto') }}</div>
								@endif
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-lg-12 pull-right box-iva-total">
							<div class="form-group col-xs-12 col-sm-12 col-lg-6 box-iva-percent">
								{!!Form::label("I.V.A:")!!}
								{!!Form::input("number", "iva_percentage", '12.00', array("class" => "form-control","value"=>0, "min"=>0, "step"=>"any"))!!}
								@if($errors->has('iva_percentage'))
								<div class="error">{{ $errors->first('iva_percentage') }}</div>
								@endif
							</div>
							<div class="form-group col-xs-12 col-sm-12 col-lg-6 box-iva-total-amount">
								{!!Form::label("Total I.V.A:")!!}
								{!!Form::input("number", "iva", Input::old('iva'), array("class" => "form-control","value"=>0, "min"=>0, "step"=>"any", "readonly"=>"readonly"))!!}
								@if($errors->has('iva'))
								<div class="error">{{ $errors->first('iva') }}</div>
								@endif
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-lg-6 pull-right box-total-total">
							<div class="form-group col-xs-12 col-sm-12 col-lg-12">
								{!!Form::label("Total:")!!}
								{!!Form::input("number", "total", Input::old('total'), array("class" => "form-control","value"=>0, "min"=>0, "step"=>"any", "readonly"=>"readonly"))!!}
								@if($errors->has('total'))
								<div class="error">{{ $errors->first('total') }}</div>
								@endif
							</div>
						</div>
					</div>
					<div class="form-group col-xs-12 col-sm-12 col-lg-4 sale-send-box">
						<div class="form-group col-xs-12 col-sm-6 col-lg-7 pull-right box-buy">
							{!!Form::submit("Comprar", array("class" => "btn btn-lg btn-success btn-block", "id" =>"btnSubmit"))!!}
						</div>
						<div class="form-group col-xs-12 col-sm-6 col-lg-7 pull-right">
							<input type="reset" class="btn btn-lg btn-danger btn-block btn-reset-buy" value="Cancelar">
						</div>
					</div>
				</div>
				<div class="row">

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
$('input[name="telefono"]').mask("9999-9999999",{placeholder:" "});
</script>

@stop

@section('function')
var count = <?php if(Input::old('products')){ echo count(Input::old('products')); }else{ echo 0; } ?>;
$('.btn-add-product').click(function(e){
	e.preventDefault();

	if($('.box-product-description input[name="producto"]').valid() && $('.box-product-description input[name="cantidad"]').valid() && $('.box-product-description input[name="monto"]').valid()){
		count++;
		var total = $('.box-product-description input[name="cantidad"]').val() * $('.box-product-description input[name="monto"]').val();
		$('#tableListProducts tbody').append(
			'<tr id="prd_">' +
			'	<td>' +
				$('.box-product-description input[name="producto"]').val() + ' <input type="hidden" value="'+$('.box-product-description input[name="producto"]').val()+'" name="products['+count+'][nombre]">'+
			'	</td>' +
			'	<td class="box-cantidad">' +
			' 		<input type="number" min="1" step="any" class="col-lg-6" name="products['+count+'][cantidad]" value="'+$('.box-product-description input[name="cantidad"]').val()+'" placeholder="Cantidad">'+
			'	</td>' +
			'	<td class="box-monto">' +
			' 		<span>' + $('.box-product-description input[name="monto"]').val() + '</span> Bs. <input type="hidden" value="'+$('.box-product-description input[name="monto"]').val()+'" name="products['+count+'][monto]">' +
			'	</td>' +
			'	<td class="box-monto-total">' +
			' 		<span>' + total + '</span> Bs. <input type="hidden" value="'+total+'" name="products['+count+'][total]">' +
			'	</td>' +
			'	<td class="">' +
			'		<button type="button" class="btn btn-danger del-btn"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>'+
			'	</td>' +
			'</tr>'
		);

		$('.box-product-description input[name="producto"]').val('');
		$('.box-product-description input[name="cantidad"]').val(1);
		$('.box-product-description input[name="monto"]').val('');

		$("td.box-monto-total input").trigger("changeTable");
	}
});

$('#tableListProducts').on('click','button.del-btn',function(e){
	e.preventDefault();
	$(this).parent().parent().remove();
	$("td.box-monto-total input").trigger("changeTable");
});

$('#tableListProducts').on("changeTable", 'td.box-monto-total input', function(){
	var amount = 0.0;
	$.each($('td.box-monto-total input'),function(){
		amount = amount + parseFloat($(this).val());
	});

	$('.box-sub-total input[name="monto"]').val(amount);

	var iva = parseFloat($('.box-iva-total .box-iva-percent input').val());
	var totaliva = amount * (iva/100);
	$('.box-iva-total .box-iva-total-amount input').val(totaliva);
	var total = totaliva + amount;
	$('.box-total-total input[name="total"]').val(total);
});

$('#tableListProducts').on('keyup change', 'td.box-cantidad input', function(){
	var cantidad = parseFloat($(this).val());
	console.log(cantidad);
	if(!isNaN(cantidad) || cantidad > 0){
		var amount = parseFloat($('td.box-monto input', $(this).parent().parent()).val());
		var new_amount = cantidad * amount;
		console.log(new_amount);
		$('td.box-monto-total input', $(this).parent().parent()).val(new_amount);
		$('td.box-monto-total span', $(this).parent().parent()).text(new_amount);

		$("td.box-monto-total input").trigger("changeTable");
	}else{
		alert("Cantidad no puede ser nula o menor a cero");
	}
});

$('.btn-reset-buy').click(function(){
	$('#tableListProducts tbody').html('');
});

$("#formid").validate({
	onsubmit: false,
    rules: {
        producto: { required: true},
        cantidad: { required: true},
        monto: {required:true,number:true}
    },
    messages: {
        producto: 'Debe colocar una descripción',
        cantidad: 'Debe colocar una cantidad',
        monto: {
        	required:'Debe colocar un monto',
        	number:'El campo debe ser numérico'
        }
    }
});
@stop
