<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignIn extends Model
{
    protected $table = 'sign_ins';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'region',
        'status'
    ];

    public function userloginlogs()
    {
        return $this->has(UserLoginLog::class);
    }
}
