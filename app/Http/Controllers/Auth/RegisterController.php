<?php

namespace App\Http\Controllers\Auth;

use App\Classes\Email\RegisterEmail;
use App\Classes\Store;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function Register(Request $request, User $User)
    {
        $request->validate([
            'email' => 'email|required|unique:users',
            'name' => 'required|max:100|unique:users',
            'password' => 'required|min:6|max:10',
            'dataNascimento' => 'required'
        ]);

        $senha = bcrypt($request->senha);

        do {
            $token = Store::criarHash();
            $resultado = DB::table('users')->where('email_verified_at', $token)->exists();
        } while ($resultado);

        $email = new RegisterEmail();
        $resultado = $email->Enviar_email_cadastro($request->email, $token);

        if ($resultado == 0) {
            return response()->json([
                'message' => 'Ocorreu ao cadastrar, por favor tenta mais tarde',
                'status' =>  403
            ]);
        } else {
            $data = $request->except(['dataNascimento']);
            $user = $User->create($data);

            $user->password = $senha;
            $user->email_verified_at = $token;
            $user->save();

            $user->profile()->updateOrCreate([
                'birth' => $request->dataNascimento
            ]);

            return response()->json([
                'message' => 'Usuario Cadastrado com sucesso',
                'status' => 200
            ]);
        }
    }
}