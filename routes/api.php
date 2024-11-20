<?php

use Illuminate\Support\Facades\Route;

Route::group('usuario', function() {
    Route::put('cadastrar', 'UsuarioController@cadastrar');
    Route::post('login', 'UsuarioController@login');
});

Route::group('cliente', function() {
    Route::put('cadastrar', 'ClienteController@cadastrar');
    Route::get('buscar', 'ClienteController@buscar');
    Route::put('editar', 'ClienteController@editar');
    Route::delete('deletar', 'ClienteController@deletar');

    Route::post('buscarvendas', 'ClienteController@buscarVendas');
});

Route::group('produto', function() {
    Route::put('cadastrar', 'ProdutoController@cadastrar');
    Route::get('buscar', 'ProdutoController@buscar');
    Route::put('editar', 'ProdutoController@editar');
    Route::delete('deletar', 'ProdutoController@deletar');
});

Route::group('venda', function() {
    Route::put('cadastrar', 'VendaController@cadastrar');
});
