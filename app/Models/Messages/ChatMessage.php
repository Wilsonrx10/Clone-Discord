<?php

namespace App\Models\Messages;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_usuario',
        'id_anfitriao',
        'nome_usuario',
        'foto_perfil',
        'mention',
        'mensagem'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
