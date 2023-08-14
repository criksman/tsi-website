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
            $table->string('tipo', 20);
            $table->text('enunciado');
            $table->string('audio', 100);
            $table->string('respuesta_corr');
            $table->string('respuesta_inc1');
            $table->string('respuesta_inc2');
            $table->string('respuesta_inc3');
            $table->boolean('estado')->default(false);

            $table->foreign('tematica_id')->references('tematica_id')->on('tematicas');
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
