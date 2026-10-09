<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $table = 'cotizaciones';
    protected $fillable = [
        'comision_id', 'nro_proforma', 'ruc_proveedor', 'nombre_proveedor', 
        'tipo_proveedor', 'detalle_pasajes', 'valor_total', 
        'fecha_cotizacion', 'archivo_proforma', 'registrado_por'
    ];
    protected $casts = [
        'fecha_cotizacion' => 'date',
        'valor_total' => 'decimal:2'
    ];
    public function comision() { return $this->belongsTo(Comision::class); }
    public function registradoPor() { return $this->belongsTo(User::class, 'registrado_por'); }
}
