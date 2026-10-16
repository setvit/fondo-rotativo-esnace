<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Comision;

echo "=== Actualizando ETICKET = FACTURA para COM-20260921140224 ===\n";

$com = Comision::where('codigo','COM-20260921140224')->first();
if(!$com){
    echo "No encontrado COM-20260921140224, usando ID 1\n";
    $com = Comision::find(1);
}
if(!$com){
    echo "No hay comisiones\n";
    exit(1);
}

echo "Comisión: ".$com->codigo." ID: ".$com->id." Destino: ".$com->destino."\n";
echo "Total: ".$com->total_valor_pasajes."\n";

$pasajes = $com->pasajes()->get();
echo "Pasajes encontrados: ".$pasajes->count()."\n";
foreach($pasajes as $pp){
    echo " - ID ".$pp->id." Valor ".$pp->valor." Principal: ".($pp->es_factura_principal? 'SI' : 'NO')." Factura: ".substr($pp->numero_factura ?? '',0,50)."\n";
}

$pje = $com->pasajes()->where('es_factura_principal', true)->first();
if(!$pje){
    $pje = $com->pasajes()->where('es_factura_principal', 1)->first();
}
if(!$pje){
    $pje = $com->pasajes()->orderBy('valor','desc')->first();
}
if(!$pje){
    echo "No hay pasaje, creando uno con valor real...\n";
    $pje = $com->pasajes()->create([
        'pasajero_id' => $com->pasajeros()->first()->id ?? 1,
        'valor' => 2193.09,
        'numero_factura' => 'TEMP',
        'es_factura_principal' => true,
        'aerolinea' => 'AVIANCA/IBERIA',
        'ruta' => 'GYE-ALC'
    ]);
}

echo "\nPasaje seleccionado ID ".$pje->id."\n";

$nuevaFactura = "ETICKET = FACTURA AVIANCA - IBERIA\n".
"IDA:\n".
"GYE-BOG AV8380 ETKT 20249197048101 - 26 SEP 02:30 Asiento 7A\n".
"BOG-MAD AV46 ETKT 20249197048102 - 26 SEP 06:45 Asiento 12F\n".
"MAD-ALC IB1009 ETKT 20249197048103 - 27 SEP 06:55 Asiento 7D\n".
"RETORNO:\n".
"ALC-MAD IB1012 ETKT 202 2491970481 - 03OCT 13:40 Asiento 19A Grupo 3\n".
"MAD-BOG AV0011 ETKT 202 2491970481 - 03OCT 17:20 Asiento 18D\n".
"BOG-GYE AV8391 ETKT 202 2491970481 - 03OCT 21:40 Asiento 17A\n".
"Total ETKT: 202 2491970481 / 20249197048101 / 20249197048102 / 20249197048103\n".
"AVIANCA: Factura es ETICKET según web oficial - www.avianca.com";

$pje->numero_factura = $nuevaFactura;
$pje->es_factura_principal = true;
$pje->valor = 2193.09;
$pje->aerolinea = "AVIANCA/IBERIA";
$pje->ruta = "GYE-ALC-ESPANA";
$pje->save();

echo "\n✓ ACTUALIZADO OK\n";
echo "Nueva factura:\n".$pje->numero_factura."\n";
echo "\n=== Ahora abra kardex PDF: http://localhost:8000/comisiones/".$com->id."/mini-liquidacion/pdf ===\n";
