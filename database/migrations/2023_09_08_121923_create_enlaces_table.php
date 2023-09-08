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
        Schema::create('enlaces', function (Blueprint $table) {
            $table->integer('enlace_id')->autoIncrement();
            $table->integer('tematica_id');
            $table->text('link');
            $table->string('descripcion', 300);

            $table->foreign('tematica_id')->references('tematica_id')->on('tematicas');
            
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enlaces');
    }
};
