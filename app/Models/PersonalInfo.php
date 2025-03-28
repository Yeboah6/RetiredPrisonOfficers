<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    protected $table = 'personal_infos';

    protected $fillable = [
        'reg_id',
        'full_name',
        'image',
        'govt_pension_no',
        'prison_svc_no',
        'residential_address',
        'postal_address',
        'telephone',
        'ghana_card_no',
        'sex',
        'present_age',
        'hometown',
        'present_place_of_residence',
        'marital_status',
        'email',
        'stat'
    ];
}
