/**
 * Created by Juliano Sirtori on 21/03/2017.
 */
$(function () {

    $('.menu_cadastro_avaliacao').addClass('active');

    var rh = $("#InputAvalStatus1").val();
    var ger = $("#InputAvalStatus2").val();
    var enc = $("#InputAvalStatus3").val();
    var res = $("#InputAvalStatus4").val();

    if(rh == 'Enviado'){
        $("#InputAvalStatus1").css('color', 'green');
        $("#InputAvalStatus1").css('border-color', 'green');
    }else{
        $("#InputAvalStatus1").css('color', 'red');
        $("#InputAvalStatus1").css('border-color', 'red');
    }
    if(ger == 'Enviado'){
        $("#InputAvalStatus2").css('color', 'green');
        $("#InputAvalStatus2").css('border-color', 'green');
    }else{
        $("#InputAvalStatus2").css('color', 'red');
        $("#InputAvalStatus2").css('border-color', 'red');
    }

    if(enc == 'Enviado'){
        $("#InputAvalStatus3").css('color', 'green');
        $("#InputAvalStatus3").css('border-color', 'green');
    }else{
        $("#InputAvalStatus3").css('color', 'red');
        $("#InputAvalStatus3").css('border-color', 'red');
    }

    if(res == 'Enviado'){
        $("#InputAvalStatus4").css('color', 'green');
        $("#InputAvalStatus4").css('border-color', 'green');
    }else{
        $("#InputAvalStatus4").css('color', 'red');
        $("#InputAvalStatus4").css('border-color', 'red');
    }
});

function mandarEmail(id) {
    var email = $('#'+id).val();
    if(email != ''){
        $('#inputEmailaddress').val(email);
        $('#myModal').modal('show');
    }else{
        alert('Preencha o campo Email');
    }
}

function mudaCorResultado() {
    $('#resultadoFinal').alert
}