<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>
    
    {!! HTML::style('assets/admin_page/bootstrap/dist/css/bootstrap.min.css') !!}
    {!! HTML::style('assets/admin_page/metisMenu/dist/metisMenu.min.css') !!}
    {!! HTML::style('assets/css/timeline.css') !!}
    {!! HTML::style('assets/css/sb-admin-2.css') !!}
    {!! HTML::style('assets/admin_page/morrisjs/morris.css') !!}
    
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    {!! HTML::style('assets/css/telesistema.css') !!}

    {!! HTML::script('assets/admin_page/jquery/dist/jquery.min.js') !!}
    {!! HTML::script('assets/admin_page/bootstrap/dist/js/bootstrap.min.js') !!}
    {!! HTML::script('assets/admin_page/metisMenu/dist/metisMenu.min.js') !!}
    {!! HTML::script('assets/admin_page/raphael/raphael-min.js') !!}
    {!! HTML::script('assets/js/morris.min.js') !!}
    <!--{!! HTML::script('assets/js/morris-data.js') !!}-->
    {!! HTML::script('assets/js/sb-admin-2.js') !!}
    {!! HTML::script('assets/js/jquery.validate.js') !!}
    {!! HTML::script('assets/js/jquery.maskedinput.js') !!}
    <style type="text/css">
    @yield('custom_styles')
    </style>

  </head>

  <body>
      <div id="wrapper">

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