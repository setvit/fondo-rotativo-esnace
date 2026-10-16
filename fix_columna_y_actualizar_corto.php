<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Comision;

echo "=== FIX Columna numero_factura muy corta ===\n";

// 1. Ver tipo actual
try {
    $col = DB::select("SHOW COLUMNS FROM pasajes WHERE Field = 'numero_factura'");
    echo "Columna actual: ".json_encode($col)."\n";
} catch(Exception $e){ echo $e->getMessage()."\n"; }

// 2. Agrandar columna a TEXT para que quepan ETKTs
echo "Agrandando columna numero_factura a TEXT...\n";
try {
    DB::statement("ALTER TABLE pasajes MODIFY numero_factura TEXT NULL");
    echo "✓ Columna agrandada a TEXT OK\n";
} catch(Exception $e){
    echo "Error alter: ".$e->getMessage()."\n";
    try {
        DB::statement("ALTER TABLE pasajes MODIFY numero_factura VARCHAR(1000) NULL");
        echo "✓ Columna agrandada a VARCHAR(1000) OK\n";
    } catch(Exception $e2){
        echo "Error 2: ".$e2->getMessage()."\n";
    }
}

// 3. Ahora actualizar con ETKTs cortos (para no exceder aunque ya es TEXT)
$com = Comision::where('codigo','COM-20260921140224')->first();
if(!$com) $com = Comision::find(1);

$pje = $com->pasajes()->orderBy('valor','desc')->first();
echo "Pasaje ID: ".$pje->id."\n";

// Version CORTA que cabe y no cambia formato entregado a financiero
// Mantiene factura original 001-002-0093834849 + ETKTs
$nuevaFacturaCorta = "001-002-0093834849 | ETKT=FACTURA AVIANCA | ETKT 202 2491970481 IB1012/AV0011/AV8391 | ETKT 20249197048101 AV8380 | ETKT 20249197048102 AV46 | ETKT 20249197048103 IB1009 | GYE-BOG-MAD-ALC";

$pje->numero_factura = $nuevaFacturaCorta;
$pje->save();

echo "✓ Actualizado con version corta OK\n";
echo "Factura: ".$pje->numero_factura."\n";

// 4. Guardar detalle largo en otro campo si existe, o en descripcion
// Intentar guardar detalle completo en factura_path o crear nota
$detalleLargo = "DETALLE COMPLETO ETICKETS - COM-20260921140224 ESPANA ALICANTE:\n".
"Factura original entregada a financiero: 001-002-0093834849\n".
"AVIANCA: Factura es ETICKET segun web oficial\n".
"IDA:\n".
"GYE-BOG AV8380 ETKT 20249197048101 - 26 SEP 02:30 Asiento 7A - COBA LOOR/RAFAEL\n".
"BOG-MAD AV46 ETKT 20249197048102 - 26 SEP 06:45 Asiento 12F\n".
"MAD-ALC IB1009 ETKT 20249197048103 - 27 SEP 06:55 Asiento 7D\n".
"RETORNO:\n".
"ALC-MAD IB1012 ETKT 202 2491970481 - 03OCT 13:40 Asiento 19A Grupo 3\n".
"MAD-BOG AV0011 ETKT 202 2491970481 - 03OCT 17:20 Asiento 18D\n".
"BOG-GYE AV8391 ETKT 202 2491970481 - 03OCT 21:40 Asiento 17A\n".
"Total ETKTs: 202 2491970481 / 20249197048101 / 20249197048102 / 20249197048103\n".
"Pases abordaje adjuntos PASAJES_IDA.pdf y PASAJES_RETORNO.pdf";

if(Schema::hasColumn('pasajes','observaciones')){
    $pje->observaciones = $detalleLargo;
    $pje->save();
    echo "✓ Detalle largo guardado en observaciones\n";
} else {
    // Guardar en archivo
    file_put_contents(storage_path('app/eticket_'.$com->codigo.'.txt'), $detalleLargo);
    echo "✓ Detalle largo guardado en storage/app/eticket_".$com->codigo.".txt\n";
}

echo "\n=== LISTO - Ahora abra: http://localhost:8000/comisiones/".$com->id."/mini-liquidacion/pdf ===\n";
echo "Formato original 001-002-0093834849 se mantiene, solo se agregan ETKTs cortos\n";
