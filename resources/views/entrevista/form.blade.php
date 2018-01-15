@extends('layout.main_layout')

@section("title", "Cadastro")

@section("dialogs")

@endsection

@section("css")
    <link rel="stylesheet" type="text/css" href="{{asset('/css/consulta_cadastro.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/entrevista_cadastro.css')}}">
@endsection

@section("cabecalho_pagina")
    @if(isset($salvou))
        <div style="text-align: center; background: darkseagreen;margin: 10px" class="col-lg-12">
            <h3>Salvou</h3>
        </div>
    @endif

    <div class="col-lg-4">
        <h1 class="page-header">Nova Entrevista</h1>
    </div>
    <div class="col-lg-2">
        <a class="btn btn-primary page-header" target="_blank"
           href="{{route('curriculo_show',['id'=> $curriculo['id']] )}}">Curriculo Completo</a>
    </div>
    <div class="col-lg-2 text-right">
        <a class="btn btn-primary page-header" target="_blank"
           href="{{route('consultas_cadastro',['id'=> $curriculo['id']] )}}">Consulta</a>
    </div>


@endsection
@section("corpo_pagina")
    <div class="col-lg-12">
        <div class="col-lg-9">
            <div class="panel panel-default" id="divCamposEntrevista">
                <div class="panel-heading">
                    Entrevista
                </div>
                <div class="panel-body">

                    <div class="col-lg-12  text-right">
                        <div class="form-group">
                            <label>Data da entrevista:</label>
                            <h5> @php echo date('d/m/y') @endphp</h5>
                        </div>
                    </div>
                    <form action="{{route('entrevistas_cadastro')}}" method="post" id="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$curriculo['id']}}">
                        <input type="hidden" name="entrevista[id_curriculo]" value="{{$curriculo['id']}}">
                        <div class="col-lg-12 ">
                            <div class="form-group">
                                <label for="entLoj">Já fez entrevista na loja:</label>
                                <input class="form-control" type="text" name="entrevista[jaFezEnt]"
                                       value="{{old('entrevista.jaFezEnt')}}" id="jaFezEnt">
                            </div>
                        </div>
                        <div class="col-lg-7 ">
                            <div class="form-group">
                                <label for="candidato">Candidato: </label>
                                @if($errors->has('curriculo.nome'))
                                    <input class="form-control error_campo" type="text" name="curriculo[nome]"
                                           value="{{old('curriculo.nome')}}" id="nome">
                                    <p class="error">{{$errors->first('curriculo.nome')}}</p>
                                @else
                                    <input class="form-control" type="text" name="curriculo[nome]"
                                           value="{{old('curriculo.nome')}}" id="nome">
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2 ">
                            <div class="form-group">
                                <label for="anos">Idade </label>
                                @if($errors->has('curriculo.anos'))
                                    <input class="form-control error_campo" type="number" name="curriculo[anos]"
                                           value="{{old('curriculo.anos')}}" id="anos">
                                    <p class="error">{{$errors->first('curriculo.anos')}}</p>
                                @else
                                    <input class="form-control" type="number" name="curriculo[anos]"
                                           value="{{old('curriculo.anos')}}" id="anos">
                                @endif
                            </div>

                        </div>
                        <div class="col-lg-3 ">
                            <div class="form-group">
                                <label for="celular">Celular</label>
                                @if($errors->has('curriculo.foneRec'))
                                    <input class="form-control error_campo" type="text" name="curriculo[foneRec]"
                                           value="{{old('curriculo.foneRec')}}" id="foneRec">
                                    <p class="error">{{$errors->first('curriculo.foneRec')}}</p>
                                @else
                                    <input class="form-control" type="text" name="curriculo[foneRec]"
                                           value="{{old('curriculo.foneRec')}}" id="foneRec">
                                @endif
                            </div>
                        </div>


                        <div class="col-lg-5 ">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                @if($errors->has('curriculo.email'))
                                    <input class="form-control" type="email" name="curriculo[email]"
                                           id="email" value="{{old('curriculo.email')}}">
                                    <p class="error">{{$errors->first('curriculo.email')}}</p>
                                @else
                                    <input class="form-control" type="email" name="curriculo[email]"
                                           id="email" value="{{old('curriculo.email')}}">
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <label for="facebook">Facebook:</label>
                                @if($errors->has('curriculo.facebook'))
                                    <input class="form-control error_campo" type="text"
                                           value="{{old('curriculo.facebook')}}"
                                           id="facebook"
                                           name="curriculo[facebook]">
                                    <p class="error">{{$errors->first('curriculo.facebook')}}</p>
                                @else
                                    <input class="form-control" type="text" value="{{old('curriculo.facebook')}}"
                                           id="facebook"
                                           name="curriculo[facebook]">
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-3 ">
                            <div class="form-group">
                                <label for="fone">Telefone</label>
                                <input class="form-control" type="text" id="fone" value="{{old('curriculo.fone')}}"
                                       name="curriculo[fone]">
                            </div>
                        </div>

                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <label for="cpf">CPF: </label>
                                @if($errors->has('curriculo.cpf'))
                                    <input class="form-control error_campo" type="text" value="{{old('curriculo.cpf')}}"
                                           name="curriculo[cpf]" id="cpf">
                                    <p class="error">{{$errors->first('curriculo.cpf')}}</p>
                                @else
                                    <input class="form-control" type="text" value="{{old('curriculo.cpf')}}"
                                           name="curriculo[cpf]" id="cpf">
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <label for="rg">RG: </label>
                                @if($errors->has('curriculo.rg'))
                                    <input class="form-control error_campo" type="text" id="rg"
                                           value="{{old('curriculo.rg')}}" name="curriculo[rg]">
                                    <p class="error">{{$errors->first('curriculo.rg')}}</p>
                                @else
                                    <input class="form-control" type="text" id="rg" value="{{old('curriculo.rg')}}"
                                           name="curriculo[rg]">
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <label for="sexo">Sexo:</label>
                                @if(old('curriculo.sexo'))
                                    <script>
                                        $(function () {
                                            valor = "{{old('curriculo.sexo')}}";
                                            $('#sexo').val(valor);
                                            if (valor == "M") {
                                                $('#divQuartel').show('explode');
                                            } else {
                                                $('#divQuartel').hide('explode');
                                            }
                                        });
                                    </script>
                                @endif
                                <select class="form-control" id="sexo" name="curriculo[sexo]">
                                    <option value="M">Masculino</option>
                                    <option value="F">Femino</option>
                                </select>
                            </div>
                        </div>

                        <div id="divQuartel">
                            <div class="col-lg-6 ">
                                <div class="form-group">
                                    <label for="quartel">Quartel: </label>
                                    <input class="form-control" type="text" name="entrevista[quartel]"
                                           value="{{old('entrevista.quartel')}}" id="quartel">
                                </div>
                            </div>
                            <div class="col-lg-6 ">
                                <div class="form-group">
                                    <label for="quartel3">3ª do quartel: </label>
                                    <input class="form-control" type="text" name="entrevista[quartel3]"
                                           value="{{old('entrevista.quartel3')}}" id="quartel3">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <label for="titulo">Titulo: </label>
                                <input class="form-control" type="text" name="entrevista[titulo]"
                                       value="{{old('entrevista.titulo')}}" id="titulo">
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <label for="ctps">CTPS:</label>
                                <input class="form-control" type="text" name="entrevista[ctps]"
                                       value="{{old('entrevista.jaFezEnt')}}" id="ctps">
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <label for="cartCid">Cartão do Cidadão:</label>
                                <input class="form-control" type="text" name="entrevista[cartCid]"
                                       value="{{old('entrevista.jaFezEnt')}}" id="cartCid">
                            </div>
                        </div>


                        <!--Forms: pai, paiProf -->

                        <div class="col-lg-6 ">
                            <div class="form-group">
                                <label for="pai">Pai:</label>
                                @if($errors->has('curriculo.nomePai'))
                                    <input class="form-control error_campo" type="text"
                                           value="{{old('curriculo.nomePai')}}"
                                           name="curriculo[nomePai]" id="nomePai">
                                    <p class="error">{{$errors->first('curriculo.nomePai')}}</p>
                                @else
                                    <input class="form-control" type="text" value="{{old('curriculo.nomePai')}}"
                                           name="curriculo[nomePai]" id="nomePai">
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="form-group">
                                <label for="paiProf">Profissão:</label>
                                @if($errors->has('curriculo.profPai'))
                                    <input class="form-control error_campo" type="text" id="profPai"
                                           name="curriculo[profPai]" value="{{old('curriculo.profPai')}}">
                                    <p class="error">{{$errors->first('curriculo.profPai')}}</p>
                                @else
                                    <input class="form-control" type="text" value="{{old('curriculo.profPai')}}"
                                           id="profPai" name="curriculo[profPai]">
                                    <p class="error">{{$errors->first('curriculo.profPai')}}</p>
                                @endif
                            </div>
                        </div>
                        <!--Forms: mae, maeProf -->
                        <div class="col-lg-6 ">
                            <div class="form-group">
                                <label for="mae">Mãe: </label>
                                @if($errors->has('curriculo.nomeMae'))
                                    <input class="form-control error_campo" type="text" id="nomeMae"
                                           value="{{old('curriculo.nomeMae')}}"
                                           name="curriculo[nomeMae]">
                                    <p class="error">{{$errors->first('curriculo.nomeMae')}}</p>
                                @else
                                    <input class="form-control" type="text" id="nomeMae"
                                           value="{{old('curriculo.nomeMae')}}"
                                           name="curriculo[nomeMae]">
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="form-group">
                                <label for="maeProf">Profissão:</label>
                                @if($errors->has('curriculo.profMae'))
                                    <input class="form-control error_campo" type="text" id="maeProf"
                                           name="curriculo[profMae]" value="{{old('curriculo.profMae')}}">
                                    <p class="error">{{$errors->first('curriculo.profMae')}}</p>
                                @else
                                    <input class="form-control" type="text" id="profMae"
                                           value="{{old('curriculo.profMae')}}"
                                           name="curriculo[profMae]">
                                    <p class="error">{{$errors->first('curriculo.profMae')}}</p>
                                @endif
                            </div>
                        </div>
                        <!--Formns: estCiv, nomConj, proEsp  -->
                        <div class="col-lg-3 ">
                            <div class="form-group">
                                <label for="estadoCivil">Estado Civil:</label>
                                @if(old('entrevista.estadoCivil'))
                                    <script>
                                        $(function () {
                                            valor = "{{old('entrevista.estadoCivil')}}";
                                            $('#estadoCivil').val(valor);
                                            if (valor == "Namorando" || valor == "Casado(a)") {
                                                $('#divEstCivil').show('explode');
                                            } else {
                                                $('#divEstCivil').hide('explode');
                                            }
                                        })
                                    </script>
                                @endif
                                <select class="form-control" id="estadoCivil" name="entrevista[estadoCivil]">
                                    <option value="Solteiro(a)">Solteiro(a)</option>
                                    <option value="Casado(a)">Casado(a)</option>
                                    <option value="Namorando">Namorando</option>
                                    <option value="Viúvo(a)">Viúvo(a)</option>
                                    <option value="Separado(a)">Separada)</option>
                                </select>
                            </div>
                        </div>
                        <div id="divEstCivil">
                            <div class="col-lg-5 ">
                                <div class="form-group">
                                    <label for="nomConj">Nome Cônjuge:</label>
                                    <input class="form-control" type="text" value="{{old('entrevista.nomConj')}}"
                                           id="nomConj"
                                           name="entrevista[nomConj]">
                                </div>
                            </div>
                            <div class="col-lg-4 ">
                                <div class="form-group">
                                    <label for="proEsp">Esposo (a) faz o que?:</label>
                                    <input class="form-control" value="{{old('entrevista.nomConj')}}" type="text"
                                           id="proEsp"
                                           name="entrevista[proEsp]">
                                </div>
                            </div>
                        </div>


                        <!--Forms: comqMora, casa -->

                        <div class="col-lg-9 ">
                            <div class="form-group">
                                <label for="comMor">Com quem você mora?</label>
                                <input class="form-control" type="text" value="{{old('entrevista.comQMor')}}"
                                       id="comQMor"
                                       name="entrevista[comQMor]">
                            </div>
                        </div>
                        <div class="col-lg-3 ">
                            <div class="form-group">
                                <label for="casa">Casa:</label>
                                @if(old('entrevista.casProAl'))
                                    <script>
                                        $(function () {
                                            $('#casa').val("{{old('entrevista.casProAl')}}");
                                        })
                                    </script>
                                @endif
                                <select class="form-control" id="casa" name="entrevista[casProAl]">
                                    <option value="alugada">Alugada</option>
                                    <option value="Própria">Própria</option>
                                </select>
                            </div>
                        </div>


                        <!--Forms: filhos, filObs, filCuid-->

                        <div class="col-lg-3 ">
                            <div class="form-group">
                                <label for="filhos">Tem filhos?</label>
                                @if(old('entrevista.temFil'))
                                    <script>
                                        $(function () {
                                            valor = "{{old('entrevista.temFil')}}";
                                            $('#filhos').val(valor);
                                            if (valor == "S") {
                                                $('#filho').show('explode');
                                            } else {
                                                $('#filho').hide('explode');
                                            }
                                        });
                                    </script>
                                @endif
                                <select class="form-control" id="filhos" name="entrevista[temFil]">
                                    <option value="N">Não</option>
                                    <option value="S">Sim</option>
                                </select>
                            </div>
                        </div>
                        <div id="filho" style="display: none">
                            <div class="col-lg-4 ">
                                <div class="form-group">
                                    <label for="filCuid">Quem cuidará dos filhos menores? </label>
                                    <input class="form-control" type="text" value="{{old('entrevista.queCuiFil')}}"
                                           id="filCuid"
                                           name="entrevista[queCuiFil]">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <label for="vt">VT</label>
                                <input class="form-control" type="text" value="{{old('entrevista.vt')}}" id="vt"
                                       name="entrevista[vt]">
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <label for="jusCom">Justiça comum:</label>
                                <input class="form-control" type="text" value="{{old('entrevista.jusCom')}}" id="jusCom"
                                       name="entrevista[jusCom]">
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <label for="jusTra">Justiça trabalhista:</label>
                                <input class="form-control" type="text" value="{{old('entrevista.jusTrab')}}"
                                       id="jusTrab" name="entrevista[jusTrab]">
                            </div>
                        </div>
                        <div class="col-lg-12 ">
                            <div class="form-group">
                                <label for="morCidQua">Morou em outras cidades quais e quando:</label>
                                <input class="form-control" type="text" value="{{old('entrevista.moCida')}}"
                                       id="moCida" name="entrevista[moCida]">
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="form-group">
                                <label for="antCrim">Antecedentes Criminais: </label>
                                <input class="form-control" type="text" value="{{old('entrevista.antCrim')}}"
                                       id="antCrim" name="entrevista[antCrim]">
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="form-group">
                                <label for="vicio">Vícios:</label>
                                <input class="form-control" type="text" value="{{old('entrevista.vicios')}}" id="vicios"
                                       name="entrevista[vicios]">
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <label for="remedios">Remédios: </label>
                                <input class="form-control" type="text" value="{{old('entrevista.remedio')}}"
                                       id="remedio" name="entrevista[remedio]">
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <label for="proSaud">Tem problema de Saúde:</label>
                                <input class="form-control" type="text" value="{{old('entrevista.probSau')}}"
                                       id="probSau" name="entrevista[probSau]">
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <label for="resPeso">Restrição para levantar peso:</label>
                                <input class="form-control" type="text" value="{{old('entrevista.resPeso')}}"
                                       id="resPeso" name="entrevista[resPeso]">
                            </div>
                        </div>
                        <div class="col-lg-12 ">
                            <div class="form-group">
                                <label for="escolaridade">Escolaridade:</label>
                                <input class="form-control" type="text" id="escolaridade"
                                       name="entrevista[escolaridade]">
                            </div>
                        </div>
                        <div class="col-lg-12 ">
                            <div class="form-group">
                                <label for="parEmp">Parentes na empresa:</label>
                                <input class="form-control" type="text" id="parEmpresa"
                                       value="{{old('entrevista.parEmpresa')}}" name="entrevista[parEmpresa]">
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <label for="contSup">Conta Super: </label>
                                <input class="form-control" type="text" value="{{old('entrevista.contSup')}}"
                                       id="contSup" name="entrevista[contSup]">
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <label for="sitBanc">Situação no Banco: </label>
                                <input class="form-control" type="text" value="{{old('entrevista.sitBco')}}"
                                       id="sitBco" name="entrevista[sitBco]">
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <label for="disponibilidade">Disponibilidade:</label>
                                <input class="form-control" type="text" value="{{old('entrevista.dishor')}}"
                                       id="dishor" name="entrevista[dishor]">
                            </div>
                        </div>
                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <label for="sabDom">Sáb/Dom:</label>
                                <input class="form-control" type="text" value="{{old('entrevista.sabDom')}}" id="sabDom"
                                       name="entrevista[sabDom]">
                            </div>
                        </div>

                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <label for="horExtr">Horas Extra:</label>
                                <input class="form-control" type="text" value="{{old('entrevista.horExt')}}"
                                       id="horExt" name="entrevista[horExt]">
                            </div>

                        </div>
                        <div class="col-lg-4 ">
                            <div class="form-group">
                                <label for="limLoj">Limpeza da Loja:</label>
                                <input class="form-control" type="text" value="{{old('entrevista.ajuLimp')}}"
                                       id="ajuLimp" name="entrevista[ajuLimp]">
                            </div>
                        </div>
                        <div class="col-lg-3 ">
                            <div class="form-group">
                                <label for="religiao">Religião: </label>
                                <input class="form-control" type="text" value="{{old('entrevista.religiao')}}"
                                       id="religiao" name="entrevista[religiao]">
                            </div>
                        </div>

                        <div class="col-lg-3 ">
                            <div class="form-group">
                                <label for="comFix">Compromisso Fixo: </label>
                                <input class="form-control" type="text" value="{{old('entrevista.compFixo')}}"
                                       id="compFixo"
                                       name="entrevista[compFixo]">
                            </div>
                        </div>

                        <div class="col-lg-3 ">
                            <div class="form-group">
                                <label for="pretSal">Pretensão Salarial:</label>
                                <input class="form-control" type="text" value="{{old('entrevista.pretSal')}}"
                                       id="pretSal" name="entrevista[pretSal]">
                            </div>
                        </div>

                        <div class="col-lg-3 ">
                            <div class="form-group">
                                <label for="ultSal">Último Salário:</label>
                                <input class="form-control" type="text" value="{{old('entrevista.ulmSal')}}" id="ulmSal"
                                       name="entrevista[ulmSal]">
                            </div>
                        </div>
                        <div class="col-lg-12 ">
                            <div class="form-group">
                                <label for="nocTrabPre">Noções sobre o trabalho pretendido:</label>
                                @if($errors->has('entrevista.nocTrabPre'))
                                    <textarea  class="form-control" rows="5" id="nocTrabPr"
                                              name="entrevista[nocTrabPre]">{{old('entrevista.nocTrabPre')}}</textarea>
                                @else
                                    @if($entrevista != null)
                                        <textarea class="form-control" rows="5" id="nocTrabPr"
                                                  name="entrevista[nocTrabPre]">{{$entrevista[0]['nocTrabPre']}}</textarea>
                                    @else
                                        <textarea class="form-control" rows="5" id="nocTrabPr"
                                                  name="entrevista[nocTrabPre]"></textarea>
                                        @endif
                                @endif
                            </div>
                        </div>

                        @if($entrevista != null)
                            <input type="hidden" name="dados[id]" value="{{$entrevista[0]['id']}}">
                        @endif

                        <div class="col-lg-12 text-right">
                            <button id="btnEnviar" type="submit" class="btn btnEnvEnt btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-3" id="divDadosPessoais">
            <p class="campoDadoPessoal"><span>Nome: </span>{{$curriculo['nome'] }}</p>
            <hr>
            <p class="campoDadoPessoal"><span>Data de Nascimento:</span>
                @php
                    $date = date_create($curriculo['datNasc']);
                    echo date_format($date, 'd/m/Y');
                @endphp</p>
            <hr>
            <p class="campoDadoPessoal"><span>Já Trabalhou no SuperPão:</span>
                @if($curriculo['trabSupe'] == 1)
                    Sim
                @else
                    Nao
                @endif</p>
            <hr>
            <p class="campoDadoPessoal"><span>Pai:</span> {{$curriculo['nomePai'] }}</p>
            <hr>
            <p class="campoDadoPessoal"><span>Mãe:</span> {{$curriculo['nomeMae'] }}</p>
            <hr>
            <p class="campoDadoPessoal"><span>Bairo:</span> {{$curriculo['bairro'] }}</p>
            <hr>
            <p class="campoDadoPessoal"><span>Numero:</span> {{$curriculo['numero'] }}</p>
            <hr>
            <p class="campoDadoPessoal"><span>Cidade:</span> {{$curriculo['cidade'] }}</p>
            <hr>
            <p class="campoDadoPessoal"><span>Fone:</span> {{$curriculo['foneRec'] }}</p>
            <hr>
            <p class="campoDadoPessoal"><span>Fone para Recados:</span> {{$curriculo['foneRec'] }}</p>
            <hr>
            <p class="campoDadoPessoal"><span>Facebook:</span> {{$curriculo['facebook']}}</p>
        </div>
    </div>


@endsection

@section("scripts")
    <script type="text/javascript">

        $(function (){
            
            $('.menu_cadastro_entrevista').addClass('active');

            $('#nocTrabPr').on('keyup onpaste', function () {
                var alturaScroll = this.scrollHeight;
                var alturaCaixa = $(this).height();

                if (alturaScroll > (alturaCaixa + 10)) {
                    if (alturaScroll > 500) return;
                    $(this).css('height', alturaScroll);
                }
            });

            $('#divEstCivil').hide();
            $("#cpf").mask("999.999.999-99");
            $("#celular").mask("(99) 9 - 9999-9999");
            $("#fone").mask("(99) 9 - 9999-9999");
            $('#rg').mask("99999999999999");
            $('#pretSal').mask("R$ 9.999,99");
            $('#ultSal').mask("R$ 9.999,99");

            $('#sexo').change(function () {
                if ($(this).val() == "M") {
                    $('#divQuartel').show('explode');
                } else {
                    $('#divQuartel').hide('explode');
                }
            });
            $('#estadoCivil').change(function () {
                if ($(this).val() == "Namorando" || $(this).val() == "Casado(a)") {
                    $('#divEstCivil').show('explode');
                } else {
                    $('#divEstCivil').hide('explode');
                }
            });
            $('#filhos').change(function () {
                if ($(this).val() == "S") {
                    $('#filho').show('explode');
                } else {
                    $('#filho').hide('explode');
                }
            });

            @if($entrevista != null)
                @foreach(array_keys($entrevista[0]) as $key)
                    @if($key != 'nocTrabPre')
                    $('#{{$key}}').text('{{$entrevista[0][$key]}}');
            @endif
         @endforeach
$('#form').attr('action', '{{route('entrevistas_editar')}}');
            document.getElementById('btnEnviar').innerHTML = 'Editar';
            @endif

            @if( old('curriculo.nome') == null)
                @foreach(array_keys($curriculo) as $key)
                    $('#{{$key}}').val('{{$curriculo[$key]}}');
            @endforeach
        @endif
$('#anos').html(calcularIdade('{{$curriculo['datNasc']}}'));
        });
    </script>
@endsection

@section('menu_cadastro_css')active @endsection
@section('menu_cadastro_entrevista_css')
    background-color: #5C4C9E;
    color: white;
@endsection