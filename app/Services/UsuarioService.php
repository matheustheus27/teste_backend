<?php

namespace App\Services;

use App\Models\Usuario;
use Exception;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsuarioService
{
    public function cadastrar($dados)
    {
        try {
            Usuario::create([
                'email' => $dados['email'],
                'password' => Hash::make($dados['password']),
            ]);

            return response()->json([
                'status' => true,
                'mensagem' => 'Usuario cadastrado com sucesso!'
            ], 201);
        } catch(Exception $e)
        {
            dd($e);
            return response()->json([
                'status' => false,
                'mensagem' => 'Falha ao cadastrar usuario!'
            ], 422);
        }
    }

    public function login($dados)
    {
        try {
            if (!$token = JWTAuth::attempt($dados)) {
                return response()->json([
                    'status' => false,
                    'mensagem' => 'Login não autorizado!'
                ], 401);
            }
        } catch(JWTException $e) {
            return response()->json([
                'status' => false,
                'mensagem' => 'Falha ao gerar o token!'
            ], 500);
        }

        return response()->json(compact('token'));
    }
}
