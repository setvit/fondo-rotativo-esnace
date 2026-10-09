<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('pasajes', function (Blueprint $table) {
            if(!Schema::hasColumn('pasajes','informe_path')){
                $table->string('informe_path')->nullable()->after('pase_abordo_retorno')->comment('Informe individual por pasajero');
            }
            if(!Schema::hasColumn('pasajes','informe_fecha')){
                $table->date('informe_fecha')->nullable()->after('informe_path');
            }
        });
        Schema::table('comisiones', function (Blueprint $table) {
            if(!Schema::hasColumn('comisiones','informe_path')){
                $table->string('informe_path')->nullable()->after('total_valor_pasajes');
            }
            if(!Schema::hasColumn('comisiones','informe_fecha')){
                $table->date('informe_fecha')->nullable()->after('informe_path');
            }
            if(!Schema::hasColumn('comisiones','fecha_liquidacion')){
                $table->timestamp('fecha_liquidacion')->nullable()->after('informe_fecha');
            }
        });
    }
    public function down(): void {
        Schema::table('pasajes', function (Blueprint $table) {
            $table->dropColumn(['informe_path','informe_fecha']);
        });
    }
};
