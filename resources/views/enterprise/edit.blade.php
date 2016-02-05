@extends('layout.baseadmin')

@section('title')
Empresas
@stop

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <h1 class="page-header">Editar empresa</h1>
            </div>
            <div class="btn-group box-right" role="group" style="margin-bottom:20px">
                @foreach($empresa->representatives as $representante)
                    <a href="{{ URL::route('admin.representante.edit',$representante->id)}}" class="btn btn-outline btn-primary">
                        @if($representante->tipo == 'legal')
                        Modificar Representante Legal
                        @else
                        Modificar Persona de contacto
                        @endif
                    </a>
                @endforeach
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-xs-12 col-sm-9 col-lg-9">
                {!! Form::model($empresa, array('route' => array('admin.empresa.update', $empresa->id), 'method' => 'PUT','id'=>'formid',"files"=>true)) !!}
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Razón social:") !!}
                        {!!Form::text("razon_social", Input::old('razon_social'), array("class" => "form-control"))!!}
                        @if($errors->has('razon_social'))
                        <div class="error">{{ $errors->first('razon_social') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Nombre comercial:") !!}
                        {!!Form::text("nombre_comercial", Input::old('nombre_comercial'), array("class" => "form-control"))!!}
                        @if($errors->has('nombre_comercial'))
                        <div class="error">{{ $errors->first('nombre_comercial') }}</div>
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

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        <label>*Web: <i class="fa fa-info-circle fa-fw" data-toggle="tooltip" data-placement="right" title="Utilice el formato: http://www.example.com"></i></label>
                        {!!Form::input("email", "email", Input::old('email'), array("class" => "form-control","value"=>0, "min"=>0, "step"=>"any"))!!}
                        @if($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Web:") !!}
                        {!!Form::text("web", Input::old('web'), array("class" => "form-control"))!!}
                        @if($errors->has('web'))
                        <div class="error">{{ $errors->first('web') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Estatus:") !!}
                        {!! Form::select('status',array( '1' => 'Activo', '0' => 'Inactivo'), null, array('class' => 'form-control')) !!}
                        @if($errors->has('status'))
                        <div class="error">{{ $errors->first('status') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Planes:") !!}
                        {!! Form::select('plan_id', $planes, null, array('class' => 'form-control')) !!}
                        @if($errors->has('plan_id'))
                        <div class="error">{{ $errors->first('plan_id') }}</div>
                        @endif
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Logo:") !!}
                        {!! Form::file('logo', array('class' => 'form-control')) !!}
                        @if($errors->has('logo'))
                            <div class="error">{{ $errors->first('logo') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-lg-6">
                        {!!Form::submit("Editar Empresa", array("class" => "btn btn-lg btn-success btn-block", "id" =>"btnSubmit"))!!}
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
$('input[name="rif"]').mask("~-9999999?999",{placeholder:" "});
$('input[name="telefono"]').mask("9999-9999999",{placeholder:" "});
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
</script>

@stop

