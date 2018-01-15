@extends('layout.main_layout')


@section('title')
    Lista todos os curriculos
@endsection

@section("css")
    <link rel="stylesheet" type="text/css" href="{{asset('/css/showCurriculo.css')}}">
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {
            $('#texto').load('keyup onpaste', function () {
                var alturaScroll = this.scrollHeight;
                var alturaCaixa = $(this).height();

                if (alturaScroll > (alturaCaixa + 10)) {
                    if (alturaScroll > 500) return;
                    $(this).css('height', alturaScroll);
                }
            });
            $('#btnDelCur').click(function () {
                $("#dialog-apaga-curriculo").dialog({
                    resizable: false,
                    height: "auto",
                    width: 400,
                    modal: true,
                    buttons: {
                        "Apagar Curriculo": function () {
                            window.location = '{{route('curriculo_delete', ['id' => $curriculo->id])}}';
                        },
                        Cancel: function () {
                            $(this).dialog("close");
                        }
                    }
                });
            });
            $('#btnGeraPDF').click(function () {
                $("#dialog-btn-pdf").dialog({
                    resizable: false,
                    height: "auto",
                    width: 300,
                    modal: true,
                    buttons: {
                        "Ok": function () {
                            chekDocumentos = $('#chekDocumentos').is(":checked");
                            chekConhecimento = $('#chekConhecimento').is(":checked");
                            chekIndicacao = $('#chekIndicacao').is(":checked");
                            chekExperiencia = $('#chekExperiencia').is(":checked");
                            chekConsulta = $('#chekConsulta').is(":checked");
                            chekEntrevista = $('#chekEntrevista').is(":checked");

                            window.open("{{route('curriculo_pdf',['id'=> $curriculo->id])}}" + "&documentos=" + chekDocumentos
                                + "&conhecimento=" + chekConhecimento + "&indicacao=" + chekIndicacao
                                + '&experiencia=' + chekExperiencia + '&consulta=' + chekConsulta + '&entrevista=' + chekEntrevista);
                        },
                        Cancel: function () {
                            $(this).dialog("close");
                        }
                    }
                });
            });
            $('#idade').html(calcularIdade('{{$curriculo->datNasc}}'));

        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('dist/css/showCurriculo.css')}}">
@endsection

@section('dialogs')
    <div class="ui-dialog " id="dialog-apaga-curriculo" title="Apagar Curriculo">
        <p style="font-weight: bold">
            Tem certeza que deseja apagar esse curriculo?.
        </p>
    </div>


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


@section('cabecalho_pagina')
    <div class="col-lg-7">
        <h1 class="page-header">{{$curriculo->nome}}</h1>
    </div>
    <div class="col-lg-5 text-right cabecalho_pagina_curriculo">
        <p><span class="pergunta">Tipo Curriculo: </span>{{$indicacao->tipInd}}</p>
        <p><span class="pergunta">Indicação de: </span>{{$indicacao->nomInd}}</p>
    </div>

@endsection

@section('corpo_pagina')



    <div class="col-lg-9">
        <form method="POST" action="{{route('addStatus')}}">
            <input type="hidden" name="id" value="{{$curriculo->id}}">
            {{ csrf_field() }}
            <script>
                $(function () {
                    $('#selectStatus').val('{{$curriculo->status}}')
                    $('#selectVaga').val('{{$curriculo->vaga_id}}')
                });
            </script>
            <div class="col-lg-12">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="">Status</label>

                        <select id="selectStatus" class="form-control" name="status">
                            <option value="Em Andamento">Em Andamento</option>
                            <option value="Aprovado">Aprovado</option>
                            <option value="Reprovado">Reprovado</option>
                            <option value="Em Espera">Em Espera</option>
                            {{--Adicionado nova opção de status - por Matheus--}}
                            <option value="Contratado">Contratado</option>
                        </select>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="">Vaga</label>
                        <select id="selectVaga" class="form-control" name="vaga_id">
                            @foreach ($vagas as $vaga)
                                <option value="{{$vaga->id}}">{{$vaga->descricao}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <button style="margin-top: 25px" type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
        <div class="col-lg-12 text-center cabecalho_curriculo">
            Dados Pessoais
        </div>
        <div class="col-lg-12 dados_curriculo">
            <div class="col-lg-8">
                <p><span class="pergunta">Nome: </span>{{$curriculo->nome}}</p>
                <p><span class="pergunta">Data de Nascimento: </span>{{$curriculo->datNasc}}
                    <span class="pergunta">&nbsp Anos: </span><span id="idade"></span></p>
                <p><span class="pergunta data">Data do Preenchimento da Ficha: </span>{{$curriculo->dat_ficha}}</p>
                <p><span class="pergunta">Já Trabalhou no Superpão: </span>
                    @if($curriculo->trabSupe == 1)
                        Sim
                    @else
                        Nao
                    @endif
                </p>
                @if(isset($curriculo->nomePai))
                    <p><span class="pergunta">Pai: </span>{{$curriculo->nomePai}}</p>
                @endif
                @if(isset($curriculo->nomeMae))
                    <p><span class="pergunta">Mãe: </span>{{$curriculo->nomeMae}}</p>
                @endif
                @if(isset($curriculo->bairro))
                    <p><span class="pergunta">Bairro: </span>{{$curriculo->bairro}}</p>
                @endif
                @if(isset($curriculo->ru))
                    <p><span class="pergunta">Rua: </span>{{$curriculo->rua}}</p>
                @endif
                @if(isset($curriculo->numero))
                    <p><span class="pergunta">Numero: </span>{{$curriculo->numero}}</p>
                @endif
                @if(isset($curriculo->cidade))
                    <p><span class="pergunta">Cidade: </span>{{$curriculo->cidade}}</p>
                @endif

            </div>
            <div class="col-lg-4">
                @if(isset($curriculo->fone))
                    <p><span class="pergunta">Fone: </span>{{$curriculo->fone}}</p>
                @endif
                @if(isset($curriculo->foneRec))
                    <p><span class="pergunta">Fone para Recados: </span><p>{{$curriculo->foneRec}}</p></p>
                @endif
                @if(isset($curriculo->facebook))
                    <p><span class="pergunta">Facebook: </span>{{$curriculo->facebook}}</p>
                @endif
            </div>
        </div>

        @if(isset($curriculo->cpf) or $curriculo->rg or $curriculo->numCnh )
            <div class="col-lg-12 text-center cabecalho_curriculo">
                Documentos
            </div>
            <div class="col-lg-12 dados_curriculo">
                <div class="col-lg-4 ">
                    @if(isset($curriculo->cpf))
                        <p><span class="pergunta">CPF: </span>{{$curriculo->cpf}}</p>
                    @endif
                    @if(isset($curriculo->rg))
                        <p><span class="pergunta">RG: </span>{{$curriculo->rg}}</p>

                    @endif
                </div>
                <div class="col-lg-4 ">
                    @if(isset($curriculo->numCnh))
                        <p><span class="pergunta">N. Carteira de Motorista: </span>{{$curriculo->numCnh}}</p>
                        <p><span class="pergunta">Categoria: </span>{{$curriculo->catCnh}}</p>
                    @endif

                </div>
                <div class="col-lg-4 "></div>
            </div>
        @endif
        <div class="col-lg-12 text-center cabecalho_curriculo">
            Conhecimento
        </div>
        <div class="col-lg-12 dados_curriculo">
            @if((strlen($conhecimentos.hasItems()) != 4) or (isset($curriculo->curTec)))
                <div class="col-lg-5 ">

                    @if( strlen($conhecimentos.hasItems()) != 4 )
                        <p><span class="pergunta">Conhecimentos em:</span>
                            @foreach($conhecimentos as $conhecimento)
                                {{$conhecimento->conhecimento}},
                            @endforeach
                        </p>
                    @endif
                    @if(isset($curriculo->curTec))
                        <p><span class="pergunta">Curso Tecnico: </span>{{$curriculo->curTec}}</p>
                    @endif

                </div>
            @endif

            <div class="col-lg-7 ">
                @if(isset($curriculo->escolaridade))
                    <p><span class="pergunta">Escolaridade: </span>{{$curriculo->escolaridade}}</p>
                @endif
                @if(isset($curriculo->cursoSup))
                    <p><span class="pergunta">Curso: </span>{{$curriculo->cursoSup}}</p>
                @endif
                @if(isset($curriculo->cursoSupPer))
                    <p><span class="pergunta">Período: </span>{{$curriculo->cursoSupPer}}</p>
                @endif
            </div>
        </div>
        @if(strlen($experiencias.hasItems()) != 4)
            <div class="col-lg-12 text-center cabecalho_curriculo">
                Experiencia
            </div>
            <div class="col-lg-12 dados_curriculo">

                @foreach($experiencias as $experiencia)
                    <div class="col-lg-4 ">
                        <p><span class="pergunta">Empresa: </span>{{$experiencia->empresa}}</p>
                        <p><span class="pergunta">Entrada e Saida: </span>{{$experiencia->entSai}}</p>
                        <p><span class="pergunta">Função: </span>{{$experiencia->funcao}}</p>
                        <p><span class="pergunta">Motivo Saida: </span>{{$experiencia->motSai}}</p>
                    </div>
                @endforeach
            </div>
        @endif
        @if(strlen($consultas.hasItems()) != 4)
            <div class="col-lg-12 text-center cabecalho_curriculo">
                Consultas
            </div>
            <div class="col-lg-12 dados_curriculo">
                @foreach($consultas as $consulta)
                    <div class="col-lg-6 ">
                        <p><span class="pergunta">Fonte: </span>{{$consulta->fontConsu}}</p>
                        <p><span class="pergunta">Resultado: </span>{{$consulta->resConsu}}</p>
                        <hr>
                    </div>
                @endforeach
            </div>
        @endif
        @if(isset($entrevista))
            <div class="col-lg-12 text-center cabecalho_curriculo">
                Entrevista
            </div>
            <div class="col-lg-12 dados_curriculo">
                <div class="col-lg-6 ">
                    @if(isset($entrevista->created_at))
                        <p><span class="pergunta">Data da Entrevista: </span>{{$entrevista->created_at}}</p>
                    @endif
                    @if(isset($entrevista->titulo))
                        <p><span class="pergunta">Titulo: </span>{{$entrevista->titulo}}</p>
                    @endif
                    @if(isset($entrevista->quartel))
                        <p><span class="pergunta">Quartel:</span>{{$entrevista->quartel}}</p>
                    @endif
                    @if(isset($entrevista->quartel3))
                        <p><span class="pergunta">3° do Quartel:</span>{{$entrevista->quartel3}}</p>
                    @endif
                    @if(isset($entrevista->cursoSup))
                        <p><span class="pergunta">Cartão Cidadão:</span>{{$entrevista->cursoSup}}</p>
                    @endif
                    @if(isset($entrevista->ctps))
                        <p><span class="pergunta">CTPS:</span>{{$entrevista->ctps}}</p>
                    @endif

                    <hr>


                    @if(isset($entrevista->casProAl))
                        <p><span class="pergunta">Casa Própria ou alugada:</span>{{$entrevista->casProAl}}</p>
                    @endif
                    @if(isset($entrevista->comQMor))
                        <p><span class="pergunta">Com quem você mora?:</span>{{$entrevista->comQMor}}</p>
                    @endif
                    @if(isset($entrevista->temFil))
                        <p><span class="pergunta">Tem Filhos:</span>{{$entrevista->temFil}}</p>
                    @endif
                    @if(isset($entrevista->queCuiFil))
                        <p><span class="pergunta">Quem Cuidará dos filhos menores:</span>{{$entrevista->queCuiFil}}</p>
                    @endif
                    <hr>

                    @if(isset($entrevista->moCida))
                        <p>
                            <span class="pergunta">Morou em outras cidades, quais, quando e porque:</span>{{$entrevista->moCida}}
                        </p>
                    @endif
                    @if(isset($entrevista->antCrim))
                        <p><span class="pergunta">Antecedentes Criminais:</span>{{$entrevista->antCrim}}</p>
                    @endif
                    @if(isset($entrevista->vicios))
                        <p><span class="pergunta">Vícios:</span>{{$entrevista->vicios}}</p>
                    @endif
                    @if(isset($entrevista->remedio))
                        <p><span class="pergunta">Remédios:</span>{{$entrevista->remedio}}</p>
                    @endif
                    @if(isset($entrevista->probSau))
                        <p><span class="pergunta">Tem problema de Saúde:</span>{{$entrevista->probSau}}</p>
                    @endif
                    @if(isset($entrevista->resPeso))
                        <p><span class="pergunta">Restrição para levantar peso:</span>{{$entrevista->resPeso}}</p>
                    @endif
                    <hr>

                    @if(isset($entrevista->vt))
                        <p><span class="pergunta">VT:</span>{{$entrevista->vt}}</p>
                    @endif
                    @if(isset($entrevista->jusCom))
                        <p><span class="pergunta">Justiça comum:</span>{{$entrevista->jusCom}}</p>
                    @endif
                    @if(isset($entrevista->jusTrab))
                        <p><span class="pergunta">Justiça trabalhista:</span>{{$entrevista->jusTrab}}</p>
                    @endif
                    <hr>
                </div>

                <div class="col-lg-6 ">
                    @if(isset($entrevista->parEmpresa))
                        <p><span class="pergunta">Parentes na empresa:</span>{{$entrevista->parEmpresa}}</p>
                    @endif
                    @if(isset($entrevista->escolaridade))
                        <p><span class="pergunta">Escolaridade:</span>{{$entrevista->escolaridade}}</p>
                    @endif
                    @if(isset($entrevista->contSup))
                        <p><span class="pergunta">Conta Super:</span>{{$entrevista->contSup}}</p>
                    @endif
                    @if(isset($entrevista->sitBco))
                        <p><span class="pergunta">Situação no bco:</span>{{$entrevista->sitBco}}</p>
                    @endif
                    @if(isset($entrevista->dishor))
                        <p><span class="pergunta">Disponibilidade horário:</span>{{$entrevista->dishor}}</p>
                    @endif
                    @if(isset($entrevista->sabDom))
                        <p><span class="pergunta">Sáb e Domingos:</span>{{$entrevista->sabDom}}</p>
                    @endif
                    <hr>

                    @if(isset($entrevista->horExt))
                        <p><span class="pergunta">Horas extras:</span>{{$entrevista->horExt}}</p>
                    @endif
                    @if(isset($entrevista->ajuLimp))
                        <p><span class="pergunta">Ajudar na limpeza:</span>{{$entrevista->ajuLimp}}</p>
                    @endif
                    @if(isset($entrevista->religiao))
                        <p><span class="pergunta">Religião:</span>{{$entrevista->religiao}}</p>
                    @endif
                    @if(isset($entrevista->compFixo))
                        <p><span class="pergunta">Tem Algum compromisso fixo:</span>{{$entrevista->compFixo}}</p>
                    @endif
                    <hr>
                </div>
                <div class="col-lg-12">
                    @if(isset($entrevista->pretSal))
                        <p><span class="pergunta">Pretensão salarial:</span>{{$entrevista->pretSal}}</p>
                    @endif
                    @if(isset($entrevista->ulmSal))
                        <p><span class="pergunta">Último salário:</span>{{$entrevista->ulmSal}}</p>
                    @endif
                    @if(isset($entrevista->nocTrabPre))
                        <p>
                            <span class="pergunta">Informática e Noções sobre o travalho pretendido:</span>
                        </p>
                        <textarea readonly="readonly" style="width: 700px" id="texto"
                                  rows="10">{{$entrevista->nocTrabPre}}</textarea>
                    @endif
                    <hr>
                </div>
            </div>
        @endif

    </div>


    <div class="col-lg-3">
        <div class="col-lg-12">
            <a id="btnGeraPDF" class="btn btn-success btn-lateral-show">Gerar
                PDF</a>
            <a href="{{route('curriculo_index')}}?editar=1&id={{$curriculo->id}}"
               class="btn btn-primary btn-lateral-show">Editar Curriculo</a>
            @if(strlen($consultas.hasItems()) != 4)
                <a href="{{route('consultas_cadastro',['id'=> $curriculo->id])}}"
                   class="btn btn-primary  btn-lateral-show">Editar Consulta</a>
            @else
                <a href="{{route('consultas_cadastro',['id'=> $curriculo->id])}}"
                   class="btn btn-primary  btn-lateral-show">Cadastrar Consulta</a>
            @endif

            @if(isset($entrevista))
                <a href="{{route('entrevistas_cadastro')}}?id={{$curriculo->id}}"
                   class="btn btn-primary btn-lateral-show">Editar Entrevista</a>
                @if(isset($curriculo->avaliacao->resFinal))
                    <a href="{{route('avaliacao_cadastro')}}?id={{$curriculo->id}}"
                       class="btn btn-primary btn-lateral-show">Editar/Vizualizar Avaliacão</a>
                @else
                    <a href="{{route('avaliacao_cadastro')}}?id={{$curriculo->id}}"
                       class="btn btn-primary btn-lateral-show">Cadastrar Avaliação</a>
                @endif
            @elseif(isset($consulta))
                <a href="{{route('entrevistas_cadastro')}}?id={{$curriculo->id}}"
                   class="btn btn-primary btn-lateral-show">Cadastrar Entrevista</a>
            @endif


            <a id="btnDelCur"
               class="btn btn-danger btn-lateral-show">Apagar Curriculo</a>
        </div>
    </div>
@endsection
