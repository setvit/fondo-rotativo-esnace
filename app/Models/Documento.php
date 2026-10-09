<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Documento extends Model
{
    protected $fillable = ['comision_id', 'tipo', 'nombre', 'ruta'];
    public function comision() { return $this->belongsTo(Comision::class); }
}
