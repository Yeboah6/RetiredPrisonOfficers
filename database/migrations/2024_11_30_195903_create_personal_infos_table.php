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
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->id();
            $table -> string('reg_id') -> nullable();

            $table -> string('full_name') -> nullable();
            $table -> string('image') -> nullable();
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
            $table -> string('stat') -> nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_infos');
    }
};
