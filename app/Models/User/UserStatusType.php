<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatusType extends Model
{
    use HasFactory;

    public function statu()
    {
       return $this->belongsTo(UserStatu::class);
    }
}