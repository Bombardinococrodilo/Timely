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
    Schema::create('horarios', function (Blueprint $table) {
        $table->id();
        
       
        $table->foreignId('profesor_id')->constrained('profesores')->onDelete('cascade');
        $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade');
        $table->foreignId('asignatura_id')->constrained('asignaturas')->onDelete('cascade');
        $table->foreignId('espacio_id')->constrained('espacios')->onDelete('cascade'); 
        
        $table->string('dia'); 
        $table->time('hora_inicio');
        $table->time('hora_fin');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
