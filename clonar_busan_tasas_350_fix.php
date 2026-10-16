<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Comision;
use Illuminate\Support\Facades\DB;

echo "=== CLONANDO PASAJE EXISTENTE PARA $350 TASAS KIWI ===\n";

$com = Comision::where('codigo','COM-20260925151104')->first();
if(!$com) $com = Comision::find(3);

echo "Comisión: ".$com->codigo." ID: ".$com->id."\n";

$orig = DB::table('pasajes')->where('comision_id', $com->id)->where('valor', 5438.70)->first();
if(!$orig){
    $orig = DB::table('pasajes')->where('comision_id', $com->id)->first();
}
echo "Original ID ".$orig->id." valor $".$orig->valor."\n";
echo "factura_path: ".$orig->factura_path."\n";
echo "tipo_comprobante: ".$orig->tipo_comprobante."\n";
echo "tipo_pago: ".$orig->tipo_pago."\n";
echo "proveedor: ".$orig->proveedor."\n";
echo "estado: ".$orig->estado."\n";
echo "numero_factura: ".$orig->numero_factura."\n";

// Borrar tasas $350 si existe para recrear
DB::table('pasajes')->where('comision_id',$com->id)->where('valor',350)->delete();

// Clonar con $350
$nuevo = (array)$orig;
unset($nuevo['id']);
$nuevo['valor'] = 350.00;
$nuevo['numero_factura'] = 'N/D 4492684260 - 28/09/2026 - TASAS KIWI BUSAN $350 - Segun Edo Cta BanEcuador 3-00167809-0 - Total $5438.70 + $350 = $5788.70 BUSAN';
$nuevo['aerolinea'] = 'PLATAFORMA VIRTUAL KIWI - TASAS - N/D 4492684260';
$nuevo['ruta'] = 'GYE-BUSAN-GUAYAQUIL - TASAS PLATAFORMA KIWI';
$nuevo['fecha_factura'] = '2026-09-28';
$nuevo['factura_path'] = $orig->factura_path; // usar mismo path o dejar vacio si existe
$nuevo['es_factura_principal'] = 1;
$nuevo['created_at'] = now();
$nuevo['updated_at'] = now();

try {
    $newId = DB::table('pasajes')->insertGetId($nuevo);
    echo "✓ Creado tasas $350 ID ".$newId." clonando original OK\n";
} catch(Exception $e){
    echo "Error insert clon: ".$e->getMessage()."\n";
    // Si factura_path no puede ser duplicado, poner path generico
    $nuevo['factura_path'] = 'facturas/kiwi_busan_tasas_350.pdf';
    $newId = DB::table('pasajes')->insertGetId($nuevo);
    echo "✓ Creado con path generico ID ".$newId." OK\n";
}

// Actualizar principal $5438.70 con detalle Edo Cta
DB::table('pasajes')->where('id',$orig->id)->update([
    'numero_factura' => 'N/D 443105148 - 28/09/2026 - KIWI PASAJE GYE-BUSAN-GYE 2 PAX $5438.70 - Reserva Kiwi $5438.70',
    'fecha_factura' => '2026-09-28',
    'updated_at' => now()
]);
echo "✓ Principal $5438.70 actualizado con N/D 443105148\n";

$total = DB::table('pasajes')->where('comision_id',$com->id)->where('es_factura_principal',1)->sum('valor');
echo "\nTotal principal: $".$total." (debe ser 5788.70 = 5438.70 + 350)\n";

$com->total_valor_pasajes = $total;
$com->save();

echo "\nPasajes despues:\n";
foreach(DB::table('pasajes')->where('comision_id',$com->id)->get() as $p){
    echo " - ID ".$p->id." $".$p->valor." Principal:".$p->es_factura_principal." - ".$p->numero_factura." - fecha:".$p->fecha_factura." path:".$p->factura_path."\n";
}

echo "\n=== BUSAN $5438.70 + $350 = $5788.70 CORREGIDO ===\n";
echo "Total 7 trans segun Edo Cta 01-30 Sep 2026: $9567.79 - Saldo $431.55\n";
echo "Con ultima $247.25 -> Saldo $184.30\n";
