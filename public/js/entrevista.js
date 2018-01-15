/**
 * Created by Juliano Sirtori on 21/03/2017.
 */
$(function () {

    $('.menu_cadastro_entrevista').addClass('active');

    $('#InputEntData').datepicker({
        altFormat:"dd-mm-yyyy"
    });

    var sexo = $('#selectEntSex').val();

    if(sexo.localeCompare("Feminino") == 0){
        $("#quartel").hide();
    }
});