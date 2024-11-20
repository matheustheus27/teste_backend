<?php

namespace App\Http\Controllers;

use App\Services\ProdutoService;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function cadastrar(Request $request)
    {
        $request->validate([
            'cod' => 'required|int|unique:produtos,cod',
            'nome' => 'required|string',
            'descricao' => 'required|string',
            'preco' => 'required|numeric',
        ]);

        $produtoService = new  ProdutoService();

        return $produtoService->cadastrar($request->all());
    }

    public function buscar()
    {
        $produtoService = new  ProdutoService();

        return $produtoService->buscar();
    }

    public function editar(Request $request)
    {
        $request->validate([
            'cod' => 'required|int'
        ]);

        $produtoService = new  ProdutoService();

        return $produtoService->editar($request->all());
    }

    public function deletar(Request $request)
    {
        $request->validate([
            'cod' => 'required|array',
            'cod.*' => 'int',
        ]);

        $produtoService = new  ProdutoService();

        return $produtoService->deletar($request->all());
    }
}
