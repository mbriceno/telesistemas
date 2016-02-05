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
                <h1 class="page-header">Agregar nueva empresa</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-xs-12 col-sm-9 col-lg-9">
                {!! Form::open(array("method" => "POST","route" => "admin.empresa.store","role" => "form","id"=>"formid","files"=>true)) !!}
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
                        {!!Form::label("*E-mail:")!!}
                        {!!Form::input("email", "email", Input::old('email'), array("class" => "form-control","value"=>0, "min"=>0, "step"=>"any"))!!}
                        @if($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        <label>*Web: <i class="fa fa-info-circle fa-fw" data-toggle="tooltip" data-placement="right" title="Utilice el formato: http://www.example.com"></i></label>
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
                        {!! Form::label("*Logo:") !!}
                        {!! Form::file('logo', array('class' => 'form-control')) !!}
                        @if($errors->has('logo'))
                            <div class="error">{{ $errors->first('logo') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <h3 class="page-header">Representante Legal</h3>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Nombre:") !!}
                        {!!Form::text("nombre_rl", Input::old('nombre_rl'), array("class" => "form-control"))!!}
                        @if($errors->has('nombre_rl'))
                        <div class="error">{{ $errors->first('nombre_rl') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Apellido:") !!}
                        {!!Form::text("apellido_rl", Input::old('apellido_rl'), array("class" => "form-control"))!!}
                        @if($errors->has('apellido_rl'))
                        <div class="error">{{ $errors->first('apellido_rl') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*C.I.:") !!}
                        {!!Form::text("ci_rl", Input::old('ci_rl'), array("class" => "form-control"))!!}
                        @if($errors->has('ci_rl'))
                        <div class="error">{{ $errors->first('ci_rl') }}</div>
                        @endif
                        <small>Ej.:V-XXXXXXXX</small>
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*R.I.F.:") !!}
                        {!!Form::text("rif_rl", Input::old('rif_rl'), array("class" => "form-control"))!!}
                        @if($errors->has('rif_rl'))
                        <div class="error">{{ $errors->first('rif_rl') }}</div>
                        @endif
                    </div>
                                        
                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!!Form::label("*E-mail:")!!}
                        {!!Form::input("email", "email_rl", Input::old('email_rl'), array("class" => "form-control","value"=>0, "min"=>0, "step"=>"any"))!!}
                        @if($errors->has('email_rl'))
                        <div class="error">{{ $errors->first('email_rl') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!!Form::label("*Teléfono:")!!}
                        {!!Form::text("telefono_rl", Input::old('telefono_rl'), array("class" => "form-control"))!!}
                        @if($errors->has('telefono_rl'))
                        <div class="error">{{ $errors->first('telefono_rl') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!!Form::label("*Dirección:")!!}
                        {!!Form::textarea("direccion_rl", Input::old('direccion_rl'), array("class" => "form-control"))!!}
                        @if($errors->has('direccion_rl'))
                        <div class="error">{{ $errors->first('direccion_rl') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <h3 class="page-header">Persona de contacto</h3>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Nombre:") !!}
                        {!!Form::text("nombre_ct", Input::old('nombre_ct'), array("class" => "form-control"))!!}
                        @if($errors->has('nombre_ct'))
                        <div class="error">{{ $errors->first('nombre_ct') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Apellido:") !!}
                        {!!Form::text("apellido_ct", Input::old('apellido_ct'), array("class" => "form-control"))!!}
                        @if($errors->has('apellido_ct'))
                        <div class="error">{{ $errors->first('apellido_ct') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*C.I.:") !!}
                        {!!Form::text("ci_ct", Input::old('ci_ct'), array("class" => "form-control"))!!}
                        @if($errors->has('ci_ct'))
                        <div class="error">{{ $errors->first('ci_ct') }}</div>
                        @endif
                        <small>Ej.:V-XXXXXXXX</small>
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*R.I.F.:") !!}
                        {!!Form::text("rif_ct", Input::old('rif_ct'), array("class" => "form-control"))!!}
                        @if($errors->has('rif_ct'))
                        <div class="error">{{ $errors->first('rif_ct') }}</div>
                        @endif
                        <small>Ej.:J-XXXXXXXX</small>
                    </div>
                                        
                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!!Form::label("*E-mail:")!!}
                        {!!Form::input("email", "email_ct", Input::old('email_ct'), array("class" => "form-control","value"=>0, "min"=>0, "step"=>"any"))!!}
                        @if($errors->has('email_ct'))
                        <div class="error">{{ $errors->first('email_ct') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!!Form::label("*Teléfono:")!!}
                        {!!Form::text("telefono_ct", Input::old('telefono_ct'), array("class" => "form-control"))!!}
                        @if($errors->has('telefono_ct'))
                        <div class="error">{{ $errors->first('telefono_ct') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!!Form::label("*Dirección:")!!}
                        {!!Form::textarea("direccion_ct", Input::old('direccion_ct'), array("class" => "form-control"))!!}
                        @if($errors->has('direccion_ct'))
                        <div class="error">{{ $errors->first('direccion_ct') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <h3 class="page-header">Planes Disponibles</h3>
                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Planes:") !!}
                        {!! Form::select('plan_id', $planes, null, array('class' => 'form-control')) !!}
                        @if($errors->has('plan_id'))
                        <div class="error">{{ $errors->first('plan_id') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-lg-6">
                        {!!Form::submit("Agregar Empresa", array("class" => "btn btn-lg btn-success btn-block", "id" =>"btnSubmit"))!!}
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
$('input[name="rif"],input[name="ci_rl"],input[name="rif_rl"],input[name="ci_ct"],input[name="rif_ct"]').mask("~-9999999?999",{placeholder:" "});
$('input[name="telefono"],input[name="telefono_rl"],input[name="telefono_ct"]').mask("9999-9999999",{placeholder:" "});
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
</script>

@stop

