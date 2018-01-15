$(function () {
    $('.menu_cadastro_consulta').addClass('active');

    $('#btnConSubmit').click(function () {
        $('#form_consulta').submit();


    });
});

function addRowConsulta(cont) {
    $('#contador').val(cont);
    if (cont == 0) {
        cont = 1;
    }
    $('#btnCadCon').click(function () {
        $('#contador').val(cont);
        $('#consultas').append(
            '<div class="col-lg-3">\
                <div class="form-group">\
                    <label for="fontConsu[' + cont + ']">Fonte</label>\
                            <input type="text" name="fontConsu[' + cont + ']" id="fonte" class="form-control" value="">\
                        </div>\
                    </div>\
                    <div class="col-lg-9">\
                        <div class="form-group">\
                                <label for="recConsu[' + cont + ']" >Resultado</label>\
                                <input type="text" name="resConsu[' + cont + ']"  class="form-control" value="">\
                            </div>\
                        </div>\
                    </div>'
        );
        cont = cont + 1;
        $('html, body').animate({scrollTop: 999999}, 'slow');
    });
}