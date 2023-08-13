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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('user_id')->autoIncrement();
            $table->string('username', 30);
            $table->string('email');
            $table->string('password');
            $table->smallInteger('rol_id');
            $table->string('foto', 100);
            $table->boolean('estado')->default(true);
            
            //FKs
            $table->foreign('rol_id')->references('rol_id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
