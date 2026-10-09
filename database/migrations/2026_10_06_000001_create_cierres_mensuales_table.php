<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if(!Schema::hasTable('cierres_mensuales')){
            Schema::create('cierres_mensuales', function (Blueprint $table) {
                $table->id();
                $table->string('codigo',100)->unique();
                $table->string('periodo',50);
                $table->string('periodo_codigo',20);
                $table->date('fecha_cierre');
                $table->decimal('fondo_asignado',10,2)->default(10000);
                $table->decimal('fondo_teorico',10,2)->default(10000);
                $table->decimal('saldo_inicial_banco',10,2)->default(0);
                $table->decimal('saldo_final_banco',10,2)->default(0);
                $table->decimal('comision_bancaria',10,2)->default(0);
                $table->decimal('total_debitos_banco',10,2)->default(0);
                $table->decimal('total_creditos_banco',10,2)->default(0);
                $table->decimal('total_ejecutado',10,2)->default(0);
                $table->decimal('total_liquidadas',10,2)->default(0);
                $table->decimal('total_por_liquidar',10,2)->default(0);
                $table->decimal('saldo_disponible',10,2)->default(0);
                $table->decimal('saldo_final_conciliado',10,2)->default(0);
                $table->decimal('valor_a_reponer',10,2)->default(0);
                $table->integer('cantidad_liquidadas')->default(0);
                $table->integer('cantidad_por_liquidar')->default(0);
                $table->foreignId('administrador_id')->nullable()->constrained('users')->onDelete('set null');
                $table->string('estado_cuenta_path',255)->nullable();
                $table->string('pdf_path',255)->nullable();
                $table->enum('estado',['CERRADO','REPOSICION_SOLICITADA','REPOSICION_RECIBIDA'])->default('CERRADO');
                $table->text('observaciones')->nullable();
                $table->timestamps();
            });
        } else {
            Schema::table('cierres_mensuales', function (Blueprint $table) {
                if(!Schema::hasColumn('cierres_mensuales','saldo_inicial_banco')) $table->decimal('saldo_inicial_banco',10,2)->default(0)->after('fondo_asignado');
                if(!Schema::hasColumn('cierres_mensuales','saldo_final_banco')) $table->decimal('saldo_final_banco',10,2)->default(0)->after('saldo_inicial_banco');
                if(!Schema::hasColumn('cierres_mensuales','comision_bancaria')) $table->decimal('comision_bancaria',10,2)->default(0)->after('saldo_final_banco');
                if(!Schema::hasColumn('cierres_mensuales','total_debitos_banco')) $table->decimal('total_debitos_banco',10,2)->default(0)->after('comision_bancaria');
                if(!Schema::hasColumn('cierres_mensuales','fondo_teorico')) $table->decimal('fondo_teorico',10,2)->default(10000)->after('fondo_asignado');
                if(!Schema::hasColumn('cierres_mensuales','saldo_final_conciliado')) $table->decimal('saldo_final_conciliado',10,2)->default(0)->after('saldo_disponible');
                if(!Schema::hasColumn('cierres_mensuales','estado_cuenta_path')) $table->string('estado_cuenta_path',255)->nullable()->after('pdf_path');
            });
        }
    }
    public function down(): void { Schema::dropIfExists('cierres_mensuales'); }
};
