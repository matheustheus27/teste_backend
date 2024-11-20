<?php

namespace App\Http\Controllers;

use App\Services\ClienteService;
use App\Services\VendaService;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function cadastrar(Request $request)
    {
        $request->validate([
            'cpf' => 'required|string|unique:clientes,cpf',
            'nome' => 'required|string'
        ]);

        $clienteService = new  ClienteService();

        return $clienteService->cadastrar($request->all());
    }

    public function buscar()
    {
        $clienteService = new  ClienteService();

        return $clienteService->buscar();
    }

    public function editar(Request $request)
    {
        $request->validate([
            'cpf' => 'required|string'
        ]);

        $clienteService = new  ClienteService();

        return $clienteService->editar($request->all());
    }

    public function deletar(Request $request)
    {
        $request->validate([
            'cpf' => 'required|array',
            'cpf.*' => 'string',
        ]);

        $clienteService = new  ClienteService();

        return $clienteService->deletar($request->all());
    }

    public function buscarVendas(Request $request)
    {

        $request->validate([
            'cpf' => 'required|string'
        ]);

        $vendaService = new VendaService();

        return $vendaService->buscar($request->all());
    }
}
