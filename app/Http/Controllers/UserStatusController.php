<?php

namespace App\Http\Controllers;

use App\Models\User\UserStatusType;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{
    public function getTypeStatus()
    {
        return UserStatusType::all();
    }
    public function updateStatus(Request $request)
    {
        $request->validate([
            'status_id' => 'required|integer'
        ]);

        $request->user()->status()->update([
            'user_statu_type_id' => $request->status_id
        ]);

        return $this->respondSuccess(
            'Atualizado com sucesso',
            $request->user()->status()->first()
        );
    }
}