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
            $table->string('usuario_id',30);
            $table->string('email');
            $table->string('password');
            $table->smallInteger('rol_id');
            $table->string('foto', 100);
            $table->boolean('estado')->default(true);

            $table->primary(['usuario_id','email']);
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
