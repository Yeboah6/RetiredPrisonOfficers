<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RetiredOfficers extends Model
{
    protected $table = 'retired_officers';

    protected $fillable = [
        'reg_id',
        'full_name',
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

        'date_of_enlistment',
        'date_of_retirement',
        'rank_of_retirement',
        'station_retired',
        'branch',
        'where_to_attend_meeting',

        'present_occupation',
        'next_of_kin',
        'member_signature'
    ];
}
