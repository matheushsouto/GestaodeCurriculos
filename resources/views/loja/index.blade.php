@extends('layout.main_layout')

@section('cabecalho_pagina')
    <div class="col-lg-12">
        <h1 class="page-header">Cadastrar Loja</h1>
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
                    <form method="post" id="form-loja">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" required name="loja[nome]" value="{{$lojaUp->nome}}"
                                   id="nome" placeholder="Nome">
                        </div>
                        <div class="form-group">
                            <label for="bandeira">Bandeira</label>
                            <input type="text" class="form-control" required name="loja[bandeira]" value="{{$lojaUp->bandeira}}"
                                   id="bandeira"
                                   placeholder="Bandeira">
                        </div>
                        <div class="form-group">
                            <label for="endereco">Endereço</label>
                            <input type="text" class="form-control" required name="loja[endereco]" value="{{$lojaUp->endereco}}"
                                   id="endereco"
                                   placeholder="Endereço">
                        </div>
                        <div class="form-group">
                            <label for="cidade">Cidade</label>
                            <input type="text" class="form-control" required id="cidade" name="loja[cidade]"
                                   value="{{$lojaUp->cidade}}"
                                   placeholder="Cidade">
                        </div>
                        <div class="text-right">
                            @if($lojaUp->nome != "")
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
        <p>OBS: Todos os dados relacionados a essa loja sera apagado também</p>
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
                            <th>Nome</th>
                            <th>Bandeira</th>
                            <th>Endereço</th>
                            <th>Cidade</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($lojas as $loja)
                            <tr>
                                <td>{{$loja->nome}}</td>
                                <td>{{$loja->bandeira}}</td>
                                <td>{{$loja->endereco}}</td>
                                <td>{{$loja->cidade}}</td>
                                <td>
                                    <a class="btn btn-primary" href="/loja/editar/{{$loja->id}}"><span
                                                class="fa fa-edit"></span></a>&nbsp
                                    <button class="btn btn-danger" onclick="showDialogTrash(0{{$loja->id}}, '{{ csrf_token() }}')">
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
    <script src="{{asset('/js/pageScript/loja/index.js')}}"></script>
@endsection