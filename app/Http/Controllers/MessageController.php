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
      
    }

    public function EnviarMensagem(Request $request)
    {

    }
}