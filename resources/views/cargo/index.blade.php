@extends('layout.main_layout')

@section('cabecalho_pagina')
    <div class="col-lg-12">
        <h1 class="page-header">Cadastrar Cargo</h1>
    </div>
@endsection

@section('corpo_pagina')

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Cadastro
            </div>
            <div class="panel-body">
                <div class="col-lg-9">
                    <form method="post" id="form-cargo">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Descricao</label>
                            <input type="text" class="form-control" name="cargo[descricao]" id="descricao"
                                   placeholder="Descrição"   value="{{$cargoUp->descricao}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Função</label>
                            <input type="text" class="form-control" name="cargo[funcao]" id="funcao"
                                   placeholder="Função" value="{{$cargoUp->funcao}}">
                        </div>
                        <div class="text-right">
                            @if($cargoUp->nome != "")
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
    <div id="dialog-trash" title="Tem certeza que deseja apagar a Loja">
        <p>OBS: Todos os dados relacionados a esse cargo sera apagado também</p>
    </div>

    <div class="col-lg-12">
        <div class="panel panel-default" id="div_tipo_curricolo">
            <div class="panel-heading">
                Lojas Cadastradas
            </div>
            <div class="panel-body">
                <div class="col-lg-9">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Função</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cargos as $cargo)
                            <tr>
                                <td>{{$cargo->descricao}}</td>
                                <td>{{$cargo->funcao}}</td>
                                <td>
                                    <a class="btn btn-primary" href="/cargo/editar/{{$cargo->id}}"><span
                                                class="fa fa-edit"></span></a>&nbsp
                                    <button class="btn btn-danger" onclick="showDialogTrash(0{{$cargo->id}}, '{{ csrf_token() }}')">
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
    <script src="{{asset('/vendor/jquery-validation/dist/jquery.validate.js')}}"></script>
    <script src="{{asset('/vendor/jquery-validation/dist/localization/messages_pt_BR.js')}}"></script>
    <script src="{{asset('/js/pageScript/curriculo/curriculo-cadastro.js')}}"></script>
    <script src="{{asset('/js/pageScript/cargo/index.js')}}"></script>
@endsection