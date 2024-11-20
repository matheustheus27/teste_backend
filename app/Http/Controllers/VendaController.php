<?php

namespace App\Http\Controllers;

use App\Services\VendaService;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function cadastrar(Request $request)
    {
        $request->validate([
            'cliente' => 'required|string',
            'produto' => 'required|int',
            'quantidade'  => 'required|numeric|min:1',
            'valor_unitario' => 'required|numeric|min:0.01',
            'valor_total' => 'required|numeric|min:0.01',
            'dt_compra' => 'required|date'
        ]);

        $vendaService = new  VendaService();

        return $vendaService->cadastrar($request->all());
    }
}
