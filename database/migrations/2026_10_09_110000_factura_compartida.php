<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('pasajes', function (Blueprint $table) {
            if(!Schema::hasColumn('pasajes','factura_grupo')){ $table->string('factura_grupo')->nullable()->after('factura_path')->comment('ID grupo factura compartida'); }
            if(!Schema::hasColumn('pasajes','es_factura_principal')){ $table->boolean('es_factura_principal')->default(true)->after('factura_grupo'); }
            if(!Schema::hasColumn('pasajes','informe_path')){ $table->string('informe_path')->nullable()->after('pase_abordo_retorno'); }
            if(!Schema::hasColumn('pasajes','informe_fecha')){ $table->date('informe_fecha')->nullable()->after('informe_path'); }
        });
        Schema::table('comisiones', function (Blueprint $table) {
            if(!Schema::hasColumn('comisiones','informe_path')){ $table->string('informe_path')->nullable()->after('total_valor_pasajes'); }
            if(!Schema::hasColumn('comisiones','informe_fecha')){ $table->date('informe_fecha')->nullable()->after('informe_path'); }
            if(!Schema::hasColumn('comisiones','fecha_liquidacion')){ $table->timestamp('fecha_liquidacion')->nullable()->after('informe_fecha'); }
        });
        // Corregir datos existentes: marcar existentes como principales
        \DB::table('pasajes')->whereNull('es_factura_principal')->update(['es_factura_principal'=>true]);
        \DB::table('pasajes')->whereNull('factura_grupo')->update(['factura_grupo'=> \DB::raw('id')]);
    }
    public function down(): void {
        Schema::table('pasajes', function (Blueprint $table) {
            $table->dropColumn(['factura_grupo','es_factura_principal','informe_path','informe_fecha']);
        });
    }
};
