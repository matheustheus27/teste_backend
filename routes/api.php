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

    Route::get('buscarvendas', 'ClienteController@buscarVendas');
});
