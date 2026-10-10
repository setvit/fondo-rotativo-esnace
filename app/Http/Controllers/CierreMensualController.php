<?php
namespace App\Http\Controllers;
use App\Models\CierreMensual;
use App\Models\Comision;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CierreMensualController extends Controller
{
    public function index(){
        $cierres = CierreMensual::orderBy('fecha_cierre','desc')->get();
        // Para preview del formulario
        $ultimo = $cierres->first();
        $saldoSugerido = $ultimo ? $ultimo->saldo_final_banco : 9999.34;
        return view('cierres.index', compact('cierres','saldoSugerido'));
    }
    
    public function store(Request $request){
        $request->validate([
            'periodo' => 'required|string',
            'mes' => 'required|integer|min:1|max:12',
            'anio' => 'required|integer|min:2024|max:2030',
            'fecha_cierre' => 'required|date',
            'cuenta_bancaria' => 'required|string',
            'saldo_inicial_banco' => 'required|numeric|min:0',
            'comision_bancaria' => 'nullable|numeric|min:0',
            'transacciones' => 'required|array|min:1',
            'transacciones.*.fecha' => 'required|date',
            'transacciones.*.descripcion' => 'required|string|max:500',
            'transacciones.*.referencia' => 'required|string|max:100',
            'transacciones.*.debito' => 'required|numeric|min:0',
        ]);

        $transacciones = $request->transacciones;
        // Ordenar por fecha asc como BanEcuador
        usort($transacciones, fn($a,$b) => strtotime($a['fecha']) <=> strtotime($b['fecha']));

        $totalDebitos = collect($transacciones)->sum('debito');
        $totalDebitosSinTarjeta = $totalDebitos - ($request->comision_bancaria ?? 0);
        
        $saldoFinal = $request->saldo_inicial_banco - $totalDebitos;
        $valorReponer = 10000 - $saldoFinal; // Fondo teórico 10k - saldo final
        $valorReponerSoloComisiones = $valorReponer - ($request->comision_bancaria ?? 0);

        // Código automático ESNACE-COOPNA-FR-2026-09
        $codigo = 'ESNACE-COOPNA-FR-'.$request->anio.'-'.str_pad($request->mes,2,'0',STR_PAD_LEFT);

        // Evitar duplicado - si ya existe actualizar
        $cierre = CierreMensual::updateOrCreate(
            ['codigo' => $codigo],
            [
                'periodo' => strtoupper($request->periodo),
                'periodo_codigo' => $codigo,
                'fecha_cierre' => $request->fecha_cierre,
                'cuenta_bancaria' => $request->cuenta_bancaria,
                'fondo_asignado' => 10000,
                'fondo_teorico' => 10000,
                'saldo_inicial_banco' => $request->saldo_inicial_banco,
                'total_debitos_banco' => $totalDebitos,
                'saldo_final_banco' => $saldoFinal,
                'saldo_final_conciliado' => $saldoFinal,
                'comision_bancaria' => $request->comision_bancaria ?? 5.03,
                'valor_a_reponer' => $valorReponer,
                'total_ejecutado' => $totalDebitosSinTarjeta,
                'total_liquidadas' => 0, // se calcula en show
                'total_por_liquidar' => 0,
                'cantidad_liquidadas' => 0,
                'cantidad_por_liquidar' => 0,
                'num_transacciones' => count($transacciones),
                'detalle_transacciones' => $transacciones,
                'usuario_id' => auth()->id() ?? 1,
                'observaciones' => $request->observaciones ?? 'Cierre conciliado exacto BanEcuador - '.count($transacciones).' transacciones - $'.number_format($totalDebitos,2).' - Saldo $'.number_format($saldoFinal,2),
                'estado' => 'CERRADO'
            ]
        );

        return redirect()->to('/cierres-mensuales/'.$cierre->id)->with('success','✅ Cierre '.$codigo.' generado - '.count($transacciones).' transacciones - Total $'.number_format($totalDebitos,2).' - Saldo Final $'.number_format($saldoFinal,2).' - A Reponer $'.number_format($valorReponer,2));
    }
    
    public function show($id){ 
        $cierre = CierreMensual::findOrFail($id);
        // Comisiones para este periodo (si existen)
        try {
            $liquidadas = Comision::where('estado','LIQUIDADA')
                ->whereMonth('fecha_liquidacion', $cierre->fecha_cierre->month ?? 9)
                ->whereYear('fecha_liquidacion', $cierre->fecha_cierre->year ?? 2026)
                ->get();
            $porLiquidar = Comision::whereIn('estado',['FACTURADO','POR_LIQUIDAR','CUADRO_APROBADO','APROBADO'])
                ->whereMonth('created_at', $cierre->fecha_cierre->month ?? 9)
                ->get();
        } catch(\Exception $e){
            $liquidadas = collect([]);
            $porLiquidar = collect([]);
        }
        return view('cierres.show', compact('cierre','liquidadas','porLiquidar')); 
    }
    
    public function pdf($id){ 
        $cierre = CierreMensual::findOrFail($id);
        try {
            $liquidadas = Comision::where('estado','LIQUIDADA')->take(5)->get();
            $porLiquidar = Comision::whereIn('estado',['FACTURADO','POR_LIQUIDAR'])->take(5)->get();
        } catch(\Exception $e){
            $liquidadas = collect([]);
            $porLiquidar = collect([]);
        }
        $pdf = Pdf::loadView('cierres.pdf_oficial', compact('cierre','liquidadas','porLiquidar'))->setPaper('a4','portrait');
        return $pdf->stream('Cierre_Mensual_'.$cierre->codigo.'_Conciliado_BanEcuador_'.number_format($cierre->saldo_final_banco,2).'.pdf');
    }

    public function destroy($id){
        $c = CierreMensual::findOrFail($id);
        $c->delete();
        return redirect('/cierres-mensuales')->with('success','Cierre eliminado');
    }
}
