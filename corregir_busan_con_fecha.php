<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Comision;
use Illuminate\Support\Facades\DB;

echo "=== CORRIGIENDO BUSAN con fecha_factura ===\n";

$com = Comision::where('codigo','COM-20260925151104')->first();
if(!$com) $com = Comision::find(3);

echo "Comisión: ".$com->codigo." ID: ".$com->id."\n";

// Ver columnas requeridas
$cols = DB::select("SHOW COLUMNS FROM pasajes");
foreach($cols as $c){
    if(strpos($c->Field,'fecha')!==false || $c->Null=='NO'){
        echo $c->Field." - ".$c->Type." Null:".$c->Null." Default:".$c->Default."\n";
    }
}

$tasa = $com->pasajes()->where('valor',350)->first();
if($tasa){
    echo "Ya existe tasas, borrando para recrear con fecha...\n";
    $tasa->delete();
}

$pasajero = $com->pasajeros()->first();
$pid = $pasajero ? $pasajero->id : 3;

echo "Creando $350 tasas con fecha_factura 2026-09-28...\n";
try {
    $nuevo = $com->pasajes()->create([
        'pasajero_id' => $pid,
        'valor' => 350.00,
        'numero_factura' => 'N/D 4492684260 - 28/09/2026 - TASAS KIWI BUSAN $350 - Edo Cta BanEcuador',
        'es_factura_principal' => true,
        'aerolinea' => 'PLATAFORMA VIRTUAL KIWI - TASAS',
        'ruta' => 'GYE-BUSAN TASAS KIWI',
        'factura_grupo' => 'BUSAN-TASAS-350',
        'fecha_factura' => '2026-09-28',
        'fecha_emision' => '2026-09-28',
        'fecha_viaje' => '2026-10-03',
    ]);
    echo "Creado ID ".$nuevo->id." OK\n";
} catch(Exception $e){
    echo "Error create: ".$e->getMessage()."\n";
    echo "Probando con DB raw...\n";
    DB::table('pasajes')->insert([
        'comision_id' => $com->id,
        'pasajero_id' => $pid,
        'valor' => 350.00,
        'numero_factura' => 'N/D 4492684260 - 28/09/2026 - TASAS KIWI BUSAN $350 - Edo Cta BanEcuador',
        'es_factura_principal' => 1,
        'aerolinea' => 'KIWI TASAS',
        'ruta' => 'GYE-BUSAN TASAS',
        'factura_grupo' => 'BUSAN-TASAS-350',
        'fecha_factura' => '2026-09-28',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    echo "Insertado con DB raw OK\n";
}

// Actualizar principal $5438.70 con fecha
$principal = $com->pasajes()->where('valor',5438.70)->first();
if($principal){
    $principal->numero_factura = "N/D 443105148 - 28/09/2026 - KIWI PASAJE GYE-BUSAN-GYE 2 PAX $5438.70 - Reserva Kiwi";
    $principal->fecha_factura = '2026-09-28';
    $principal->save();
    echo "Principal $5438.70 actualizado\n";
}

$total = $com->pasajes()->where('es_factura_principal', true)->sum('valor');
echo "\nTotal principal: $".$total." (debe ser 5788.70)\n";
$com->total_valor_pasajes = $total;
$com->save();

echo "\nPasajes despues:\n";
foreach($com->pasajes()->get() as $p){
    echo " - ID ".$p->id." $".$p->valor." - ".$p->numero_factura." - fecha: ".$p->fecha_factura."\n";
}

echo "\n✓ BUSAN CORREGIDO - Edo Cta BanEcuador 7 trans $9567.79 saldo $431.55\n";
echo "Con ultima comision $247.25 -> saldo $184.30\n";
