<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:100'
        ], [
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email precisa ser um endereço de email válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha precisa ter no mínimo 6 caracteres.',
            'password.max' => 'A senha pode ter no máximo 100 caracteres.'
        ]);
        
        if (Auth::attempt($request->all())) {
            $user = Auth::user();
            if ($user->ativo_account == 0) {
                Auth::logout();
                return Redirect::route('login')->with('error', 'Por favor ative a sua conta, verique seu endereço email');
            } else if ($user->cad_concluir == 0) {
                return Redirect::route('user.complete');
            } else {
                return Redirect::route("Channel");
            }
        } else {
            return Redirect::route('login')->with('error', 'Dados do usuario incorrecto');
        }
    }
}