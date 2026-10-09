<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Comision extends Model {
    protected $table = 'comisiones';
    protected $fillable = ['codigo','destino','motivo','tipo','fecha_salida','fecha_retorno','estado','estado_documental','total_valor_pasajes','puede_comprar','custodio_id'];
    protected $casts = ['fecha_salida'=>'date','fecha_retorno'=>'date','total_valor_pasajes'=>'decimal:2','puede_comprar'=>'boolean'];
    
    public function custodio() { return $this->belongsTo(User::class, 'custodio_id'); }
    public function pasajeros() { return $this->hasMany(Pasajero::class, 'comision_id'); }
    public function cotizaciones() { return $this->hasMany(Cotizacion::class, 'comision_id'); }
    public function cuadroComparativo() { return $this->hasOne(CuadroComparativo::class, 'comision_id'); }
    public function pasajes() { return $this->hasMany(Pasaje::class, 'comision_id'); }
    public function documentos() { return $this->hasMany(Documento::class, 'comision_id'); }
    
    public function liquidaciones() {
        return $this->belongsToMany(Liquidacion::class, 'liquidacion_comision', 'comision_id', 'liquidacion_id')->withPivot('valor')->withTimestamps();
    }
    
    public function estaLiquidada(): bool {
        return $this->estado_documental === 'LIQUIDADA';
    }
}
