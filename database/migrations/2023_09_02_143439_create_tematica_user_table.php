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
        Schema::create('tematica_user', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('tematica_id');
            $table->primary(['user_id','tematica_id']);

            $table->integer('progreso')->default(0);

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('tematica_id')->references('tematica_id')->on('tematicas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tematica_user');
    }
};
