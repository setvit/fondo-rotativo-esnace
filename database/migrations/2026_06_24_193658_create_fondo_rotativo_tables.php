<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->string('grado', 20)->after('id');
            $table->string('nombres', 100)->after('grado');
            $table->string('apellidos', 100)->after('nombres');
            $table->enum('rol', ['CUSTODIO','JEFE_LOGISTICA','CONSULTA'])->default('CONSULTA')->after('email');
            $table->boolean('activo')->default(true)->after('password');
            $table->dropColumn('name');
        });

        Schema::create('control_fondo', function (Blueprint $table) {
            $table->id();
            $table->decimal('monto_asignado', 10, 2)->default(10000.00);
            $table->decimal('monto_ejecutado', 10, 2)->default(0.00);
            $table->decimal('saldo_disponible', 10, 2)->default(10000.00);
            $table->decimal('porcentaje_ejecutado', 5, 2)->default(0.00);
            $table->boolean('alerta_60_enviada')->default(false);
            $table->date('fecha_ultima_reposicion')->nullable();
            $table->timestamps();
        });
        DB::table('control_fondo')->insert(['id' => 1, 'created_at' => now(), 'updated_at' => now()]);

        Schema::create('comisiones', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50)->unique();
            $table->string('destino', 100);
            $table->enum('tipo', ['NACIONAL','INTERNACIONAL']);
            $table->date('fecha_salida');
            $table->date('fecha_retorno');
            $table->enum('estado', ['CREADA','CON_PASAJEROS','COTIZANDO','CUADRO_BORRADOR','EN_LOGISTICA','RECHAZADA','APROBADA','LISTA_COMPRA','COMPRADA','EN_EJECUCION','EN_CIERRE','DOCUMENTADA','LIQUIDADA','CERRADA'])->default('CREADA');
            $table->enum('estado_documental', ['INCOMPLETO','COMPLETO'])->default('INCOMPLETO');
            $table->decimal('total_valor_pasajes', 10, 2)->default(0.00);
            $table->boolean('puede_comprar')->default(false);
            $table->foreignId('custodio_id')->constrained('users');
            $table->timestamps();
        });

        Schema::create('pasajeros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comision_id')->constrained('comisiones')->onDelete('cascade');
            $table->string('nombre', 150);
            $table->string('cedula', 10);
            $table->string('cargo', 150);
            $table->enum('reparto', ['COOPNA','CODESC','CUINMA','COAVNA']);
            $table->timestamps();
        });

        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comision_id')->constrained('comisiones')->onDelete('cascade');
            $table->string('nro_proforma', 50);
            $table->string('ruc_proveedor', 13);
            $table->string('nombre_proveedor', 150);
            $table->enum('tipo_proveedor', ['AEROLINEA','AGENCIA']);
            $table->text('detalle_pasajes');
            $table->decimal('valor_total', 10, 2);
            $table->date('fecha_cotizacion');
            $table->string('archivo_proforma', 255);
            $table->foreignId('registrado_por')->constrained('users');
            $table->timestamps();
        });

        Schema::create('cuadros_comparativos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comision_id')->unique()->constrained('comisiones')->onDelete('cascade');
            $table->enum('estado', ['BORRADOR','ENVIADO_LOGISTICA','APROBADO','RECHAZADO'])->default('BORRADOR');
            $table->foreignId('cotizacion_ganadora_id')->nullable()->constrained('cotizaciones');
            $table->foreignId('jefe_logistica_id')->nullable()->constrained('users');
            $table->string('revisado_por', 150)->nullable();
            $table->datetime('fecha_revision')->nullable();
            $table->text('sumilla')->nullable();
            $table->text('motivo_rechazo')->nullable();
            $table->timestamps();
        });

        Schema::create('pasajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comision_id')->constrained('comisiones')->onDelete('cascade');
            $table->foreignId('pasajero_id')->constrained('pasajeros')->onDelete('cascade');
            $table->string('ruta', 200);
            $table->decimal('valor', 10, 2);
            $table->string('nro_factura', 50);
            $table->string('ruc_factura', 13);
            $table->date('fecha_compra');
            $table->string('aerolinea', 100);
            $table->enum('clase', ['ECONOMICA'])->default('ECONOMICA');
            $table->boolean('incluye_maleta_adicional')->default(false);
            $table->enum('metodo_pago', ['TRANSFERENCIA','TARJETA_CREDITO','TARJETA_DEBITO']);
            $table->string('ruta_factura', 255);
            $table->string('ruta_pasaje', 255);
            $table->string('ruta_checkin', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comision_id')->constrained('comisiones')->onDelete('cascade');
            $table->foreignId('pasajero_id')->nullable()->constrained('pasajeros')->onDelete('cascade');
            $table->enum('categoria', ['INICIO','CIERRE','OTRO']);
            $table->string('tipo', 100);
            $table->string('archivo', 255);
            $table->datetime('fecha_subida')->useCurrent();
            $table->timestamps();
        });

        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->enum('tipo', ['CUADRO_PENDIENTE','CUADRO_APROBADO','CUADRO_RECHAZADO','ALERTA_60']);
            $table->text('mensaje');
            $table->boolean('leida')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('notificaciones');
        Schema::dropIfExists('documentos');
        Schema::dropIfExists('pasajes');
        Schema::dropIfExists('cuadros_comparativos');
        Schema::dropIfExists('cotizaciones');
        Schema::dropIfExists('pasajeros');
        Schema::dropIfExists('comisiones');
        Schema::dropIfExists('control_fondo');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['grado', 'nombres', 'apellidos', 'rol', 'activo']);
            $table->string('name')->after('id');
        });
    }
};
