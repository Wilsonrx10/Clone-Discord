<?php

namespace App\Models\Servers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $with = ['members','server_type'];

    protected $fillable = [
        'server_type_id',
        'name',
        'photo',
        'admin'
    ];

    public function server_type()
    {
        return $this->belongsTo(ServerType::class);
    }

    public function members()
    {
        return $this->hasMany(ServerMembers::class);
    }
}