@extends('layout.main_layout')

@section("dialogs")
    <div class="ui-dialog " id="dialog-inputs-null" title="Campos Não Preenchidos">
        <p style="font-weight: bold">
            Possui campos não preenchidos
        </p>
        <p>
            Preencha os campos em <span style="color: red">Vermelho</span> para enviar os seu curriculo
        </p>

    </div>
    <div class="ui-dialog " id="dialog-inputs-cpf" title="CPF já cadastrado">
        <p> Para editar seus dados, digite seu RG abaixo:</p>
        <input type="text" id="inputValRG" class="form-control">
    </div>
    <div class="ui-dialog " id="dialog-aviso_indicador" title="Campos Não Preenchidos">
        <p>
            Campo indicador obrigatorio
        </p>
    </div>
    <div class="ui-dialog " id="dialog-cpf-invalido" title="CPF Invalido">
        <p style="font-weight: bold">
            CPF digitado não é valido, digite novamente.
        </p>

    </div>
@endsection

@section("cabecalho_pagina")


    @if (count($errors) == 0)
        @if(isset($salvou))
            <div style="text-align: center; background: darkseagreen;margin: 10px" class="col-lg-12">
                <h3>Salvou</h3>

            </div>
        @endif

    @else
        <div style="text-align: center; background: rgba(255,12,12,0.64);margin: 10px" class="col-lg-12">
            <h3>Não Salvou, verifique os campos em vermelho!</h3>
        </div>
        <script type="text/javascript">
            //Exibe os campos quando o laravel envia de volta a pagina com erros
            $(function () {
                $("#selectEscolari").val('{{old('curriculo.escolaridade')}}');
                $("#selectCursoTec").val('{{old('curriculo.curTec')}}');
                $("#traSPao").val('{{old('curriculo.trabSupe')}}');
                $("#selectCidAtu").val('{{old('curriculo.cidade')}}');
                $("#selectCNH").val('{{old('curriculo.cnh')}}');
                $("#cargo_id").val({{old('curriculo.cargo_id')}});
                if ('{{old('cnh')}}' == 'S') {
                    $('#divCNH').show(500);
                }
                $("#selectPriEmp").val('{{old('priEmp')}}');
                $("#selectCatCNH").val('{{old('curriculo.catCnh')}}');
                $('#selectTipCur').val('{{old('tipCur')}}');

                if ("{{old('tipCur')}}" != "Normal") {
                    $('#indicador').show(500);
                    $('#btnDivDadosConhecimentos').hide(500);
                } else {
                    $('#btnDivDadosConhecimentos').hide(500);
                }
                $('#divDadosPessoais').show(500);
                $('#btndivDocumentos').hide(500);
                $('#divDocumentos').show(500);
                $('#btndivConhecimento').hide(500);
                $('#divConhecimento').show(500);
                if ("{{old('curriculo.escolaridade')}}" == "Ensino Superior Completo") {
                    $('#divCurso').show(500);
                    $('#divCursoPer').hide(500);
                } else if ("{{old('escolaridade')}}" == "Ensino Superior Incompleto") {
                    $('#divCurso').show(500);
                    $('#divCursoPer').show(500);
                } else {
                    $('#divCurso').hide(500);
                    $('#divCursoPer').hide(500);
                }
                $('#selectCursoTec').val('{{old('selectCurTec')}}');
                if ('{{old('curriculo.selectCurTec')}}' == 'S') {
                    $('#divQualCurso').show(500);
                }
                $('#btndivExperiencia').hide(500);
                $('#divExperiencia').show(500);
                if ("{{old('priEmp')}}" == "N") {
                    $('#empresas').show(500);
                } else {
                    $('#empresas').hide();
                }
                $('#btn_cadastrar_curricolo').show(500);
            });

        </script>
    @endif


    <div class="col-lg-6">
        <h1 class="page-header">Novo Currículo</h1>
    </div>
    <div class="col-lg-2">
        <a href="{{route('modo_candidato')}}" id="btnModoCandidato" class="btn btn-default page-header">Modo
            Candidato</a>
    </div>
    <div class="col-lg-2">
        <a href="{{route('curriculo_listall',['tipo'=>'todos'])}}" class="btn btn-default page-header">Curriculos
            Cadastrados</a>
    </div>
@endsection

@section("corpo_pagina")
    <!-- Primeira Etapa / Tipo Curricolo -->
    <div class="col-lg-12">
        <h4>OBS: Os Campos com '(<span class="campo_obrigatorio">*</span>)' são de preenchimento
            obrigatório</h4>
    </div>
    <div class="clearfix"></div>
    <form method="post" id="form" action="{{route('curriculo_cadastro')}}">
        {{ csrf_field() }}
        <input id="inputValueID" type="hidden" name="id" value="">
        <div class="col-lg-12">
            <div class="panel panel-default" id="div_tipo_curricolo">
                <div class="panel-heading">
                    Tipo do Curricolo
                </div>
                <div class="panel-body">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Tipo do Curricolo (<span
                                        class="campo_obrigatorio">*</span>)</label>
                            <select onchange="tipoCurricolo()" name="tipCur" id="selectTipCur"
                                    class="form-control">
                                <option value="Indicação">Indicação</option>
                                <option selected value="Normal">Normal</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div id="indicador">
                            <div class="form-group">
                                <label>Indicador(<span class="campo_obrigatorio">*</span>)</label>
                                @if($errors->has('indicador'))
                                    <input name="indicador" id="inputIndicador"
                                           value="{{old('indicador')}}" type="text" class="form-control error_campo">
                                    <p class="error">{{$errors->first('indicador')}}</p>
                                @else
                                    <input name="indicador" id="inputIndicador" value="{{old('indicador')}}" type="text"
                                           class="form-control">
                            @endif
                            <!--  <p class="help-block">Example block-level help text here.</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">

                        <div class="form-group">
                            <label>Cargo(<span class="campo_obrigatorio">*</span>)</label>
                            <select id="cargo_id" name="curriculo[cargo_id]" class="form-control">
                                @foreach($cargos as $cargo)
                                    <option value="{{$cargo->id}}" >{{$cargo->descricao}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 text-right">
                        <button type="button" class="btn btn-success" id="btnDivDadosConhecimentos"
                                onclick="showDadosPessoais()"><i
                                    class="fa fa-arrow-right">
                                Proximo</i></button>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-12" id="divDadosPessoais">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dados Pessoais
                </div>
                <div class="panel-body">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="cpf">CPF(<span class="campo_obrigatorio">*</span>)</label>
                            @if($errors->has('curriculo.cpf'))
                                <input type="text" class="form-control error_campo" value="{{old('curriculo.cpf')}}"
                                       name="curriculo[cpf]"
                                       id="cpf"
                                       placeholder="CPF">
                                <p class="error">{{$errors->first('curriculo.cpf')}}</p>
                            @else
                                <input type="text" class="form-control" value="{{old('curriculo.cpf')}}"
                                       name="curriculo[cpf]" id="cpf"
                                       placeholder="CPF">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="nomCandidato">Seu nome(<span
                                        class="campo_obrigatorio">*</span>)</label>
                            @if($errors->has('curriculo.nome'))
                                <input type="text" name="curriculo[nome]" class="form-control error_campo"
                                       id="nomCandidato"
                                       placeholder="Nome" value="{{old('curriculo.nome')}}">
                                <p class="error">{{$errors->first('curriculo.nome')}}</p>
                            @else
                                <input type="text" name="curriculo[nome]" class="form-control" id="nomCandidato"
                                       placeholder="Nome" value="{{old('curriculo.nome')}}">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Você ja trabalhou no Grupo Superpão?(<span
                                        class="campo_obrigatorio">*</span>)</label>
                            <select id="traSPao" name="curriculo[trabSupe]" class="form-control">
                                <option value="1">Sim</option>
                                <option selected value="0">Não</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="datPrench">Data do Preenchimento da Ficha(<span
                                        class="campo_obrigatorio">*</span>)</label>
                            @if($errors->has('curriculo.dat_ficha'))
                                <input value="{{old('curriculo.dat_ficha')}}" id="datPrench" name="curriculo[dat_ficha]"
                                       type="date" class="form-control error_campo">
                                <p class="error">{{$errors->first('curriculo.dat_ficha')}}</p>
                            @else
                                <input value="{{old('curriculo.dat_ficha')}}" id="datPrench" name="curriculo[dat_ficha]"
                                       type="date" class="form-control">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="InputFone">Fone(<span
                                        class="campo_obrigatorio">*</span>)</label>
                            @if($errors->has('curriculo.fone'))
                                <input type="tel" value="{{old('curriculo.fone')}}" name="curriculo[fone]"
                                       class="form-control error_campo" id="InputFone" placeholder="Fone">
                                <p class="error">{{$errors->first('curriculo.fone')}}</p>
                            @else
                                <input type="tel" name="curriculo[fone]" value="{{old('curriculo.fone')}}"
                                       class="form-control"
                                       id="InputFone" placeholder="Fone">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="InputFoneReca">Fone para recados(<span
                                        class="campo_obrigatorio">*</span>)</label>
                            @if($errors->has('curriculo.foneRec'))
                                <input type="tel" value="{{old('curriculo.foneRec')}}" class="form-control error_campo"
                                       name="curriculo[foneRec]" id="InputFoneReca"
                                       placeholder="Fone para Recados">
                                <p class="error">{{$errors->first('curriculo.foneRec')}}</p>
                            @else
                                <input type="tel" value="{{old('curriculo.foneRec')}}" class="form-control"
                                       name="curriculo[foneRec]"
                                       id="InputFoneReca"
                                       placeholder="Fone para Recados">
                            @endif

                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="InputDatNas">Data de Nascimento(<span
                                        class="campo_obrigatorio">*</span>)</label>
                            @if($errors->has('curriculo.datNasc'))
                                <input name="curriculo[datNasc]" type="date" value="{{old('curriculo.datNasc')}}"
                                       class="form-control error_campo"
                                       id="InputDatNas">
                                <p class="error">{{$errors->first('curriculo.datNasc')}}</p>
                            @else
                                <input name="curriculo[datNasc]" type="date" value="{{old('curriculo.datNasc')}}"
                                       class="form-control "
                                       id="InputDatNas">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="form-group">
                            <label>Idade</label>
                            <input id="inputIdade" style="padding: 8px" class="form-control" type="text"
                                   name="curriculo[anos]" value="{{old('curriculo.anos')}}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="InputFacebook">Seu Nome no Facebook(<span
                                        class="campo_obrigatorio">*</span>)</label>
                            @if($errors->has('curriculo.facebook'))
                                <input type="text" value="{{old('curriculo.facebook')}}" name="curriculo[facebook]"
                                       class="form-control error_campo" id="InputFacebook" placeholder="Facebook">
                                <p class="error">{{$errors->first('curriculo.facebook')}}</p>
                            @else
                                <input type="text" name="curriculo[facebook]" class="form-control"
                                       value="{{old('curriculo.facebook')}}"
                                       id="InputFacebook" placeholder="Facebook">
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="InputEndRes">Rua(<span
                                        class="campo_obrigatorio">*</span>)</label>
                            @if($errors->has('curriculo.rua'))
                                <input type="text" class="form-control error_campo" id="InputEndRes"
                                       value="{{old('curriculo.rua')}}"
                                       name="curriculo[rua]" placeholder="Rua">
                                <p class="error">{{$errors->first('curriculo.rua')}}</p>
                            @else
                                <input type="text" class="form-control" id="InputEndRes"
                                       value="{{old('curriculo.rua')}}"
                                       name="curriculo[rua]" placeholder="Rua">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="form-group">
                            <label for="InputNumero">Numero(<span
                                        class="campo_obrigatorio">*</span>)</label>
                            @if($errors->has('curriculo.numero'))
                                <input value="{{old('curriculo.numero')}}" type="text" class="form-control error_campo"
                                       id="InputNumero"
                                       name="curriculo[numero]" placeholder="Num.">
                                <p class="error">{{$errors->first('curriculo.numero')}}</p>
                            @else
                                <input value="{{old('curriculo.numero')}}" type="text" class="form-control"
                                       id="InputNumero"
                                       name="curriculo[numero]" placeholder="Num.">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="InputBairro">Bairro(<span
                                        class="campo_obrigatorio">*</span>)</label>
                            @if($errors->has('curriculo.bairro'))
                                <input type="text" class="form-control error_campo" value="{{old('curriculo.bairro')}}"
                                       id="InputBairro" name="curriculo[bairro]"
                                       placeholder="Bairro">
                                <p class="error">{{$errors->first('curriculo.bairro')}}</p>
                            @else
                                <input type="text" class="form-control" value="{{old('curriculo.bairro')}}"
                                       id="InputBairro"
                                       name="curriculo[bairro]"
                                       placeholder="Bairro">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="selectCidAtu">Cidade Atual(<span
                                        class="campo_obrigatorio">*</span>)</label>
                            <select name="curriculo[cidade]" class="form-control" id="selectCidAtu">
                                <option>Campina do Simão</option>
                                <option>Candói</option>
                                <option>Cantagalo</option>
                                <option>Espigão Alto do Iguaçu</option>
                                <option>Foz do Jordão</option>
                                <option>Goioxim</option>
                                <option selected>Guarapuava</option>
                                <option>Inácio Martins</option>
                                <option>Laranjeiras do Sul</option>
                                <option>Marquinho</option>
                                <option>Nova Laranjeiras</option>
                                <option>Pinhão</option>
                                <option>Porto Barreiro</option>
                                <option>Quedas do Iguaçu</option>
                                <option>Reserva do Iguaçu</option>
                                <option>Rio Bonito do Iguaçu</option>
                                <option>Turvo</option>
                                <option>Virmond</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="InputnomePai">Nome Completo do Pai(<span
                                        class="campo_obrigatorio">*</span>)</label>
                            @if($errors->has('curriculo.nomePai'))
                                <input type="text" class="form-control error_campo" value="{{old('curriculo.nomePai')}}"
                                       id="InputnomePai" name="curriculo[nomePai]" placeholder="Nome do Pai">
                                <p class="error">{{$errors->first('curriculo.nomePai')}}</p>
                            @else
                                <input type="text" class="form-control" value="{{old('curriculo.nomePai')}}"
                                       id="InputnomePai"
                                       name="curriculo[nomePai]" placeholder="Nome do Pai">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="InputnomeMae">Nome Completo da Mãe(<span
                                        class="campo_obrigatorio">*</span>)</label>
                            @if($errors->has('curriculo.nomeMae'))
                                <input type="text" value="{{old('curriculo.nomeMae')}}" class="form-control error_campo"
                                       id="InputnomeMae" name="curriculo[nomeMae]" placeholder="Nome da Mae">
                                <p class="error">{{$errors->first('curriculo[nomeMae]')}}</p>
                            @else
                                <input type="text" value="{{old('curriculo[nomeMae]')}}" class="form-control"
                                       id="InputnomeMae"
                                       name="curriculo[nomeMae]" placeholder="Nome da Mae">
                            @endif
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-right">
                        <button type="button" class="btn btn-success" id="btndivDocumentos"
                                onclick="showDiv('divDocumentos')"><i
                                    class="fa fa-arrow-right">
                                Proximo</i></button>
                    </div>

                </div>
            </div>
        </div>

        <div id="divDocumentos" class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Documentos
                </div>
                <div class="panel-body">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="inputRG">Carteira de Identidade(<span
                                        class="campo_obrigatorio">*</span>)</label>
                            @if($errors->has('curriculo.rg'))
                                <input type="text" id="inputRG" class="form-control error_campo" name="curriculo[rg]"
                                       placeholder="Carteira de Identidade">
                                <p class="error">{{$errors->first('curriculo.rg')}}</p>
                            @else
                                <input type="text" id="inputRG" class="form-control" name="curriculo[rg]"
                                       placeholder="Carteira de Identidade" value="{{old('curriculo.rg')}}">
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Possui Carteira de Motorista(<span class="campo_obrigatorio">*</span>)</label>
                            <select id="selectCNH" name="curriculo[cnh]" class="form-control">
                                <option value="S">Sim</option>
                                <option selected value="N">Não</option>
                            </select>
                        </div>
                    </div>
                    <div id="divCNH">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="inputCarMot">Numero da Carteira de Motorista(<span
                                            class="campo_obrigatorio">*</span>)</label>
                                @if($errors->has('curriculo.numCnh'))
                                    <input value="{{old('curriculo.numCnh')}}" type="text" id="inputCarMot"
                                           class="form-control error_campo" name="curriculo[numCnh]"
                                           placeholder="Carteira de Motorista">
                                    <p class="error">{{$errors->first('curriculo.numCnh')}}</p>
                                @else
                                    <input value="{{old('curriculo.numCnh')}}" type="text" id="inputCarMot"
                                           class="form-control"
                                           name="curriculo[numCnh]" placeholder="Carteira de Motorista">
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-6"></div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="selectCatCNH">Categoria da Carteira de Motorista(<span
                                            class="campo_obrigatorio">*</span>)</label>
                                <select id="selectCatCNH" name="curriculo[catCnh]"
                                        class="form-control" {{old('curriculo[catCnh]')}}>
                                    <option value="A">A</option>
                                    <option value="AB">AB</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-right">
                        <button type="button" class="btn btn-success" id="btndivConhecimento"
                                onclick="showDiv('divConhecimento')"><i
                                    class="fa fa-arrow-right">
                                Proximo</i></button>
                    </div>
                </div>
            </div>
        </div>

        <div id="divConhecimento" class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Conhecimentos
                </div>
                <div class="panel-body">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label>Você possui conhecimentos em:(<span
                                        class="campo_obrigatorio">*</span>)</label>
                            <div id="areas_de_conhecimentos">
                                <label>
                                    @if(empty(old("acougue")))
                                        <input id="checkAcou" type="checkbox" value="açougue" name="acougue">
                                    @else
                                        <input id="checkAcou" checked type="checkbox" value="açougue" name="acougue">
                                    @endif
                                    Açougue
                                </label>
                                <label>
                                    @if(empty(old("padaria")))
                                        <input id="checkPada" type="checkbox" value="padaria" name="padaria">
                                    @else
                                        <input id="checkPada" checked type="checkbox" value="padaria" name="padaria">
                                    @endif
                                    Padaria
                                </label>
                                <label>
                                    @if(empty(old("informatica")))
                                        <input id="checkinfo" type="checkbox" value="informatica" name="informatica">
                                    @else
                                        <input id="checkinfo" checked type="checkbox" value="informatica"
                                               name="informatica">
                                    @endif
                                    Informatica
                                </label>
                                <label>
                                    @if(empty(old("confeitaria")))
                                        <input id="checkconfe" type="checkbox" value="confeitaria" name="confeitaria">
                                    @else
                                        <input id="checkconfe" checked type="checkbox" value="confeitaria"
                                               name="confeitaria">
                                    @endif
                                    Confeitaria
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Estudou até(<span class="campo_obrigatorio">*</span>)</label>
                                <select id="selectEscolari" name="curriculo[escolaridade]"
                                        class="form-control">
                                    <option value="Ensino Fundamental Incompleto">Ensino Fundamental (1°
                                        Grau) Incompleto
                                    </option>
                                    <option value="Ensino Fundamental Completo">Ensino Fundamental (1°
                                        Grau)
                                        Completo
                                    </option>
                                    <option value="Ensino Médio Incompleto">Ensino Médio (2° Grau)
                                        Incompleto
                                    </option>
                                    <option value="Ensino Médio Completo">Ensino Médio (2° Grau)
                                        Completo
                                    </option>
                                    <option value="Ensino Superior Incompleto">Ensino Superior
                                        Incompleto
                                    </option>
                                    <option value="Ensino Superior Completo">Ensino Superior Completo
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-9" id="divCurso">
                            <div class="form-group">
                                <label>Curso:(<span class="campo_obrigatorio">*</span>)</label>
                                @if($errors->has('curriculo.cursoSup'))
                                    <input value="{{old('curriculo.cursoSup')}}" type="text"
                                           class="form-control error_campo" id="inputCurso" name="curriculo[cursoSup]"
                                           placeholder="Curso Superior">
                                    <p class="error">{{$errors->first('curriculo.cursoSup')}}</p>
                                @else
                                    <input value="{{old('curriculo.cursoSup')}}" type="text" class="form-control"
                                           id="inputCurso"
                                           name="curriculo[cursoSup]"
                                           placeholder="Curso Superior">
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group" id="divCursoPer">
                                <label>Período Atual:(<span class="campo_obrigatorio">*</span>)</label>
                                @if($errors->has('curriculo.cursoSupPer'))
                                    <input value="{{old('curriculo.cursoSupPer')}}" type="text"
                                           class="form-control error_campo"
                                           id="inputCursoPer" name="curriculo[cursoSupPer]" placeholder="Periodo Atual">
                                    <p class="error">{{$errors->first('curriculo.cursoSupPer')}}</p>
                                @else
                                    <input value="{{old('curriculo.cursoSupPer')}}" type="text" class="form-control"
                                           id="inputCursoPer"
                                           name="curriculo[cursoSupPer]" placeholder="Periodo Atual">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Você ja fez um curso tecnico?(<span
                                        class="campo_obrigatorio">*</span>)</label>
                            <select id="selectCursoTec" name="selectCurTec" class="form-control">
                                <option value="S">Sim</option>
                                <option selected value="N">Não</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-9" id="divQualCurso">
                        <label>Qual?(<span class="campo_obrigatorio">*</span>)</label>
                        @if($errors->has('curriculo.curTec'))
                            <input value="{{old('curTec')}}" id="inputCurTec" type="text"
                                   placeholder="Qual Curso Tecnico você fez?"
                                   class="form-control error_campo" name="curriculo[curTec]">
                            <p class="error">{{$errors->first('curriculo.curTec')}}</p>
                        @else
                            <input value="{{old('curriculo.curTec')}}" id="inputCurTec" type="text"
                                   placeholder="Qual Curso Tecnico você fez?"
                                   class="form-control" name="curriculo[curTec]">
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-right">
                        <button type="button" class="btn btn-success" id="btndivExperiencia"
                                onclick="showDivExpericencia('divExperiencia')"><i
                                    class="fa fa-arrow-right">
                                Proximo</i></button>
                    </div>
                </div>
            </div>
        </div>

        <div id="divExperiencia" class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Experiencia - Seus 3 últimos trabalhos
                </div>
                <div class="panel-body">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>É seu primeiro Emprego(<span
                                        class="campo_obrigatorio">*</span>)</label>
                            <select class="form-control" id="selectPriEmp" name="priEmp">
                                <option value="S">Sim</option>
                                <option selected value="N">Não</option>

                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div id="empresas" class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Último Emprego
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="InputNomEmp">Empresa(<span
                                                    class="campo_obrigatorio">*</span>)</label>
                                        @if($errors->has('empresa[0]'))
                                            <input type="text" class="form-control error_campo" id="InputNomEmp"
                                                   value="{{old('empresa')[0]}}" name="empresa[0]" placeholder="Nome">
                                            <p class="error">{{$errors->first('empresa[0]')}}</p>
                                        @else
                                            <input type="text" class="form-control" id="InputNomEmp" name="empresa[0]"
                                                   value="{{old('empresa')[0]}}" placeholder="Nome">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="InputEntSai">Entrada e Saida(<span
                                                    class="campo_obrigatorio">*</span>)</label>
                                        @if($errors->has('entSai[0]'))
                                            <input type="text" class="form-control error_campo" id="InputEntSai"
                                                   name="entSai[0]" value="{{old('entSai')[0]}}"
                                                   placeholder="dd/mm/yyyy até dd/mm/yyyy">
                                            <p class="error">{{$errors->first('entSai[0]')}}</p>
                                        @else
                                            <input type="text" class="form-control" id="InputEntSai" name="entSai[0]"
                                                   placeholder="dd/mm/yyyy até dd/mm/yyyy" value="{{old('entSai')[0]}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="InputFuncao">Função(<span
                                                    class="campo_obrigatorio">*</span>)</label>
                                        @if($errors->has('funcao[0]'))
                                            <input type="text" class="form-control error_campo"
                                                   value="{{old('funcao')[0]}}" id="InputFuncao" name="funcao[0]"
                                                   placeholder="Função">
                                            <p class="error">{{$errors->first('funcao[0]')}}</p>
                                        @else
                                            <input type="text" class="form-control" value="{{old('funcao')[0]}}"
                                                   id="InputFuncao" name="funcao[0]" placeholder="Função">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="InputMotSaid">Motivo Saida(<span
                                                    class="campo_obrigatorio">*</span>)</label>
                                        @if($errors->has('motSai[0]'))
                                            <input type="text" class="form-control error_campo"
                                                   value="{{old('motSai')[0]}}"
                                                   name="motSai[2]" id="InputMotSaid" placeholder="Nome">
                                            <p class="error">{{$errors->first('motSai[0]')}}</p>
                                        @else
                                            <input type="text" class="form-control" value="{{old('motSai')[0]}}"
                                                   name="motSai[0]" id="InputMotSaid" placeholder="Nome">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Penúltimo Emprego
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="InputNomEmp2">Empresa</label>
                                        @if($errors->has("empresa[1]"))
                                            <input type="text" class="form-control error_campo"
                                                   value="{{old('empresa')[1]}}" id="InputNomEmp2"
                                                   name="empresa[1]" placeholder="Nome">
                                            <p class="error">{{$errors->first('empresa[1]')}}</p>
                                        @else
                                            <input type="text" class="form-control" id="InputNomEmp2"
                                                   value="{{old('empresa')[1]}}" name="empresa[1]"
                                                   placeholder="Nome">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="InputEntSai2">Entrada e Saida</label>
                                        @if($errors->has('entSai[1]'))
                                            <input type="text" class="form-control error_campo"
                                                   value="{{old('entSai')[1]}}" id="InputEntSai2"
                                                   name="entSai[1]"
                                                   placeholder="dd/mm/yyyy até dd/mm/yyyy">
                                            <p class="error">{{$errors->first('entSai[1]')}}</p>
                                        @else
                                            <input type="text" class="form-control" id="InputEntSai2"
                                                   value="{{old('entSai')[1]}}" name="entSai[1]"
                                                   placeholder="dd/mm/yyyy até dd/mm/yyyy">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="InputFuncao2">Função</label>
                                        @if($errors->has('funcao[1]'))
                                            <input type="text" class="form-control error_campo"
                                                   value="{{old('funcao')[1]}}" id="InputFuncao2" name="funcao[1]"
                                                   placeholder="Função">
                                            <p class="error">{{$errors->first('funcao[1]')}}</p>
                                        @else
                                            <input type="text" class="form-control" value="{{old('funcao')[1]}}"
                                                   id="InputFuncao2" name="funcao[1]" placeholder="Função">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="InputMotSaid2">Motivo Saida</label>
                                        @if($errors->has('motSai[1]'))
                                            <input type="text" class="form-control error_campo"
                                                   value="{{old('motSai')[1]}}" name="motSai[1]" id="InputMotSaid2"
                                                   placeholder="Nome">
                                            <p class="error">{{$errors->first('motSai[1]')}}</p>
                                        @else
                                            <input type="text" class="form-control" value="{{old('motSai')[1]}}"
                                                   name="motSai[1]" id="InputMotSaid2" placeholder="Nome">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Antepenúltimo Emprego
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="InputNomEmp3">Empresa</label>
                                        @if($errors->has('empresa[2]'))
                                            <input type="text" class="form-control error_campo"
                                                   value="{{old('empresa')[2]}}" id="InputNomEmp3"
                                                   name="empresa[2]" placeholder="Nome">
                                            <p class="error">{{$errors->first('empresa[2]')}}</p>
                                        @else
                                            <input type="text" class="form-control" id="InputNomEmp3" name="empresa[2]"
                                                   value="{{old('empresa')[2]}}" placeholder="Nome">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="InputEntSai3">Entrada e Saida</label>
                                        @if($errors->has('entSai[2]'))
                                            <input type="text" class="form-control error_campo" id="InputEntSai3"
                                                   name="entSai[2]" value="{{old('entSai')[2]}}"
                                                   placeholder="dd/mm/yyyy até dd/mm/yyyy">
                                            <p class="error">{{$errors->first('entSai[2]')}}</p>
                                        @else
                                            <input type="text" class="form-control" id="InputEntSai3"
                                                   name="entSai[2]" value="{{old('entSai')[2]}}"
                                                   placeholder="dd/mm/yyyy até dd/mm/yyyy">
                                        @endif

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="InputFuncao3">Função</label>
                                        @if($errors->has('funcao[2]'))
                                            <input type="text" class="form-control error_campo"
                                                   value="{{old('funcao')[2]}}" id="InputFuncao3" name="funcao[2]"
                                                   placeholder="Função">
                                            <p class="error">{{$errors->first('funcao[2]')}}</p>
                                        @else
                                            <input type="text" class="form-control" value="{{old('funcao')[2]}}"
                                                   id="InputFuncao3" name="funcao[2]" placeholder="Função">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="InputMotSaid3">Motivo Saida</label>
                                        @if($errors->has('motSai[2]'))
                                            <input type="text" class="form-control error_campo"
                                                   value="{{old('motSai')[2]}}" name="motSai[2]" id="InputMotSaid3"
                                                   placeholder="Nome">
                                            <p class="error">{{$errors->first('motSai')[2]}}</p>
                                        @else
                                            <input type="text" class="form-control" value="{{old('motSai')[2]}}"
                                                   name="motSai[2]" id="InputMotSaid3" placeholder="Nome">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
    <div class="col-lg-12 text-right" id="btn_cadastrar_curricolo">
        <button type="form" id="btnSavCur" class="btn btn-primary"><i class="fa fa-save"> </i>
            Cadastrar Currículo
        </button>
    </div>
@endsection

@section("scripts")
    <script src="{{asset('/js/pageScript/curriculo/curriculo-cadastro.js')}}"></script>
    @include('js.cpfAutoCompleta-js')

@endsection

