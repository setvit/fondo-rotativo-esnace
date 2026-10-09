
<?php
namespace App\Services;

use App\Models\FondoReparto;
use App\Models\MovimientoFondo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FondoRotativoServiceV2
{
    const FONDO_GLOBAL_MAX = 10000;
    const UMBRAL_REPOSICION = 70; // 70%
    const MONTO_UMBRAL = 7000; // 70% de 10000
    const SALDO_MINIMO_GLOBAL = 3000; // 10000 - 7000

    public static function verificarSaldo(string $reparto, string $tipoComision, float $valorPasaje): array
    {
        $tipoPasaje = $tipoComision === 'INTERNACIONAL' ? 'EXTERIOR' : 'INTERIOR';
        $fondos = FondoReparto::where('reparto', $reparto)->where('tipo_pasaje', $tipoPasaje)->orderByDesc('saldo_actual')->get();

        if ($fondos->isEmpty()) {
            return ['puede_comprar'=>false,'alerta'=>'CRITICA','mensaje'=>"No existe fondo para {$reparto} - {$tipoPasaje}",'fondos'=>collect()];
        }

        $fondo = $fondos->first();
        $saldoAnterior = $fondo->saldo_actual;
        $saldoNuevo = $saldoAnterior - $valorPasaje;
        $esSobregiro = $saldoNuevo < 0;

        // Verificar fondo global $10000
        $saldoGlobal = DB::table('control_fondo_global')->value('saldo_global') ?? 10000;
        $saldoGlobalNuevo = $saldoGlobal - $valorPasaje;
        $porcentajeUsoGlobal = ((self::FONDO_GLOBAL_MAX - $saldoGlobalNuevo) / self::FONDO_GLOBAL_MAX) * 100;

        $mensajes = [];
        $alerta = 'OK';

        if ($esSobregiro) {
            $mensajes[] = "🚨 SOBREGIRO {$reparto} ({$fondo->estructura}): Saldo {$saldoAnterior} -> Pasaje {$valorPasaje} = NEGATIVO {$saldoNuevo}";
            $alerta = 'SOBREGIRO';
        } elseif ($saldoNuevo < 500) {
            $mensajes[] = "⚠️ SALDO CRITICO {$reparto}: Quedará con \${$saldoNuevo}";
            $alerta = 'CRITICA';
        }

        // Validación fondo global 70%
        if ($porcentajeUsoGlobal >= self::UMBRAL_REPOSICION) {
            $mensajes[] = "🚨 FONDO GLOBAL AL {$porcentajeUsoGlobal}%: Saldo global quedará en \${$saldoGlobalNuevo}. DEBE SOLICITAR REPOSICIÓN AL 100% (\$10,000)";
            if ($alerta === 'OK') $alerta = 'REPOSICION';
        }

        return [
            'puede_comprar' => true,
            'alerta' => $alerta,
            'es_sobregiro' => $esSobregiro,
            'requiere_reposicion' => $porcentajeUsoGlobal >= self::UMBRAL_REPOSICION,
            'porcentaje_uso_global' => $porcentajeUsoGlobal,
            'saldo_global_anterior' => $saldoGlobal,
            'saldo_global_nuevo' => $saldoGlobalNuevo,
            'saldo_anterior' => $saldoAnterior,
            'saldo_nuevo' => $saldoNuevo,
            'valor_sobregiro' => $esSobregiro ? abs($saldoNuevo) : 0,
            'fondo' => $fondo,
            'mensaje' => implode(' | ', $mensajes) ?: "OK: {$reparto} saldo posterior \${$saldoNuevo} | Global: \${$saldoGlobalNuevo} (".number_format($porcentajeUsoGlobal,1)."% usado)",
        ];
    }

    public static function debeSolicitarReposicion(): bool
    {
        $ejecutado = DB::table('movimientos_fondos')->sum('valor_pasaje');
        return $ejecutado >= self::MONTO_UMBRAL; // >=7000
    }

    public static function getEstadoFondoGlobal(): array
    {
        $ejecutado = DB::table('movimientos_fondos')->sum('valor_pasaje');
        $saldo = self::FONDO_GLOBAL_MAX - $ejecutado;
        $porcentaje = ($ejecutado / self::FONDO_GLOBAL_MAX) * 100;

        return [
            'monto_max' => self::FONDO_GLOBAL_MAX,
            'ejecutado' => $ejecutado,
            'saldo' => $saldo,
            'porcentaje_usado' => $porcentaje,
            'debe_reponer' => $porcentaje >= self::UMBRAL_REPOSICION,
            'mensaje_reposicion' => $porcentaje >= self::UMBRAL_REPOSICION 
                ? "🚨 ALERTA: Fondo al ".number_format($porcentaje,1)."% de uso (\$ejecutado / \$10,000). Solicitar reposición al 100% (\$10,000) según norma COOPNA"
                : "Fondo OK: ".number_format($porcentaje,1)."% usado",
        ];
    }
}
