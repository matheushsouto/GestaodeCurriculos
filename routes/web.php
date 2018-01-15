<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'home'], function () {

    Route::post('/addNotation', 'HomeController@addNotation')->name('addNotation');
    Route::get('/listNotation', 'HomeController@listNotation')->name('listNotation');
    Route::post('/delNotation', 'HomeController@delNotation')->name('delNotation');
    Route::get('/openNotation', 'HomeController@openNotation')->name('openNotation');
});

Route::group(['prefix' => 'curriculo'], function () {

    Route::get('/cadastro', 'CurriculoController@index')->name('curriculo_index');
    Route::post('/cadastro', 'CurriculoController@form')->name('curriculo_cadastro');
    Route::post('/update','CurriculoController@update')->name('curriculo_update');

    //modo candidato
    Route::post('/cadastro/modocandidato', 'ModoCandidatoController@form')->name('curriculo_cadastro_modocandidato');
    Route::get('/cadastro/modocandidato','ModoCandidatoController@modoCandidato')->name('modo_candidato');
    Route::post('/update/modocandidato','ModoCandidatoController@update')->name('curriculo_update_modocandidato');
    Route::get('/findCpf','ModoCandidatoController@gelAllByCpf')->name('pesquisa_cuuriculo_cpf');
    Route::get('/findId','ModoCandidatoController@gelAllById')->name('pesquisa_cuuriculo_id');
    Route::get('/verificaRG','ModoCandidatoController@verificaRG')->name('verificaRG');

    //Atualiza o Status
    Route::post('/update/status','CurriculoController@addStatus')->name('addStatus');

    //Mostra o curriculo completo seleiconado
    Route::get('/show/{id}', 'CurriculoController@show')->name('curriculo_show');
    Route::get('/{id}/delete', 'CurriculoController@delete')->name('curriculo_delete');
    Route::get('/pdf', 'CurriculoController@pdf')->name('curriculo_pdf');

    //rotas para preencher tabela, com ajax
    Route::match(['get', 'post'],'/showCurriculos/{tipo}', 'CurriculoController@showCurriculos')->name('show_curriculo');
    Route::match(['get', 'post'],'/showCurriculos/experiencia/{tipo}', 'CurriculoController@showCurriculosExperiencia')->name('show_experiencia');

    //Rotas para consulta
    Route::get('/consultar/{tipo}', 'CurriculoController@listAll')->name('curriculo_listall');
    Route::get('/consultar/experiencia/{tipo}', 'CurriculoController@listAllExperiencia')->name('curriculo_experiencia');
});

Route::group(['prefix' => 'consulta'], function () {
    Route::match(['get', 'post'],'/cadastrar', 'ConsultaController@cadastro')->name('consultas_cadastro');
});

Route::group(['prefix' => 'entrevista'], function () {

    Route::match(['get', 'post'],'/cadastrar', 'EntrevistaController@cadastro')->name('entrevistas_cadastro');
    Route::match(['get', 'post'],'/editar', 'EntrevistaController@editar')->name('entrevistas_editar');
    Route::get('/show', 'EntrevistaController@show')->name('entrevistas_show');
    Route::post('/delete', 'EntrevistaController@apagar')->name('entrevistas_delete');
    Route::get('/', 'EntrevistaController@index')->name('entrevistas');
});

Route::group(['prefix' => 'avaliacao'], function () {

    Route::match(['get', 'post'],'/cadastrar', 'AvaliacaoController@cadastro')->name('avaliacao_cadastro');
    Route::match(['get', 'post'],'/editar', 'AvaliacaoController@editar')->name('avaliacao_editar');
    Route::get('/show', 'AvaliacaoController@show')->name('avaliacao_show');
    Route::post('/delete', 'AvaliacaoController@apagar')->name('avaliacao_delete');
    Route::post('/email', 'AvaliacaoController@email')->name('email');
    Route::get('/', 'AvaliacaoController@index')->name('avaliacao');
});


Route::group(['prefix' => 'loja'], function () {
    Route::get('/', 'LojaController@index')->name('loja');
    Route::post('/', 'LojaController@cadastro')->name('loja_cadastrar');
    Route::get('/editar/{id}', 'LojaController@index')->name('loja_editar_get');
    Route::post('/editar/{id}', 'LojaController@index')->name('loja_editar_post');
    Route::delete('/apagar/{id}', 'LojaController@apagar')->name('loja_delete');
});


Route::group(['prefix' => 'cargo'], function () {
    Route::get('/', 'CargoController@index')->name('cargo');
    Route::post('/', 'CargoController@cadastro')->name('cargo_cadastrar');
    Route::get('/editar/{id}', 'CargoController@index')->name('cargo_editar_get');
    Route::post('/editar/{id}', 'CargoController@index')->name('cargo_editar_post');
    Route::delete('/apagar/{id}', 'CargoController@apagar')->name('cargo_delete');
});


Route::group(['prefix' => 'vaga'], function () {
    Route::get('/', 'VagaController@index')->name('vaga');
    Route::post('/', 'VagaController@cadastro')->name('vaga_cadastrar');
    Route::get('/editar/{id}', 'VagaController@index')->name('vaga_editar_get');
    Route::post('/editar/{id}', 'VagaController@index')->name('vaga_editar_post');
    Route::delete('/apagar/{id}', 'VagaController@apagar')->name('vaga_delete');
});



