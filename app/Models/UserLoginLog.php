<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLoginLog extends Model
{
    protected $table = 'user_login_logs';

    protected $fillable = [
        'user_id',
        'login_time',
        'ip_address',
        'user_agent',
    ];

    public function user()
    {
        return $this->belongsTo(Signin::class, 'id');
    }
}
