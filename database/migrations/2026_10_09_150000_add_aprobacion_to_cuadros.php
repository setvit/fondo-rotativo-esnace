<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('cuadros_comparativos', function (Blueprint $table) {
            if(!Schema::hasColumn('cuadros_comparativos','archivo_aprobado_pdf')){
                $table->string('archivo_aprobado_pdf')->nullable()->after('codigo_verificacion');
            }
            if(!Schema::hasColumn('cuadros_comparativos','aprobado_por')){
                $table->string('aprobado_por')->nullable()->after('archivo_aprobado_pdf');
                $table->timestamp('fecha_aprobacion')->nullable()->after('aprobado_por');
                $table->text('comentario_aprobacion')->nullable()->after('fecha_aprobacion');
                $table->unsignedBigInteger('usuario_aprobacion_id')->nullable()->after('comentario_aprobacion');
            }
        });
    }
    public function down(): void {
        Schema::table('cuadros_comparativos', function (Blueprint $table) {
            $table->dropColumn(['archivo_aprobado_pdf','aprobado_por','fecha_aprobacion','comentario_aprobacion','usuario_aprobacion_id']);
        });
    }
};
