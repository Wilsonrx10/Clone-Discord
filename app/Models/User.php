<?php

namespace App\Models;

use App\Models\Servers\Server;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\User\skills;
use App\Models\User\Statu;
use App\Models\User\user_profiles;
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
        return $this->hasOne(user_profiles::class);
    }
    public function status()
    {
        return $this->hasOne(Statu::class);
    }

    public function server()
    {
        return $this->hasMany(Server::class);
    }
}