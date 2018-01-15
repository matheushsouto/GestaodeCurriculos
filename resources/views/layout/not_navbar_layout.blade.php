<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistema de Currículos - @yield('title')</title>


    <link rel="shortcut icon" href="{{asset('curriculum.ico')}}" >
    <link href="{{asset('/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">
    <link href="{{asset('/vendor/morrisjs/morris.css')}}" rel="stylesheet">
    <link href="{{asset('/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('/vendor/jquery-ui-1.12.1/jquery-ui.css')}}" rel="stylesheet">


    <link href="{{asset('/css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{asset('/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('/css/layout.css')}}" rel="stylesheet">

    @yield("css")


</head>

<body>
<script src="{{asset('/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/vendor/jquery-ui-1.12.1/jquery-ui.js')}}"></script>
<script src="{{asset('/vendor/metisMenu/metisMenu.min.js')}}"></script>
<script src="{{asset('/js/sb-admin-2.js')}}"></script>

<script src="{{asset('/vendor/jquery/jquery.mask.js')}}"></script>
@yield("scripts")

<div id="wrapper">


    <div >
        <div class="row">
            @yield('cabecalho_pagina')
        </div>

        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    @yield('corpo_pagina')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->

</div>

@yield("dialogs")
</body>

</html>
