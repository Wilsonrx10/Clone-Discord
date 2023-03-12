<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadImagemController extends Controller
{
    public function UploadImagem($caminho, $imagem)
    {
        $imagem = explode(",", $imagem);
        $extensao = "";
        // pegar a extensão da imagem 
        if (str_contains($imagem[0], 'gif')) {
            $extensao = 'gif';
        } else if (str_contains($imagem[0], 'png')) {
            $extensao = 'png';
        } else if (str_contains($imagem[0], 'jpg')) {
            $extensao = 'jpg';
        } else if (str_contains($imagem[0], 'jpeg')) {
            $extensao = 'jpeg';
        }
        // Decodificar a imagem 
        $decode = base64_decode($imagem[1]);
        $filename = Str::random() . "." . $extensao;
        // pegar o local para salvar a imagem 
        $caminho = public_path() . '/' . 'image/' . $caminho . '/' . $filename;
        // Realizar o upload 
        if (file_put_contents($caminho, $decode)) {
            return $filename;
        } else {
            return false;
        }
    }
}