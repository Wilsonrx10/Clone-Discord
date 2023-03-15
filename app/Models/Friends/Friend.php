<?php

namespace App\Models\Friends;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    use HasFactory;

    protected $with = ['user','status'];

    protected $fillable = [
        'user_id',
        'friend_id',
        'request_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }

    public function status()
    {
        return $this->belongsTo(FriendStatu::class,'friend_id');
    }
}