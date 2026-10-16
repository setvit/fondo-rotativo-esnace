<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Comision;
use Illuminate\Support\Facades\DB;

echo "=== BORRAR factura prueba 001-002-0093834849 y dejar SOLO ETICKETS ===\n";

$com = Comision::where('codigo','COM-20260921140224')->first();
if(!$com) $com = Comision::find(1);

echo "Comisión: ".$com->codigo." ID: ".$com->id."\n";

$pje = $com->pasajes()->orderBy('valor','desc')->first();
echo "Pasaje ID: ".$pje->id." Valor: ".$pje->valor."\n";
echo "Factura actual (prueba): ".$pje->numero_factura."\n";

// Solo ETICKETS - sin factura de prueba
$soloEtickets = "ETICKET = FACTURA (AVIANCA/Iberia) - ETKT 202 2491970481 / ETKT 20249197048101 / ETKT 20249197048102 / ETKT 20249197048103 - IDA GYE-BOG AV8380 / BOG-MAD AV46 / MAD-ALC IB1009 - RETORNO ALC-MAD IB1012 / MAD-BOG AV0011 / BOG-GYE AV8391";

$pje->numero_factura = $soloEtickets;
$pje->es_factura_principal = true;
$pje->valor = 2193.09;
$pje->aerolinea = "AVIANCA / IBERIA";
$pje->ruta = "GYE-ALC";
$pje->save();

echo "\n✓ ACTUALIZADO - Solo ETICKETS, factura prueba eliminada\n";
echo "Nueva factura: ".$pje->numero_factura."\n";

// Verificar en DB
$check = DB::table('pasajes')->where('id', $pje->id)->first();
echo "\nVerificacion DB: ".$check->numero_factura."\n";

echo "\n=== Ahora abra: http://localhost:8000/comisiones/".$com->id."/mini-liquidacion/pdf ===\n";
echo "Solo aparecen ETICKETS, sin 001-002-0093834849\n";
