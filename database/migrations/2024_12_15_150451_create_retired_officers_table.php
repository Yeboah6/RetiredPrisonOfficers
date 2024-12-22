<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('retired_officers', function (Blueprint $table) {
            $table->id();
            $table -> string('reg_id') -> nullable();

            $table -> string('full_name') -> nullable();
            $table -> string('govt_pension_no') -> nullable();
            $table -> string('prison_svc_no') -> nullable();
            $table -> string('residential_address') -> nullable();
            $table -> string('postal_address') -> nullable();
            $table -> string('telephone') -> nullable();
            $table -> string('email') -> nullable();
            $table -> string('ghana_card_no') -> nullable();
            $table -> string('sex') -> nullable();
            $table -> string('present_age') -> nullable();
            $table -> string('hometown') -> nullable();
            $table -> string('present_place_of_residence') -> nullable();
            $table -> string('marital_status') -> nullable();
            
            $table -> string('date_of_enlistment') -> nullable();
            $table -> string('date_of_retirement') -> nullable();
            $table -> string('rank_of_retirement') -> nullable();
            $table -> string('station_retired') -> nullable();
            $table -> string('where_to_attend_meeting') -> nullable();
            $table -> string('branch') -> nullable();

            $table -> string('present_occupation') -> nullable();
            $table -> string('next_of_kin') -> nullable();
            $table -> string('member_signature') -> nullable();
            $table -> string('status') -> nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retired_officers');
    }
};
