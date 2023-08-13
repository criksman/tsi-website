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
        Schema::create('tematicas', function (Blueprint $table) {
            $table->integer('tematica_id')->autoIncrement();
            $table->integer('idioma_id');
            $table->smallInteger('dificultad_id');
            $table->smallInteger('seccion_id');
            $table->string('nombre', 30);
            $table->string('descripción',200);
            $table->string('foto')->defaut('none');

            $table->foreign('idioma_id')->references('idioma_id')->on('idiomas');
            $table->foreign('dificultad_id')->references('dificultad_id')->on('dificultades');
            $table->foreign('seccion_id')->references('seccion_id')->on('secciones');
            
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tematicas');
    }
};
