@extends('layout.baseadmin')


@section('title')
Bancos
@stop

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <h1 class="page-header">Editar banco</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-xs-12 col-sm-9 col-lg-6">
                {!! Form::model($banco, array('route' => array('admin.bancos.update', $banco->id), 'method' => 'PUT','id'=>'formid')) !!}
                    <div class="form-group">
                        {!! Form::label("*Nombre:") !!}
                        {!!Form::text("nombre", Input::old('nombre'), array("class" => "form-control"))!!}
                        @if($errors->has('nombre'))
                        <div class="error">{{ $errors->first('nombre') }}</div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-6 col-lg-6">
                            {!!Form::submit("Editar banco", array("class" => "btn btn-lg btn-success btn-block", "id" =>"btnSubmit"))!!}
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-lg-6">
                            <a href="{!!URL::route('admin.bancos.index')!!}" class="btn btn-lg btn-danger btn-block">Volver</a>
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

