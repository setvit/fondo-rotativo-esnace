<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Solo agrega campos faltantes a pasajes, sin borrar nada
        Schema::table('pasajes', function (Blueprint $table) {
            if(!Schema::hasColumn('pasajes','tipo_comprobante')){
                $table->enum('tipo_comprobante',['FACTURA_SRI','COMPROBANTE_EXTERIOR'])->default('FACTURA_SRI')->after('factura_path');
            }
            if(!Schema::hasColumn('pasajes','tipo_pago')){
                $table->enum('tipo_pago',['TARJETA_DEBITO_BANECUADOR','TRANSFERENCIA','EFECTIVO'])->default('TARJETA_DEBITO_BANECUADOR')->after('tipo_comprobante');
            }
            if(!Schema::hasColumn('pasajes','numero_voucher')){
                $table->string('numero_voucher',50)->nullable()->after('tipo_pago')->comment('Voucher tarjeta BanEcuador');
            }
            if(!Schema::hasColumn('pasajes','correo_notificacion')){
                $table->string('correo_notificacion',100)->nullable()->after('numero_voucher')->comment('Correo institucional notificacion BanEcuador');
            }
            if(!Schema::hasColumn('pasajes','proveedor')){
                $table->string('proveedor',100)->default('KIWI.COM')->after('correo_notificacion');
            }
            if(!Schema::hasColumn('pasajes','pase_abordo_ida')){
                $table->string('pase_abordo_ida',255)->nullable()->after('proveedor');
            }
            if(!Schema::hasColumn('pasajes','pase_abordo_retorno')){
                $table->string('pase_abordo_retorno',255)->nullable()->after('pase_abordo_ida');
            }
        });
    }
    public function down(): void {
        Schema::table('pasajes', function (Blueprint $table) {
            $table->dropColumn(['tipo_comprobante','tipo_pago','numero_voucher','correo_notificacion','proveedor','pase_abordo_ida','pase_abordo_retorno']);
        });
    }
};
