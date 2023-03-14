<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FriendController extends Controller
{
    public function Friend(Request $request)
    {
        return Inertia::render('Friends');
    }

    public function BuscarListaAmigos(Request $request)
    {
        return response()->json([
            'friends' => $request->user()->friends()->with('friend')->get()
        ]);
    }

    public function BuscarListaUsuariosCompleto()
    {
        return User::all();
    }
}