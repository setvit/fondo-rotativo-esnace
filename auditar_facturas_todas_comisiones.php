<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== AUDITORIA FACTURA_NUMERO EN TODAS LAS COMISIONES ===\n\n";

$pasajes = DB::table('pasajes')
    ->join('comisiones','pasajes.comision_id','=','comisiones.id')
    ->select('comisiones.codigo','comisiones.destino','pasajes.id as pasaje_id','pasajes.valor','pasajes.numero_factura','pasajes.fecha_factura','pasajes.aerolinea','pasajes.factura_path')
    ->orderBy('comisiones.id')
    ->orderBy('pasajes.id')
    ->get();

foreach($pasajes as $p){
    $origen = "OK";
    if(strpos($p->numero_factura,'N/D')!==false && strpos($p->numero_factura,'443105148')!==false) $origen = "BANCO - N/D ESTADO CUENTA - NO ES RESERVA - CORREGIR";
    if(strpos($p->numero_factura,'N/D')!==false && strpos($p->numero_factura,'4492684260')!==false) $origen = "BANCO - N/D ESTADO CUENTA $350 - NO ES RESERVA - CORREGIR";
    if(strpos($p->numero_factura,'001-002')!==false) $origen = "FACTURA SRI FALSA DE PRUEBA - CORREGIR";
    if($p->numero_factura=='847921151' || strpos($p->numero_factura,'847921151')!==false) $origen = "RESERVA KIWI BUSAN - OK ES RESERVA";
    if(strpos($p->numero_factura,'ETKT')!==false || strpos($p->numero_factura,'202')!==false) $origen = "ETKT - OK ES SUSTENTO INTERNACIONAL";
    
    echo $p->codigo." | ".$p->destino." | Pasaje ID ".$p->pasaje_id." | $".$p->valor." | Factura: ".$p->numero_factura." | => ".$origen."\n";
}

echo "\n=== COMISIONES ===\n";
$coms = DB::table('comisiones')->select('id','codigo','destino','total_valor_pasajes')->get();
foreach($coms as $c){
    echo $c->id." ".$c->codigo." ".$c->destino." Total: $".$c->total_valor_pasajes."\n";
}
