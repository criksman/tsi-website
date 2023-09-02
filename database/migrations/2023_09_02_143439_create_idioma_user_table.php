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
        Schema::create('idioma_user', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('idioma_id');
            $table->primary(['user_id','idioma_id']);

            $table->integer('progreso')->default(0);

            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('idioma_id')->references('idioma_id')->on('idiomas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('idioma_user');
    }
};
