<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(){
    Schema::create('pasajes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('comision_id')->constrained()->onDelete('cascade');
        $table->foreignId('cotizacion_id')->nullable()->constrained('cotizaciones');
        $table->string('aerolinea');
        $table->string('ruta');
        $table->decimal('valor', 10,2);
        $table->string('numero_factura');
        $table->date('fecha_factura');
        $table->string('factura_path'); // PDF
        $table->string('estado')->default('COMPRADO');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasajes');
    }
};
