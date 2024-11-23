<?php

namespace App\Http\Controllers;

use App\Services\EnderecoService;
use App\Services\VendaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EnderecoController extends Controller
{
    public function cadastrar(Request $request)
    {
        $validacao = Validator::make($request->all(), [
            'rua' => 'required|string',
            'num' => 'required|string',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'estado' => 'required|string',
            'pais' => 'required|string',
            'cep' => 'required|string',
        ],[
            'rua.required' => 'O campo rua é obrigatório.',
            'rua.string' => 'O campo rua deve ser do tipo texto.',
            'num.required' => 'O campo num é obrigatório.',
            'num.string' => 'O campo num deve ser do tipo texto.',
            'bairro.required' => 'O campo bairro é obrigatório.',
            'bairro.string' => 'O campo bairro deve ser do tipo texto.',
            'cidade.required' => 'O campo cidade é obrigatório.',
            'cidade.string' => 'O campo cidade deve ser do tipo texto.',
            'estado.required' => 'O campo estado é obrigatório.',
            'estado.string' => 'O campo estado deve ser do tipo texto.',
            'pais.required' => 'O campo pais é obrigatório.',
            'pais.string' => 'O campo pais deve ser do tipo texto.',
            'cep.required' => 'O campo cep é obrigatório.',
            'cep.string' => 'O campo cep deve ser do tipo texto.',
        ]);

        if ($validacao->fails()) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Erro de validação.',
                'errors' => $validacao->errors(),
            ], 422);
        }

        $enderecoService = new  EnderecoService();

        return $enderecoService->cadastrar($request->all());
    }
}
