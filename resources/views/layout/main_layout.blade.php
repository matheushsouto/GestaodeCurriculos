<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistema de Currículos - @yield('title')</title>

    {{--Arquivos CSS de bibliotecas de terceiros--}}
    <link href="{{asset('/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">
    <link href="{{asset('/vendor/morrisjs/morris.css')}}" rel="stylesheet">
    <link href="{{asset('/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('/vendor/jquery-ui-1.12.1/jquery-ui.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('/vendor/datatables/datatables.min.css')}}"/>
    <link href="{{asset('/vendor/select2/select2.min.css')}}" rel="stylesheet" />

    {{--Minhas folhas de estilos--}}
    <link href="{{asset('/css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{asset('/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('/css/layout.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/tabela.css')}}">
    @yield("css")

</head>

<body>

<script src="{{asset('/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/vendor/jquery-ui-1.12.1/jquery-ui.js')}}"></script>
<script src="{{asset('/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/vendor/metisMenu/metisMenu.min.js')}}"></script>
<script src="{{asset('/vendor/jquery/jquery.mask.js')}}"></script>

<script type="text/javascript" src="{{asset('/vendor/pdfmake/pdfmake.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/vendor/pdfmake/vfs_fonts.js')}}"></script>
<script type="text/javascript" src="{{asset('/vendor/datatables/datatables.min.js')}}"></script>

<script src="{{asset('/js/sb-admin-2.js')}}"></script>
<script src="{{asset('/js/dialogs/dialogNovaAvaliacao.js')}}"></script>
<script src="{{asset('/js/dialogs/dialogNovaConsulta.js')}}"></script>
<script src="{{asset('/js/dialogs/dialogNovaEntrevista.js')}}"></script>
<script src="{{asset('/js/myLib/calcularIdade.js')}}"></script>

<script>
    $(function ($) {
        var urlAvaliacao = '{{ route('show_curriculo',['tipo' => 'avaliacao']) }}';
        var urlConsulta = '{{ route('show_curriculo',['tipo' => 'consulta']) }}';
        var urlEntrevista = '{{ route('show_curriculo',['tipo' => 'entrevista']) }}';
        dialogNovaAvaliacao(urlAvaliacao,'{{route('avaliacao_cadastro')}}' , '{{ csrf_token() }}');
        dialogNovaEntrevista(urlEntrevista, '{{route('entrevistas_cadastro')}}' ,'{{ csrf_token() }}');
        dialogNovaConsulta(urlConsulta,'{{route('consultas_cadastro')}}', '{{ csrf_token() }}');

    });

</script>

@yield("scripts")
<div id="wrapper">

    <!-- Navigation -->
    <nav id="cabecalho_menu" class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a style=" padding: 0; margin-top: 10px; margin-left: 10px" class="navbar-brand"
               href="{{route('home')}}"><img class="logo_curriculo_img"  src="{{asset('img/logo_superpao.png')}}"></a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">

            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-gear  fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i>Meus Dados</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i>Configurações</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            Sair
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- /.navbar-top-links -->


        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="menu_inicio_css">
                        <a href="{{route('home')}}"><i class="fa fa-dashboard fa-fw"> </i>&nbsp Inicio</a>
                    </li>
                    <li class="menu_cadastro_curriculo">
                        <a href="{{route('curriculo_index')}}"><i class="fa fa-book fa-fw "> </i>&nbsp Curriculo</a>
                    </li>
                    <li class="menu_cadastro_consulta">
                        <a  id="btnCadConsulta" ><i class="fa fa- fa-search-plus "> </i>&nbsp Curriculo - Consulta</a>
                    </li>
                    <li class="menu_cadastro_entrevista">
                        <a  id="btnCadEntrevista"><i class="fa fa-book fa-users "> </i>&nbsp Curriculo - Entrevista</a>
                    </li>
                    <li class="menu_cadastro_avaliacao">
                        <a  id="btnCadAvaliacao" ><i class="fa fa-book fa-check-square "> </i>&nbsp Curriculo - Avaliacao</a>
                    </li>
                    <li class="menu_loja">
                        <a href="/loja"><i class="fa fa-shopping-cart fa-fw"> </i>&nbsp Lojas</a>
                    </li>
                    <li class="menu_cargo">
                        <a href="/cargo"><i class="fa fa-archive fa-fw"> </i>&nbsp Cargos</a>
                    </li>
                    <li class="menu_vagas">
                        <a href="/vaga"><i class="fa fa-check fa-fw"> </i>&nbsp Vagas</a>
                    </li>
                    <li class="menu_consulta">
                        <a href="#"><i class="fa fa-search fa-fw "></i>&nbsp  Consultar Curriculos<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="menu_consulta_todos"
                                   href="{{route('curriculo_listall',['tipo'=>'todos'])}}"><i
                                            class="fa fa-search"> </i>&nbsp Todos Curricolos</a>
                            </li>
                            <li>

                                <a class="menu_consulta_pendentes"
                                   href="{{route('curriculo_listall',['tipo'=>'pendentes'])}}"><i
                                            class="fa fa-clock-o"> </i>&nbsp Curricolos Pendentes</a>

                            </li>
                            <li>
                                <a class="menu_consulta_baixados"
                                   href="{{route('curriculo_listall',['tipo'=>'baixados'])}}"><i
                                            class="fa fa-arrow-down"> </i>&nbsp Curricolos Baixados</a>
                            </li>
                            <li>
                                <a class="Fmenu_consulta_indicados"
                                   href="{{route('curriculo_listall',['tipo'=>'indicados'])}}"><i
                                            class="fa fa-hand-o-right"> </i>&nbsp Curricolos Indicados</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div id="page-wrapper">
        <div class="row">
            @yield('cabecalho_pagina')
        </div>

        <!-- /.paineis indicadores -->
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
<!--refatorar depois -->
</div>
<div id="dialog-nova-consulta" title="Curriculos Disponiveis Para Nova Consulta">
    <div class="col-lg-12">
        <p>Selecione um Curriculo</p>
        <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="table-consulta">
            <thead>
            <tr>
                <th></th>
                <th>Nome</th>
                <th>Vaga</th>
                <th>Indicação</th>
                <th>Escolaridade</th>
            </tr>
            </thead>
        </table>
    </div>
</div>

<div id="dialog-nova-entrevista" title="Curriculos Disponiveis Para Nova Entrevista">
    <div class="col-lg-12">
        <p>Selcione uma Entrevista</p>
        <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="table-entrevista">
            <thead>
            <tr>
                <th></th>
                <th>Nome</th>
                <th>Cargo</th>
                <th>Indicação</th>
                <th>Escolaridade</th>
            </tr>
            </thead>
        </table>
    </div>
</div>

<div id="dialog-nova-avaliacao" title="Curriculos Disponiveis Para Nova Entrevista">
    <div class="col-lg-12">
        <p>Selcione uma Entrevista</p>
        <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="table-avaliacao">
            <thead>
            <tr>
                <th></th>
                <th>Nome</th>
                <th>Cargo</th>
                <th>Indicação</th>
                <th>Escolaridade</th>
            </tr>
            </thead>
        </table>
    </div>
</div>



@yield("dialogs")


</body>

</html>
