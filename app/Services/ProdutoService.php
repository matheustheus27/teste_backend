<?php

namespace App\Services;

use App\Models\Produto;
use Exception;

class ProdutoService
{
    public function cadastrar($dados)
    {
        try {
            if (Produto::where('cod', $dados['cod'])->exists()) {
                return response()->json([
                    'status' => false,
                    'mensagem' => 'Produto com código já cadastrado!'
                ], 422);
            }

            Produto::create([
                'cod' => $dados['cod'],
                'nome' => $dados['nome'],
                'descricao' => $dados['descricao'],
                'preco' => $dados['preco']
            ]);

            return response()->json([
                'status' => true,
                'mensagem' => 'Produto cadastrado com sucesso!'
            ], 201);
        } catch(Exception $e) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Falha ao cadastrar produto!'
            ], 422);
        }
    }

    public function buscar()
    {
        try {
            $produtos = Produto::all();

            return response()->json([
                'status' => true,
                'mensagem' => 'Produtos encontrados com sucesso!',
                'dados' => $produtos
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Falha ao encontrar produtos!'
            ], 422);
        }
    }

    public function editar($dados)
    {
        try {
            $produto = Produto::where('cod', $dados['cod'])->first();

            if (!$produto) {
                return response()->json([
                    'status' => false,
                    'mensagem' => 'Produto não encontrado!'
                ], 404);
            }

            if(isset($dados['nome']) && $produto->nome != $dados['nome']) $produto->nome = $dados['nome'];
            if(isset($dados['descricao']) && $produto->descricao != $dados['descricao']) $produto->descricao = $dados['descricao'];

            if(isset($dados['preco']) && $produto->preco != $dados['preco']) {
                if ($dados['preco'] < 0) {
                    return response()->json([
                        'status' => false,
                        'mensagem' => 'Preço deve ser um valor positivo!'
                    ], 422);
                }

                $produto->preco = $dados['preco'];
            }

            $produto->save();

            return response()->json([
                'status' => true,
                'mensagem' => 'Produto editado com sucesso!',
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Falha ao editar produto!'
            ], 422);
        }
    }

    public function deletar($dados)
    {

        try {
            Produto::whereIn('cod', $dados['cod'])->delete();

            return response()->json([
                'status' => true,
                'mensagem' => 'Produtos deletados com sucesso!',
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Falha ao deletar produtos!'
            ], 422);
        }
    }
}
