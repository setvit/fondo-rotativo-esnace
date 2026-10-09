<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pasajero extends Model
{
    protected $fillable = ['comision_id', 'nombre', 'cedula', 'cargo', 'reparto'];
    
    public function comision() 
    { 
        return $this->belongsTo(Comision::class); 
    }
}
