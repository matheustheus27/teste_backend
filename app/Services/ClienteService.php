<?php

namespace App\Services;

use App\Models\Cliente;
use Exception;

class ClienteService
{
    public function cadastrar($dados)
    {
        try {
            if (Cliente::where('cpf', $dados['cpf'])->exists()) {
                return response()->json([
                    'status' => false,
                    'mensagem' => 'Cliente com CPF já cadastrado!'
                ], 422);
            }

            Cliente::create([
                'cpf' => $dados['cpf'],
                'nome' => $dados['nome'],
            ]);

            return response()->json([
                'status' => true,
                'mensagem' => 'Cliente cadastrado com sucesso!'
            ], 201);
        } catch(Exception $e) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Falha ao cadastrar cliente!'
            ], 422);
        }
    }

    public function buscar()
    {
        try {
            $clientes = Cliente::all();

            return response()->json([
                'status' => true,
                'mensagem' => 'Clientes encontrados com sucesso!',
                'dados' => $clientes
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Falha ao encontrar clientes!'
            ], 422);
        }
    }

    public function editar($dados)
    {
        try {
            $cliente = Cliente::where('cpf', $dados['cpf'])->first();

            if (!$cliente) {
                return response()->json([
                    'status' => false,
                    'mensagem' => 'Cliente não encontrado!'
                ], 404);
            }

            if($cliente->nome != $dados['nome']) $cliente->nome = $dados['nome'];

            $cliente->save();

            return response()->json([
                'status' => true,
                'mensagem' => 'Cliente editado com sucesso!',
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Falha ao editar cliente!'
            ], 422);
        }
    }

    public function deletar($dados)
    {

        try {
            Cliente::whereIn('cpf', $dados['cpf'])->delete();

            return response()->json([
                'status' => true,
                'mensagem' => 'Clientes deletados com sucesso!',
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Falha ao deletar clientes!'
            ], 422);
        }
    }
}
