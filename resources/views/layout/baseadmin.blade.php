<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    {!! HTML::style('assets/css/bootstrap.min.css') !!}
    {!! HTML::style('assets/css/timeline.css') !!}
    {!! HTML::style('assets/css/sb-admin.css') !!}
	{!! HTML::style('assets/admin_page/metisMenu/dist/metisMenu.min.css') !!}
	{!! HTML::style('assets/font-awesome/css/font-awesome.min.css') !!}
    
    <!--link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"-->
    {!! HTML::style('assets/css/telesistema.css') !!}
    {!! HTML::style('assets/css/telesistema-aux.css') !!}

    {!! HTML::script('assets/js/jquery.min.js') !!}
    {!! HTML::script('assets/js/bootstrap.min.js') !!}
	{!! HTML::script('assets/admin_page/metisMenu/dist/metisMenu.min.js') !!}
    {!! HTML::script('assets/js/morris.min.js') !!}
    {!! HTML::script('assets/js/sb-admin-2.js') !!}
    {!! HTML::script('assets/js/jquery.validate.js') !!}
    {!! HTML::script('assets/js/jquery.maskedinput.js') !!}

    <style type="text/css">
    @yield('custom_styles')
    </style>

  </head>

  <body>
      <div id="wrapper" class="@yield('additional-class')">

        @include('admin.header')

        @yield('content')

        @include('admin.footer')

    </div>
    <!-- /#wrapper -->
    <script>
        $(function(){
            @yield('function');
        });
    </script>
  </body> <!-- /#body -->
</html>
