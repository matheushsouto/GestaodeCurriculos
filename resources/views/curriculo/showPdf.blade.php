@extends('layout.pdf')

@section('cabecalho_pagina')
    <div class="col-sm-5">
        <h1 class="page-header">{{$curriculo->nome}}</h1>
    </div>
    @if($indicacao != null)

        <div style="display: inline-block;" class="col-sm-4 cabecalho_pagina_curriculo">
            <p><span class="pergunta">Tipo Curriculo: </span>{{$indicacao->tipInd}}</p>
            <p><span class="pergunta">Indicação de: </span>{{$indicacao->nomInd}}</p>
        </div>
        <div style="display: inline-block;" class="col-sm-6 text-right cabecalho_pagina_curriculo">
            @if(isset($curriculo->vaga))
                <p><span class="pergunta">Vaga: </span>{{$curriculo->vaga}}</p>
            @endif
        </div>

    @endif


@endsection

@section('corpo_pagina')
    <div class="col-sm-12">
        <div class="col-sm-12 text-center cabecalho_curriculo">
            Dados Pessoais
        </div>
        <div class="col-sm-12 dados_curriculo">
            <div style="display: inline-block" class="col-sm-3">
                <p><span class="pergunta">Nome: </span>{{$curriculo->nome}}</p>
                <p><span class="pergunta">Data de Nascimento: </span>{{$curriculo->datNasc}}
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
            </div>
            <div style="display: inline-block" class="col-sm-3">
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
            <div style="display: inline-block" class="col-sm-3">
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

        @if($documentos != null)
            @if(isset($curriculo->cpf) or $curriculo->rg or $curriculo->numCnh )
                <div class="col-sm-12 text-center cabecalho_curriculo">
                    Documentos
                </div>
                <div class="col-sm-12 dados_curriculo">
                    <div style="display: inline-block" class="col-sm-4 ">
                        @if(isset($curriculo->cpf))
                            <p><span class="pergunta">CPF: </span>{{$curriculo->cpf}}</p>
                        @endif
                        @if(isset($curriculo->rg))
                            <p><span class="pergunta">RG: </span>{{$curriculo->rg}}</p>

                        @endif
                    </div>
                    <div style="display: inline-block" class="col-sm-4">
                        @if(!empty($curriculo->numCnh))
                            <p><span class="pergunta">N. Carteira de Motorista: </span>{{$curriculo->numCnh}}</p>
                            <p><span class="pergunta">Categoria: </span>{{$curriculo->catCnh}}</p>
                        @endif
                    </div>
                </div>
            @endif
        @endif
        @if($conhecimentos != null)
            <div class="col-sm-12 text-center cabecalho_curriculo">
                Conhecimento

            </div>
            <div class="col-sm-12 dados_curriculo">
                @if((strlen($conhecimentos.hasItems()) != 4) and (isset($curriculo->curTec)))
                    <div style="display: inline-block" class="col-sm-5 ">
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
                <div style="display: inline-block" class="col-sm-7 ">
                    <p><span class="pergunta">Escolaridade: </span>{{$curriculo->escolaridade}}</p>
                    @if(isset($curriculo->cursoSup))
                        <p><span class="pergunta">Curso: </span>{{$curriculo->cursoSup}}</p>
                    @endif
                    @if(isset($curriculo->curSupPer))
                        <p><span class="pergunta">Período: </span>{{$curriculo->curSupPer}}</p>
                    @endif
                </div>
            </div>
        @endif

        @if($experiencias != null)
            @if(strlen($experiencias.hasItems()) != 4)
                <div class="col-sm-12 text-center cabecalho_curriculo">
                    Experiencia
                </div>
                <div class=" col-sm-12 dados_curriculo">
                    @foreach($experiencias as $experiencia)
                        <div style="display: inline-block" class="col-sm-4 ">
                            <p><span class="pergunta">Empresa: </span>{{$experiencia->empresa}}</p>
                            <p><span class="pergunta">Entrada e Saida: </span>{{$experiencia->entSai}}</p>
                            <p><span class="pergunta">Função: </span>{{$experiencia->funcao}}</p>
                            <p><span class="pergunta">Motivo Saida: </span>{{$experiencia->motSai}}</p>
                            <hr>
                        </div>

                    @endforeach
                </div>
            @endif
        @endif
        @if($consultas != null)
            @if(strlen($consultas.hasItems()) != 4)
                <div class="col-sm-12 text-center cabecalho_curriculo">
                    Consultas
                </div>
                <div style="display: inline-block" class="col-sm-12 dados_curriculo">
                    @foreach($consultas as $consulta)
                        <div style="display: inline-block" class="col-sm-4 ">
                            <p><span class="pergunta">Fonte: </span>{{$consulta->fontConsu}}</p>
                            <p><span class="pergunta">Resultado: </span>{{$consulta->resConsu}}</p>
                            <hr>
                        </div>
                    @endforeach
                </div>

            @endif
        @endif
        @if($entrevista != null)
            <div class="col-sm-12 text-center cabecalho_curriculo">
                Entrevista
            </div>
            <div class="col-sm-12 dados_curriculo">
                <div class="col-sm-6"  >
                    @if(isset($entrevista->created_at))
                        <p><span class="pergunta">Data : </span>{{$entrevista->created_at}}</p>

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

                <div class="col-sm-6" >
                <div class="col-sm-12">
                    @if(isset($entrevista->moCida))
                        <p>
                            <span class="pergunta">Morou em outras cidades, quais, quando e porque:</span>{{$entrevista->moCida}}
                        </p>
                    @endif
                    @if(isset($entrevista->pretSal))
                        <p><span class="pergunta">Pretensão salarial:</span>{{$entrevista->pretSal}}</p>
                    @endif
                    @if(isset($entrevista->ulmSal))
                        <p><span class="pergunta">Último salário:</span>{{$entrevista->ulmSal}}</p>
                    @endif
                    @if(isset($entrevista->nocTrabPre))
                        <p>
                            <span class="pergunta">Informática e Noções sobre o travalho pretendido:</span>{{$entrevista->nocTrabPre}}
                        </p>
                    @endif
                    <hr>
                </div>
            </div>
        @endif
    </div>
@endsection