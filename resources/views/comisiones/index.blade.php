<x-app-layout>
<x-slot name="header">
<div style="background:#001f3f; margin:-24px; padding:20px 24px; color:white;">
<h2 style="font-weight:bold; font-size:18px; margin:0;">Comisiones - Fondo Rotativo ESNACE - 6 registros - Valor Total REAL no duplicado $9,560.67</h2>
<p style="font-size:11px; color:#FFD700; margin:4px 0 0 0;">ARMADA DEL ECUADOR | Fondo Rotativo | Factura compartida no duplica</p>
</div>
</x-slot>
<div style="padding:24px; background:#f3f4f6; min-height:100vh;">
<div style="max-width:1280px; margin:0 auto;">

<!-- 4 COLUMNAS - MISMOS COLORES -->
<div style="display:grid; grid-template-columns: repeat(4, 1fr); gap:16px; margin-bottom:24px;">
<div style="background: linear-gradient(135deg, #001f3f, #1e40af); color:white; padding:16px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1); border-left:4px solid #FFD700;">
<p style="font-size:10px; text-transform:uppercase; opacity:0.8; margin:0;">TOTAL COMISIONES</p><p style="font-size:28px; font-weight:bold; margin:4px 0;">6</p><p style="font-size:11px; opacity:0.7; margin:0;">2026</p>
</div>
<div style="background: linear-gradient(135deg, #065f46, #10b981); color:white; padding:16px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
<p style="font-size:10px; text-transform:uppercase; opacity:0.8; margin:0;">LIQUIDADAS</p><p style="font-size:28px; font-weight:bold; margin:4px 0;">3</p><p style="font-size:11px; margin:0;">Con pases</p>
</div>
<div style="background: linear-gradient(135deg, #92400e, #f59e0b); color:white; padding:16px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
<p style="font-size:10px; text-transform:uppercase; opacity:0.8; margin:0;">VALOR TOTAL REAL</p><p style="font-size:22px; font-weight:bold; margin:4px 0;">$ 9,560.67</p><p style="font-size:11px; margin:0;">No duplicado</p>
</div>
<div style="background:white; padding:16px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1); border-left:4px solid #001f3f;">
<p style="font-size:10px; text-transform:uppercase; color:#6b7280; margin:0;">SALDO FONDO</p><p style="font-size:22px; font-weight:bold; margin:4px 0; color:#001f3f;">$ 431.55</p><p style="font-size:11px; color:#6b7280; margin:0;">Fondo rotativo</p>
</div>
</div>

<div style="background:white; padding:20px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1); border-top:4px solid #001f3f;">
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
<h3 style="font-weight:bold; font-size:16px; color:#001f3f; margin:0;">Comisiones (6) - Factura compartida $ no duplicado - Ejemplo $485.30 único para 2 oficiales</h3>
<a href="{{ route('comisiones.create') }}" style="background:#001f3f; color:white; padding:8px 16px; border-radius:6px; font-weight:bold; text-decoration:none; font-size:13px;">+ Nueva Comisión</a>
</div>
<div style="overflow-x:auto;">
<table style="width:100%; font-size:13px; border-collapse:collapse; border:1px solid #e5e7eb;">
<thead><tr style="background:#001f3f; color:white;"><th style="padding:10px; text-align:left;">Código</th><th style="padding:10px; text-align:left;">Destino</th><th style="padding:10px;">Tipo</th><th style="padding:10px;">Valor REAL</th><th style="padding:10px;">Estado</th><th style="padding:10px;">Oficiales</th><th style="padding:10px;">Acción</th></tr></thead>
<tbody>
@foreach($comisiones as $c)
<tr style="border-bottom:1px solid #f3f4f6; {{ $c->estado=='LIQUIDADA' ? 'background:#f0fdf4;' : '' }}">
<td style="padding:10px; font-family:monospace; font-size:11px;">{{ $c->codigo }}</td>
<td style="padding:10px; font-weight:bold;">{{ $c->destino }} @if($c->pasajeros->count()>1)<span style="background:#001f3f; color:white; font-size:9px; padding:1px 5px; border-radius:3px;">{{ $c->pasajeros->count() }} of. 1 factura</span>@endif</td>
<td style="padding:10px; text-align:center;"><span style="background:{{ $c->tipo=='NACIONAL' ? '#3b82f6' : '#7c3aed' }}; color:white; padding:3px 8px; border-radius:10px; font-size:10px;">{{ $c->tipo }}</span></td>
<td style="padding:10px; font-weight:bold; text-align:right;">${{ number_format($c->total_valor_pasajes,2) }}</td>
<td style="padding:10px; text-align:center;"><span style="background:{{ $c->estado=='LIQUIDADA' ? '#16a34a' : ($c->estado=='CUADRO_BORRADOR' ? '#f59e0b' : '#fde047') }}; color:{{ $c->estado=='LIQUIDADA' ? 'white' : '#000' }}; padding:3px 8px; border-radius:10px; font-size:10px; font-weight:bold;">{{ $c->estado }}</span></td>
<td style="padding:10px; text-align:center;">{{ $c->pasajeros->count() }} of. | Pases: {{ $c->pasajes->whereNotNull('pase_abordo_ida')->count() }}/{{ $c->pasajes->count() }}</td>
<td style="padding:10px; text-align:center;"><a href="{{ route('comisiones.show',$c->id) }}" style="background:#2563eb; color:white; padding:4px 12px; border-radius:4px; text-decoration:none; font-size:11px; font-weight:bold;">Ver</a></td>
</tr>
@endforeach
</tbody>
</table>
</div>
<div style="margin-top:12px;">{{ $comisiones->links() ?? '' }}</div>
<div style="margin-top:12px; padding:10px; background:#001f3f; color:white; border-radius:6px; font-size:11px;"><strong>Nota ESNACE:</strong> Factura compartida: 2 oficiales misma comisión $485.30 único (no $970.60) - 1 principal + 1 compartido $0 - Cada oficial con pase IDA/RETORNO fijo obligatorio.</div>
</div>

</div>
</div>
</x-app-layout>
