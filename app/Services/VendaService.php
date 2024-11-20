<?php

namespace App\Services;

use App\Models\Venda;
use Exception;

class VendaService
{
    public function cadastrar($dados)
    {
        try {
            Venda::create([
                'cliente' => $dados['cliente'],
                'produto' => $dados['produto'],
                'quantidade' => $dados['quantidade'],
                'valor_unitario' => $dados['valor_unitario'],
                'valor_total' => $dados['valor_total'],
                'dt_compra' => $dados['dt_compra']
            ]);

            return response()->json([
                'status' => true,
                'mensagem' => 'Venda cadastrada com sucesso!'
            ], 201);
        } catch(Exception $e) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Falha ao cadastrar venda!'
            ], 422);
        }
    }

    public function buscar($dados)
    {
        try {
            $vendas = Venda::where('cliente', $dados['cpf']);

            if(isset($dados['filtros']['dt_compra'])) {
                if(isset($dados['filtros']['dt_compra']['ini'])) $vendas->where('dt_compra', '>=', $dados['filtros']['dt_compra']['ini']);
                if(isset($dados['filtros']['dt_compra']['fim'])) $vendas->where('dt_compra', '<=', $dados['filtros']['dt_compra']['fim']);
            }

            $vendas = $vendas->orderBy('dt_compra', 'desc')->get();

            return response()->json([
                'status' => true,
                'mensagem' => 'Vendas encontrados com sucesso!',
                'dados' => $vendas
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Falha ao encontrar vendas!'
            ], 422);
        }
    }
}
