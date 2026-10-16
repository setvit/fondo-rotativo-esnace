<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== CORRIGIENDO BUSAN - USANDO RESERVA 847921151 COMO SUSTENTO ===\n";

$comId = 3;

$pasajes = DB::table('pasajes')->where('comision_id',$comId)->get();
foreach($pasajes as $p){
    echo "ID ".$p->id." $".$p->valor." Factura actual: ".$p->numero_factura."\n";
}

// Corregir ID 3 $5438.70 - usar reserva 847921151
DB::table('pasajes')->where('id',3)->update([
    'numero_factura' => '847921151 - RESERVA KIWI - GYE-BUSAN-GYE 2 PAX - $5438.70 - Pagado con N/D 443105148 del 28/09/2026 segun Edo Cta BanEcuador 3-00167809-0',
    'aerolinea' => 'KIWI.COM - RESERVA 847921151',
    'ruta' => 'GYE-BUSAN-GYE 2 PAX DAQUILEMA/RICAURTE - Reserva 847921151',
    'factura_path' => DB::table('pasajes')->where('id',3)->value('factura_path'),
    'updated_at' => now()
]);
echo "✓ ID 3 $5438.70 corregido a reserva 847921151\n";

// Corregir ID 12 $350 - usar misma reserva 847921151 desglose tasas
DB::table('pasajes')->where('id',12)->update([
    'numero_factura' => '847921151 - RESERVA KIWI - TASAS PLATAFORMA KIWI BUSAN $350 - Pagado con N/D 4492684260 del 28/09/2026 segun Edo Cta BanEcuador - Total reserva $5438.70 + $350 = $5788.70',
    'aerolinea' => 'KIWI.COM - TASAS - RESERVA 847921151',
    'ruta' => 'GYE-BUSAN-GYE - TASAS PLATAFORMA KIWI - Reserva 847921151',
    'updated_at' => now()
]);
echo "✓ ID 12 $350 corregido a reserva 847921151 - tasas\n";

// Verificar
echo "\nDespues:\n";
foreach(DB::table('pasajes')->where('comision_id',$comId)->get() as $p){
    echo "ID ".$p->id." $".$p->valor." Principal:".$p->es_factura_principal." - ".$p->numero_factura."\n";
}

$total = DB::table('pasajes')->where('comision_id',$comId)->where('es_factura_principal',1)->sum('valor');
echo "\nTotal principal BUSAN: $".$total." (5788.70)\n";
echo "Sustento: Reserva Kiwi 847921151 (reserva_kiwi_busan.pdf que me paso - GYE ↔ PUS Sat 3 Oct - Tue 1 Dec · 2)\n";
echo "Comprobante pago: Edo Cta BanEcuador 28/09 N/D 443105148 $5438.70 y N/D 4492684260 $350\n";
echo "✓ CORREGIDO - AHORA CON SUSTENTO RESERVA, NO N/D BANCO\n";
