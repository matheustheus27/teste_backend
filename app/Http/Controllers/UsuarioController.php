<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function cadastrar(Request $request)
    {
        $validacao = Validator::make($request->all(), [
            'email' => 'required|string|email|unique:usuarios,email',
            'password' => 'required|string|min:8'
        ],[
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um e-mail válido.',
            'email.unique' => 'E-mail já cadastrado no sistema.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
        ]);

        if ($validacao->fails()) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Erro de validação.',
                'errors' => $validacao->errors(),
            ], 422);
        }

        $usuarioService = new  UsuarioService();

        return $usuarioService->cadastrar($request->all());
    }

    public function login(Request $request)
    {
        $validacao = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8'
        ],[
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um e-mail válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
        ]);

        if ($validacao->fails()) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Erro de validação.',
                'errors' => $validacao->errors(),
            ], 422);
        }

        $usuarioService = new UsuarioService();

        return $usuarioService->login($request->only(['email', 'password']));
    }
}
