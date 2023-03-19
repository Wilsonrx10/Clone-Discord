<?php

namespace App\Http\Controllers;

use App\Models\Servers\Server;
use App\Models\Servers\ServerType;
use Illuminate\Http\Request;

class ServidorController extends Controller
{
    public function getTypeServer()
    {
        return ServerType::all();
    }

    public function getServers(Request $request)
    {
        return $request->user()->server()->get();
    }
    public function CriarNovoServidor(Request $request, UploadImagemController $imagem)
    {
        $request->validate([
            'type_server' => 'required',
            'nome' => 'required|string|max:200'
        ]);

        $img = "";

        if($request->imagem) {
            $img = $imagem->UploadImagem('servidores', $request->imagem);
        } else {
            $img = 'discord.png';
        }

        if ($img) {
            $server = $request->user()->server()->create([
                'server_type_id' => $request->type_server,
                'name' => $request->nome,
                'photo' => $img,
            ]);

            $server->members()->create([
                'user_id' => $request->user()->id,
                'is_admin' => true,
            ]);
        } else {
            return $this->respondError('ocorreu um erro ao adicionar o servidor',[]);
        }
    }

    public function OpenServer(Server $server)
    {   
        return $server->load('messages','members');
    }
}