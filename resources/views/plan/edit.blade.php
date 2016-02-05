@extends('layout.baseadmin')


@section('title')
Planes y Servicios
@stop

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <h1 class="page-header">Editar Plan</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-xs-12 col-sm-9 col-lg-9">
                {!! Form::model($plan, array('route' => array('admin.plan.update', $plan->id), 'method' => 'PUT','id'=>'formid')) !!}
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Nombre:") !!}
                        {!!Form::text("nombre", Input::old('nombre'), array("class" => "form-control"))!!}
                        @if($errors->has('nombre'))
                        <div class="error">{{ $errors->first('nombre') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Rubro:") !!}
                        {!! Form::select('rubro_id', $rubros, null, array('class' => 'form-control')) !!}
                        @if($errors->has('rubro_id'))
                        <div class="error">{{ $errors->first('rubro_id') }}</div>
                        @endif
                    </div>
                                        
                    <div class="form-group col-xs-12 col-sm-12 col-lg-12">
                        {!!Form::label("*Descripción:")!!}
                        {!!Form::textarea("descripcion", Input::old('descripcion'), array("class" => "form-control"))!!}
                        @if($errors->has('descripcion'))
                        <div class="error">{{ $errors->first('descripcion') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Duración de la membresía:") !!}
                        <div>
                        {!! Form::input('number', 'tiempo_membresia', Input::old('tiempo_membresia'), array("class"=>"form-control custom_width_number","min"=>0)) !!}
                        {!! Form::select('unidad_tiempo', 
                                        array('hours' => 'Hora(s)', 
                                                'days' => 'Día(s)', 
                                                'weeks' => 'Semana(s)', 
                                                'months' => 'Mes(es)', 
                                                'years' => 'Año(s)'), 
                                        null, 
                                        array("class" => "form-control col-xs-9 col-sm-9 col-lg-9 custom_width_select") ) !!}
                                        
                        </div>
                        @if($errors->has('tiempo_membresia'))
                        <div class="error">{{ $errors->first('tiempo_membresia') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Período de pago:") !!}
                        {!! Form::select('period_id', $periodos, null, array('class' => 'form-control')) !!}
                        @if($errors->has('period_id'))
                        <div class="error">{{ $errors->first('period_id') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Tipo de plan:") !!}
                        {!! Form::select('tipo',array( 'planes' => 'Planes', 'servicios' => 'Servicios'), null, array('class' => 'form-control')) !!}
                        @if($errors->has('tipo'))
                        <div class="error">{{ $errors->first('tipo') }}</div>
                        @endif
                    </div>

                    <!--div class="form-group col-xs-6 col-sm-3 col-lg-6">
                        {!!Form::label("*Fecha Inicio:")!!}
                        {!!Form::input('date', 'fecha_inicio', Input::old('fecha_inicio'), array("class" => "form-control",'id'=>'fecha_inicio'))!!}
                        @if($errors->has('fecha_inicio'))
                        <div class="error">{{ $errors->first('fecha_inicio') }}</div>
                        @endif
                    </div-->

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!!Form::label("*Costo:")!!}
                        {!!Form::input("number", "costo", Input::old('costo'), array("class" => "form-control","value"=>0, "min"=>0, "step"=>"any"))!!}
                        @if($errors->has('costo'))
                        <div class="error">{{ $errors->first('costo') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Descuento (%):") !!}
                        {!! Form::input("number", "porcentaje", Input::old('porcentaje'), array("class" => "form-control","value"=>0, "min"=>0, "max"=>100, "step"=>"any")) !!}
                        @if($errors->has('porcentaje'))
                        <div class="error">{{ $errors->first('porcentaje') }}</div>
                        @endif
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-lg-6">
                        {!! Form::label("*Estatus:") !!}
                        {!! Form::select('status',array( '1' => 'Activo', '0' => 'Inactivo'), null, array('class' => 'form-control')) !!}
                        @if($errors->has('status'))
                        <div class="error">{{ $errors->first('status') }}</div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6 col-lg-6">
                        {!!Form::submit("Agregar Plan", array("class" => "btn btn-lg btn-success btn-block", "id" =>"btnSubmit"))!!}
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

</script>

@stop

