<?php

namespace App\Http\Controllers;

use App\Events\EnviarMessage;
use App\Models\Messages\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class MessageController extends Controller
{
    public function BuscarMessages(Request $request, $user)
    {
        // return $request->user()->messages()
        // ->where('user_id', $request->user()->id)
        // ->orWhere('receiver_id', $request->user()->id)
        // ->orderBy('id','DESC')
        // ->get();

        // return $request->user()->with(['messages' => function ($query) use ($request) {
        //     $query->where('user_id', $request->user()->id)
        //           ->orWhere('receiver_id', $request->user()->id)
        //           ->orderBy('id', 'DESC');
        // }])->get();

        return ChatMessage::where(function($query) use ($user) {
            $query->where('user_id', $user)
            ->orWhere('receiver_id', $user);
        })->orderBy('id', 'ASC')->get();

    }

    public function EnviarMensagem(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'receiver' => 'required'
        ]);

        $request->user()->messages()->create([
            'receiver_id' => $request->receiver['id'],
            'message' => $request->message,
        ]);

        return $this->respondSuccess('Sucesso ao enviar mensagem', []);
    }
}
