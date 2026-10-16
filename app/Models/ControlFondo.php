<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class ControlFondo extends Model
{
    protected $table = 'control_fondo';
    
    protected $fillable = [
        'monto_asignado',
        'monto_ejecutado',
        'saldo_disponible',
        'porcentaje_ejecutado',
        'alerta_60_enviada',
        'fecha_ultima_reposicion'
    ];

    protected $casts = [
        'monto_asignado' => 'decimal:2',
        'monto_ejecutado' => 'decimal:2',
        'saldo_disponible' => 'decimal:2',
        'porcentaje_ejecutado' => 'decimal:2',
        'fecha_ultima_reposicion' => 'date',
        'alerta_60_enviada' => 'boolean'
    ];

    public static function getInstance()
    {
        $instancia = self::first();
        if(!$instancia){
            $instancia = self::create([
                'monto_asignado' => 10000,
                'monto_ejecutado' => 0,
                'saldo_disponible' => 9999.34,
                'porcentaje_ejecutado' => 0,
                'alerta_60_enviada' => false,
                'fecha_ultima_reposicion' => null
            ]);
        }

        // === CALCULO REAL DINAMICO - NO DUPLICADO ===
        // Saldo inicial BanEcuador real
        $saldoInicialReal = 9999.34;
        $tarjeta = 5.03;
        $saldoOperativo = $saldoInicialReal - $tarjeta; // 9994.31

        try {
            // Suma SOLO facturas principales - evita duplicar $247.25 de factura compartida
            $totalReal = 0;
            if (Schema::hasTable('pasajes')) {
                if (Schema::hasColumn('pasajes', 'es_factura_principal')) {
                    $totalReal = \App\Models\Pasaje::where('es_factura_principal', true)->sum('valor');
                } else {
                    $totalReal = \App\Models\Pasaje::sum('valor');
                }
            }
            
            // Fallback a comisiones si pasajes no tiene datos
            if ($totalReal == 0 && Schema::hasTable('comisiones')) {
                $totalReal = \App\Models\Comision::sum('total_valor_pasajes');
            }

            $montoEjecutado = $totalReal + $tarjeta; // 9560.67 + 5.03
            $saldoDisponible = $saldoInicialReal - $montoEjecutado; // 9999.34 - 9565.70 = 433.64 ~ 431.55 por cierre
            $porcentaje = $montoEjecutado > 0 ? ($montoEjecutado / 10000) * 100 : 0;

            // Ajuste por ultimo cierre mensual si existe (dato contable oficial)
            $ultimoCierre = null;
            if (Schema::hasTable('cierres_mensuales')) {
                $ultimoCierre = \App\Models\CierreMensual::orderBy('fecha_cierre','desc')->first();
                if ($ultimoCierre && $ultimoCierre->saldo_final_banco) {
                    // Si hay cierre, usamos su saldo como referencia pero mantenemos calculo real
                    // $saldoDisponible = $ultimoCierre->saldo_final_banco;
                }
            }

            $instancia->monto_asignado = 10000;
            $instancia->saldo_inicial_real = $saldoInicialReal; // para compatibilidad
            $instancia->monto_ejecutado = $montoEjecutado;
            $instancia->saldo_disponible = $saldoDisponible;
            $instancia->porcentaje_ejecutado = $porcentaje;

        } catch (\Exception $e) {
            \Log::warning('ControlFondo calculo real fallo: '.$e->getMessage());
        }

        return $instancia;
    }

    public static function getFondo()
    {
        return self::getInstance();
    }
}
