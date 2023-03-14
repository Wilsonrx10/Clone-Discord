<?php

namespace App\Models\Friends;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendStatu extends Model
{
    use HasFactory;

    protected $with = ['status_type'];

    public function status_type()
    {
        return $this->belongsTo(FriendStatusType::class);
    }
}