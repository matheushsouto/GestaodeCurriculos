@extends('layout.main_layout')

@section("title", "Cadastro")

@section("css")
    <link rel="stylesheet" type="text/css" href="{{asset('/css/consulta_cadastro.css')}}">
@endsection

@section("cabecalho_pagina")
    @if(isset($salvou))
        <div style="text-align: center; background: darkseagreen;margin: 10px" class="col-lg-12">
            <h3>Salvou</h3>
        </div>
    @endif
    <div class="col-lg-6">
        <h1 class="page-header">Novo Consulta</h1>
    </div>

    <div class="col-lg-6 text-right">
        <a href="{{route('curriculo_show', ['id'=>$curriculo['id']])}}" class="btn btn-primary page-header">Curriculo
            Completo</a>
        <a href="{{route('curriculo_listall', ['tipo'=>'todos'])}}" class="btn btn-primary page-header">Todos os
        Curriculos</a>
    </div>
@endsection

@section("corpo_pagina")
    <div class="col-lg-12" id="divDadosPessoais">
        <div class="panel panel-default">
            <div class="panel-heading">
                Dados Pessoais
            </div>

            <div class="panel-body">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input type="text" id="cpf" class="form-control" readonly="readonly"
                               value="{{$curriculo['cpf']}}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" class="form-control" readonly="readonly"
                               value="{{$curriculo['nome']}}">
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="facebook">facebook</label>
                        <input type="text" id="facebook" class="form-control" readonly="readonly"
                               value="{{$curriculo['facebook']}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="telefone1">Telefone1</label>
                        <input type="text" id="telefone1" class="form-control" readonly="readonly"
                               value="{{$curriculo['fone']}}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="telefone2">Telefone2</label>
                        <input type="text" id="telefone2" class="form-control" readonly="readonly"
                               value="{{$curriculo['foneRec']}}">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" id="cidade" class="form-control" readonly="readonly"
                               value="{{$curriculo['cidade']}}">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nomMae">Nome da Mãe</label>
                        <input type="text" id="nomMae" class="form-control" readonly="readonly"
                               value="{{$curriculo['nomeMae']}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="cpf">Nome do Pai</label>
                        <input type="nomPai" id="nomPai" class="form-control" readonly="readonly"
                               value="{{$curriculo['nomePai']}}">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-12" id="divDadosPessoais">
        <div class="panel panel-default">
            <div class="panel-heading">
                Consultas
            </div>

            <div class="panel-body">
                <form method="POST" id="form_consulta" action="{{route('consultas_cadastro')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="contador" id="contador" value="0">
                    <input type="hidden" name="id" value="{{$curriculo['id']}}">
                    <div id="consultas" class="col-lg-12">
                        @php $cont = 0 @endphp
                        @foreach($consultas as $consulta)
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="fontConsu[{{$cont}}]">Fonte</label>
                                    <input type="text" name="fontConsu[{{$cont}}]" id="fonte" class="form-control"
                                           value="{{$consulta->fontConsu}}">
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label for="resConsu[{{$cont}}]">Resultado</label>
                                    <input type="text" name="resConsu[{{$cont}}]" class="form-control"
                                           value="{{$consulta->resConsu}}">
                                </div>
                            </div>
                            @php $cont++ @endphp
                        @endforeach
                        @if($cont == 0)
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="fontConsu[{{$cont}}]">Fonte</label>
                                    <input type="text" name="fontConsu[{{$cont}}]" id="fonte" class="form-control"
                                           value="">
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label for="resConsu[{{$cont}}]">Resultado</label>
                                    <input type="text" name="resConsu[{{$cont}}]" class="form-control" value="">
                                </div>
                            </div>
                        @endif

                    </div>
                </form>
                <div class="col-lg-12 text-right">
                    <div class="form-group">
                        <button id="btnCadCon" class="fa fa-plus-circle fa-3x"></button>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <button id="btnConSubmit" class="btn btn-success">Cadastrar</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="{{asset('/js/pageScript/consulta/consulta-form.js')}}"></script>
    <script type="application/javascript">
        $(function () {
          addRowConsulta(0{{$cont}});
        });
    </script>
@endsection

