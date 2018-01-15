@extends('layout.main_layout')

@section('title')
    Lista todos os curriculos
@endsection

@section('scripts')

    <script type="text/javascript">

        $(function () {
            var selected = [];
            var selecionados = [];
            //configura a dataTable
            var table = $('#users-table').DataTable({
                processing: true,
                ajax: {
                    url: '{{ route('show_curriculo', ['tipo' => $tipo]) }}',
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
                    {data: 'nomInd', mame: 'indicacoes.nomInd'},
                    {data: 'bairro', name: 'curriculos.bairro'},
                    {data: 'datNasc', name: 'curriculos.datNasc', render: renderData},
                    {data: 'escolaridade', name: 'curriculos.escolaridade'},
                    {data: 'status', name: 'curriculos.status'},
                    {data: 'cargo', name: 'curriculos.cargo_id'},
                    {data: 'created_at', name: 'curriculos.created_at', render: renderData}
                ],
                bAutoWidth: true,
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
                    } else if (data.status == "Contratado") {
                        $(row).css("background-color", "#fff669");
                    }
                },
                initComplete: function () {
                    var drawCollumn = false; // variavel auxliar para não desenhar input na primeira coluna
                    this.api().columns().every(function () {
                        if (drawCollumn) {
                            var column = this;
                            var input = document.createElement("input");
                            $(input).addClass("form-control input-sm");
                            $(input).appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    column.search($(this).val()).draw();
                                });
                        }
                        drawCollumn = true;

                    });
                }
            });
            $("input.toggle-vis").checkboxradio();


            new $.fn.dataTable.Buttons(table, {
                buttons: [
                    'excel', 'pdf'
                ]
            });

            table.buttons().container()
                .appendTo($('.tableTools-container'));

            $('input.toggle-vis').on('click', function (e) {
                e.preventDefault();

                if (!$(this).is(":checked") ){
                    $("label > .ui-checkboxradio-icon").addClass("ui-checkboxradio-checked ui-state-active");
                }else{
                    $(this).prop("checked", false);
                }

                // Get the column API object
                var column = table.column($(this).attr('data-column'));

                // Toggle the visibility
                column.visible(!column.visible());
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
                if ($(this).hasClass('selected')) {
                    selecionados.splice(selecionados.indexOf(row.data().id), row.data().id);
                } else {
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
                jQuery.each(selecionados, function (i, val) {
                    window.open("{{route('curriculo_pdf')}}?id=" + val + "&documentos=true" +
                        "&conhecimento=true&indicacao=true" +
                        "&experiencia=true&consulta=true&entrevista=true");
                });
            });


            function renderData(data, type, row) {
                var dateSplit = data.split('-');
                return type === "display" || type === "filter" ?
                    dateSplit[1] + '/' + dateSplit[2] + '/' + dateSplit[0] :
                    data;
            }

        });
    </script>
@endsection


@section('cabecalho_pagina')
    <div class="row page-header">
        <div class="col-lg-7">
            <h1>Curriculos - {{ucfirst($tipo)}}</h1>
        </div>
        <div class="col-lg-5">
            <div class="col-lg-6">
                <a id="gerarPdf" class="btn btn-success bt_print_sel"><i class="fa fa-print"></i> Imprimir Selecionados
                </a>
            </div>

            <div class="col-lg-6 ">
                <a href="{{route('curriculo_experiencia',['tipo' => $tipo])}}" class="btn btn-primary"><i
                            class="fa fa-low-vision"></i>
                    Tabela Experiencia</a>
            </div>
        </div>
    </div>
@endsection


@section('menu_consulta_'.$tipo)
    background-color: #5C4C9E;
    color: white;
@endsection

@section('corpo_pagina')


    <div class="col-lg-12 col-sm-12 ">
        <div class="col-lg-03">
            <div class="pull-right tableTools-container">

            </div>
        </div>
        <div class="col-lg-09">
            Selecione as Colunas para esconde-las
            <fieldset>
                <label for="checkbox-nested-1">Nome
                    <input type="checkbox" class="toggle-vis" data-column="1"  id="checkbox-nested-1">
                </label>
                <label for="checkbox-nested-2">CPF
                    <input type="checkbox" class="toggle-vis" data-column="2" name="checkbox-nested-2" id="checkbox-nested-2">
                </label>
                <label for="checkbox-nested-3">Indicação
                    <input type="checkbox" class="toggle-vis" data-column="3" name="checkbox-nested-3" id="checkbox-nested-3">
                </label>
                <label for="checkbox-nested-4">Bairro
                    <input type="checkbox" class="toggle-vis" data-column="4" name="checkbox-nested-4" id="checkbox-nested-4">
                </label> <label for="checkbox-nested-5">Dta. Nascimento
                    <input type="checkbox" class="toggle-vis" data-column="5" name="checkbox-nested-5" id="checkbox-nested-5">
                </label> <label for="checkbox-nested-6">Escolaridade
                    <input type="checkbox" class="toggle-vis" data-column="6" name="checkbox-nested-6" id="checkbox-nested-6">
                </label>
                <label for="checkbox-nested-7">Status
                    <input type="checkbox" class="toggle-vis" data-column="7" name="checkbox-nested-7" id="checkbox-nested-7">
                </label>
                <label for="checkbox-nested-8">Status
                    <input type="checkbox" class="toggle-vis" data-column="8" name="checkbox-nested-8" id="checkbox-nested-8">
                </label>
                <label for="checkbox-nested-9">Cargo
                    <input type="checkbox" class="toggle-vis" data-column="9" name="checkbox-nested-9" id="checkbox-nested-9">
                </label>
            </fieldset>
        </div>


    </div>
    <div class="col-lg-12 col-sm-12">
        <div class="table-header">
            Results for "Latest Registered Domains"
        </div>
        <table class="table table-bordered" cellspacing="0" width="100%" id="users-table">
            <thead>
            <tr>
                <th id="link_column"></th>
                <th id="nome_column">Nome</th>
                <th id="cpf_column">CPF</th>
                <th id="cpf_column">Indicação</th>
                <th id="bairro_column">Bairro</th>
                <th id="dtaNas_column">Dta. Nascimento</th>
                <th id="escolaridade_column">Escolaridade</th>
                <th id="status_column">Status</th>
                <th id="vaga_column">Cargo</th>
                <th id="cadastro_column">Cadastro</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th></th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Indicação</th>
                <th>Bairro</th>
                <th>Dta. Nascimento</th>
                <th>Escolaridade</th>
                <th>Status</th>
                <th>Cargo</th>
                <th>Cadastro</th>
            </tr>
            </tfoot>
        </table>
    </div>


@endsection
