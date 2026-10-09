@extends('layouts.app')
@section('content')
<div class="container p-4">
<div class="card p-4">
<h4>Registrar Cargo Adicional KIWI - BUSAN $350</h4>
<div class="alert alert-warning">
<strong>Comisión:</strong> COM-20260925151104 GUAYAQUIL-BUSAN-GUAYAQUIL<br>
<strong>Valor original:</strong> $5,438.70<br>
<strong>Cargo adicional Kiwi tasas:</strong> $350.00<br>
<strong>Nuevo valor real:</strong> $5,788.70<br><br>
Este cargo se registró DESPUÉS de la compra inicial, por tasas administrativas no incluidas.
</div>

<form method="POST" action="{{ route('comisiones.cargo-kiwi', $comision->id) }}" enctype="multipart/form-data">
@csrf
<div class="row">
<div class="col-md-6"><label>Valor cargo adicional ($)</label><input type="number" step="0.01" name="valor_cargo" class="form-control" value="350.00" required></div>
<div class="col-md-6"><label>N° Factura / Comprobante Kiwi</label><input type="text" name="numero_factura_kiwi" class="form-control" placeholder="KIWI-INV-XXXX" required></div>
</div>
<div class="mt-3"><label>Motivo</label><textarea name="motivo" class="form-control" rows="3" required>Cobro adicional posterior plataforma Kiwi por concepto de tasas aeroportuarias e impuestos administrativos no incluidos en el valor inicial del pasaje GUAYAQUIL-BUSAN-GUAYAQUIL. Viaje ya realizado.</textarea></div>
<div class="mt-3"><label>Adjuntar comprobante Kiwi (PDF)</label><input type="file" name="comprobante_kiwi" class="form-control" accept=".pdf,.jpg,.png"></div>
<button class="btn btn-danger mt-3">Registrar Cargo $350 y Actualizar Fondo a 83%</button>
<a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Cancelar</a>
</form>

<div class="mt-4 p-3 bg-light">
<strong>Efecto en ControlFondo:</strong><br>
Antes: Ejecutado $7,950.34 (79.50%) | Saldo $2,049.66<br>
Después: Ejecutado $8,300.34 (83.00%) | Saldo $1,699.66<br>
<small>Se genera MovimientoFondo tipo CARGO_ADICIONAL_KIWI con valor $350 positivo</small>
</div>
</div>
</div>
@endsection
