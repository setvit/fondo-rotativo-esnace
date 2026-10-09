<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CierreMensual extends Model {
    protected $table = 'cierres_mensuales';
    protected $fillable = ['periodo','periodo_codigo','codigo','fecha_cierre','saldo_inicial_banco','total_debitos_banco','saldo_final_banco','comision_bancaria','valor_a_reponer','num_transacciones','detalle_transacciones','estado_cuenta_pdf','cuenta_bancaria','usuario_id','observaciones'];
    protected $casts = ['fecha_cierre'=>'date','detalle_transacciones'=>'array','saldo_inicial_banco'=>'decimal:2','total_debitos_banco'=>'decimal:2','saldo_final_banco'=>'decimal:2','comision_bancaria'=>'decimal:2','valor_a_reponer'=>'decimal:2'];
}
