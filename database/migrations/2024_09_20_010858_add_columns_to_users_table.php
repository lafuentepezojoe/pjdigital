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
            $table->string('nombres', 150)->nullable()->default('');
            $table->string('apellidos', 150)->nullable()->default('');
            $table->string('telefono', 150)->nullable()->default('');
            $table->string('direccion', 250)->nullable()->default('');
            $table->string('rol', 150)->nullable()->default('');
            $table->boolean('status')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nombres');
            $table->dropColumn('apellidos');
            $table->dropColumn('telefono');
            $table->dropColumn('direccion');
            $table->dropColumn('status');
        });
    }
};
