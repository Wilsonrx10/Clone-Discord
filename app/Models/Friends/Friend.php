<?php

namespace App\Models\Friends;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    public function friend()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }
}