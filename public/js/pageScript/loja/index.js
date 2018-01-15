$(function ($) {
   $('#form-loja').validate();
    $('#dialog-trash').hide();
});

function showDialogTrash(id, csrf_token){
    $('#dialog-trash').dialog({
        resizable: false,
        height: "auto",
        width: 400,
        modal: true,
        buttons: {
            "Apagar": function() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    },
                    url: '/loja/apagar/' + id,
                    type: 'DELETE',
                    success: function (data) {
                        location.reload();
                    }
                });
            },
            Cancel: function() {
                $( this ).dialog( "close" );
            }
        }
    });
}