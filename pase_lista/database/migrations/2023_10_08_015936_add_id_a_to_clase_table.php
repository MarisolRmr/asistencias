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
        Schema::table('clase', function (Blueprint $table) {
            //
            $table->foreignId('id_aula')->constrained('aula')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clase', function (Blueprint $table) {
            //
            $table->dropForeign(['id_aula']);
            $table->dropColumn('id_aula');
        });

    }
};
