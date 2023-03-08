<?php

namespace App\Models\Servers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerType extends Model
{
    use HasFactory;

    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}