<?php

namespace App\Http\Controllers;
use App\Models\Servidor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServidorController extends Controller
{
    public function CriarNovoServidor(Request $request, Servidor $servidor,UploadImagemController $imagem)
    {
        $img = null;

        $request->DadosFormulario['imagem'] != null ? $img =  $imagem->UploadImagem('servidores', $request->DadosFormulario['imagem']) : $img = 'discord.png';

        if ($img != false) {
            $dados = [
                'nome_servidor' => $request->DadosFormulario['nome'],
                'administrador_servidor' => $request->DadosFormulario['administrador'],
                'foto_servidor' => $img,
            ];

            $servidor->create($dados);

            // Selecionar os Dados do Administrador 
            $administrador = DB::table('users')->where('id', $request->session()->get('id_usuario'))->first();

            // Buscar o ultimo id na tabela servidor 
            $ultimo_id = $servidor->orderBy('created_at','desc')->first();

            DB::table('membros_servidors')->insert([
                'id_servidor' => $ultimo_id->id,
                'id_membro' => $administrador->id,
                'nome_membro' => $administrador->name,
                'foto_membro' => $administrador->foto_perfil,
                'administrador' => true,
                'boot' => false
            ]);
        } else {
            return "ocorreu um erro ao adicionar o servidor";
        }
    }

    public function BuscarListaServidores(Request $request, Servidor $servidores)
    {
        $id_user = $request->session()->get('id_usuario');
        $membros_servidor = DB::table('membros_servidors')->where('id_membro',$id_user)->get();
        $id_servidores = [];
        foreach ($membros_servidor as $server) {
            array_push($id_servidores,$server->id_servidor);
        }

        $servidores = $servidores->whereIn('id', $id_servidores)->get();

        return json_encode($servidores);
    }

    public function AbrirServidor(Request $request, Servidor $servidor)
    {
        // Verificar se neste servidor existe membros 
        $membros = DB::table('membros_servidors')->where('id',$request->id)
        ->where('administrador','<','1')
        ->get();

       if ($membros->count() > 1) {
        // Trazer todos dados relacionado a este servidor 
       } else {
        return json_encode(false);
       }

    }
}