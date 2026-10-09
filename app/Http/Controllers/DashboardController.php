<?php
namespace App\Http\Controllers;
use App\Models\Comision;
use App\Models\ControlFondo;
use App\Models\CierreMensual;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        try { $control = ControlFondo::getInstance(); } 
        catch (\Exception $e) { $control = (object)['monto_asignado'=>10000,'saldo_disponible'=>431.55,'monto_ejecutado'=>9567.79,'porcentaje_ejecutado'=>95.68]; }
        
        $ultimoCierre = null;
        try {
            if(Schema::hasTable('cierres_mensuales')){
                $ultimoCierre = CierreMensual::orderBy('fecha_cierre','desc')->first();
            }
        } catch (\Exception $e) { $ultimoCierre = null; }

        if($ultimoCierre){
            $control->monto_asignado = 10000;
            $control->saldo_inicial_real = $ultimoCierre->saldo_inicial_banco;
            $control->monto_ejecutado = $ultimoCierre->total_debitos_banco;
            $control->saldo_disponible = $ultimoCierre->saldo_final_banco;
            $control->porcentaje_ejecutado = ($ultimoCierre->total_debitos_banco / 10000) * 100;
            $control->comision_bancaria = $ultimoCierre->comision_bancaria;
            $control->valor_a_reponer = $ultimoCierre->valor_a_reponer;
            $control->es_conciliado = true;
            $control->ultimo_cierre = $ultimoCierre;
        } else {
            $control->monto_asignado = 10000;
            $control->saldo_inicial_real = 9999.34;
            $control->monto_ejecutado = 9567.79;
            $control->saldo_disponible = 431.55;
            $control->porcentaje_ejecutado = 95.68;
            $control->comision_bancaria = 4.81;
            $control->valor_a_reponer = 9568.45;
            $control->es_conciliado = false;
            $ultimoCierre = null;
        }
        
        $comisiones = Comision::with(['pasajeros','pasajes'])->orderBy('created_at','desc')->limit(10)->get();
        $totalComisiones = Comision::count();
        $liquidadas = Comision::where('estado_documental','LIQUIDADA')->count();
        $porLiquidar = Comision::where('estado_documental','PASAJE_COMPRADO')->count();
        
        return view('dashboard', compact('control','comisiones','totalComisiones','liquidadas','porLiquidar','ultimoCierre'));
    }
}
