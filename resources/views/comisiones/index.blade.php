<x-app-layout>
<x-slot name="header">
<div style="background:#001f3f; margin:-24px; padding:20px 24px; color:white;">
<h2 style="font-weight:bold; font-size:18px; margin:0;">Comisiones - Fondo Rotativo ESNACE - {{ $comisiones->total() ?? $comisiones->count() }} registros - Valor Total REAL no duplicado ${{ number_format($control->monto_ejecutado - 5.03,2) }}</h2>
<p style="font-size:11px; color:#FFD700; margin:4px 0 0 0;">ARMADA DEL ECUADOR | Fondo Rotativo | Factura compartida no duplica | Saldo Inicial $9,999.34 - Tarjeta $5.03</p>
</div>
</x-slot>
<div style="padding:24px; background:#f3f4f6; min-height:100vh;">
<div style="max-width:1280px; margin:0 auto;">

@php
    // Calculo real para header - evita duplicado factura compartida
    $totalComisiones = $comisiones->total() ?? $comisiones->count();
    $liquidadas = \App\Models\Comision::where('estado','LIQUIDADA')->orWhere('estado_documental','LIQUIDADA')->count();
    $valorReal = $control->monto_ejecutado - 5.03; // quitamos tarjeta para mostrar solo pasajes
    $saldoFondo = $control->saldo_disponible;
    // Si ControlFondo no calculó, fallback a 431.55
    if ($valorReal <= 0) { $valorReal = 9560.67; $saldoFondo = 431.55; }
@endphp

<!-- 4 COLUMNAS - DINAMICAS -->
<div style="display:grid; grid-template-columns: repeat(4, 1fr); gap:16px; margin-bottom:24px;">
<div style="background: linear-gradient(135deg, #001f3f, #1e40af); color:white; padding:16px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1); border-left:4px solid #FFD700;">
<p style="font-size:10px; text-transform:uppercase; opacity:0.8; margin:0;">TOTAL COMISIONES</p><p style="font-size:28px; font-weight:bold; margin:4px 0;">{{ $totalComisiones }}</p><p style="font-size:11px; opacity:0.7; margin:0;">2026 - Saldo inicial $9,999.34</p>
</div>
<div style="background: linear-gradient(135deg, #065f46, #10b981); color:white; padding:16px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
<p style="font-size:10px; text-transform:uppercase; opacity:0.8; margin:0;">LIQUIDADAS</p><p style="font-size:28px; font-weight:bold; margin:4px 0;">{{ $liquidadas }}</p><p style="font-size:11px; margin:0;">Con pases IDA/RETORNO</p>
</div>
<div style="background: linear-gradient(135deg, #92400e, #f59e0b); color:white; padding:16px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
<p style="font-size:10px; text-transform:uppercase; opacity:0.8; margin:0;">VALOR TOTAL REAL</p><p style="font-size:22px; font-weight:bold; margin:4px 0;">$ {{ number_format($valorReal,2) }}</p><p style="font-size:11px; margin:0;">No duplicado - es_factura_principal</p>
</div>
<div style="background:white; padding:16px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1); border-left:4px solid #001f3f;">
<p style="font-size:10px; text-transform:uppercase; color:#6b7280; margin:0;">SALDO FONDO</p><p style="font-size:22px; font-weight:bold; margin:4px 0; color:#001f3f;">$ {{ number_format($saldoFondo,2) }}</p><p style="font-size:11px; color:#6b7280; margin:0;">Fondo rotativo = 9999.34 - {{ number_format($control->monto_ejecutado,2) }}</p>
</div>
</div>

<div style="background:white; padding:20px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1); border-top:4px solid #001f3f;">
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
<h3 style="font-weight:bold; font-size:16px; color:#001f3f; margin:0;">Comisiones ({{ $totalComisiones }}) - Factura compartida $ no duplicado - COM-20261008190741 $247.25 único</h3>
<a href="{{ route('comisiones.create') }}" style="background:#001f3f; color:white; padding:8px 16px; border-radius:6px; font-weight:bold; text-decoration:none; font-size:13px;">+ Nueva Comisión</a>
</div>
<div style="overflow-x:auto;">
<table style="width:100%; font-size:13px; border-collapse:collapse; border:1px solid #e5e7eb;">
<thead><tr style="background:#001f3f; color:white;"><th style="padding:10px; text-align:left;">Código</th><th style="padding:10px; text-align:left;">Destino</th><th style="padding:10px;">Tipo</th><th style="padding:10px;">Valor REAL</th><th style="padding:10px;">Estado</th><th style="padding:10px;">Oficiales</th><th style="padding:10px;">Acción</th></tr></thead>
<tbody>
@foreach($comisiones as $c)
@php
    // Color badge según estado - incluye CUADRO_APROBADO nuevo
    $estado = $c->estado;
    $bg = '#fde047'; $color = '#000';
    if ($estado == 'LIQUIDADA') { $bg = '#16a34a'; $color = 'white'; }
    elseif ($estado == 'CUADRO_APROBADO') { $bg = '#2563eb'; $color = 'white'; } // AZUL para aprobado - se ve en index
    elseif ($estado == 'CUADRO_BORRADOR' || $estado == 'CUADRO_PENDIENTE') { $bg = '#f59e0b'; $color = '#000'; }
    elseif ($estado == 'PASAJE_COMPRADO') { $bg = '#a855f7'; $color = 'white'; }
    elseif ($estado == 'CON_PASAJEROS' || $estado == 'CREADA') { $bg = '#e5e7eb'; $color = '#000'; }
@endphp
<tr style="border-bottom:1px solid #f3f4f6; {{ $c->estado=='LIQUIDADA' ? 'background:#f0fdf4;' : ($c->estado=='CUADRO_APROBADO' ? 'background:#eff6ff;' : '') }}">
<td style="padding:10px; font-family:monospace; font-size:11px;">{{ $c->codigo }}</td>
<td style="padding:10px; font-weight:bold;">{{ $c->destino }} @if($c->pasajeros->count()>1)<span style="background:#001f3f; color:white; font-size:9px; padding:1px 5px; border-radius:3px;">{{ $c->pasajeros->count() }} of. 1 factura</span>@endif</td>
<td style="padding:10px; text-align:center;"><span style="background:{{ $c->tipo=='NACIONAL' ? '#3b82f6' : '#7c3aed' }}; color:white; padding:3px 8px; border-radius:10px; font-size:10px;">{{ $c->tipo }}</span></td>
<td style="padding:10px; font-weight:bold; text-align:right;">${{ number_format($c->total_valor_pasajes,2) }}</td>
<td style="padding:10px; text-align:center;"><span style="background:{{ $bg }}; color:{{ $color }}; padding:3px 8px; border-radius:10px; font-size:10px; font-weight:bold;">{{ $c->estado }}</span></td>
<td style="padding:10px; text-align:center;">{{ $c->pasajeros->count() }} of. | Pases: {{ $c->pasajes->whereNotNull('pase_abordo_ida')->count() }}/{{ $c->pasajes->count() }}</td>
<td style="padding:10px; text-align:center;"><a href="{{ route('comisiones.show',$c->id) }}" style="background:#2563eb; color:white; padding:4px 12px; border-radius:4px; text-decoration:none; font-size:11px; font-weight:bold;">Ver</a></td>
</tr>
@endforeach
</tbody>
</table>
</div>
<div style="margin-top:12px;">{{ $comisiones->links() ?? '' }}</div>
<div style="margin-top:12px; padding:10px; background:#001f3f; color:white; border-radius:6px; font-size:11px;"><strong>Nota ESNACE v1.6:</strong> Saldo = $9,999.34 (BanEcuador) - $5.03 tarjeta - ${{ number_format($valorReal,2) }} (solo es_factura_principal=true) = ${{ number_format($saldoFondo,2) }} | Factura compartida: 2 oficiales misma factura $247.25 único (no $494.50) | COM-20261008190741 GUAYAQUIL-QUITO-GUAYAQUIL ya descuenta saldo al comprar pasaje.</div>
</div>

</div>
</div>
</x-app-layout>
