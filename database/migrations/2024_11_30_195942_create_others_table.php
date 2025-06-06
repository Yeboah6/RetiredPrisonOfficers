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
        Schema::create('others', function (Blueprint $table) { 
            $table->id();
            $table -> bigInteger('personal_id')->unsigned()->index()->nullable();
            $table -> foreign('personal_id') -> references('id') -> on('personal_infos') ->onDelete('cascade');

            $table -> string('present_occupation') -> nullable();
            $table -> string('next_of_kin') -> nullable();
            $table -> string('member_signature') -> nullable();
            $table -> string('added_by');
            $table -> string('status') -> nullable();
            
            $table -> string('secretary') -> nullable();
            $table -> string('chairman') -> nullable();
            $table -> string('treasury') -> nullable();
            $table -> string('repoag_no') -> nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('others');
    }
};
