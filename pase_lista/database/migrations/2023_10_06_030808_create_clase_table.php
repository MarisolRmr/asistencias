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
        Schema::create('clase', function (Blueprint $table) {
            $table->id();
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->string('dia');
            $table->string('estado');
            $table->string('clave');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('materia_id')->constrained('materia');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clase');
    }
};
