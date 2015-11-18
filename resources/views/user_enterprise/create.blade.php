@extends('layout.baseadmin')

@section('title')
Nuevo usuario para empresas
@stop

@section('additional-class')
@role('empresas.administrador')
wrapper-ventas
@endrole
@stop

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <h1 class="page-header">Nuevo usuario para empresas</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-xs-12 col-sm-9 col-lg-9">
                {!! Form::open(array("method" => "POST","route" => "admin.usuarios_empresa.store","role" => "form","id"=>"formid")) !!}
                <input type="hidden" name="enterprise_id" value="{{$id}}">
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Nombre de usuario:") !!}
                        {!!Form::text("name", Input::old('name'), array("class" => "form-control"))!!}
                        @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
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
                        {!! Form::label("Password:") !!}
                        {!! Form::input("password", "password", Input::old('web'), array("class" => "form-control")) !!}
                        @if($errors->has('password'))
                        <div class="error">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("Confirmar Password:") !!}
                        {!! Form::input("password", "password_confirmation", Input::old('web'), array("class" => "form-control")) !!}
                        @if($errors->has('password_confirmation'))
                        <div class="error">{{ $errors->first('password_confirmation') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Cargo/Tipo de usuario:") !!}
                        {!! Form::select('role_id', $roles, null, array('class' => 'form-control')) !!}
                        @if($errors->has('role_id'))
                        <div class="error">{{ $errors->first('role_id') }}</div>
                        @endif
                    </div>

                </div>
                <div class="row">
                    <h3 class="page-header">Datos de perfil</h3>

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
                        {!! Form::label("*C.I.:") !!}
                        {!!Form::text("ci", Input::old('ci'), array("class" => "form-control"))!!}
                        @if($errors->has('ci'))
                        <div class="error">{{ $errors->first('ci') }}</div>
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
                        {!!Form::label("*Celular:")!!}
                        {!!Form::text("celular", Input::old('celular'), array("class" => "form-control"))!!}
                        @if($errors->has('celular'))
                        <div class="error">{{ $errors->first('celular') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Sexo:") !!}
                        {!! Form::select('sexo',array( 'M' => 'Masculino', 'F' => 'Femenino'), null, array('class' => 'form-control')) !!}
                        @if($errors->has('sexo'))
                        <div class="error">{{ $errors->first('sexo') }}</div>
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
                        {!!Form::submit("Crear usuario", array("class" => "btn btn-lg btn-success btn-block", "id" =>"btnSubmit"))!!}
                    </div>
                    <div class="form-group col-xs-12 col-sm-6 col-lg-6">
                        <a href="{!! URL::route('admin.empresa.staff', $id) !!}" class="btn btn-lg btn-danger btn-block">Volver</a>
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
$('input[name="ci"]').mask("~-9999999?999",{placeholder:" "});
$('input[name="telefono"],input[name="celular"]').mask("9999-9999999",{placeholder:" "});
</script>

@stop

