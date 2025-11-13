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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('docente_id')->constrained('usuarios');
            $table->string('nombre', 100);
            $table->text('descripcion');
            $table->text('temario');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('cupo');
            $table->double('precio');
            $table->string('estado', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
