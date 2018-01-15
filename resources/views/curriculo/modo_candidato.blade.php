@extends('layout.not_navbar_layout')
@section("scripts")
    <script src="{{asset('/js/pageScript/curriculo/curriculo-cadastro.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $("#cpf").blur(function () {

                var $tipCur = $('#selectTipCur');
                var $indicador = $('#inputIndicador');
                var $cpf = $('#cpf');
                var $id = $('#id');
                var $valRG = $('#inputValRG');
                var $nome = $('#nomCandidato');
                var $trSPao = $('#traSPao');
                var $datPren = $('#datPrench');
                var $telf = $('#InputFone');
                var $foneRec = $('#InputFoneReca');
                var $idade = $('#inputIdade');
                var $datNa = $('#InputDatNas');
                var $facebook = $('#InputFacebook');
                var $rua = $('#InputEndRes');
                var $numero = $('#InputNumero');
                var $bairro = $('#InputBairro');
                var $cidade = $('#selectCidAtu');
                var $nomPai = $('#InputNomPai');
                var $nomMa = $('#InputNomMae');
                var $rg = $('#inputRG');
                var $cnh = $('#selectCNH');
                var $numCnh = $('#inputCarMot');
                var $catCnh = $('#selectCatCNH');
                var $acougue = $('#checkAcou');
                var $padaria = $('#checkPada');
                var $informatica = $('#checkinfo');
                var $confeitaria = $('#checkconfe');
                var $escolaridade = $('#selectEscolari');
                var $cursoSup = $('#inputCurso');
                var $cursoSupPer = $('#inputCursoPer');
                var $curTec = $('#inputCurTec');
                var $priEmp = $('#selectPriEmp');
                var $nomEmp1 = $('#InputNomEmp');
                var $entSai1 = $('#InputEntSai');
                var $funcao1 = $('#InputFuncao');
                var $motSaid1 = $('#InputMotSaid');
                var $nomEmp2 = $('#InputNomEmp2');
                var $entSai2 = $('#InputEntSai2');
                var $funcao2 = $('#InputFuncao2');
                var $motSaid2 = $('#InputMotSaid2');
                var $nomEmp3 = $('#InputNomEm3');
                var $entSai3 = $('#InputEntSai3');
                var $funcao3 = $('#InputFuncao3');
                var $motSaid3 = $('#InputMotSaid3');


                $.getJSON(
                    '{{route('pesquisa_cuuriculo_cpf')}}',
                    {cpf: $(this).val()},
                    function (json) {
                        $("#dialog-inputs-cpf").dialog({
                            modal: true,
                            buttons: {
                                Ok: function () {
                                    $.get("{{route('verificaRG')}}?cpf=" + $cpf.val() + "&rg=" + $valRG.val(), function (data) {
                                        if (data != json.curriculo[0].nome) {
                                            alert("RG Incorreto, tente novamente");

                                        } else {
                                            $('form').attr("action", "{{route('curriculo_update_modocandidato')}}");
                                            document.getElementById('btnSavCur').innerHTML = '<i class="fa fa-save"> </i> Editar Curriculo';
                                            $("#dialog-inputs-cpf").dialog("close");
                                            $tipCur.val(json.indicacoes[0].tipInd);
                                            $indicador.val(json.indicacoes[0].nomInd);
                                            $id.val(json.curriculo[0].id);
                                            $nome.val(json.curriculo[0].nome);
                                            $trSPao.val(json.curriculo[0].trabSupe);
                                            $datPren.val(json.curriculo[0].dat_ficha);
                                            $telf.val(json.curriculo[0].fone);
                                            $idade.val(json.curriculo[0].anos);
                                            $foneRec.val(json.curriculo[0].foneRec);
                                            $datNa.val(json.curriculo[0].datNasc);
                                            $facebook.val(json.curriculo[0].facebook);
                                            $rua.val(json.curriculo[0].rua);
                                            $numero.val(json.curriculo[0].numero);
                                            $bairro.val(json.curriculo[0].bairro);
                                            $cidade.val(json.curriculo[0].cidade);
                                            $nomPai.val(json.curriculo[0].nomePai);
                                            $nomMa.val(json.curriculo[0].nomeMae);
                                            $rg.val(json.curriculo[0].rg);
                                            $cnh.val(json.curriculo[0].cnh);
                                            $numCnh.val(json.curriculo[0].numCnh);
                                            $catCnh.val(json.curriculo[0].catCnh);
                                            var i;
                                            if (json.conhecimentos != null) {
                                                for (i = 0; i < 4; i++) {
                                                    if (json.conhecimentos[i] != null) {
                                                        if (json.conhecimentos[i].conhecimento == "acougue") {
                                                            $acougue.prop("checked", true);
                                                        }

                                                        if (json.conhecimentos[i].conhecimento == "informatica") {
                                                            $informatica.prop("checked", true);
                                                        }
                                                        if (json.conhecimentos[i].conhecimento == "confeitaria") {
                                                            $confeitaria.prop("checked", true);
                                                        }
                                                        if (json.conhecimentos[i].conhecimento == "padaria") {
                                                            $padaria.prop("checked", true);
                                                        }
                                                    }

                                                }
                                            }

                                            $escolaridade.val(json.curriculo[0].escolaridade);
                                            $cursoSup.val(json.curriculo[0].cursoSup);
                                            $cursoSupPer.val(json.curriculo[0].cursoSupPer);
                                            $curTec.val(json.curriculo[0].curTec);

                                            if (json.experiencias != null) {
                                                $('#empresas').hide();
                                                $('#selectPriEmp').val('S');
                                                if (json.experiencias[0] != null) {
                                                    $('#empresas').show();
                                                    $('#selectPriEmp').val('N');
                                                    $nomEmp1.val(json.experiencias[0].empresa);
                                                    $entSai1.val(json.experiencias[0].entSai);
                                                    $funcao1.val(json.experiencias[0].funcao);
                                                    $motSaid1.val(json.experiencias[0].motSai);

                                                }
                                                if (json.experiencias[1] != null) {
                                                    $nomEmp2.val(json.experiencias[1].empresa);
                                                    $entSai2.val(json.experiencias[1].entSai);
                                                    $funcao2.val(json.experiencias[1].funcao);
                                                    $motSaid2.val(json.experiencias[1].motSai);
                                                }
                                                if (json.experiencias[2] != null) {
                                                    $nomEmp3.val(json.experiencias[2].empresa);
                                                    $entSai3.val(json.experiencias[2].entSai);
                                                    $funcao3.val(json.experiencias[2].funcao);
                                                    $motSaid3.val(json.experiencias[2].motSai);
                                                }

                                            }

                                            if (json.curriculo[0].cnh == 'S') {
                                                $('#divCNH').show(500);
                                            }

                                            if (json.indicacoes[0].tipCur != "Normal") {
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
                                            if (json.curriculo[0].escolaridade == "Ensino Superior Completo") {
                                                $('#divCurso').show(500);
                                                $('#divCursoPer').hide(500);
                                            } else if (json.curriculo[0].escolaridade == "Ensino Superior Incompleto") {
                                                $('#divCurso').show(500);
                                                $('#divCursoPer').show(500);
                                            } else {
                                                $('#divCurso').hide(500);
                                                $('#divCursoPer').hide(500);
                                            }
                                            if (json.curriculo[0].curTec != null) {
                                                $('#divQualCurso').show(500);
                                            }
                                            $('#btndivExperiencia').hide(500);
                                            $('#divExperiencia').show(500);

                                            $('#btn_cadastrar_curricolo').show(500);

                                        }
                                    });
                                }
                            }
                        });
                    }
                );
            });

            //destaca em vermelho inputs em branco se não preenchidos
            $('input').blur(function () {
                if (($(this).val().trim() == "" )) {
                    $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});

                } else {
                    $(this).css({"border": "1px solid #ccc", "padding": "6px 12px"});
                }
            });

            //ao clicar no botao para submeter verefica se os campos estão preenchido
            $("#btnSavCur").click(function () {
                var cont = 0;
                $("input").each(function () {
                    if ($(this).val().trim() == "") {
                        var id = $(this).attr("id");

                        if (id == "inputIndicador" || id == "catCNH" || id == "inputCarMot" || id == "inputCurso" ||
                            id == "inputCursoPer" || id == "inputCurTec" || $(this).attr('type') == "checkbox" ||
                            id == "InputNomEmp" || id == "InputEntSai" || id == "InputFuncao" || id == "InputMotSaid" ||
                            id == "InputNomEmp2" || id == "InputEntSai2" || id == "InputFuncao2" || id == "InputMotSaid2" ||
                            id == "InputNomEmp3" || id == "InputEntSai3" || id == "InputFuncao3" || id == "InputMotSaid3" ||
                            id == "inputIdade" || id == "inputValRG" || id == "cargo_id" || id == "id") {
                            switch (id) {
                                case "inputIndicador":
                                    if ($("#selectTipCur").val().trim() == "Indicação") {
                                        $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
                                        cont++;
                                        console.log($(this).attr("id") + "  - " + cont);
                                    }
                                    break;
                                case "catCNH":
                                    if ($('#selectCNH').val() == "S") {
                                        $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
                                        cont++;
                                        console.log($(this).attr("id") + "  - " + cont);
                                    }
                                    break;
                                case "inputCarMot":
                                    if ($('#selectCNH').val() == "S") {
                                        $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
                                        cont++;
                                        console.log($(this).attr("id") + "  - " + cont);
                                    } else if ($('#selectCNH').val() == "Ensino Superior Incompleto") {
                                        $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
                                        cont++;
                                        console.log($(this).attr("id") + "  - " + cont);
                                    }
                                    break;
                                case "inputCurso":
                                    if (($('#selectEscolari').val() == "Ensino Superior Completo") || ($('#selectEscolari').val() == "Ensino Superior Incompleto")) {
                                        $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
                                        cont++;
                                        console.log($(this).attr("id") + "  - " + cont);
                                    }
                                    break;
                                case "inputCursoPer":
                                    if ($('#selectEscolari').val() == "Ensino Superior Incompleto") {
                                        $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
                                        cont++;
                                        console.log($(this).attr("id") + "  - " + cont);
                                    }
                                    break;
                                case "inputCurTec":
                                    if ($('#selectCursoTec').val() == "S") {
                                        $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
                                        cont++;
                                        console.log($(this).attr("id") + "  - " + cont);
                                    }
                                    break;
                                case "InputNomEmp":
                                    if ($('#selectPriEmp').val() == "N") {
                                        $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
                                        cont++;
                                        console.log($(this).attr("id") + "  - " + cont);
                                    }
                                    break;
                                case "InputEntSai":
                                    if ($('#selectPriEmp').val() == "N") {
                                        $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
                                        cont++;
                                        console.log($(this).attr("id") + "  - " + cont);
                                    }
                                    break;
                                case "InputFuncao":
                                    if ($('#selectPriEmp').val() == "N") {
                                        $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
                                        cont++;
                                        console.log($(this).attr("id") + "  - " + cont);
                                    }
                                    break;
                                case "InputMotSaid":
                                    if ($('#selectPriEmp').val() == "N") {
                                        $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
                                        cont++;
                                        console.log($(this).attr("id") + "  - " + cont);
                                    }
                                    break;
                                default:
                                    $(this).css({"border": "1px solid #ccc", "padding": "6px 12px"});

                            }

                        } else {
                            $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
                            console.log(+$(this).attr("id") + "  - " + cont);
                            cont++;

                        }

                    }
                });
                console.log(cont);
                if (cont == 0) {
                    $("#form").submit();
                } else {
                    $("#dialog-inputs-null").dialog({
                        modal: true,
                        buttons: {
                            Ok: function () {
                                $(this).dialog("close");
                            }
                        }
                    });
                }
            });
            data = new Date();
            if (data.getMonth() < 09) {
                mes = "0" + (data.getMonth()+1);
            }
            if (data.getDate() < 10) {
                dia = "0" + data.getDate();
            }
            $('#datPrench').val(data.getFullYear() + "-" + mes + "-" + dia);
            $('#datPrench').prop("readonly", "readonly");

        });
    </script>
    <script type="text/javascript">
        $(function () {
            $("#divDadosPessoais").show(200);
        });
    </script>
@endsection

@section('dialogs')
    <div id="dialog-inputs-null" title="Campos Não Preenchidos">
        <p style="font-weight: bold">
            Possui campos não preenchidos
        </p>
        <p>
            Preencha os campos em <span style="color: red">Vermelho</span> para enviar os seu curriculo
        </p>

    </div>
    <div id="dialog-inputs-cpf" title="CPF já cadastrado">
        <p> Para editar seus dados, digite seu RG abaixo:</p>
        <input type="text" id="inputValRG" class="form-control">
    </div>
    <div id="dialog-cpf-invalido" title="CPF Invalido">
        <p style="font-weight: bold">
            CPF digitado não é valido, digite novamente.
        </p>

    </div>
@endsection
@section('corpo_pagina')
    <div id="modo_candidato">

        <div class="row">
            @if (count($errors) == 0)
                @if(isset($salvou))
                    <div style="text-align: center; background: darkseagreen;margin: 10px" class="col-lg-12">
                        <h3>Salvou</h3>
                    </div>
                @endif
            @else
                <div style="text-align: center; background: rgba(255,12,12,0.64);margin: 10px" class="col-lg-12">
                    <h3>Não Salvou, verefique os campos em vermelho</h3>
                    {{var_dump($errors)}}

                </div>
                <script type="text/javascript">
                    //exibe os campos quando o laravel envia de volta a pagina com erros
                    $(function () {
                        $("#selectEscolari").val('{{old('escolaridade')}}');
                        $("#selectCursoTec").val('{{old('curTec')}}');
                        $("#traSPao").val('{{old('trSPao')}}');
                        $("#selectCidAtu").val('{{old('cidade')}}');
                        $("#selectCNH").val('{{old('cnh')}}');
                        if ('{{old('cnh')}}' == 'S') {
                            $('#divCNH').show(500);
                        }
                        $("#selectPriEmp").val('{{old('priEmp')}}');
                        $("#selectCatCNH").val('{{old('catCnh')}}');
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
                        if ("{{old('escolaridade')}}" == "Ensino Superior Completo") {
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
                        if ('{{old('selectCurTec')}}' == 'S') {
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

            <div class="col-lg-5">
                <h1 class="page-header">Cadastro de Currículos</h1>
            </div>
            <div class="col-lg-7 text-right">
                <img src="{{asset("img/grupo-superpao.png")}}" width="60%">
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <!-- /.paineis indicadores -->
        <div class="row">

            <div class="col-lg-12">
                <div class="row">
                    <!-- Primeira Etapa / Tipo Curricolo -->
                    <div class="col-lg-12">
                        <h4>OBS: Os Campos com '(<span class="campo_obrigatorio">*</span>)' são de preenchimento
                            obrigatório</h4>
                    </div>
                    <div class="clearfix"></div>
                    <form method="post" id="form" action="{{route('curriculo_cadastro_modocandidato')}}">
                        {{ csrf_field() }}
                        <input type="hidden" id="cargo_id" name="curriculo[cargo_id]" value="">
                        <input type="hidden" id="id" name="id" value="">
                        <div class="col-lg-12" style="display: none">
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
                                            <!--  <p class="help-block">Example block-level help text here.</p> -->
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div id="indicador">
                                            <div class="form-group">
                                                <label>Indicador(<span class="campo_obrigatorio">*</span>)</label>
                                                @if($errors->has('indicador'))
                                                    <input name="indicador" id="inputIndicador"
                                                           value="{{old('indicador')}}" type="text"
                                                           class="form-control error_campo">
                                                    <p class="error">{{$errors->first('indicador')}}</p>
                                                @else
                                                    <input name="indicador" id="inputIndicador"
                                                           value="{{old('indicador')}}" type="text"
                                                           class="form-control">
                                            @endif
                                            <!--  <p class="help-block">Example block-level help text here.</p> -->
                                            </div>
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


                        <div class="col-lg-12" style="display: block" id="divDadosPessoais">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Dados Pessoais
                                </div>
                                <div class="panel-body">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="cpf">CPF(<span class="campo_obrigatorio">*</span>)</label>
                                            @if($errors->has('curriculo.cpf'))
                                                <input type="text" class="form-control error_campo"
                                                       value="{{old('curriculo.cpf')}}" name="curriculo[cpf]"
                                                       id="cpf" placeholder="CPF">
                                                <p class="error">{{$errors->first('curriculo.cpf')}}</p>
                                            @else
                                                <input type="text" class="form-control" value="{{old('cpf')}}"
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
                                                <input type="text" name="curriculo[nome]"
                                                       class="form-control error_campo"
                                                       id="nomCandidato" placeholder="Nome"
                                                       value="{{old('curriculo[nome]')}}">
                                                <p class="error">{{$errors->first('curriculo[nome]')}}</p>
                                            @else
                                                <input type="text" name="curriculo[nome]" class="form-control"
                                                       id="nomCandidato"
                                                       placeholder="Nome" value="{{old('curriculo[nome]')}}">
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
                                                <input value="{{old('curriculo.dat_ficha')}}" id="datPrench"
                                                       name="curriculo[dat_ficha]"
                                                       type="date" class="form-control error_campo">
                                                <p class="error">{{$errors->first('dat_ficha')}}</p>
                                            @else
                                                <input value="{{old('curriculo.dat_ficha')}}" readonly="" id="datPrench"
                                                       name="curriculo[dat_ficha]"
                                                       type="date" class="form-control">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="InputFone">Fone(<span
                                                        class="campo_obrigatorio">*</span>)</label>
                                            @if($errors->has('curriculo.fone'))
                                                <input type="tel" value="{{old('curriculo.fone')}}"
                                                       name="curriculo[fone]"
                                                       class="form-control error_campo" id="InputFone"
                                                       placeholder="Fone">
                                                <p class="error">{{$errors->first('curriculo.fone')}}</p>
                                            @else
                                                <input type="tel" name="curriculo[fone]"
                                                       value="{{old('curriculo.fone')}}" class="form-control"
                                                       id="InputFone" placeholder="Fone">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="InputFoneReca">Fone para recados(<span
                                                        class="campo_obrigatorio">*</span>)</label>
                                            @if($errors->has('curriculo.foneRec'))
                                                <input type="tel" value="{{old('curriculo.foneRec')}}"
                                                       class="form-control error_campo"
                                                       name="curriculo[foneRec]" id="InputFoneReca"
                                                       placeholder="Fone para Recados">
                                                <p class="error">{{$errors->first('curriculo.fonRec')}}</p>
                                            @else
                                                <input type="tel" value="{{old('curriculo[foneRec]')}}"
                                                       class="form-control" name="curriculo[foneRec]"
                                                       id="InputFoneReca" placeholder="Fone para Recados">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="InputDatNas">Data de Nascimento(<span
                                                        class="campo_obrigatorio">*</span>)</label>
                                            @if($errors->has('curriculo.datNasc'))
                                                <input name="curriculo[datNasc]" type="date"
                                                       value="{{old('curriculo.datNasc')}}"
                                                       class="form-control error_campo" id="InputDatNas">
                                                <p class="error">{{$errors->first('curriculo.datNasc')}}</p>
                                            @else
                                                <input name="curriculo[datNasc]" type="date"
                                                       value="{{old('curriculo.datNasc')}}" class="form-control "
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
                                            @if($errors->has('curriculo.facebook]'))
                                                <input type="text" value="{{old('curriculo.facebook')}}"
                                                       name="curriculo[facebook]"
                                                       class="form-control error_campo" id="InputFacebook"
                                                       placeholder="Facebook">
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
                                                <input type="text" class="form-control" id="InputEndRes"
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
                                                <input value="{{old('curriculo.numero')}}" type="text"
                                                       class="form-control error_campo"
                                                       id="InputNumero" name="curriculo[numero]" placeholder="Num.">
                                                <p class="error">{{$errors->first('curriculo.numero')}}</p>
                                            @else
                                                <input value="{{old('curriculo.numero')}}" type="text"
                                                       class="form-control" id="InputNumero"
                                                       name="curriculo[numero]" placeholder="Num.">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="InputBairro">Bairro(<span
                                                        class="campo_obrigatorio">*</span>)</label>
                                            @if($errors->has('curriculo.bairro'))
                                                <input type="text" class="form-control error_campo"
                                                       value="{{old('curriculo.bairro')}}"
                                                       id="InputBairro" name="curriculo[bairro]"
                                                       placeholder="Bairro">
                                                <p class="error">{{$errors->first('curriculo.bairro')}}</p>
                                            @else
                                                <input type="text" class="form-control"
                                                       value="{{old('curriculo.bairro')}}" id="InputBairro"
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
                                            <label for="InputNomPai">Nome Completo do Pai(<span
                                                        class="campo_obrigatorio">*</span>)</label>
                                            @if($errors->has('curriculo.nomePai'))
                                                <input type="text" class="form-control error_campo"
                                                       value="{{old('curriculo.nomePai')}}"
                                                       id="InputNomPai" name="curriculo[nomePai]"
                                                       placeholder="Nome do Pai">
                                                <p class="error">{{$errors->first('curriculo.nomePai')}}</p>
                                            @else
                                                <input type="text" class="form-control"
                                                       value="{{old('curriculo.nomPai')}}" id="InputNomPai"
                                                       name="curriculo[nomePai]" placeholder="Nome do Pai">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="InputNomMae">Nome Completo da Mãe(<span
                                                        class="campo_obrigatorio">*</span>)</label>
                                            @if($errors->has('curriculo.nomeMae'))
                                                <input type="text" value="{{old('curriculo.nomeMae')}}"
                                                       class="form-control error_campo"
                                                       id="InputNomMae" name="curriculo[nomeMae]"
                                                       placeholder="Nome da Mae">
                                                <p class="error">{{$errors->first('curriculo.nomeMae')}}</p>
                                            @else
                                                <input type="text" value="{{old('curriculo.nomeMae')}}"
                                                       class="form-control" id="InputNomMae"
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
                                                <input type="text" id="inputRG" class="form-control error_campo"
                                                       name="curriculo[rg]"
                                                       placeholder="Carteira de Identidade">
                                                <p class="error">{{$errors->first('curriculo.rg')}}</p>
                                            @else
                                                <input type="text" id="inputRG" class="form-control"
                                                       name="curriculo[rg]"
                                                       placeholder="Carteira de Identidade"
                                                       value="{{old('curriculo.rg')}}">
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
                                                    <input value="{{old('curriculo.numCnh')}}" type="text"
                                                           id="inputCarMot"
                                                           class="form-control error_campo" name="curriculo[numCnh]"
                                                           placeholder="Carteira de Motorista">
                                                    <p class="error">{{$errors->first('numCnh')}}</p>
                                                @else
                                                    <input value="{{old('curriculo.numCnh')}}" type="text"
                                                           id="inputCarMot" class="form-control"
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
                                                        class="form-control" {{old('curriculo.catCnh')}}>
                                                    <option value="A">A</option>
                                                    <option value="AB">AB</option>
                                                    <option value="B">B</option>
                                                    <option value="C">A</option>
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
                                                        <input id="checkAcou" type="checkbox" value="açougue"
                                                               name="acougue">
                                                    @else
                                                        <input id="checkAcou" checked type="checkbox" value="açougue"
                                                               name="acougue">
                                                    @endif
                                                    Açougue
                                                </label>
                                                <label>
                                                    @if(empty(old("padaria")))
                                                        <input id="checkPada" type="checkbox" value="padaria"
                                                               name="padaria">
                                                    @else
                                                        <input id="checkPada" checked type="checkbox" value="padaria"
                                                               name="padaria">
                                                    @endif
                                                    Padaria
                                                </label>
                                                <label>
                                                    @if(empty(old("informatica")))
                                                        <input id="checkinfo" type="checkbox" value="informatica"
                                                               name="informatica">
                                                    @else
                                                        <input id="checkinfo" checked type="checkbox"
                                                               value="informatica"
                                                               name="informatica">
                                                    @endif
                                                    Informatica
                                                </label>
                                                <label>
                                                    @if(empty(old("confeitaria")))
                                                        <input id="checkconfe" type="checkbox" value="confeitaria"
                                                               name="confeitaria">
                                                    @else
                                                        <input id="checkconfe" checked type="checkbox"
                                                               value="confeitaria"
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
                                                           class="form-control error_campo" id="inputCurso"
                                                           name="curriculo[cursoSup]"
                                                           placeholder="Curso Superior">
                                                    <p class="error">{{$errors->first('curriculo.cursoSup')}}</p>
                                                @else
                                                    <input value="{{old('curriculo.cursoSup')}}" type="text"
                                                           class="form-control" id="inputCurso"
                                                           name="curriculo[cursoSup]" placeholder="Curso Superior">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group" id="divCursoPer">
                                                <label>Período Atual:(<span class="campo_obrigatorio">*</span>)</label>
                                                @if($errors->has('curriculo.cursoSupPer'))
                                                    <input value="{{old('curriculo.cursoSupPer')}}" type="text"
                                                           class="form-control error_campo"
                                                           id="inputCursoPer" name="curriculo[cursoSupPer]"
                                                           placeholder="Periodo Atual">
                                                    <p class="error">{{$errors->first('curriculo[cursoSupPer]')}}</p>
                                                @else
                                                    <input value="{{old('curriculo[cursoSupPer]')}}" type="text"
                                                           class="form-control"
                                                           id="inputCursoPer" name="curriculo[cursoSupPer]"
                                                           placeholder="Periodo Atual">
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
                                            <input value="{{old('curriculo.curTec')}}" id="inputCurTec" type="text"
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
                                            <select class="form-control" id="selectPriEmp" value="{{old('priEmp')}}"
                                                    name="priEmp">
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
                                                            <input type="text" class="form-control error_campo"
                                                                   id="InputNomEmp"
                                                                   value="{{old('empresa')[0]}}" name="empresa[0]"
                                                                   placeholder="Nome">
                                                            <p class="error">{{$errors->first('empresa[0]')}}</p>
                                                        @else
                                                            <input type="text" class="form-control" id="InputNomEmp"
                                                                   name="empresa[0]"
                                                                   value="{{old('empresa')[0]}}" placeholder="Nome">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="InputEntSai">Entrada e Saida(<span
                                                                    class="campo_obrigatorio">*</span>)</label>
                                                        @if($errors->has('entSai[0]'))
                                                            <input type="text" class="form-control error_campo"
                                                                   id="InputEntSai"
                                                                   name="entSai[0]" value="{{old('entSai')[0]}}"
                                                                   placeholder="dd/mm/yyyy até dd/mm/yyyy">
                                                            <p class="error">{{$errors->first('entSai[0]')}}</p>
                                                        @else
                                                            <input type="text" class="form-control" id="InputEntSai"
                                                                   name="entSai[0]"
                                                                   placeholder="dd/mm/yyyy até dd/mm/yyyy"
                                                                   value="{{old('entSai')[0]}}">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="InputFuncao">Função(<span
                                                                    class="campo_obrigatorio">*</span>)</label>
                                                        @if($errors->has('funcao[0]'))
                                                            <input type="text" class="form-control error_campo"
                                                                   value="{{old('funcao')[0]}}" id="InputFuncao"
                                                                   name="funcao[0]"
                                                                   placeholder="Função">
                                                            <p class="error">{{$errors->first('funcao[0]')}}</p>
                                                        @else
                                                            <input type="text" class="form-control"
                                                                   value="{{old('funcao')[0]}}"
                                                                   id="InputFuncao" name="funcao[0]"
                                                                   placeholder="Função">
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
                                                                   name="motSai[2]" id="InputMotSaid"
                                                                   placeholder="Nome">
                                                            <p class="error">{{$errors->first('motSai[0]')}}</p>
                                                        @else
                                                            <input type="text" class="form-control"
                                                                   value="{{old('motSai')[0]}}"
                                                                   name="motSai[0]" id="InputMotSaid"
                                                                   placeholder="Nome">
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
                                                                   value="{{old('funcao')[1]}}" id="InputFuncao2"
                                                                   name="funcao[1]"
                                                                   placeholder="Função">
                                                            <p class="error">{{$errors->first('funcao[1]')}}</p>
                                                        @else
                                                            <input type="text" class="form-control"
                                                                   value="{{old('funcao')[1]}}"
                                                                   id="InputFuncao2" name="funcao[1]"
                                                                   placeholder="Função">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="InputMotSaid2">Motivo Saida</label>
                                                        @if($errors->has('motSai[1]'))
                                                            <input type="text" class="form-control error_campo"
                                                                   value="{{old('motSai')[1]}}" name="motSai[1]"
                                                                   id="InputMotSaid2"
                                                                   placeholder="Nome">
                                                            <p class="error">{{$errors->first('motSai[1]')}}</p>
                                                        @else
                                                            <input type="text" class="form-control"
                                                                   value="{{old('motSai')[1]}}"
                                                                   name="motSai[1]" id="InputMotSaid2"
                                                                   placeholder="Nome">
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
                                                            <input type="text" class="form-control" id="InputNomEmp3"
                                                                   name="empresa[2]"
                                                                   value="{{old('empresa')[2]}}" placeholder="Nome">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="InputEntSai3">Entrada e Saida</label>
                                                        @if($errors->has('entSai[2]'))
                                                            <input type="text" class="form-control error_campo"
                                                                   id="InputEntSai3"
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
                                                                   value="{{old('funcao')[2]}}" id="InputFuncao3"
                                                                   name="funcao[2]"
                                                                   placeholder="Função">
                                                            <p class="error">{{$errors->first('funcao[2]')}}</p>
                                                        @else
                                                            <input type="text" class="form-control"
                                                                   value="{{old('funcao')[2]}}"
                                                                   id="InputFuncao3" name="funcao[2]"
                                                                   placeholder="Função">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="InputMotSaid3">Motivo Saida</label>
                                                        @if($errors->has('motSai[2]'))
                                                            <input type="text" class="form-control error_campo"
                                                                   value="{{old('motSai')[2]}}" name="motSai[2]"
                                                                   id="InputMotSaid3"
                                                                   placeholder="Nome">
                                                            <p class="error">{{$errors->first('motSai')[2]}}</p>
                                                        @else
                                                            <input type="text" class="form-control"
                                                                   value="{{old('motSai')[2]}}"
                                                                   name="motSai[2]" id="InputMotSaid3"
                                                                   placeholder="Nome">
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
                </div>

            </div>
        </div>
    </div>
@endsection
