<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    protected $table = 'liquidaciones'; // TABLA REAL
    
    protected $fillable = [
        'codigo',
        'monto_asignado',
        'monto_ejecutado_liquidacion',
        'saldo_disponible_al_corte',
        'porcentaje_ejecutado',
        'cantidad_comisiones',
        'estado',
        'fecha_liquidacion',
        'fecha_reposicion',
        'user_id',
        'observaciones',
        'administrador',
        'aprobador'
    ];

    protected $casts = [
        'fecha_liquidacion' => 'datetime',
        'fecha_reposicion' => 'datetime',
        'monto_ejecutado_liquidacion' => 'decimal:2',
        'saldo_disponible_al_corte' => 'decimal:2',
    ];

    public function comisiones()
    {
        return $this->belongsToMany(Comision::class, 'liquidacion_comision', 'liquidacion_id', 'comision_id')
                    ->withPivot('valor')
                    ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
