<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CuadroComparativo extends Model
{
    protected $table = 'cuadros_comparativos';
    
    protected $fillable = [
        'comision_id',
        'estado', 
        'cotizacion_ganadora_id',
        'sumilla',
        'observaciones',
        'ruta_pdf', 
        'generado_por', 
        'codigo_verificacion', 
        'hash_documento'
    ];
    
    public function comision() { 
        return $this->belongsTo(Comision::class); 
    }
}