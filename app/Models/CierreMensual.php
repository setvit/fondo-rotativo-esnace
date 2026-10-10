<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CierreMensual extends Model {
    protected $table = 'cierres_mensuales';
    protected $fillable = [
        'periodo','periodo_codigo','codigo','fecha_cierre',
        'fondo_asignado','fondo_teorico',
        'saldo_inicial_banco','total_debitos_banco','saldo_final_banco','saldo_final_conciliado',
        'comision_bancaria','total_debitos_banco','total_creditos_banco',
        'total_ejecutado','total_liquidadas','total_por_liquidar',
        'saldo_disponible','valor_a_reponer',
        'cantidad_liquidadas','cantidad_por_liquidar','num_transacciones',
        'detalle_transacciones','estado_cuenta_path','pdf_path',
        'cuenta_bancaria','administrador_id','usuario_id','estado','observaciones'
    ];
    protected $casts = [
        'fecha_cierre'=>'date',
        'detalle_transacciones'=>'array',
        'saldo_inicial_banco'=>'decimal:2',
        'total_debitos_banco'=>'decimal:2',
        'saldo_final_banco'=>'decimal:2',
        'saldo_final_conciliado'=>'decimal:2',
        'comision_bancaria'=>'decimal:2',
        'valor_a_reponer'=>'decimal:2',
        'fondo_asignado'=>'decimal:2',
        'fondo_teorico'=>'decimal:2',
        'total_ejecutado'=>'decimal:2'
    ];
    
    // Accesor para que no falle si detalle_transacciones es null
    public function getTransaccionesAttribute(){
        if(is_array($this->detalle_transacciones)) return $this->detalle_transacciones;
        if(is_string($this->detalle_transacciones)) return json_decode($this->detalle_transacciones, true) ?? [];
        return [];
    }
    
    public function getSaldoInicialRealAttribute(){
        return $this->saldo_inicial_banco;
    }
}
