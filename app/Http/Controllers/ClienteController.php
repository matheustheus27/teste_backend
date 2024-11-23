<?php

namespace App\Http\Controllers;

use App\Services\ClienteService;
use App\Services\VendaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function cadastrar(Request $request)
    {
        $validacao = Validator::make($request->all(), [
            'cpf' => 'required|string|unique:clientes,cpf',
            'nome' => 'required|string'
        ],[
            'cpf.required' => 'O campo cpf é obrigatório.',
            'cpf.string' => 'O campo cpf deve ser do tipo texto.',
            'cpf.unique' => 'Cliente já cadastrado no sistema.',
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser do tipo texto.',
        ]);

        if ($validacao->fails()) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Erro de validação.',
                'errors' => $validacao->errors(),
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
        $validacao = Validator::make($request->all(), [
            'cpf' => 'required|string'
        ],[
            'cpf.required' => 'O campo cpf é obrigatório.',
            'cpf.string' => 'O campo cpf deve ser do tipo texto.',
        ]);

        if ($validacao->fails()) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Erro de validação.',
                'errors' => $validacao->errors(),
            ], 422);
        }

        $clienteService = new  ClienteService();

        return $clienteService->editar($request->all());
    }

    public function deletar(Request $request)
    {
        $validacao = Validator::make($request->all(), [
            'cpf' => 'required|array',
            'cpf.*' => 'string',
        ],[
            'cpf.required' => 'O campo cpf é obrigatório.',
            'cpf.array' => 'O campo cpf deve ser uma lista.',
            'cpf.*.string' => 'O campo cpf deve ser do tipo texto.',
        ]);

        if ($validacao->fails()) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Erro de validação.',
                'errors' => $validacao->errors(),
            ], 422);
        }

        $clienteService = new  ClienteService();

        return $clienteService->deletar($request->all());
    }

    public function buscarVendas(Request $request)
    {
        $validacao = Validator::make($request->all(), [
            'cpf' => 'required|string'
        ],[
            'cpf.required' => 'O campo cpf é obrigatório.',
            'cpf.string' => 'O campo cpf deve ser do tipo texto.',
        ]);

        if ($validacao->fails()) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Erro de validação.',
                'errors' => $validacao->errors(),
            ], 422);
        }

        $vendaService = new VendaService();

        return $vendaService->buscar($request->all());
    }
}
