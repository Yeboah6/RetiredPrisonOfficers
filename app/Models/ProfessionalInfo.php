<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalInfo extends Model
{
    protected $table = 'professional_infos'; 

    protected $fillable = [
        'personal_id',
        'date_of_enlistment',
        'date_of_retirement',
        'rank_of_retirement',
        'station_retired',
        'branch',
        'where_to_attend_meeting'
    ];
}
