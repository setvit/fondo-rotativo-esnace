<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('movimientos_fondos', function (Blueprint $table) {
            if(!Schema::hasColumn('movimientos_fondos','tipo_movimiento')){
                $table->enum('tipo_movimiento', ['COMPRA','DESCUENTO','CARGO_ADICIONAL_KIWI','TASAS_IMPUESTOS','REEMBOLSO'])->default('COMPRA')->after('valor_pasaje');
            }
            if(!Schema::hasColumn('movimientos_fondos','motivo_ajuste')){
                $table->string('motivo_ajuste')->nullable()->after('tipo_movimiento');
                $table->string('plataforma')->nullable()->after('motivo_ajuste');
                $table->decimal('valor_original', 10,2)->nullable()->after('plataforma');
                $table->string('numero_factura_kiwi')->nullable()->after('valor_original');
            }
        });
    }
    public function down(): void {
        // no drop
    }
};
