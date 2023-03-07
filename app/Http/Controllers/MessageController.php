<?php

namespace App\Http\Controllers;

use App\Events\EnviarMessage;
use App\Models\Messages\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class MessageController extends Controller
{
    public function BuscarMessages(Request $request,ChatMessage $mensagem)
    {
        $id_usuario = $request->session()->get('id_usuario');
        $id_anfitriao = $request->id;
        $resultado = $mensagem->where('id_usuario',$id_usuario)
        ->where('id_anfitriao',$id_anfitriao)->get();

        return json_encode($resultado);

    }

    public function EnviarMensagem(Request $request,ChatMessage $mensagem,User $user)
    {
        $id_usuario = $request->session()->get('id_usuario');
        $id_anfitriao = $request->id;
        $body = $request->mensagem;

        $buscarDadosUsuario = $user->where('id',$id_usuario)->first();
        
        // Usuario que vai enviar a mensagem 
        $usuario = [
        'id_usuario' => $id_usuario,
        'id_anfitriao' => $id_anfitriao,
        'nome_usuario' => $buscarDadosUsuario->name,
        'foto_perfil' => $buscarDadosUsuario->foto_perfil,
        'mensagem' => $body,
        'mention' => false
        ];

        $mensagem->create($usuario);

        // Anfitrião que vai receber a mensagem 
        $anfitriao = [
        'id_usuario' => $id_anfitriao,
        'id_anfitriao' => $id_usuario,
        'nome_usuario' => $buscarDadosUsuario->name,
        'foto_perfil' => $buscarDadosUsuario->foto_perfil,
        'mensagem' => $body,
        'mention' => false
        ];
        
        $mensagem->create($anfitriao);

        $msg = "Testando Websocket";

        Event::dispatch(new EnviarMessage($msg,$id_anfitriao));
        
    }
}
