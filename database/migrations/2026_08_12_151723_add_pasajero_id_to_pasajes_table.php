<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('pasajes', function (Blueprint $table) {
            $table->foreignId('pasajero_id')->nullable()->after('comision_id')->constrained('pasajeros')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::table('pasajes', function (Blueprint $table) {
            $table->dropForeign(['pasajero_id']);
            $table->dropColumn('pasajero_id');
        });
    }
};
