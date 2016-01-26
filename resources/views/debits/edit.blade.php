@extends('layout.baseadmin')


@section('title')
Orden de débito: {{$debit->enterprise->razon_social}}
@stop

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <h1 class="page-header">Editar débito: {{$debit->enterprise->razon_social}}</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-xs-12 col-sm-9 col-lg-9">
                {!! Form::model($debit, array('route' => array('admin.pagos-empresas.update', $debit->id), 'method' => 'PUT','id'=>'formid')) !!}
                <input type="hidden" name="enterprise_id" value="{{$debit->enterprise->id}}">
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-12 col-lg-12">
                        {!! Form::label("*Período:") !!}
                        {!! Form::text("periodo", $debit->periodo , array("class" => "form-control"))!!}
                        @if($errors->has('periodo'))
                        <div class="error">{{ $errors->first('periodo') }}</div>
                        @endif
                    </div>
                    
                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Factura:") !!}
                        {!!Form::text("factura", $debit->factura, array("class" => "form-control"))!!}
                        @if($errors->has('factura'))
                        <div class="error">{{ $errors->first('factura') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Cuenta Bancaria:") !!}
                        {!!Form::text("nro_cuenta_bancaria", $debit->nro_cuenta_bancaria, array("class" => "form-control"))!!}
                        @if($errors->has('nro_cuenta_bancaria'))
                        <div class="error">{{ $errors->first('nro_cuenta_bancaria') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Titular Cuenta Bancaria:") !!}
                        {!!Form::text("titular_cuenta_bancaria", $debit->titular_cuenta_bancaria, array("class" => "form-control"))!!}
                        @if($errors->has('titular_cuenta_bancaria'))
                        <div class="error">{{ $errors->first('titular_cuenta_bancaria') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        <label>*C.I/R.I.F Cuenta Bancaria: <i class="fa fa-info-circle fa-fw" data-toggle="tooltip" data-placement="right" title="Utilice el formato: V-XXXXXXXX"></i></label>
                        {!!Form::text("cirif_cuenta_bancaria", $debit->cirif_cuenta_bancaria, array("class" => "form-control"))!!}
                        @if($errors->has('cirif_cuenta_bancaria'))
                        <div class="error">{{ $errors->first('cirif_cuenta_bancaria') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!!Form::label("*Monto:")!!}
                        {!!Form::input("number", "monto", $debit->monto , array("class" => "form-control","value"=>0, "min"=>0, "step"=>"any"))!!}
                        @if($errors->has('monto'))
                        <div class="error">{{ $errors->first('monto') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-6 col-sm-3 col-lg-6">
                        {!!Form::label("*Fecha de déposito:")!!}
                        {!!Form::input('date', 'fecha_debito', $debit->fecha_debito, 
                            array("class" => "form-control",
                                    'id'=>'fecha_debito', 
                                    "max" => date('Y-m-d'),
                                    "min" => date('Y-m-d', strtotime(date("Y-m-d") . " - 2 year") ) ) ) !!}
                        @if($errors->has('fecha_debito'))
                        <div class="error">{{ $errors->first('fecha_debito') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Estatus:") !!}
                        {!! Form::select('status', $debit_status, $debit->status, array('class' => 'form-control')) !!}
                        @if($errors->has('status'))
                        <div class="error">{{ $errors->first('status') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-lg-6">
                        {!!Form::submit("Editar Pago", array("class" => "btn btn-lg btn-success btn-block", "id" =>"btnSubmit"))!!}
                    </div>
                    <div class="form-group col-xs-12 col-sm-6 col-lg-6">
                        <a href="{!!URL::route('admin.pagos-empresas.listado', $debit->enterprise->id)!!}" class="btn btn-lg btn-danger btn-block">Volver</a>
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
$('input[name="cirif_cuenta_bancaria"]').mask("~-9999999?999",{placeholder:" "});
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
</script>

@stop