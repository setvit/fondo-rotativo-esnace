<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pasaje extends Model
{
    protected $table = 'pasajes';
    
    protected $fillable = [
        'comision_id',
        'pasajero_id',
        'cotizacion_id',
        'aerolinea',
        'ruta',
        'valor',
        'numero_factura',
        'fecha_factura',
        'factura_path',
        'estado',
        'tipo_comprobante',
        'tipo_pago',
        'numero_voucher',
        'correo_notificacion',
        'proveedor',
        'pase_abordo_ida',
        'pase_abordo_retorno',
        'informe_path',
        'informe_fecha',
        // NUEVO: Para factura compartida entre varios oficiales
        'factura_grupo',
        'es_factura_principal'
    ];

    protected $casts = [
        'valor' => 'decimal:2',
        'fecha_factura' => 'date',
        'informe_fecha' => 'date',
        'es_factura_principal' => 'boolean'
    ];

    public function comision(){ return $this->belongsTo(Comision::class, 'comision_id'); }
    public function pasajero(){ return $this->belongsTo(Pasajero::class, 'pasajero_id'); }
    public function cotizacion(){ return $this->belongsTo(Cotizacion::class, 'cotizacion_id'); }

    public function scopeComprobanteExterior($query){ return $query->where('tipo_comprobante', 'COMPROBANTE_EXTERIOR'); }
    public function scopeFacturaSRI($query){ return $query->where('tipo_comprobante', 'FACTURA_SRI'); }
    public function scopeFacturasPrincipales($query){ return $query->where('es_factura_principal', true); }

    public function tienePasesCompletos(): bool { return !empty($this->pase_abordo_ida) && !empty($this->pase_abordo_retorno); }
    public function tienePaseIda(): bool { return !empty($this->pase_abordo_ida); }
    
    // Si es compartida, el valor real es del grupo, no por pasajero
    public function esFacturaCompartida(): bool { return !$this->es_factura_principal; }
}
