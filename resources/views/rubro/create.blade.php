@extends('layout.baseadmin')


@section('title')
Rubros
@stop

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <h1 class="page-header">Agregar nuevo rubro</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-xs-12 col-sm-9 col-lg-9">
                {!! Form::open(array("method" => "POST","route" => "admin.rubro.store","role" => "form","id"=>"formid")) !!}

                    <div class="form-group">
                        {!! Form::label("*Nombre:") !!}
                        {!!Form::text("nombre", Input::old('nombre'), array("class" => "form-control"))!!}
                        @if($errors->has('nombre'))
                        <div class="error">{{ $errors->first('nombre') }}</div>
                        @endif
                    </div> 
                                        
                    <div class="form-group">
                        {!!Form::label("*Descripción:")!!}
                        {!!Form::textarea("descripcion", Input::old('descripcion'), array("class" => "form-control"))!!}
                        @if($errors->has('descripcion'))
                        <div class="error">{{ $errors->first('descripcion') }}</div>
                        @endif
                    </div>

                    <div class="form-group ">
                        {!! Form::label("*Activo:") !!}
                        {!! Form::select('status',array( '1' => 'Activo', '0' => 'Inactivo'), null, array('class' => 'form-control')) !!}
                        @if($errors->has('status'))
                        <div class="error">{{ $errors->first('status') }}</div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-6 col-lg-6">
                            {!!Form::submit("Agregar Rubro", array("class" => "btn btn-lg btn-success btn-block", "id" =>"btnSubmit"))!!}
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-lg-6">
                            <a href="{!!URL::route('admin.rubro.index')!!}" class="btn btn-lg btn-danger btn-block">Volver</a>
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

    /*$('#btnSubmit').click(function(e){
        if ($("#formid").valid()) 
        {
            console.log("Valido");
        }
        else
        {
            console.log("No Valido");
        }
    });
    $("#formid").validate({
        rules: {
            name: { required: true},
            descripcion: { required: true},
        },
        messages: {
            name: '<div class="alert alert-danger" role="alert">El campo nombre es requerido.</div>',
            descripcion: '<div class="alert alert-danger" role="alert">El campo descripción es requerido.</div>',
        }
    });*/

</script>

@stop

