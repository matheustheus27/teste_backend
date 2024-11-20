<?php

namespace App\Http\Controllers;

use App\Services\UsuarioService;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function cadastrar(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|unique:usuarios,email',
            'password' => 'required|string|min:8'
        ]);

        $usuarioService = new  UsuarioService();

        return $usuarioService->cadastrar($request->all());
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8'
        ]);

        $usuarioService = new UsuarioService();

        return $usuarioService->login($request->only(['email', 'password']));
    }
}
