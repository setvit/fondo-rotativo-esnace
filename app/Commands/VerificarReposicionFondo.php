<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FondoRotativoServiceV2;

class VerificarReposicionFondo extends Command
{
    protected $signature = 'fondo:verificar';
    protected $description = 'Verifica si el fondo rotativo llego al 70% de gasto ($7,000 de $10,000)';

    public function handle()
    {
        try {
            $service = new FondoRotativoServiceV2();
            $estado = $service->obtenerEstadoGlobal();

            $this->info('=== ESTADO FONDO ROTATIVO ===');
            $this->info('Asignado: $' . number_format($estado['asignado'] ?? 10000, 2));
            $this->info('Gastado: $' . number_format($estado['gastado'] ?? 0, 2));
            $this->info('Disponible: $' . number_format($estado['disponible'] ?? 10000, 2));
            $this->info('Porcentaje gastado: ' . number_format($estado['porcentaje_gastado'] ?? 0, 2) . '%');

            if (($estado['porcentaje_gastado'] ?? 0) >= 70) {
                $this->warn('¡ALERTA! Fondo llego al 70% - Solicitar reposicion');
                $this->warn('Faltante para 70%: $' . number_format($estado['faltante_para_70'] ?? 0, 2));
            } else {
                $this->info('Fondo OK - Aun no llega al 70%');
            }

            return 0;
        } catch (\Throwable $e) {
            $this->error('Error: ' . $e->getMessage());
            $this->info('Si aun no hay datos, es normal. Ejecute el seeder primero.');
            return 1;
        }
    }
}
