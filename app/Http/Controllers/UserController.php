<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UserController extends Controller
{

    public function Channel(Request $request)
    {
        return Inertia::render('Channel', [
            'user' => $request->user(),
        ]);
    }

    public function atualizarStatus(Request $request)
    {
        $request->user()->status()->updateOrCreate([
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'estado atualizado',
            'type' => 200
        ]);
    }
}