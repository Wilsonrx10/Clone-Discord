<?php

namespace App\Http\Controllers;

use App\Models\Friends\Friend;
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
        return Friend::where(function ($query) use ($request) {
            $query->where('user_id', $request->user()->id);
            $query->orderBy('id', 'ASC');
        })->get();
    }

    public function BuscarListaUsuariosCompleto()
    {
        return User::all();
    }
}