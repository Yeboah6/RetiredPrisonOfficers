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
        Schema::create('registration_forms', function (Blueprint $table) {
            $table->id();
            $table -> string('full_name') -> nullable();
            $table -> string('govt_pension_no') -> nullable();
            $table -> string('prison_svc_no') -> nullable();
            $table -> string('residential_address') -> nullable();
            $table -> string('postal_address') -> nullable();
            $table -> string('telephone') -> nullable();
            $table -> string('ghana_card_no') -> nullable();
            $table -> string('sex') -> nullable();
            $table -> string('present_age') -> nullable();
            $table -> string('date_of_enlistment') -> nullable();
            $table -> string('date_of_retirement') -> nullable();
            $table -> string('rank_of_retirement') -> nullable();
            $table -> string('station_retired') -> nullable();
            $table -> string('where_to_attend_meeting') -> nullable();
            $table -> string('hometown') -> nullable();
            $table -> string('present_place_of_residence') -> nullable();
            $table -> string('present_occupation') -> nullable();
            $table -> string('marital_status') -> nullable();
            $table -> string('next_of_kin') -> nullable();
            $table -> string('member_signature') -> nullable();

            $table -> string('registration_fee') -> nullable();
            $table -> string('secretary') -> nullable();
            $table -> string('chairman') -> nullable();
            $table -> string('treasury') -> nullable();
            $table -> string('reg_no') -> nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_forms');
    }
};