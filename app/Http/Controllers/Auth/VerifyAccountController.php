<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class VerifyAccountController extends Controller
{
    public function verificar_token_usuario(Request $request)
    {
        $token = $request->input('token');
        if ($token) {
            $dados = DB::table('users')->where('email_verified_at', $token)->first();
            if ($dados) {
                $id_usuario = $dados->id;
                DB::table('users')->where('id', $id_usuario)->update([
                    'email_verified_at' => null,
                    'ativo_account' => true
                ]);
            } else {
                return Inertia::render('auth/token/index');
            }
        } else {
            return Inertia::render('auth/Login');
        }
    }
}