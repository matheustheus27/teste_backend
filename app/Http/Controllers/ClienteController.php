<?php

namespace App\Http\Controllers;

use App\Services\ClienteService;
use App\Services\VendaService;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function cadastrar(Request $request)
    {
        try {
            $request->validate([
                'cpf' => 'required|string|unique:clientes,cpf',
                'nome' => 'required|string'
            ]);
        } catch(ValidationException $e) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Algum campo da requisição não é valido!'
            ], 422);
        }

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
        try {
            $request->validate([
                'cpf' => 'required|string'
            ]);
        } catch(ValidationException $e) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Algum campo da requisição não é valido!'
            ], 422);
        }

        $clienteService = new  ClienteService();

        return $clienteService->editar($request->all());
    }

    public function deletar(Request $request)
    {
        try {
            $request->validate([
                'cpf' => 'required|array',
                'cpf.*' => 'string',
            ]);
        } catch(ValidationException $e) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Algum campo da requisição não é valido!'
            ], 422);
        }

        $clienteService = new  ClienteService();

        return $clienteService->deletar($request->all());
    }

    public function buscarVendas(Request $request)
    {
        try {
            $request->validate([
                'cpf' => 'required|string'
            ]);
        } catch(ValidationException $e) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Algum campo da requisição não é valido!'
            ], 422);
        }

        $vendaService = new VendaService();

        return $vendaService->buscar($request->all());
    }
}
