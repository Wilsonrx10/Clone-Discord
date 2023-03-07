<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UploadImagemController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CompleteRegistrationController extends Controller
{
    public function fases_concluir_cadastro(Request $request, User $user)
    {
        if ($request->user()) {
            if ($user->cad_concluir != 0) {
                return Redirect::route("Channel");
            } else {
                $dados = User::find($request->user()->id);
                return Inertia::render('auth/Registre_complete', [
                    'dados_usuario' => $dados
                ]);
            }
        } else {
            return Redirect::route("login");
        }
    }

    public function Concluir_cadastro(Request $request)
    {
        $upload = new UploadImagemController();
        $foto = $upload->UploadImagem('usuarios', $request->foto_perfil);
        
        if ($foto) {

           $request->user()->update([
                "cad_concluir" => true
            ]);
            $request->user()->profile()->update([
                "nationality" => $request->nacionalidade,
                "city" => $request->cidade,
                "phone" => $request->telefone,
                "surname" => $request->apelido,
                "biography" => $request->biografia,
                "profile_photo" => $foto,
            ]);

            foreach ($request->habilidades as $habilidade) {
                $request->user()->skills()->create([
                    'nome' => $habilidade['name']
                ]);
            }

            return Redirect::route("Channel");

        } else {
            return response()->json([
                'status' => 403,
                'message' => 'ocorreu um erro ao concluir o cadastro'
            ]);
        }
    }
}