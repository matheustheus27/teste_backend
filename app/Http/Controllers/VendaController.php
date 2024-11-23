<?php

namespace App\Http\Controllers;

use App\Services\VendaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendaController extends Controller
{
    public function cadastrar(Request $request)
    {
        $validacao = Validator::make($request->all(), [
            'cliente' => 'required|string',
            'produto' => 'required|string',
            'quantidade'  => 'required|numeric|min:1',
            'valor_unitario' => 'required|numeric|min:0.01',
            'valor_total' => 'required|numeric|min:0.01',
            'dt_compra' => 'required|date'
        ],[
            'cliente.required' => 'O campo cliente é obrigatório.',
            'cliente.string' => 'O campo cliente deve ser do tipo texto.',
            'produto.required' => 'O campo produto é obrigatório.',
            'produto.string' => 'O campo produto deve ser do tipo texto.',
            'quantidade.required' => 'O campo quantidade é obrigatório.',
            'quantidade.numeric' => 'O campo quantidade deve ser do tipo numerico.',
            'quantidade.min' => 'O  valor minimo do campo quantidade é 1.',
            'valor_unitario.required' => 'O campo valor_unitario é obrigatório.',
            'valor_unitario.numeric' => 'O campo valor_unitario deve ser do tipo numerico.',
            'valor_unitario.min' => 'O  valor minimo do campo valor_unitario é 0.01.',
            'valor_total.required' => 'O campo valor_total é obrigatório.',
            'valor_total.numeric' => 'O campo valor_total deve ser do tipo numerico.',
            'valor_total.min' => 'O  valor minimo do campo valor_total é 0.01.',
            'dt_compra.required' => 'O campo dt_compra é obrigatório.',
            'dt_compra.date' => 'O campo dt_compra deve ser do tipo data.',
        ]);

        if ($validacao->fails()) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Erro de validação.',
                'errors' => $validacao->errors(),
            ], 422);
        }

        $vendaService = new  VendaService();

        return $vendaService->cadastrar($request->all());
    }
}
