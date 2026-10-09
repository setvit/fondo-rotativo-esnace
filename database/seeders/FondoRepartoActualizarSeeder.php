
<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FondoReparto;
use Illuminate\Support\Facades\DB;

class FondoRepartoActualizarSeeder extends Seeder
{
    public function run(): void
    {
        // Datos del Excel (saldo inicial antes de la compra de COMSUB)
        $fondosExcel = [
            ['reparto'=>'COOPNA','estructura'=>'56-001-530302','tipo_pasaje'=>'EXTERIOR','clasificacion_contable'=>'EXTERIOR','monto_asignado'=>3000,'saldo_excel'=>3000,'ejecutado_excel'=>0],
            ['reparto'=>'COMSUB','estructura'=>'56-001-530302','tipo_pasaje'=>'EXTERIOR','clasificacion_contable'=>'EXTERIOR','monto_asignado'=>2400,'saldo_excel'=>2400,'ejecutado_excel'=>0],
            ['reparto'=>'COOPNA','estructura'=>'57-001-530302','tipo_pasaje'=>'EXTERIOR','clasificacion_contable'=>'EXTERIOR','monto_asignado'=>2000,'saldo_excel'=>2000,'ejecutado_excel'=>0],
            ['reparto'=>'INHIMA','estructura'=>'01-001-530301','tipo_pasaje'=>'INTERIOR','clasificacion_contable'=>'INTERIOR','monto_asignado'=>1000,'saldo_excel'=>156.74,'ejecutado_excel'=>843.26],
            ['reparto'=>'INSGAR','estructura'=>'01-001-530301','tipo_pasaje'=>'INTERIOR','clasificacion_contable'=>'INTERIOR','monto_asignado'=>3000,'saldo_excel'=>1990.46,'ejecutado_excel'=>1009.54],
            ['reparto'=>'COOPNA','estructura'=>'55-001-530301','tipo_pasaje'=>'INTERIOR','clasificacion_contable'=>'INTERIOR','monto_asignado'=>5000,'saldo_excel'=>4283.69,'ejecutado_excel'=>716.31],
            ['reparto'=>'ESNACE','estructura'=>'55-001-530301','tipo_pasaje'=>'INTERIOR','clasificacion_contable'=>'INTERIOR','monto_asignado'=>4000,'saldo_excel'=>3816.10,'ejecutado_excel'=>183.9],
            ['reparto'=>'GINSUR','estructura'=>'55-001-530301','tipo_pasaje'=>'INTERIOR','clasificacion_contable'=>'INTERIOR','monto_asignado'=>1000,'saldo_excel'=>834.40,'ejecutado_excel'=>165.6],
            ['reparto'=>'CODESC','estructura'=>'57-001-530301','tipo_pasaje'=>'INTERIOR','clasificacion_contable'=>'INTERIOR','monto_asignado'=>10000,'saldo_excel'=>9593.76,'ejecutado_excel'=>406.24],
        ];

        foreach ($fondosExcel as $data) {
            FondoReparto::updateOrCreate(
                ['reparto' => $data['reparto'], 'estructura' => $data['estructura']],
                [
                    'tipo_pasaje' => $data['tipo_pasaje'],
                    'clasificacion_contable' => $data['clasificacion_contable'],
                    'monto_asignado' => $data['monto_asignado'],
                    // Solo si no existe, pone saldo del Excel. Si ya existe, lo respeta (no encerar)
                    'monto_ejecutado' => DB::raw('COALESCE(monto_ejecutado, '.$data['ejecutado_excel'].')'),
                    'saldo_actual' => DB::raw('COALESCE(saldo_actual, '.$data['saldo_excel'].')'),
                    'descripcion' => $data['reparto'].' - '.$data['tipo_pasaje'].' '.$data['estructura']
                ]
            );
        }

        // Ahora descontar la compra ya realizada COM-20260921140224 que no está en el Excel
        // Valor real según cuadro comparativo: $2193.09
        $valorCompraComsub = 2193.09;
        $fondoComsub = FondoReparto::where('reparto','COMSUB')->where('estructura','56-001-530302')->first();
        if ($fondoComsub) {
            // Verificar si ya se descontó (para no descontar doble)
            $yaDescontado = DB::table('movimientos_fondos')->where('codigo_comision','COM-20260921140224')->exists();
            if (!$yaDescontado) {
                $saldoAnterior = $fondoComsub->saldo_actual;
                $fondoComsub->monto_ejecutado += $valorCompraComsub;
                $fondoComsub->saldo_actual = $saldoAnterior - $valorCompraComsub;
                $fondoComsub->save();

                DB::table('movimientos_fondos')->insert([
                    'fondo_reparto_id' => $fondoComsub->id,
                    'codigo_comision' => 'COM-20260921140224',
                    'valor_pasaje' => $valorCompraComsub,
                    'saldo_anterior' => $saldoAnterior,
                    'saldo_nuevo' => $fondoComsub->saldo_actual,
                    'es_sobregiro' => $fondoComsub->saldo_actual < 0,
                    'valor_sobregiro' => $fondoComsub->saldo_actual < 0 ? abs($fondoComsub->saldo_actual) : 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $this->command->warn("Descontado COM-20260921140224 $2193.09 de COMSUB. Saldo anterior: $saldoAnterior -> Nuevo: {$fondoComsub->saldo_actual}");
            }
        }

        // Actualizar fondo global $10000 sin truncar
        $totalEjecutadoGlobal = DB::table('movimientos_fondos')->sum('valor_pasaje');
        DB::table('control_fondo_global')->updateOrInsert(
            ['id' => 1],
            [
                'monto_total_banco' => 10000,
                'monto_asignado_total' => 28075.15,
                'saldo_global' => 10000 - $totalEjecutadoGlobal,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        // Actualizar también tabla control_fondo antigua si existe
        if (DB::getSchemaBuilder()->hasTable('control_fondo')) {
            DB::table('control_fondo')->where('id',1)->update([
                'monto_ejecutado' => $totalEjecutadoGlobal,
                'saldo_disponible' => 10000 - $totalEjecutadoGlobal,
                'porcentaje_ejecutado' => ($totalEjecutadoGlobal / 10000) * 100,
            ]);
        }

        $this->command->info('✅ Fondos actualizados desde Excel SIN ENCERAR. Se conservó COM-20260921140224');
        $this->command->info('Saldo Global: $'.(10000 - $totalEjecutadoGlobal).' | Ejecutado: $'.$totalEjecutadoGlobal);
    }
}
