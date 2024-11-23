<?php

namespace App\Http\Controllers;

use App\Services\VendaService;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function cadastrar(Request $request)
    {
        try {
            $request->validate([
                'cliente' => 'required|string',
                'produto' => 'required|int',
                'quantidade'  => 'required|numeric|min:1',
                'valor_unitario' => 'required|numeric|min:0.01',
                'valor_total' => 'required|numeric|min:0.01',
                'dt_compra' => 'required|date'
            ]);
        } catch(ValidationException $e) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Algum campo da requisição não é valido!'
            ], 422);
        }

        $vendaService = new  VendaService();

        return $vendaService->cadastrar($request->all());
    }
}
