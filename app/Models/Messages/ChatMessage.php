<?php

namespace App\Models\Messages;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $with = ['user'];

    protected $fillable = [
        'user_id',
        'receiver_id',
        'message',
        'mention',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
