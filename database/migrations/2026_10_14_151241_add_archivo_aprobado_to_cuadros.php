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
 Schema::table('cuadros_comparativos', function($t){
  if(!Schema::hasColumn('cuadros_comparativos','archivo_aprobado_path')){
   $t->string('archivo_aprobado_path')->nullable()->after('estado');
  }
  if(!Schema::hasColumn('cuadros_comparativos','fecha_aprobacion')){
   $t->timestamp('fecha_aprobacion')->nullable();
  }
  if(!Schema::hasColumn('cuadros_comparativos','aprobado_por')){
   $t->string('aprobado_por')->nullable();
  }
  if(!Schema::hasColumn('cuadros_comparativos','comentario_aprobacion')){
   $t->text('comentario_aprobacion')->nullable();
  }
 });
 // Ampliar ENUM comisiones.estado para futuro
 DB::statement("ALTER TABLE comisiones MODIFY COLUMN estado ENUM('CREADA','CON_PASAJEROS','COTIZADA','CUADRO_BORRADOR','CUADRO_PENDIENTE','PASAJE_COMPRADO','CUADRO_APROBADO','LIQUIDADA','ANULADA') DEFAULT 'CREADA'");
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cuadros_comparativos', function (Blueprint $table) {
            //
        });
    }
};
