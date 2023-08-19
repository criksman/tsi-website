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
        Schema::create('preguntas', function (Blueprint $table) {
            $table->integer('pregunta_id')->autoIncrement();
            $table->integer('tematica_id');
            $table->string('tipo', 20)->nullable();
            $table->text('enunciado');
            $table->text('audio')->nullable();
            $table->string('respuesta_corr', 30);
            $table->string('respuesta_inc1', 30);
            $table->string('respuesta_inc2', 30);
            $table->string('respuesta_inc3', 30);

            $table->foreign('tematica_id')->references('tematica_id')->on('tematicas')->onDelete('cascade');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preguntas');
    }
};
