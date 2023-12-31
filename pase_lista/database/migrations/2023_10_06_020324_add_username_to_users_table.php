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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('username');
            $table->string('apellido');
            $table->string('codigo_tarjeta');
            $table->integer('rol');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('username');
            $table->dropColumn('apellido');
            $table->dropColumn('codigo_tarjeta');
            $table->dropColumn('rol');
        });
    }
};
