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
        Schema::create('official_uses', function (Blueprint $table) {
            $table->id();
            $table -> bigInteger('personal_id')->unsigned()->index()->nullable();
            $table -> foreign('personal_id') -> references('id') -> on('personal_infos') ->onDelete('cascade');

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
        Schema::dropIfExists('official_uses');
    }
};
