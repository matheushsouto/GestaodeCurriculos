function dialogNovaConsulta(url,url_consulta, csrf) {
    $('#btnCadConsulta').click(function () {
        $("#dialog-nova-consulta").dialog({
            resizable: false,
            height: "auto",
            width: 800,
            modal: true,
            create: function () {
                var table = $('#table-consulta').DataTable({
                    processing: true,
                    // serverSide: true, -> Filtragem, paginação no lado do servidor (<50.000)
                    ajax: {
                        url: url,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrf
                        }

                    },
                    language: {
                        "loadingRecords": "Carregando...",
                        "lengthMenu": "Mostrar _MENU_ entradas",
                        "decimal": "",
                        "emptyTable": "Sem dados disponíveis na tabela",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                        "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
                        "infoFiltered": "(Filtrada de _MAX_ entrada totais)",
                        "processing": "Processando...",
                        "search": "Pesquisa:",
                        "zeroRecords": "Nenhum registro correspondente encontrado",
                        "paginate": {
                            "first": "Primeiro",
                            "last": "Último",
                            "next": "Próximo",
                            "previous": "Anterior"
                        }
                    },
                    columns: [
                        {
                            "className": 'btnShowCurriculo ',
                            "orderable": false,
                            "data": null,
                            "defaultContent": ' '
                        },
                        {data: 'nome', name: 'curriculos.nome'},
                        {data: 'cargo', name: 'curriculos.cargo'},
                        {data: 'tipInd', name: 'indicacoes.tipInd'},
                        {data: 'escolaridade', name: 'curriculos.escolaridade'},
                    ],
                    createdRow: function (row, data, dataIndex) {

                        if (data.tipInd == "Indicação") {
                            $(row).addClass('danger');
                        }
                    },
                });

                // Add event listener for opening and closing details
                $('#table-consulta tbody').on('click', 'td.btnShowCurriculo', function () {
                    var tr = $(this).closest('tr');
                    var row = table.row(tr);
                    window.location.href = url_consulta + "?id=" + row.data().id;
                });
            },
            buttons: {
                Cancelar: function () {
                    $(this).dialog("close");

                }
            }
        });
    });
}
