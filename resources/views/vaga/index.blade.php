@extends('layout.main_layout')

@section('cabecalho_pagina')
    <div class="col-lg-12">
        @if($vaga->descricao != "")
            <h1 class="page-header">Editar Vaga</h1>
        @else
            <h1 class="page-header">Cadastrar Vaga</h1>
        @endif

    </div>
@endsection

@section('corpo_pagina')

    <div class="col-lg-12">
        <div class="panel panel-default" id="div_tipo_curricolo">
            <div class="panel-heading">
                Cadastro
            </div>
            <div class="panel-body">
                <div class="col-lg-9">
                    <form method="post" id="form-vaga">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Descricao</label>
                            <input required type="text" class="form-control" value="{{$vaga->descricao}}"
                                   name="vaga[descricao]" id="descricao"
                                   placeholder="Descrição">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Quantidade</label>
                            <input required type="number" class="form-control" value="{{$vaga->quantidade}}"
                                   name="vaga[quantidade]" id="função"
                                   placeholder="Quantidade">
                        </div>
                        <div class="form-group">
                            <label for="loja_id">Selecione uma loja</label>
                            <select required id="loja_id" class="form-control" name="vaga[loja_id]">
                                @foreach ($lojas as $loja)
                                    <option value="{{$loja->id}}">{{$loja->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cargo_id">Selecione um cargo</label>
                            <select required id="cargo_id" class="form-control" name="vaga[cargo_id]">
                                @foreach ($cargos as $cargo)
                                    <option value="{{$cargo->id}}">{{$cargo->descricao}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select required id="status" class="form-control" name="vaga[status]">
                                <option value="aberto">Aberto</option>
                                <option value="fechado">Fechado</option>
                            </select>
                        </div>
                        <div class="text-right">
                            @if($vaga->descricao != "")
                                <button type="submit" class="btn btn-default btn-success text-right">Editar</button>
                            @else
                                <button type="submit" class="btn btn-default btn-success text-right">Cadastrar</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="dialog-trash" title="Tem certeza que deseja apagar essa Vaga">
        <p>OBS: Todos os dados referentes a essa vaga sera apago, tem certeza?</p>
    </div>

    <div class="col-lg-12">
        <div class="panel panel-default" id="div_tipo_curricolo">
            <div class="panel-heading">
                Vagas Cadastradas
            </div>
            <div class="panel-body">
                <div class="col-lg-9">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Quantidade</th>
                            <th>Loja</th>
                            <th>Cargo</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($vagas as $vagaTable)
                            <tr>
                                <td>{{$vagaTable->descricao}}</td>
                                <td>{{$vagaTable->quantidade}}</td>
                                <td>{{$vagaTable->loja->nome}}</td>
                                <td>{{$vagaTable->cargo->descricao}}</td>
                                <td style="text-align: center; font-weight: bolder">
                                    @if($vagaTable->status == "aberto")
                                        <span style="color: green" class="fa fa-circle-o"></span>
                                    @else
                                        <span style="color: red" class="fa fa-circle-o"></span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="/vaga/editar/{{$vagaTable->id}}"><span
                                                class="fa fa-edit"></span></a>&nbsp
                                    <button class="btn btn-danger"
                                            onclick="showDialogTrash(0{{$vagaTable->id}}, '{{ csrf_token() }}')">
                                        <span class="fa fa-trash"></span></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")

    <script>
        $(function ($) {
            $('#loja_id').val({{$vaga->loja_id}});
            $('#cargo_id').val({{$vaga->cargo_id}});
            $('#status').val({{$vaga->status}});

        });
    </script>

    <script src="{{asset('/vendor/jquery-validation/dist/jquery.validate.js')}}"></script>
    <script src="{{asset('/vendor/jquery-validation/dist/localization/messages_pt_BR.js')}}"></script>
    <script src="{{asset('/js/pageScript/curriculo/curriculo-cadastro.js')}}"></script>
    <script src="{{asset('/js/pageScript/vaga/index.js')}}"></script>
@endsection