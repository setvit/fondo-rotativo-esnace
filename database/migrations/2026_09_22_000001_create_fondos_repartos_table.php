
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fondos_repartos', function (Blueprint $table) {
            $table->id();
            $table->string('reparto', 20); // COMSUB, COOPNA, etc
            $table->string('estructura', 20); // 56-001-530302
            $table->enum('tipo_pasaje', ['INTERIOR','EXTERIOR']); // Nacional vs Internacional
            $table->enum('clasificacion_contable', ['INTERIOR','EXTERIOR'])->default('EXTERIOR');
            $table->decimal('monto_asignado', 10, 2);
            $table->decimal('monto_ejecutado', 10, 2)->default(0);
            $table->decimal('saldo_actual', 10, 2);
            $table->string('descripcion')->nullable();
            $table->timestamps();
            $table->unique(['reparto','estructura'], 'uq_reparto_estructura');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('fondos_repartos');
    }
};
