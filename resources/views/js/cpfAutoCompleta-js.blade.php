<script>
    /**
     * Created by Juliano Sirtori on 31/03/2017.
     */
//script responsavel pela busca do cpf e atribuir nos campos, tela de cadastro
    $(document).ready(function () {

        var url = window.location.search.replace("?", "");
        var items = url.split("&");

        if (items.length > 1) {
            var id = items[1].replace("id=", "");
            $('#inputValueID').val(id);
            $.getJSON(
                '{{route('pesquisa_cuuriculo_id')}}',
                {id: id},
                function (json) {

                    preencheCampos("", json);
                }
            );
        }

        function preencheCampos(cpf, json) {
            console.log(json);
            $('form').attr("action", "{{route('curriculo_update')}}");
            $('#cpf').val(json.curriculo[0].cpf);
            $('#selectTipCur').val(json.indicacoes[0].tipInd);
            $('#inputValueID').val(json.curriculo[0].id);
            $('#inputIndicador').val(json.indicacoes[0].nomInd);
            $('#nomCandidato').val(json.curriculo[0].nome);
            $('#cargo_id').val(json.curriculo[0].cargo_id);
            $('#traSPao').val(json.curriculo[0].trabSupe);
            $('#datPrench').val(json.curriculo[0].dat_ficha);
            $('#InputFone').val(json.curriculo[0].fone);
            $('#inputIdade').val(json.curriculo[0].anos);
            $('#InputFoneReca').val(json.curriculo[0].foneRec);
            $('#InputDatNas').val(json.curriculo[0].datNasc);
            $('#InputFacebook').val(json.curriculo[0].facebook);
            $('#InputEndRes').val(json.curriculo[0].rua);
            $('#InputNumero').val(json.curriculo[0].numero);
            $('#InputBairro').val(json.curriculo[0].bairro);
            $('#selectCidAtu').val(json.curriculo[0].cidade);
            $('#InputNomPai').val(json.curriculo[0].nomePai);
            $('#InputNomMae').val(json.curriculo[0].nomeMae);
            $('#inputRG').val(json.curriculo[0].rg);
            $('#selectCNH').val(json.curriculo[0].cnh);
            $('#inputCarMot').val(json.curriculo[0].numCnh);
            $('#selectCatCNH').val(json.curriculo[0].catCnh);
            var i;
            if (json.conhecimentos != null) {
                for (i = 0; i < 4; i++) {
                    if (json.conhecimentos[i] != null) {
                        if (json.conhecimentos[i].conhecimento == "acougue") {
                            $('#checkAcou').prop("checked", true);
                        }

                        if (json.conhecimentos[i].conhecimento == "informatica") {
                            $('#checkinfo').prop("checked", true);
                        }
                        if (json.conhecimentos[i].conhecimento == "confeitaria") {
                            $('#checkconfe').prop("checked", true);
                        }
                        if (json.conhecimentos[i].conhecimento == "padaria") {
                            $('#checkPada').prop("checked", true);
                        }
                    }

                }
            }

            $('#selectEscolari').val(json.curriculo[0].escolaridade);
            $('#inputCurso').val(json.curriculo[0].cursoSup);
            $('#inputCursoPer').val(json.curriculo[0].cursoSupPer);
            $('#inputCurTec').val(json.curriculo[0].curTec);

            $('#empresas').hide();
            $('#selectPriEmp').val('S');
            if (json.experiencias != null) {

                if (json.experiencias[0] != null) {
                    $('#empresas').show();
                    $('#selectPriEmp').val('N');
                    $('#InputNomEmp').val(json.experiencias[0].empresa);
                    $('#InputEntSai').val(json.experiencias[0].entSai);
                    $('#InputFuncao').val(json.experiencias[0].funcao);
                    $('#InputMotSaid').val(json.experiencias[0].motSai);

                }
                if (json.experiencias[1] != null) {
                    $('#InputNomEmp2').val(json.experiencias[1].empresa);
                    $('#InputEntSai2').val(json.experiencias[1].entSai);
                    $('#InputFuncao2').val(json.experiencias[1].funcao);
                    $('#InputMotSaid2').val(json.experiencias[1].motSai);
                }
                if (json.experiencias[2] != null) {
                    $('#InputNomEmp3').val(json.experiencias[2].empresa);
                    $('#InputEntSai3').val(json.experiencias[2].entSai);
                    $('#InputFuncao3').val(json.experiencias[2].funcao);
                    $('#InputMotSaid3').val(json.experiencias[2].motSai);
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


        $("#cpf").blur(function () {

            var $cpf = $('#cpf');
            var $valRG = $('#inputValRG');
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
                                        preencheCampos($cpf.val(), json);
                                        $("#dialog-inputs-cpf").dialog("close");
                                    }
                                });
                            }
                        }
                    });
                }
            );
        });
    });
</script>