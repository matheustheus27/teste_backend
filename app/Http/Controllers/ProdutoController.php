<?php

namespace App\Http\Controllers;

use App\Services\ProdutoService;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    public function cadastrar(Request $request)
    {
        $validacao = Validator::make($request->all(), [
            'cod' => 'required|string|unique:produtos,cod',
            'nome' => 'required|string',
            'descricao' => 'required|string',
            'preco' => 'required|numeric',
        ],[
            'cod.required' => 'O campo cod é obrigatório.',
            'cod.string' => 'O campo cod deve ser do tipo texto.',
            'cod.unique' => 'Produto já cadastrado no sistema.',
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser do tipo texto.',
            'descricao.required' => 'O campo descricao é obrigatório.',
            'descricao.string' => 'O campo descricao deve ser do tipo texto.',
            'preco.required' => 'O campo preco é obrigatório.',
            'preco.numeric' => 'O campo preco deve ser do tipo numerico.',
        ]);

        if ($validacao->fails()) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Erro de validação.',
                'errors' => $validacao->errors(),
            ], 422);
        }

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
        $validacao = Validator::make($request->all(), [
            'cod' => 'required|string',
        ],[
            'cod.required' => 'O campo cod é obrigatório.',
            'cod.string' => 'O campo cod deve ser do tipo texto.',
        ]);

        if ($validacao->fails()) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Erro de validação.',
                'errors' => $validacao->errors(),
            ], 422);
        }

        $produtoService = new  ProdutoService();

        return $produtoService->editar($request->all());
    }

    public function deletar(Request $request)
    {
        $validacao = Validator::make($request->all(), [
            'cod' => 'required|array',
            'cod.*' => 'string',
        ],[
            'cod.required' => 'O campo cod é obrigatório.',
            'cod.array' => 'O campo cod deve ser uma lista.',
            'cod.*.string' => 'O campo cod deve ser do tipo texto.',
        ]);

        if ($validacao->fails()) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Erro de validação.',
                'errors' => $validacao->errors(),
            ], 422);
        }

        $produtoService = new  ProdutoService();

        return $produtoService->deletar($request->all());
    }
}
