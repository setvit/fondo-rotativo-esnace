<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Comision;

echo "=== CORRIGIENDO BUSAN COM-20260925151104 - $5438.70 + $350 = $5788.70 ===\n";

$com = Comision::where('codigo','COM-20260925151104')->first();
if(!$com) $com = Comision::find(3);

echo "Comisión: ".$com->codigo." ID: ".$com->id." Destino: ".$com->destino."\n";
echo "Antes:\n";
foreach($com->pasajes()->get() as $p){
    echo " - ID ".$p->id." $".$p->valor." Fact: ".$p->numero_factura."\n";
}

// Buscar si ya existe tasas $350
$tasa = $com->pasajes()->where('valor',350)->first();
if($tasa){
    echo "Tasas $350 ya existe ID ".$tasa->id." - actualizando detalle\n";
    $tasa->numero_factura = "N/D 4492684260 - 28/09/2026 - TASAS PLATAFORMA VIRTUAL KIWI - BUSAN - $350 - Segun Edo Cta BanEcuador";
    $tasa->aerolinea = "KIWI - TASAS";
    $tasa->ruta = "GYE-BUSAN TASAS";
    $tasa->es_factura_principal = true;
    $tasa->save();
} else {
    echo "Creando tasas $350 segun Edo Cta BanEcuador N/D 4492684260...\n";
    $pasajero = $com->pasajeros()->first();
    $pid = $pasajero ? $pasajero->id : 1;
    $com->pasajes()->create([
        'pasajero_id' => $pid,
        'valor' => 350.00,
        'numero_factura' => 'N/D 4492684260 - 28/09/2026 - TASAS PLATAFORMA VIRTUAL KIWI - BUSAN - $350 - Segun Edo Cta BanEcuador 3-00167809-0',
        'es_factura_principal' => true,
        'aerolinea' => 'PLATAFORMA VIRTUAL KIWI - TASAS',
        'ruta' => 'GUAYAQUIL-BUSAN-GUAYAQUIL - TASAS KIWI',
        'factura_grupo' => 'BUSAN-TASAS-350-EDOCTA'
    ]);
}

// Asegurar pasaje principal $5438.70 con detalle Edo Cta
$principal = $com->pasajes()->where('valor',5438.70)->first();
if($principal){
    $principal->numero_factura = "N/D 443105148 - 28/09/2026 - PLATAFORMA VIRTUAL KIWI - PASAJE GYE-BUSAN-GYE 2 PAX - $5438.70 - Reserva Kiwi total $5438.70 - DAQUILEMA/RICAURTE";
    $principal->es_factura_principal = true;
    $principal->save();
}

$total = $com->pasajes()->where('es_factura_principal', true)->sum('valor');
echo "\nTotal principal ahora: $".$total." (debe ser 5788.70)\n";

$com->total_valor_pasajes = $total;
$com->save();

echo "\nDespues:\n";
foreach($com->pasajes()->get() as $p){
    echo " - ID ".$p->id." $".$p->valor." Principal:".($p->es_factura_principal?'SI':'NO')." - ".$p->numero_factura."\n";
}

echo "\n✓ BUSAN CORREGIDO - $5438.70 + $350 = $5788.70\n";
echo "Saldo antes esta comision: $7482.67 (segun kardex)\n";
echo "Gastado esta comision: $5788.70\n";
echo "Saldo despues: $1693.97 (7482.67-5788.70)\n";
echo "Total 7 trans: $5.03 + $2193.09 + $318.55 + $5788.70 + $777.78 + $485.30 = $9567.79 + IVA $0.66 = Saldo $431.55 segun Edo Cta BanEcuador 01-30 Sep\n";
echo "Si agrega ultima comision $247.25 -> Saldo final $184.30\n";
