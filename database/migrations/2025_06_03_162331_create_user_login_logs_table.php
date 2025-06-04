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
        Schema::create('user_login_logs', function (Blueprint $table) {
            $table->id();
             $table -> bigInteger('user_id') -> unsigned() -> index() -> nullable();
            $table->foreign('user_id')->references('id')->on('sign_ins')->onDelete('cascade');
            $table -> string('login_time');
            $table -> string('ip_address');
            $table -> text('user_agent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_login_logs');
    }
};
