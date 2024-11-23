<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VendaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('usuario')->group(function() {
    Route::put('cadastrar', [UsuarioController::class, 'cadastrar']);
    Route::post('login', [UsuarioController::class, 'login'])->name('login');
});

Route::middleware('auth:api')->prefix('cliente')->group(function() {
    Route::put('cadastrar', [ClienteController::class, 'cadastrar']);
    Route::get('buscar', [ClienteController::class, 'buscar']);
    Route::put('editar', [ClienteController::class, 'editar']);
    Route::delete('deletar', [ClienteController::class, 'deletar']);

    Route::post('buscarvendas', [ClienteController::class, 'buscarVendas']);
});

Route::middleware('auth:api')->prefix('produto')->group(function() {
    Route::put('cadastrar', [ProdutoController::class, 'cadastrar']);
    Route::get('buscar', [ProdutoController::class, 'buscar']);
    Route::put('editar', [ProdutoController::class, 'editar']);
    Route::delete('deletar', [ProdutoController::class, 'deletar']);
});

Route::middleware('auth:api')->prefix('venda')->group(function() {
    Route::put('cadastrar', [VendaController::class, 'cadastrar']);
});

Route::middleware('auth:api')->prefix('endereco')->group(function() {
    Route::put('cadastrar', [EnderecoController::class, 'cadastrar']);
});
