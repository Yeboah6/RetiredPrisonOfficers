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
        Schema::create('professional_infos', function (Blueprint $table) {
            $table->id();
            $table -> bigInteger('personal_id')->unsigned()->index()->nullable();
            $table -> foreign('personal_id') -> references('id') -> on('personal_infos') ->onDelete('cascade');
            
            $table -> string('date_of_enlistment') -> nullable();
            $table -> string('date_of_retirement') -> nullable();
            $table -> string('rank_of_retirement') -> nullable();
            $table -> string('station_retired') -> nullable();
            $table -> string('where_to_attend_meeting') -> nullable();
            $table -> string('branch') -> nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional_infos');
    }
};
