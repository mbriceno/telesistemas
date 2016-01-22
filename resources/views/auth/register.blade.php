<!-- resources/views/auth/register.blade.php -->
@extends('layout.baseadmin')


@section('title')
Planes y Servicios
@stop

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <h1 class="page-header">Registrar nuevo usuario</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-xs-12 col-sm-9 col-lg-9">
                <form method="POST" action="/auth/register">
                    {!! csrf_field() !!}

                    <div>
                        Name
                        <input type="text" name="name" value="{{ old('name') }}">
                    </div>

                    <div>
                        Email
                        <input type="email" name="email" value="{{ old('email') }}">
                    </div>

                    <div>
                        Password
                        <input type="password" name="password">
                    </div>

                    <div>
                        Confirm Password
                        <input type="password" name="password_confirmation">
                    </div>

                    <div>
                        <button type="submit">Register</button>
                    </div>
                </form>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

@stop
