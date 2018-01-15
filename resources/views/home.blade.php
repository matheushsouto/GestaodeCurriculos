@extends('layout.main_layout')

@section('css')
    <link href="{{asset('/css/home.css')}}" rel="stylesheet">
@endsection
@section('scripts')
    <script>
        function carregaLista() {
            function adicionaLinkHtml(json, i) {
                $('#anotacoes').append("\
                            <div class='list-group-item col-lg-12'>\
                                <div class='col-lg-10'>\
                                    <a onclick='openAnotacao(" + json[i].id + ")'><i class='fa fa-sticky-note-o'></i>  " + json[i].titulo + "</a>\
                                </div>\
                                <div  class='col-lg-2  apagaAnotacao'>\
                                    <button onclick='apagaAnotacao(" + json[i].id + ")'  class='btn btn-danger text-right '><i class='fa fa-trash-o'></i></button>\
                                </div>\
                            </div>");
            }

            $.getJSON(
                '{{route('listNotation')}}',
                {id: 'teste'},
                function (json) {
                    var i;
                    $('#anotacoes').html("");
                    for (i = 0; i < json.length; i++) {
                        adicionaLinkHtml(json, i);
                    }
                }
            );
        }

        function openAnotacao($id) {

            $.getJSON(
                '{{route('openNotation')}}',
                {id: $id},
                function (json) {
                    carregaAnotacaoDialog(json);
                }
            );
        }

        function apagaAnotacao($id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: "POST",
                url: "{{route('delNotation')}}",
                data: {id: $id},
                success: function (data) {
                    carregaLista();
                },
                error: function () {
                    alert('Ocorreu um erro');
                }
            });
        }

        function adicionaAnotacao() {
            //inserir depois validação dos campos
            var dados = $('#form_anotacao').serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                type: "POST",
                url: "{{route('addNotation')}}",
                data: dados,
                success: function (data) {
                    carregaLista();
                    limpaCampos();
                },
                error: function () {
                    alert('Ocorreu um erro, tente novamente');
                }
            });
        }

        function carregaAnotacaoDialog(json) {
            $("#dialog-show-anotacao").dialog({
                modal: true,
                width: 350,
                show: 100,
                height: 200,
                title: json[0].titulo,
                open: function () {
                    document.getElementById("anotacaoTexto").innerHTML = json[0].anotacao;
                },
                buttons: {
                    Cancelar: function () {
                        $(this).dialog("close");
                    }
                }
            });
        }

        function carregaAddAnotDialog() {
            $("#dialog-create-ano").dialog({
                modal: true,
                width: 500,
                show: 150,
                height: 320,
                buttons: {
                    Salvar: function () {
                        adicionaAnotacao();
                        $(this).dialog("close");
                    },
                    Cancelar: function () {
                        $(this).dialog("close");
                    }
                }
            });
        }

        function limpaCampos() {
            $('#inputTitulo').val('');
            $('#inputTexto').val('');
        }

        $(function () {
            //esconde dialogs
            carregaLista();
            $('#dialog-create-ano').hide();
            $('#dialog-show-anotacao').hide()
            $('#addAnotacao').click(function () {
                carregaAddAnotDialog();
            });
        });
    </script>
@endsection

@section('dialogs')
    <div class="ui-dialog " id="dialog-create-ano" title="Nova Anotação">
        <form onsubmit="return false" method="post" action="" id="form_anotacao">
            <div class="form-group">
                <label>Titulo</label>
                <input type="text" name="titulo" id="inputTitulo" class="form-control">
            </div>
            <div class="form-group">
                <label>Texto</label>
                <textarea rows="3" type="text" name="texto" id="inputTexto" class="form-control"></textarea>
            </div>
        </form>
    </div>
    <div class="ui-dialog" id="dialog-show-anotacao" title="Anotacao">
        <p id="anotacaoTexto">A anotação não foi carregada corretamente</p>
    </div>
@endsection

@section('corpo_pagina')
    <div style="margin-top: 2%">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-copy fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$totCurriculo}}</div>
                            <div>Todos os Curricolos!</div>
                        </div>
                    </div>
                </div>
                <a href="{{route('curriculo_listall',['tipo'=>'todos'])}}">
                    <div class="panel-footer">
                        <span class="pull-left">Visualizar</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-clock-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$totalPendentesCurriculo}}</div>
                            <div>Curricolos Pendentes</div>
                        </div>
                    </div>
                </div>
                <a href="{{route('curriculo_listall',['tipo'=>'pendentes'])}}">
                    <div class="panel-footer">
                        <span class="pull-left">Visualizar</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-check-square-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$totalIndicacoesPendentes}}</div>
                            <div>Indicados Pendentes</div>
                        </div>
                    </div>
                </div>
                <a href="{{route('curriculo_listall',['pendentes'=>'indicados'])}}">
                    <div class="panel-footer">
                        <span class="pull-left">Visualizar</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-arrow-circle-down fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$totalCurriculoBaixado}}</div>
                            <div>Curriculos Baixados</div>
                        </div>
                    </div>
                </div>
                <a href="{{route('curriculo_listall',['tipo'=>'baixados'])}}">
                    <div class="panel-footer">
                        <span class="pull-left">Visualizar</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    </div>
    <!-- /.paineis indicadores -->
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default" id="div_tipo_curricolo">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i>Ultimas 10 vagas cadastradas
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <thead class="table-header">
                            <tr>
                                <th>Abrir</th>
                                <th>Descrição</th>
                                <th>Quantidade</th>
                                <th>Loja</th>
                                <th>Cargo</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($vagas as $vagaTable)
                                <tr>
                                    <td><a href="{{route('vaga_editar_get', ['id' => $vagaTable->id])}}" class="btn btn-primary"><span class="fa fa-folder-open-o"></span></a></td>
                                    <td>{{$vagaTable->descricao}}</td>
                                    <td>{{$vagaTable->quantidade}}</td>
                                    <td>{{$vagaTable->loja->nome}}</td>
                                    <td>{{$vagaTable->cargo->descricao}}</td>
                                    <td style="text-align: center">
                                        @if($vagaTable->status == "aberto")
                                            <span style="color: green" class="fa fa-circle-o"></span>
                                        @else
                                            <span style="color: red" class="fa fa-circle-o"></span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-sticky-note fa-fw"></i> Anotações
                </div>
                <div class="panel-body">
                    <button class="btn btn-default btn-block" id="addAnotacao">
                        Adicionar Notação
                    </button>
                    <div class="list-group" id="anotacoes">

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

