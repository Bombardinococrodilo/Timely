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
        Schema::create('spaces', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('tipo'); // salón, laboratorio, auditorio
        $table->integer('capacidad');
        $table->string('ubicacion')->nullable();
        $table->enum('estado', ['disponible', 'mantenimiento'])->default('disponible');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spaces');
    }
};
