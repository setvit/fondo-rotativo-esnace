
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FondoReparto extends Model
{
    protected $table = 'fondos_repartos';
    protected $fillable = [
        'reparto','estructura','tipo_pasaje','clasificacion_contable',
        'monto_asignado','monto_ejecutado','saldo_actual','descripcion'
    ];

    protected $casts = [
        'monto_asignado' => 'decimal:2',
        'monto_ejecutado' => 'decimal:2',
        'saldo_actual' => 'decimal:2',
    ];

    public function movimientos(): HasMany
    {
        return $this->hasMany(MovimientoFondo::class);
    }

    public function getEstadoAttribute(): string
    {
        if ($this->saldo_actual < 0) return 'SOBREGIRO';
        if ($this->saldo_actual < 500) return 'CRITICO';
        if ($this->saldo_actual < 1000) return 'ALERTA';
        return 'OK';
    }

    public function getColorEstadoAttribute(): string
    {
        return match($this->estado) {
            'SOBREGIRO' => 'danger',
            'CRITICO' => 'danger',
            'ALERTA' => 'warning',
            default => 'success'
        };
    }
}
