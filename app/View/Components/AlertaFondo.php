<?php
namespace App\View\Components;

use Illuminate\View\Component;
use App\Services\FondoRotativoServiceV2;

class AlertaFondo extends Component
{
    public bool $alerta = false;
    public float $porcentaje = 0;
    public float $gastado = 0;
    public float $disponible = 0;
    public float $faltantePara70 = 0;

    public function __construct()
    {
        try {
            $service = new FondoRotativoServiceV2();
            $estado = $service->obtenerEstadoGlobal();

            $this->porcentaje = $estado['porcentaje_gastado'] ?? 0;
            $this->gastado = $estado['gastado'] ?? 0;
            $this->disponible = $estado['disponible'] ?? 0;
            $this->faltantePara70 = $estado['faltante_para_70'] ?? 0;

            // Activa alerta cuando llega al 70% de gasto del fondo de $10,000
            $this->alerta = $this->porcentaje >= 70;

        } catch (\Throwable $e) {
            // Si aún no hay tablas, no rompe la app
            $this->alerta = false;
        }
    }

    public function render()
    {
        return view('components.alerta-fondo');
    }
}
