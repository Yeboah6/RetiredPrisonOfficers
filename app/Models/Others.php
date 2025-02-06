<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Others extends Model
{
    protected $table = 'others';

    protected $fillable = [
        'personal_id',
        'present_occupation',
        'next_of_kin',
        'member_signature',
        'secretary',
        'chairman',
        'treasury',
        'repoag_no'
    ];
}
