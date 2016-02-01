@extends('layout.baseadmin')

@section('title')
Auditorias
@stop

@section('content')

<div id="page-wrapper">
    <div class="row row-centered">
        <div class="col-xs-12 col-sm-12 col-lg-12">
            <h1 class="page-header">Bancos</h1>
        </div>
                
        <div class="col-xs-12 col-sm-12 col-lg-12">
            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                {!! Session::get('message') !!}
            @endif
            <div class="panel panel-default" style="margin-top:15px">
                <div class="panel-heading">
                    Auditoría del Sistema
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper table-responsive">
                        <div class="panel-group log-accordion" id="accordion" role="tablist" aria-multiselectable="true">
                            @foreach ($logs as $log)
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading{{$log->id}}">
                                    <h5 class="panel-title">
                                        <a role="button" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$log->id}}" aria-expanded="@if($log->id==1)true @else false @endif" aria-controls="collapse{{$log->id}}">
                                            {!!$log->customMessage!!}
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse{{$log->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <ul>
                                            @forelse($log->customFields as $custom)
                                            <li>{{$custom}}</li>
                                            @empty
                                            <li>Sin detalles</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>  
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-xs-12 col-sm-12 col-lg-12">
            {!! $logs->render() !!}
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

@stop
