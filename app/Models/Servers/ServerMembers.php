<?php

namespace App\Models\Servers;

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

    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}