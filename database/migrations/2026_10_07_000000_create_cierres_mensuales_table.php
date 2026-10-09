<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('cierres_mensuales')) {
            Schema::create('cierres_mensuales', function (Blueprint $table) {
                $table->id();
                $table->string('periodo')->comment('SEPTIEMBRE 2026');
                $table->string('periodo_codigo')->unique()->comment('ESNACE-COOPNA-FR-2026-09');
                $table->string('codigo')->comment('ESNACE-COOPNA-FR-2026-09');
                $table->date('fecha_cierre');
                $table->decimal('saldo_inicial_banco', 10, 2)->default(10000.00);
                $table->decimal('total_debitos_banco', 10, 2)->comment('Total comisiones 9563.42');
                $table->decimal('saldo_final_banco', 10, 2)->comment('431.55 BanEcuador');
                $table->decimal('comision_bancaria', 10, 2)->default(4.37)->comment('4.37 + IVA 0.66 = 5.03');
                $table->decimal('valor_a_reponer', 10, 2)->comment('9568.45 con IVA / 9563.42 sin');
                $table->integer('num_transacciones')->default(7)->comment('7 transacciones BanEcuador');
                $table->json('detalle_transacciones')->nullable()->comment('Detalle 7 transacciones BanEcuador con BUSAN desglose');
                $table->string('cuenta_bancaria')->default('3-00167809-0 FR-ESTACION NAVAL CENTRO - BANECUADOR');
                $table->unsignedBigInteger('usuario_id')->nullable();
                $table->text('observaciones')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('cierres_mensuales');
    }
};
