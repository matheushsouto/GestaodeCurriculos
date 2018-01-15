$(function () {


    function escondeElementos() {
        $('#indicador').hide();
        $('#divDadosPessoais').hide();
        $('#divDocumentos').hide();
        $('#divConhecimento').hide();
        $('#divExperiencia').hide();

        $('#divCurso').hide();
        $('#divCursoPer').hide();
        $('#divQualCurso').hide();
        $('#divCNH').hide();
        $('#dialog-inputs-null').hide();
        $('#dialog-cpf-invalido').hide();
        $('#dialog-aviso_indicador').hide();
        $('#btn_cadastrar_curricolo').hide();
        $('#dialog-inputs-cpf').hide();
    }

    function aplicaMascaras() {
        $(".inputEntSai").mask('99/99/9999 até 99/99/9999');
        $("#cpf").mask("999.999.999-99");
        $("#InputFone").mask("(99) 9 - 9999-9999");
        $("#InputFoneReca").mask("(99) 9 - 9999-9999");
        $('#inputRG').mask("99999999999999")
        $('#inputCarMot').mask("999999999999");

    }

    function autoCompletaBairros() {
        var listaDeBairros = [
            "Loteamento Feroz II",
            "Vila Jordão",
            "Vila Pequena",
            "Newton Agibert",
            "Vila Sekula",
            "Jardim Dona Maria",
            "Anexo Jardim Dona Maria",
            "Parque das Rosas",
            "Jardim Adolpho Lanzini",
            "Vila Broline",
            "Vila Guaíra",
            "Vila Euralina",
            "Santa Cruz",
            "Municipal Vila Rita",
            "Vila Luiza",
            "Jardim das Flores",
            "São Miguel",
            "São Jorge",
            "Anexo São Jorge",
            "Sol Nascente",
            "Hamilton Prestes",
            "Higienópolis",
            "Vila São Francisco",
            "Melo Fontoura",
            "Vila Santana",
            "Vila Rica",
            "Presidente Kennedy",
            "Núcleo Habitacional São Miguel",
            " Núcleo Habitacional Rocha Loures",
            "Wilson Luiz Silvério Martins",
            "Jardim Karen Christine",
            "Jardim Carvalho",
            "Boqueirão",
            "Tancredo Neves",
            "Vila Concórdia",
            "Municipal Concórdia II",
            "Municipal Concórdia III",
            "Jardim Floresta",
            "Jardim Social",
            "Nossa Senhora de Belém",
            "Lange",
            "Wrege",
            "Municipal Anexo ao Lange",
            "São José",
            "Núcleo Habitacional Santa Cruz",
            "Lagoa Dourada",
            "São Marcos",
            "Flávio Alves",
            "Alcindo Cardoso Teixeira",
            "Vila São Pedro",
            "Mansueto",
            "Vila Dona Ana",
            "Vila Mirim",
            "Anexo a Vila Iensen",
            "Dona Érica Iensen",
            "Vila Iensen",
            "Continental",
            "Mirante da Serra",
            "São João",
            "Campo Velho",
            "Vila Romana",
            "Anexo Zagonel",
            "Jardim Pinheirinho",
            "Vila Bela",
            "Jardim Brasília",
            "Municipal Anexo ao Jardim Brasília",
            "Municipal Anexo a Vila Planalto",
            "Vila Planalto",
            "Jardim Veneza",
            "Jardim Veneza II",
            "Jardim Gaspar",
            "Nucleo Airton Senna",
            "Cascavel",
            "Vila São Vicente",
            "Jardim Novo Horizonte",
            "Santa Regina",
            "Jardim Patricia",
            "Vila Colibri",
            "Industrial Alto Cascavel",
            "Vila Patricia",
            "Vila Mariana",
            "Aeroporto",
            "Nossa Senhora de Fátima",
            "Jardim Santa Mônica",
            "Nossa Senhora de Belém",
            "Jardim Renata",
            "Jardim Juliane",
            "Jardim das Américas",
            "Santa Terezinha",
            "Municipal Anexo a COAMIG",
            "Vila Planalto Verde",
            "Municipal Conradinho",
            "Núcleo São Cristóvão I",
            "Núcleo São Cristóvão II",
            "Núcleo Cristo Rei",
            "Núcleo Recanto Feliz",
            "Jardim Los Angeles",
            "Vila São Manoel",
            "Vila Karen",
            "Mauro Monteiro",
            "Jardim Cristine",
            "Jardim Nova Esperança",
            "Jardim Moriá",
            "Vila Palermo",
            "Jardim Cupertinópolis",
            "Anexo ao Jardim Cupertinópolis",
            "Edgar Arruda",
            "Vila Santa Rita",
            "Residencial Virmond",
            "Morada Do Sol",
            "Jardim Dona Iaiá",
            "Núcleo Habitacional João Paulo II",
            "Dona Emília",
            "Conjunto Residencial Bancários",
            "Vila José de Mattos Leão",
            "Renilda Rocco",
            "Jardim Irajá",
            "Municipal Abílio Jorge",
            "Imóvel Passo Salgado",
            "Leone Teixeira",
            "Santa Matilde",
            "João Pedro da Silva",
            "Vila Guaicici",
            "Jardim Atalaia",
            "Jardim Araucária I",
            "Jardim Araucária II",
            "Núcleo Habitacional Daniel Mansene",
            "Jardim Califórnia",
            "Vila David",
            "Jardim Rouxinol",
            "Adão Kaminski",
            "Residencial 2000",
            "Residencial Morar Melhor",
            "Cidade Nova",
            "Padre Chagas",
            "Vila Rebouças",
            "Bonsucesso",
            "Dona Laura",
            "Jardim Dona Mary",
            "Vila Maria",
            "Radial Norte",
            "Anexo ao Radial Norte",
            "Jardim Bom Pastor",
            "Magnópolis",
            "Santisi",
            "Brasílio Ribas",
            "Núcleo Habitacional Papa João XXIII",
            "Jardim Village",
            "Jardim Sinhá",
            "Jardim Ouro Verde",
            "Centro",
            "Karpinski",
            "Vila Santa Rita",
            "Vila Jardim",
            "Vila Carli",
            "Paz e Bem",
            "Jardim Santa Inês",
            "Núcleo Habitacional São Cristóvão",
            "Vila Paraná",
            "Dona Ângela",
            "Jardim Maria das Dores",
            "Jardim Capanema",
            "Vila Tupinambá",
            "Parque das Árvores",
            "Vila Bom Jardim",
            "Jardim Viena",
            "Vila São José",
            "Odilon Toledo",
            "Jardim Bandeirantes",
            "Vila Primavera",
            "Lino Queiroz",
            "Vila Fero",
            "Jardim Trianon",
            "Jardim Flórida",
            "Jardim Pérola do Oeste",
            "São Bom Jesus",
            "Jardim Vera Cruz",
            "Núcleo Boa Vista",
            "Sol Poente",
            "Jardim Europa",
            "Colégio Agrícola",
            "Xarquinho",
            "Invasão",
            "Morumbi",
            "Santa Rita"];
        $(function () {
            $("#InputBairro").autocomplete({
                source: listaDeBairros
            });
        });
    }

    escondeElementos();
    aplicaMascaras();
    autoCompletaBairros();

    d = new Date;
    dia = d.getDate();
    mes = d.getMonth() + 1;
    if (dia < 10) {
        dia = "0" + dia;
    }
    if (mes < 10) {
        mes = "0" + mes;
    }
    $('#datPrenchCandidato').val(dia + "/" + mes + "/" + d.getFullYear());
    $('#selectEscolari').change(function () {
        var valor = $('#selectEscolari').val();
        if (valor == "Ensino Superior Completo") {
            $('#divCurso').show(500);
            $('#divCursoPer').hide(500);
        } else if (valor == "Ensino Superior Incompleto") {
            $('#divCurso').show(500);
            $('#divCursoPer').show(500);
        } else {
            $('#divCurso').hide(500);
            $('#divCursoPer').hide(500);
        }
    });
    $('#selectCNH').change(function () {
        var valor = $('#selectCNH').val();
        if (valor == "S") {
            $('#divCNH').show(500);
        } else {
            $('#divCNH').hide(500);
        }
    });
    $('#selectCursoTec').change(function () {
        var valor = $('#selectCursoTec').val();
        if (valor == "S") {
            $('#divQualCurso').show(500);
        } else {
            $('#divQualCurso').hide(500);
        }
    });

    $('#selectPriEmp').change(function () {
        if ($(this).val() == "N") {
            $('#empresas').show(500);
            $('html, body').animate({scrollTop: 1300}, 'slow');
        } else {
            $('#empresas').hide(500);
        }
    });

    //calcula idade atraves da data de nascimento
    $('#InputDatNas').blur(function () {
        if ($(this).val() != "") {
            var data = $(this).val().split("-");
            var id = idade(data[0], data[1], data[2]);
            $('#inputIdade').val(id);
        }
    });

    //exibe um dialog que o cpf não é valido
    $("#cpf").blur(function () {
        cpf = $(this).val();
        if (!TestaCPF(cpf)) {
            $(this).val("");
            $("#dialog-cpf-invalido").dialog({
                modal: true,
                buttons: {
                    Ok: function () {
                        $(this).dialog("close");
                    }
                }
            });
        }
    });

    //ao clicar no botao para submeter verefica se os campos estão preenchido
    $("#btnSavCur").click(function () {
        var cont = 0;
        $("input").each(function () {
            if ($(this).val().trim() == "") {
                var id = $(this).attr("id");

                if (id == "nome") {
                    $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
                    cont++;
                } else if (id == "dat_ficha") {
                    $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
                    cont++;
                } else if (id == "anos") {
                    $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
                    cont++;
                } else if (id == "fone") {
                    $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
                    cont++;
                } else if (id == "rua") {
                    $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
                    cont++;
                } else if (id == "bairro") {
                    $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
                    cont++;
                } else if (id == "cidade") {
                    $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
                    cont++;
                } else if (id == "escolaridade") {
                    $(this).css({"border": "1px solid #F00", "padding": "6px 12px"});
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
});

function tipoCurricolo() {
    var tipCor = $("#selectTipCur").val();
    if (tipCor.localeCompare("Indicação")) {
        $('#indicador').hide();
    } else {
        $('#indicador').show(1000);


    }
}
function showDadosPessoais() {
    var tipCor = $("#selectTipCur").val();
    if (tipCor.localeCompare("Indicação")) {
        $('#divDadosPessoais').show(500).delay(1000);
        $('html, body').animate({scrollTop: 999999999}, 'slow');
        $('#btnDivDadosConhecimentos').hide(1000);
    } else if ($('#inputIndicador').val() != '') {
        $('#divDadosPessoais').show(500).delay(1000);
        $('html, body').animate({scrollTop: 999999999}, 'slow');
        $('#btnDivDadosConhecimentos').hide(1000);
    } else {
        $("#dialog-aviso_indicador").dialog({
            modal: true,
            buttons: {
                Ok: function () {
                    $(this).dialog("close");
                }
            }
        });
    }
}
function showDiv(idDiv) {
    $('#' + idDiv).show(500).delay(1000);
    $('#btn' + idDiv).hide(1000);
    $('html, body').animate({scrollTop: 999999999}, 'slow');
}
//OBS: REFATORAR TODO ESSE CODIGO
function showDivExpericencia(idDiv) {
    $('#' + idDiv).show(500).delay(1000);
    $('#btn' + idDiv).hide(1000);
    $('#btn_cadastrar_curricolo').show(500);
    $('html, body').animate({scrollTop: 1170}, 'slow');
}

function idade(ano_aniversario, mes_aniversario, dia_aniversario) {
    var d = new Date,
        ano_atual = d.getFullYear(),
        mes_atual = d.getMonth() + 1,
        dia_atual = d.getDate(),

        ano_aniversario = +ano_aniversario,
        mes_aniversario = +mes_aniversario,
        dia_aniversario = +dia_aniversario,

        quantos_anos = ano_atual - ano_aniversario;


    if (mes_atual < mes_aniversario || mes_atual == mes_aniversario && dia_atual < dia_aniversario) {
        quantos_anos--;
    }

    return quantos_anos < 0 ? 0 : quantos_anos;
}

function TestaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
    strCPF = strCPF.replace(/[^\d]+/g, '');
    if (strCPF == "00000000000")
        return false;
    for (i = 1; i <= 9; i++)
        Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;
    if ((Resto == 10) || (Resto == 11))
        Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)))
        return false;
    Soma = 0;
    for (i = 1; i <= 10; i++)
        Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
    if ((Resto == 10) || (Resto == 11))
        Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11)))
        return false;
    return true;
}
