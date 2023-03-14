<?php

namespace App\Models;

use App\Models\Friends\Friend;
use App\Models\Messages\ChatMessage;
use App\Models\Servers\Server;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\User\skills;
use App\Models\User\UserProfiles;
use App\Models\User\UserStatu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $with = ['profile','status','skills'];

    protected $fillable = [
        'name',
        'email',
        'nascimento',
        'password',
        'email_verified_at',
        'cad_concluir',
        'ativo_account'
    ];

    public function skills()
    {
        return $this->hasMany(skills::class);
    }

    public function profile()
    {
        return $this->hasOne(UserProfiles::class);
    }
    public function status()
    {
        return $this->hasOne(UserStatu::class);
    }

    public function server()
    {
        return $this->hasMany(Server::class);
    }
    public function friends()
    {
        return $this->hasMany(Friend::class);
    }
    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}