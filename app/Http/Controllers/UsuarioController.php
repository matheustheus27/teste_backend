<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UsuarioController extends Controller
{
    public function cadastrar(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email|unique:usuarios,email',
                'password' => 'required|string|min:8'
            ]);
        } catch(ValidationException $e) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Algum campo da requisição não é valido!'
            ], 422);
        }

        $usuarioService = new  UsuarioService();

        return $usuarioService->cadastrar($request->all());
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string|min:8'
            ]);
        } catch(ValidationException $e) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Algum campo da requisição não é valido!'
            ], 422);
        }

        $usuarioService = new UsuarioService();

        return $usuarioService->login($request->only(['email', 'password']));
    }
}
