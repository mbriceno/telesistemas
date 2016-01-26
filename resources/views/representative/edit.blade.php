@extends('layout.baseadmin')

@section('title')
Representantes
@stop

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <h1 class="page-header">Editar @if($representante->tipo == 'legal') Representante Legal @else Persona de contacto @endif</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-xs-12 col-sm-9 col-lg-9">
                {!! Form::model($representante, array('route' => array('admin.representante.update', $representante->id), 'method' => 'PUT','id'=>'formid')) !!}
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Nombre:") !!}
                        {!!Form::text("nombre", Input::old('nombre'), array("class" => "form-control"))!!}
                        @if($errors->has('nombre'))
                        <div class="error">{{ $errors->first('nombre') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Apellido:") !!}
                        {!!Form::text("apellido", Input::old('apellido'), array("class" => "form-control"))!!}
                        @if($errors->has('apellido'))
                        <div class="error">{{ $errors->first('apellido') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        <label>*C.I.: <i class="fa fa-info-circle fa-fw" data-toggle="tooltip" data-placement="right" title="Utilice el formato: V-XXXXXXXX"></i></label>
                        {!!Form::text("ci", Input::old('ci'), array("class" => "form-control"))!!}
                        @if($errors->has('ci'))
                        <div class="error">{{ $errors->first('ci') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        <label>*R.I.F.: <i class="fa fa-info-circle fa-fw" data-toggle="tooltip" data-placement="right" title="Utilice el formato: V-XXXXXXXX"></i></label>
                        {!!Form::text("rif", Input::old('rif'), array("class" => "form-control"))!!}
                        @if($errors->has('rif'))
                        <div class="error">{{ $errors->first('rif') }}</div>
                        @endif
                    </div>
                                        
                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!!Form::label("*E-mail:")!!}
                        {!!Form::input("email", "email", Input::old('email'), array("class" => "form-control","value"=>0, "min"=>0, "step"=>"any"))!!}
                        @if($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!!Form::label("*Teléfono:")!!}
                        {!!Form::text("telefono", Input::old('telefono'), array("class" => "form-control"))!!}
                        @if($errors->has('telefono'))
                        <div class="error">{{ $errors->first('telefono') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!!Form::label("*Dirección:")!!}
                        {!!Form::textarea("direccion", Input::old('direccion'), array("class" => "form-control"))!!}
                        @if($errors->has('direccion'))
                        <div class="error">{{ $errors->first('direccion') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-lg-6">
                        {!!Form::submit("Actualizar", array("class" => "btn btn-lg btn-success btn-block", "id" =>"btnSubmit"))!!}
                    </div>
                    <div class="form-group col-xs-12 col-sm-6 col-lg-6">
                        <a href="{!!URL::route('admin.empresa.show',$representante->enterprises[0]->id)!!}" class="btn btn-lg btn-danger btn-block">Volver</a>
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
$('input[name="rif"], input[name="ci"]').mask("~-9999999?999",{placeholder:" "});
$('input[name="telefono"]').mask("9999-9999999",{placeholder:" "});
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
</script>

@stop

