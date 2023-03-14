<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'birth',
        'surname',
        'biography',
        'nationality',
        'city',
        'phone',
        'profile_photo'
    ];
}
