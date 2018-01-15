@extends('layout.main_layout')

@section('title')
    Lista Todas as Experiencias
@endsection

@section('scripts')

    <script type="text/javascript">
        $(function () {
            var selected = [];
            var selecionados = [];
            //configura a dataTable
            var table = $('#users-table').DataTable({
                processing: true,
                // serverSide: true, -> Filtragem, paginação no lado do servidor (<50.000)
                ajax: {
                    url: '{{ route('show_experiencia', ['tipo' => $tipo]) }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                deferRender: true,
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
                    {data: 'cpf', name: 'curriculos.cpf'},
                    {data: 'cargo', mame: 'curriculos.cargo'},
                    {data: 'empresa', mame: 'curriculos.empresa'},
                    {data: 'funcao', mame: 'curriculos.funcao'},
                    {data: 'entSai', mame: 'curriculos.entSai'},
                    {data: 'motSai', mame: 'curriculos.motSai'}


                ],
                rowCallback: function (row, data) {
                    if ($.inArray(data.DT_RowId, selected) !== -1) {
                        $(row).addClass('selected');

                    }
                },
                createdRow: function (row, data, dataIndex) {

                    if (data.status == "Aprovado") {
                        $(row).addClass('success');
                    } else if (data.status == "Reprovado") {
                        $(row).addClass('danger');
                    } else if (data.tipInd == "Indicação") {
                        $(row).addClass('info');
                    }
                },
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        var input = document.createElement("input");
                        $(input).addClass("form-control input-sm")
                        $(input).appendTo($(column.footer()).empty())
                            .on('change', function () {
                                column.search($(this).val()).draw();
                            });
                    });
                }
            });

            // refatorar tudo isso

            $('#users-table tbody').on('click', 'tr', function () {
                var id = this.id;
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var index = $.inArray(id, selected);

                //adicioanar um novo
                if (index === -1) {
                    selected.push(id);
                    selecionados.push(parseInt(row.data().id));
                    //remove os repetidos
                    selecionados = selecionados.filter(function (este, i) {
                        return selecionados.indexOf(este) == i;
                    });

                } else {
                    selected.splice(index, 1);
                    selecionados.push(parseInt(row.data().id));
                    //remove os repetidos
                    selecionados = selecionados.filter(function (este, i) {
                        return selecionados.indexOf(este) == i;
                    });
                }
                //verifica se existe o select para depois remover o valor ou não
                if($(this).hasClass('selected')) {
                    selecionados.splice(selecionados.indexOf(row.data().id),row.data().id);
                }else{
                    console.log(false);
                }
                console.log(selecionados);
                $(this).toggleClass('selected');
                $(this).removeClass('info');
                $(this).removeClass('danger');
                $(this).removeClass('success');
            });

            // Add event listener for opening and closing details
            $('#users-table tbody').on('click', 'td.btnShowCurriculo', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                window.location.href = "{{route('curriculo_show', ['id'=>''])}}/" + row.data().id;
            });
            $('#gerarPdf').on('click', function () {
                jQuery.each( selecionados, function( i, val ) {
                    window.open("{{route('curriculo_pdf')}}?id="+val+"&documentos=true" +
                        "&conhecimento=true&indicacao=true" +
                        "&experiencia=true&consulta=true&entrevista=true");
                });
            });
        });
    </script>
@endsection


@section('cabecalho_pagina')
    <div class="col-lg-12 text-center">
        <h1>Curriculos</h1>
        <h3 class="page-header">{{ucfirst($tipo)}}</h3>
    </div>
    <div class="col-lg-12 text-left">
        <button id="gerarPdf" class="btn btn-success bt_print_sel"><i class="fa fa-print"></i> Imprimir Selecionados </button>
    </div>

@endsection


@section('menu_consulta_'.$tipo)
    background-color: #5C4C9E;
    color: white;
@endsection

@section('corpo_pagina')
    <table class="table table-bordered" cellspacing="0" width="100%" id="users-table">
        <thead>
        <tr>
            <th id="link_column"></th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Cargo</th>
            <th>Empresa</th>
            <th>Funcao</th>
            <th>Entrada/Saida</th>
            <th>Saida</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th></th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Cargo</th>
            <th>Empresa</th>
            <th>Funcao</th>
            <th>Entrada/Saida</th>
            <th>Mot. Saida</th>
        </tr>
        </tfoot>
    </table>

@endsection
