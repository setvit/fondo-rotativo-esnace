<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ControlFondo extends Model
{
    // TABLA REAL ES SINGULAR
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
                'monto_ejecutado' => 9563.42,
                'saldo_disponible' => 436.58,
                'porcentaje_ejecutado' => 95.63,
                'alerta_60_enviada' => false,
                'fecha_ultima_reposicion' => null
            ]);
        }
        return $instancia;
    }

    // Para compatibilidad con codigo antiguo que usa control_fondos plural
    public static function getFondo()
    {
        return self::getInstance();
    }
}
