<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UserController extends Controller
{

    public function Channel(Request $request)
    {
        $user = $request->user();

        return Inertia::render('Channel', [
            'user' => $user,
        ]);

        return $this->DadosdoUsuario($request);
    }

    public function atualizarStatus(Request $request)
    {
        
    }
}