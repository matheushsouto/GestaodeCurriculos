@extends('layout.main_layout')

@section("title", "Cadastro")

@section("dialogs")
    <div class="ui-dialog " id="dialog-btn-pdf" title="Imprimir PDF">
        <div class="form-group">
            <label>Quais dados exibir?</label>
            <div class="checkbox">
                <label>
                    <input type="checkbox" checked id="chekIndicacao" value="consulta">Indicaçõo
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" checked id="chekDocumentos" value="consulta">Documentos
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" checked id="chekConhecimento" value="consulta">Conhecimento
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" checked id="chekExperiencia" value="consulta">Experiencias
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" checked id="chekConsulta" value="consulta">Consulta
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" checked id="chekEntrevista" value="consulta">Entrevista
                </label>
            </div>
        </div>
    </div>
@endsection

@section("css")
    <link rel="stylesheet" type="text/css" href="{{asset('dist/css/avaliacao_cadastro.css')}}">
    <style>
        #progressbar .ui-progressbar-value {
            background-color: #ccc;
        }
    </style>
@endsection

@section("cabecalho_pagina")
    <div class="col-lg-4">
        <h1 class="page-header">Avaliação</h1>
    </div>
    <div class="col-lg-2 text-right">

    </div>
    <div class="col-lg-1 ">

    </div>
    <div class="col-lg-1 text-left">

    </div>

@endsection
@section("corpo_pagina")
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Envie um email</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <form action="{{route('email')}}" method="post" id="form-email">
                            {{ csrf_field() }}
                            <input type="hidden" id="email" name="email[email]" value="">
                            <input type="hidden" id="id" name="email[id]" value="{{$curriculo->id}}">
                            <div class="form-group">
                                <label for="ger_email">Assunto</label>
                                <input type="text" class="form-control" name="email[assunto]" id="assunto"
                                       placeholder="Assunto Email">
                            </div>
                            <div class="form-group">
                                <label for="ger_email">Mensagem</label>
                                <textarea rows="4" placeholder="Mensagem Email" class="form-control"
                                          name="email[mensagem]" id="mensagem"></textarea>
                            </div>
                        </form>
                        <div class="col-md-12 text-right">
                            <p><i class="glyphicon glyphicon-paperclip"></i> Curriculo Completo Anexado</p>
                        </div>
                    </div>
                    <div style="position: relative;" id="progressbar"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnEnvEmail" class="btn btn-primary">Enviar Email</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="col-lg-9">
            <form method="POST" action="{{route("avaliacao_cadastro")}}" id="form">
                {{ csrf_field() }}
                <input type="hidden" name="avaliacoes[id_curriculo]" value="{{$curriculo->id}}">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            RH
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label for="rh_email">Email</label>
                                    <input type="text" class="form-control" name="avaliacoes[rh_email]" id="rh_email"
                                           placeholder="RH Email">
                                </div>
                            </div>
                            <div class="col-lg-3 text-right">
                                <button type="button" style="margin-top: 15%" class="btn btn-success"
                                        onclick="atribuiEmailEmail('rh_email')" data-toggle="modal"
                                        data-target="#myModal">
                                    Enviar Email
                                </button>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="rh_mensagem">Consideracoes</label>
                                        <textarea rows="3" class="form-control" name="avaliacoes[rh_mensagem]"
                                                  id="rh_mensagem"
                                                  placeholder="Considerações do RH"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Gerente
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label for="ger_email">Email</label>
                                    <input type="text" class="form-control" name="avaliacoes[ger_email]" id="ger_email"
                                           placeholder="Gerente Email">
                                </div>
                            </div>
                            <div class="col-lg-3 text-right">
                                <button type="button" style="margin-top: 15%" class="btn btn-success"
                                        onclick="atribuiEmailEmail('ger_email')" data-toggle="modal"
                                        data-target="#myModal">
                                    Enviar Email
                                </button>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="ger_mensagem">Consideracoes</label>
                                        <textarea rows="3" class="form-control" name="avaliacoes[ger_mensagem]"
                                                  id="ger_mensagem"
                                                  placeholder="Considerações do Gerente"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Encaregado
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label for="enc_email">Email</label>
                                    <input type="text" class="form-control" name="avaliacoes[enc_email]" id="enc_email"
                                           placeholder="Encarregado Email">
                                </div>
                            </div>
                            <div class="col-lg-3 text-right">
                                <button type="button" style="margin-top: 15%" class="btn btn-success"
                                        onclick="atribuiEmailEmail('enc_email')" data-toggle="modal"
                                        data-target="#myModal">
                                    Enviar Email
                                </button>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="enc_mensagem">Consideracoes</label>
                                        <textarea rows="3" class="form-control" name="avaliacoes[enc_mensagem]"
                                                  id="enc_mensagem"
                                                  placeholder="Considerações do Encarregado"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Responsavel
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label for="res_email">Email</label>
                                    <input type="text" class="form-control" name="avaliacoes[res_email]" id="res_email"
                                           placeholder="Responsével Email">
                                </div>
                            </div>
                            <div class="col-lg-3 text-right">
                                <button type="button" style="margin-top: 15%" class="btn btn-success"
                                        onclick="atribuiEmailEmail('res_email')" data-toggle="modal"
                                        data-target="#myModal">
                                    Enviar Email
                                </button>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="res_email">Consideracoes</label>
                                        <textarea rows="3" class="form-control" name="avaliacoes[res_mensagem]"
                                                  id="res_mensagem"
                                                  placeholder="Considerações do Responsável"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="resfinal">Consideracoes Finais</label>
                        <textarea rows="5" class="form-control" name="avaliacoes[resfinal]"
                                  id="resFinal" placeholder="Considerações Finais"></textarea>
                    </div>
                </div>
                <div class="col-lg-12 text-right" id="divEnvAva">
                    <button class="btn btn-success">Enviar</button>
                </div>
            </form>
        </div>
        <div class="col-lg-3">
            <a class="btn btn-primary page-header btn-lateral-show" target="_blank"
               href="{{route('curriculo_show',['id'=> $curriculo['id']] )}}">Curriculo Completo</a>
            <a class="btn btn-primary page-header btn-lateral-show" target="_blank"
               href="{{route('consultas_cadastro',['id'=> $curriculo['id']] )}}">Consulta</a>
            <a class="btn btn-primary page-header btn-lateral-show" target="_blank"
               href="{{route('entrevistas_cadastro',['id'=> $curriculo['id']] )}}">Entrevista</a>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            @if($avaliacao != null)
                @foreach(array_keys($avaliacao[0]) as $key)
                    $('#{{$key}}').val('{{$avaliacao[0][$key]}}');
                @endforeach
                $('#form').attr('action', '{{route('avaliacao_editar')}}?id={{$avaliacao[0]['id']}}');
            @endif
            $("#progressbar").hide();
            $("#progressbar").progressbar({
                value: true
            });
            $('#btnEnvEmail').click(function () {

                if ($('#assunto').val() == '' || $('#mensagem').val() == '') {
                    alert("Preencha todos os campos");
                } else {
                    progressbar = $("#progressbar");
                    progressbarValue = progressbar.find(".ui-progressbar-value");
                    if ($('#email').val() == '') {
                        alert("Preencha o campo de email");
                        $('#myModal').modal('hide');
                    } else {
                        var dados = $('#form-email').serialize();
                        $("#progressbar").show();
                        progressbar.progressbar("option", "value", false);
                        $.ajax({
                            type: "POST",
                            url: '{{route('email')}}',
                            data: dados,
                            success: function (data) {
                                alert('Email Enviado');
                                $("#progressbar").hide();
                                progressbar.progressbar("option", "value", true);
                                $('#myModal').modal('hide');
                            },
                            error: function () {
                                alert("Email Não Enviao");
                                $("#progressbar").hide();
                                progressbar.progressbar("option", "value", true);
                            }
                        });
                    }
                }
            });
            $('#btnGeraPDF').click(function () {
            });
        });
        function atribuiEmailEmail(id_input) {
            email = $('#' + id_input).val();
            $('#email').val(email);
        }
    </script>
@endsection

@section('menu_cadastro_css')active @endsection
@section('menu_cadastro_Avaliação_css')
    background-color: #5C4C9E;
    color: white;
@endsection