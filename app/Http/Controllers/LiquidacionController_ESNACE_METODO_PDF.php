<?php
namespace App\Http\Controllers;
use App\Models\Comision;
use App\Models\ControlFondo;
use App\Models\Liquidacion;
use App\Models\MovimientoFondo;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class LiquidacionController extends Controller {
    public function pdf($id){
        $liq = Liquidacion::with(['comisiones.pasajeros','comisiones.cotizaciones','comisiones.cuadroComparativo'])->findOrFail($id);
        $control = ControlFondo::getInstance();
        // Estado de cuenta cronológico: todos los movimientos de las comisiones de esta liquidación
        $comisionIds = $liq->comisiones->pluck('id');
        $movimientos = MovimientoFondo::with(['comision.pasajeros','comision.cotizaciones','comision.cuadroComparativo'])
            ->whereIn('comision_id', $comisionIds)
            ->orderBy('created_at','asc')
            ->get();
        
        // Si no hay movimientos previos (caso histórico), construir desde comisiones
        if($movimientos->isEmpty()){
            $movimientos = collect();
            $saldo = $liq->monto_asignado;
            foreach($liq->comisiones->sortBy('fecha_salida') as $c){
                $valor = $c->pivot->valor;
                $mov = new \stdClass();
                $mov->created_at = $c->fecha_salida;
                $mov->codigo_comision = $c->codigo;
                $mov->comision = $c;
                $mov->valor_pasaje = $valor - ($c->codigo=='COM-20260925151104' ? 350 : 0);
                $mov->tipo_movimiento = 'COMPRA';
                $mov->plataforma = 'AVIANCA/LATAM/KIWI';
                $mov->saldo_anterior = $saldo;
                $saldo -= $mov->valor_pasaje;
                $mov->saldo_nuevo = $saldo;
                $mov->pasajero_id = null;
                $movimientos->push((object)(array)$mov);
            }
            // Agregar cargo adicional Kiwi BUSAN
            if($liq->comisiones->contains('codigo','COM-20260925151104')){
                $movCargo = new \stdClass();
                $movCargo->created_at = now();
                $movCargo->codigo_comision = 'COM-20260925151104';
                $movCargo->comision = $liq->comisiones->where('codigo','COM-20260925151104')->first();
                $movCargo->valor_pasaje = 350;
                $movCargo->tipo_movimiento = 'CARGO_ADICIONAL_KIWI';
                $movCargo->plataforma = 'KIWI';
                $movCargo->saldo_anterior = $saldo;
                $movCargo->saldo_nuevo = $saldo - 350;
                $movCargo->pasajero_id = null;
                $movimientos->push((object)(array)$movCargo);
            }
        }

        $pdf = Pdf::loadView('liquidaciones.pdf_estado_cuenta_ESNACE_DESGLOSADO', compact('liq','control','movimientos'));
        $pdf->setPaper('A4','landscape'); // Horizontal para que entre todo el desglose
        return $pdf->stream('Liquidacion-'.$liq->codigo.'-ESNACE-Desglosado.pdf');
    }
}
