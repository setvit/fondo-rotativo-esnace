<?php
// REGISTRAR CARGO ADICIONAL KIWI BUSAN - EJECUTAR CON tinker o controlador
// COM-20260925151104 GUAYAQUIL-BUSAN-GUAYAQUIL $5438.70 + $350 = $5788.70

use App\Models\Comision;
use App\Models\ControlFondo;
use App\Models\FondoReparto;
use App\Models\MovimientoFondo;
use Illuminate\Support\Facades\DB;

$comision = Comision::where('codigo','COM-20260925151104')->first();
if(!$comision){ echo "No existe COM-20260925151104\n"; return; }

$control = ControlFondo::getInstance(); // 7950.34 / 2049.66 / 79.50%
$fondo = FondoReparto::first();

$cargo = 350.00;
$saldoAnterior = $control->saldo_disponible; // 2049.66

DB::beginTransaction();
try {
    MovimientoFondo::create([
        'fondo_reparto_id' => $fondo->id,
        'comision_id' => $comision->id,
        'codigo_comision' => $comision->codigo,
        'valor_pasaje' => $cargo, // CARGO ADICIONAL POSITIVO
        'saldo_anterior' => $saldoAnterior,
        'saldo_nuevo' => $saldoAnterior - $cargo,
        'es_sobregiro' => ($saldoAnterior - $cargo) < 0,
        'valor_sobregiro' => ($saldoAnterior - $cargo) < 0 ? abs($saldoAnterior - $cargo) : 0,
        'tipo_movimiento' => 'CARGO_ADICIONAL_KIWI',
        'motivo_ajuste' => 'Cobro adicional posterior plataforma KIWI por tasas e impuestos administrativos no incluidos en compra inicial. Ruta GUAYAQUIL-BUSAN-GUAYAQUIL. Pasaje ya realizado.',
        'plataforma' => 'KIWI',
        'valor_original' => $comision->total_valor_pasajes,
        'numero_factura_kiwi' => 'KIWI-FACT-'.now()->format('Ymd'),
        'user_id' => 1 // ID de TUSA VITAR
    ]);

    // Actualizar ControlFondo
    $control->monto_ejecutado += $cargo; // 7950.34 + 350 = 8300.34
    $control->saldo_disponible -= $cargo; // 2049.66 - 350 = 1699.66
    $control->porcentaje_ejecutado = ($control->monto_ejecutado / $control->monto_asignado)*100; // 83.0034%
    $control->save();

    // Actualizar comisión BUSAN
    $comision->total_valor_pasajes += $cargo; // 5438.70 + 350 = 5788.70
    $comision->save();

    DB::commit();
    echo "✅ Cargo Kiwi $350 registrado para BUSAN\n";
    echo "Comisión BUSAN ahora: $".$comision->total_valor_pasajes."\n";
    echo "Control Fondo: Ejecutado $".$control->monto_ejecutado." | Saldo $".$control->saldo_disponible." | ".$control->porcentaje_ejecutado."%\n";
} catch(\Exception $e){
    DB::rollBack();
    echo "Error: ".$e->getMessage()."\n";
}
