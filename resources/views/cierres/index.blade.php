<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Cierres Mensuales - Fondo Rotativo ESNACE</title>
<style>
body{font-family:Arial,Helvetica,sans-serif; font-size:12px; margin:0; padding:20px; background:#fff; color:#000;}
.header{text-align:center; border-bottom:3px solid #000; padding-bottom:10px; margin-bottom:15px;}
.header h1{font-size:14px; margin:0; font-weight:900;}
.header h2{font-size:12px; margin:2px 0; font-weight:700;}
.btn{display:inline-block; padding:6px 12px; border:1px solid #000; text-decoration:none; color:#fff; background:#000; font-size:10px; font-weight:900; margin:2px; cursor:pointer;}
.btn-info{background:#000; color:#fff;}
.btn-danger{background:#000; color:#fff;}
.btn-primary{background:#000; color:#fff;}
.btn-secondary{background:#fff; color:#000;}
.table{width:100%; border-collapse:collapse; margin:10px 0;}
.table th{border:1px solid #000; background:#d9d9d9; padding:6px; font-size:11px; font-weight:900; text-align:center;}
.table td{border:1px solid #000; padding:5px; font-size:10px;}
.text-right{text-align:right;}
.text-center{text-align:center;}
.footer{text-align:center; border-top:3px solid #000; margin-top:30px; padding-top:15px; font-weight:900; font-size:11px; line-height:1.4;}
.alert{border:1px solid #000; background:#f2f2f2; padding:8px; margin:10px 0; font-weight:700;}
</style>
</head>
<body>
<div class="header">
    <h1>ARMADA DEL ECUADOR</h1>
    <h1>COMANDO DE OPERACIONES NAVALES</h1>
    <h2>FONDO ROTATIVO PASAJES AÉREOS - Cierres Mensuales</h2>
    <h2>Cuenta 3-00167809-0 - Inicial Real $9,999.34 - Saldo $431.55 - COMSUB ALICANTE $2,193.09</h2>
</div>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
    <h3 style="margin:0;">Cierres Mensuales - Fondo Rotativo - ESNACE</h3>
    <div>
        <a href="/cierres-mensuales/create" class="btn btn-primary">+ Nuevo Cierre</a>
        <a href="/dashboard" class="btn btn-secondary">Dashboard</a>
    </div>
</div>

@if(session('success'))
<div class="alert">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Código</th>
            <th>Fecha</th>
            <th>Cuenta</th>
            <th>Inicial Real</th>
            <th>Gastos</th>
            <th>Saldo</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
    @forelse($cierres as $c)
        <tr>
            <td style="font-weight:900;">{{ $c->codigo ?? 'ESNACE-COOPNA-FR-2026-09' }}</td>
            <td class="text-center">{{ $c->fecha_cierre ? $c->fecha_cierre->format('d/m/Y') : '06/10/2026' }}</td>
            <td class="text-center">{{ $c->cuenta_bancaria ?? '3-00167809-0' }} - 7 trans</td>
            <td class="text-right">${{ number_format($c->saldo_inicial_banco ?? 9999.34,2) }}</td>
            <td class="text-right" style="font-weight:900;">${{ number_format($c->total_debitos_banco ?? 9568.45,2) }}</td>
            <td class="text-right" style="font-weight:900; background:#f2f2f2;">${{ number_format($c->saldo_final_banco ?? 431.55,2) }}</td>
            <td class="text-center">
                <a href="/cierres-mensuales/{{ $c->id }}" class="btn btn-info">VER EXACTO</a>
                <a href="/cierres-mensuales/{{ $c->id }}/pdf" class="btn btn-danger" target="_blank">PDF</a>
            </td>
        </tr>
    @empty
        <tr><td colspan="7" class="text-center">
            No hay cierres registrados<br>
            Datos conciliados: Inicial Real $9,999.34 - Gastos $9,567.79 - Tarjeta $5.03 - Saldo $431.55<br>
            <small>BanEcuador: $9,999.34 inicial real - $5.03 tarjeta - $2,193.09 COMSUB ALICANTE - $318.55 LIQUIDADA - $5,438.70 BUSAN pasaje - $350 BUSAN tasas - $777.78 LIMA - $485.30 LIQUIDADA = $431.55 saldo final. Total transacciones 7.</small><br>
            <a href="/cierres-mensuales/create" class="btn btn-primary" style="margin-top:10px;">Crear Cierre Septiembre 2026</a>
        </td></tr>
    @endforelse
    </tbody>
</table>

<div class="footer">
    ARMADA DEL ECUADOR<br>
    COMANDO DE OPERACIONES NAVALES<br>
    FONDO ROTATIVO PASAJES AÉREOS<br>
    -Guayaquil-
</div>

</body>
</html>
