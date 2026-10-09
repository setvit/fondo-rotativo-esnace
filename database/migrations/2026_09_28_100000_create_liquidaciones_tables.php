<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('liquidaciones', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique(); // LIQ-20260928-GCSN1N
            $table->decimal('monto_asignado', 10,2)->default(10000);
            $table->decimal('monto_ejecutado_liquidacion', 10,2); // 7950.34
            $table->decimal('saldo_disponible_al_corte', 10,2);
            $table->decimal('porcentaje_ejecutado', 5,2); // 79.50
            $table->integer('cantidad_comisiones');
            $table->enum('estado', ['BORRADOR','ENVIADA','APROBADA','REPOSICIONADA'])->default('BORRADOR');
            $table->date('fecha_liquidacion');
            $table->date('fecha_reposicion')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->text('observaciones')->nullable();
            $table->string('administrador')->default('TNFG-IG-IF TUSA VITAR EDUARDO');
            $table->string('aprobador')->default('TNNV-AB LOPEZ LUIS DAVID');
            $table->timestamps();
        });

        Schema::create('liquidacion_comision', function (Blueprint $table) {
            $table->id();
            $table->foreignId('liquidacion_id')->constrained('liquidaciones')->onDelete('cascade');
            $table->foreignId('comision_id')->constrained('comisiones')->onDelete('cascade');
            $table->decimal('valor', 10,2);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('liquidacion_comision');
        Schema::dropIfExists('liquidaciones');
    }
};
