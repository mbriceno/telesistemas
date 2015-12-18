@extends('layout.baseadmin')

@section('title')
Cuentas
@stop

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <h1 class="page-header">Editar datos bancarios</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-xs-12 col-sm-9 col-lg-9">
                {!! Form::model($cuenta, array('route' => array('admin.cuentas_bancarias.update', $cuenta->id), 'method' => 'PUT','id'=>'formid')) !!}
                <div class="row">
                    <input type="hidden" name="enterprise_id" value="{{$id}}">
                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Titular:") !!}
                        {!!Form::text("titular", Input::old('titular'), array("class" => "form-control"))!!}
                        @if($errors->has('titular'))
                        <div class="error">{{ $errors->first('titular') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Nro. de cuenta:") !!}
                        {!! Form::text("nro_cuenta", Input::old('nro_cuenta'), array("class" => "form-control", "maxlength" =>"20")) !!}
                        @if($errors->has('nro_cuenta'))
                        <div class="error">{{ $errors->first('nro_cuenta') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*C.I/R.i.F:") !!}
                        {!!Form::text("rif_ci", Input::old('rif_ci'), array("class" => "form-control"))!!}
                        @if($errors->has('rif_ci'))
                        <div class="error">{{ $errors->first('rif_ci') }}</div>
                        @endif
                        <small>Ej.:V-XXXXXXXX</small>
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Banco:") !!}
                        {!! Form::select('bank_id', $bancos, null, array('class' => 'form-control')) !!}
                        @if($errors->has('bank_id'))
                        <div class="error">{{ $errors->first('bank_id') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Tipo:") !!}
                        {!! Form::select('tipo',array( 'CO' => 'Corriente', 'AH' => 'Ahorro', 'EL' => 'Electrónica'), null, array('class' => 'form-control')) !!}
                        @if($errors->has('tipo'))
                        <div class="error">{{ $errors->first('tipo') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-lg-6">
                        {!!Form::submit("Actualizar", array("class" => "btn btn-lg btn-success btn-block", "id" =>"btnSubmit"))!!}
                    </div>
                    <div class="form-group col-xs-12 col-sm-6 col-lg-6">
                        <a href="{!!URL::route('admin.empresa.index')!!}" class="btn btn-lg btn-danger btn-block">Volver</a>
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
$('input[name="rif_ci"], input[name="ci"]').mask("~-9999999?999",{placeholder:" "});
</script>

@stop

