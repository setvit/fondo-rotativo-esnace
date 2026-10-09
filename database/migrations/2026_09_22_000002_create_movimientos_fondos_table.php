
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('movimientos_fondos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fondo_reparto_id')->constrained('fondos_repartos');
            $table->foreignId('comision_id')->nullable()->constrained('comisiones')->nullOnDelete();
            $table->foreignId('pasajero_id')->nullable()->constrained('pasajeros')->nullOnDelete();
            $table->string('codigo_comision')->nullable(); // COM-20260921140224
            $table->decimal('valor_pasaje', 10, 2);
            $table->decimal('saldo_anterior', 10, 2);
            $table->decimal('saldo_nuevo', 10, 2);
            $table->boolean('es_sobregiro')->default(false);
            $table->decimal('valor_sobregiro', 10, 2)->default(0);
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->timestamps();
        });

        // No tocar la tabla control_fondo existente, solo agregar campo para fondo global
        // Si no existe, crearla
        if (!Schema::hasTable('control_fondo_global')) {
            Schema::create('control_fondo_global', function (Blueprint $table) {
                $table->id();
                $table->decimal('monto_total_banco', 10,2)->default(10000); // Su cuenta real
                $table->decimal('monto_asignado_total', 10,2)->default(28075.15);
                $table->decimal('saldo_global', 10,2)->default(10000);
                $table->timestamps();
            });
        }
    }
    public function down(): void
    {
        Schema::dropIfExists('movimientos_fondos');
        Schema::dropIfExists('control_fondo_global');
    }
};
