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
        Schema::create('archivos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_archivo', 150)->nullable()->default('');
            $table->string('numero_documento', 12)->nullable()->default('');
            $table->string('numero_resolucion', 100)->nullable()->default('');
            $table->string('nombres', 200)->nullable()->default('');
            $table->string('apellidos', 200)->nullable()->default('');
            $table->string('tipo', 150)->nullable()->default('');
            $table->string('archivo', 250)->nullable()->default('');
            $table->bigInteger('carpeta_id')->unsigned();
            $table->foreign('carpeta_id')->references('id')->on('carpetas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archivos');
    }
};
