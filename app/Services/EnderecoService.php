<?php

namespace App\Services;

use App\Models\Endereco;
use Exception;

class EnderecoService
{
    public function cadastrar($dados)
    {
        try {
            Endereco::create([
                'rua' => $dados['rua'],
                'num' => $dados['num'],
                'bairro' => $dados['bairro'],
                'cidade' => $dados['cidade'],
                'estado' => $dados['estado'],
                'pais' => $dados['pais'],
                'cep' => $dados['cep']
            ]);

            return response()->json([
                'status' => true,
                'mensagem' => 'Endereço cadastrada com sucesso!'
            ], 201);
        } catch(Exception $e) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Falha ao cadastrar endereço!'
            ], 422);
        }
    }
}
