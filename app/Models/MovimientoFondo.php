<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MovimientoFondo extends Model
{
    protected $table = 'movimientos_fondos'; // TABLA REAL PLURAL
    
    protected $fillable = [
        'fondo_reparto_id',
        'comision_id',
        'pasajero_id',
        'codigo_comision',
        'valor_pasaje',
        'tipo_movimiento',
        'motivo_ajuste',
        'plataforma',
        'valor_original',
        'numero_factura_kiwi',
        'saldo_anterior',
        'saldo_nuevo',
        'es_sobregiro',
        'valor_sobregiro',
        'user_id'
    ];

    protected $casts = [
        'valor_pasaje' => 'decimal:2',
        'saldo_anterior' => 'decimal:2',
        'saldo_nuevo' => 'decimal:2',
        'valor_original' => 'decimal:2',
        'valor_sobregiro' => 'decimal:2',
        'es_sobregiro' => 'boolean'
    ];

    public function comision(){ return $this->belongsTo(Comision::class, 'comision_id'); }
    public function pasajero(){ return $this->belongsTo(Pasajero::class, 'pasajero_id'); }
}
