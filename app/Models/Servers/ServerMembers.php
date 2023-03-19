<?php

namespace App\Models\Servers;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerMembers extends Model
{
    use HasFactory;

    protected $fillable = [
        'server_id',
        'user_id',
        'is_admin',
        'is_boot'
    ];

    protected $with = ['user'];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}