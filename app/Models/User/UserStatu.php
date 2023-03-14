<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $with = ['statusType'];

    public function statusType()
    {
       return $this->belongsTo(UserStatusType::class,'user_statu_type_id','id');
    }
}