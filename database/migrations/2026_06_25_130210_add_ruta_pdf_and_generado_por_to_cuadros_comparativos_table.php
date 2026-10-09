<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cuadros_comparativos', function (Blueprint $table) {
            $table->string('ruta_pdf')->nullable()->after('sumilla');
            $table->foreignId('generado_por')->nullable()->constrained('users')->after('hash_documento');
        });
    }

    public function down(): void
    {
        Schema::table('cuadros_comparativos', function (Blueprint $table) {
            $table->dropForeign(['generado_por']);
            $table->dropColumn(['ruta_pdf', 'generado_por']);
        });
    }
};