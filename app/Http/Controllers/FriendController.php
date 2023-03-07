<?php

namespace App\Http\Controllers;

use App\Models\Friends;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class FriendController extends Controller
{
    public function Friend(Request $request)
    {

        $id_usuario = $request->session()->get('id_usuario');

        $habilidades_usuario = array();

        $habilidades = DB::table('habilidades')->where('user_id', $id_usuario)->get();
        foreach ($habilidades as $habilidade) {
            array_push($habilidades_usuario, $habilidade->nome);
        }

        $usuarios = DB::table('users')
            ->join('status', 'status.id_usuario', '=', 'users.id')
            ->where('users.id', '=', $id_usuario)
            ->select('users.*', 'status.status')
            ->first();

        return Inertia::render('Friends', [
            'usuario' => $usuarios,
            'habilidades' => $habilidades_usuario
        ]);
    }

    public function BuscarListaAmigos(Request $request, Friends $friend)
    {

        $id_usuario = $request->session()->get('id_usuario');
        $lista = $friend->where('id_usuario', $id_usuario)->get();
        $id_amigos = [];
        foreach ($lista as $amigos) {
            array_push($id_amigos, $amigos->id_amigo);
        }

        $dados = DB::table('users')
            ->join('friends', 'friends.id_amigo', '=', 'users.id')
            ->where('friends.id_usuario', '=', $id_usuario)
            ->whereIn('users.id', $id_amigos)
            ->select('users.*', 'friends.status')
            ->get();

        return json_encode($dados);
    }

    public function BuscarListaUsuariosCompleto()
    {
        $lista_usuario = User::all();

        return json_encode($lista_usuario);
    }
}
