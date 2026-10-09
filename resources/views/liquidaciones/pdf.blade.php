<!DOCTYPE html>
<html><head><meta charset="utf-8">
<style>
@page { margin: 15mm 10mm 20mm 10mm; }
body { font-family: DejaVu Sans, sans-serif; font-size: 9px; }
.header-table { width:100%; border:none; }
.header-table td { border:none; text-align:center; }
.logo { width:75px; }
.titulo { text-align:center; font-size:13px; font-weight:bold; margin:10px 0 5px 0; }
.sub { text-align:center; font-size:8.5px; margin-bottom:10px; line-height:1.4; }
.tabla { width:100%; border-collapse:collapse; margin-top:8px; }
.tabla th { border:1px solid #000; padding:4px; background:#0a3161; color:white; font-size:8px; text-align:center; }
.tabla td { border:1px solid #000; padding:4px; font-size:8px; }
.bold { font-weight:bold; }
.center { text-align:center; }
.right { text-align:right; }
.verde { background:#d9ead3; }
.amarillo { background:#fff2cc; }
.firmas { width:100%; margin-top:40px; }
.firmas td { border:none; text-align:center; font-size:8px; }
.linea { border-top:1px solid #000; margin:0 20px; padding-top:5px; }
.nota { margin-top:10px; font-size:7.5px; border:1px solid #666; padding:6px; background:#fafafa; }
</style></head><body>

<table class="header-table">
<tr>
<td style="width:20%"><img src="{{ public_path('images/logo_armada.png') }}" class="logo"></td>
<td style="width:60%"><strong>ARMADA DEL ECUADOR</strong><br>COMANDO DE OPERACIONES NAVALES<br>FONDO ROTATIVO PASAJES AÉREOS - LIQUIDACIÓN POR COMPRA<br><small>Guayaquil</small></td>
<td style="width:20%"><img src="{{ public_path('images/logo_coopna.png') }}" class="logo"></td>
</tr>
</table>

<div class="titulo">LIQUIDACIÓN N° {{ $liq->codigo }} - SOLICITUD DE REPOSICIÓN 79.50%</div>
<div class="sub">
<strong>Fecha Liquidación:</strong> {{ $liq->fecha_liquidacion->format('d/m/Y') }} | 
<strong>Asignado:</strong> ${{ number_format($liq->monto_asignado,2) }} | 
<strong>Ejecutado al corte:</strong> ${{ number_format($control->monto_ejecutado,2) }} ({{ $liq->porcentaje_ejecutado }}%) | 
<strong>Saldo:</strong> ${{ number_format($liq->saldo_disponible_al_corte,2) }} | 
<strong>Monto a Reponer:</strong> ${{ number_format($liq->monto_ejecutado_liquidacion,2) }}<br>
<strong>Tipo:</strong> LIQUIDACIÓN POR COMPRA (PASAJE COMPRADO) - Incluye comisiones finalizadas y por viajar
</div>

<table class="tabla">
<thead><tr>
<th style="width:16%">Código</th>
<th style="width:20%">Ruta</th>
<th style="width:8%">Tipo</th>
<th style="width:14%">Fecha Viaje</th>
<th style="width:12%">Estado Viaje</th>
<th style="width:18%">Pasajero(s)</th>
<th style="width:12%">Valor</th>
</tr></thead>
<tbody>
@foreach($liq->comisiones as $c)
@php $esFinalizada = $c->fecha_retorno < now() || $c->tipo == 'NACIONAL'; @endphp
<tr class="{{ $esFinalizada ? 'verde' : 'amarillo' }}">
<td class="center">{{ $c->codigo }}</td>
<td>{{ $c->destino }}</td>
<td class="center">{{ $c->tipo }}</td>
<td class="center">{{ $c->fecha_salida->format('d/m/Y') }} al {{ $c->fecha_retorno->format('d/m/Y') }}</td>
<td class="center bold">{{ $esFinalizada ? 'FINALIZADA / VIAJADA' : 'POR VIAJAR - PASAJE COMPRADO' }}</td>
<td>
@foreach($c->pasajeros as $p)
{{ strtoupper(trim(($p->grado ?? '').' '.($p->apellidos ?? '').' '.($p->nombres ?? ''))) }}<br>
@endforeach
</td>
<td class="right bold">${{ number_format($c->pivot->valor,2) }}</td>
</tr>
@endforeach
<tr><td colspan="6" class="right bold">TOTAL LIQUIDADO POR COMPRA ({{ $liq->cantidad_comisiones }} comisiones)</td><td class="right bold">${{ number_format($liq->monto_ejecutado_liquidacion,2) }}</td></tr>
</tbody>
</table>

<div class="nota">
<strong>NOTA ACLARATORIA - LIQUIDACIÓN POR COMPRA:</strong> Conforme al Art. 43 del Reglamento de Fondos Rotativos y normativa interna de la Armada, la liquidación del Fondo Rotativo de Pasajes Aéreos procede por el devengado de la compra del pasaje (factura emitida y pasaje comprado), no por la finalización del viaje. Por lo tanto se incluyen:
<br>• <strong>1 comisión FINALIZADA / VIAJADA:</strong> Nacional GYE-UIO-GYE del 25/09/2026 ($318.55)
<br>• <strong>2 comisiones POR VIAJAR pero con PASAJE COMPRADO:</strong> GYE-BUSAN-GYE ($5,438.70) y ESPAÑA-ALICANTE ($2,193.09) - pasajes ya facturados y emitidos, viajes programados a futuro.
<br>Se adjuntan facturas, e-tickets y cuadros comparativos aprobados. Se solicita reposición por ${{ number_format($liq->monto_ejecutado_liquidacion,2) }} para restablecer el fondo a $10,000.00.
<br><br>
<strong>Detalle ejecución:</strong> Asignado $10,000 | Ejecutado al corte ${{ number_format($control->monto_ejecutado,2) }} ({{ $liq->porcentaje_ejecutado }}%) | Saldo ${{ number_format($liq->saldo_disponible_al_corte,2) }} | Se supera 70% -> procede reposición.
</div>

<div style="margin-top:10px; font-size:8.5px;">
<strong>Observaciones:</strong> {{ $liq->observaciones }}
</div>

<table class="firmas">
<tr>
<td style="width:45%"><div class="linea"><strong>ELABORADO POR</strong><br>TNFG-IG-IF TUSA VITAR EDUARDO<br>ADMINISTRADOR FONDO ROTATIVO<br>COOPNA</div></td>
<td style="width:10%"></td>
<td style="width:45%"><div class="linea"><strong>APROBADO / CUSTODIO</strong><br>TNNV-AB LOPEZ LUIS DAVID<br>COOPNA</div></td>
</tr>
</table>

<div style="text-align:center; font-size:6px; margin-top:20px; border-top:1px solid #ccc; padding-top:5px;">
SYED-ARE | {{ $liq->codigo }} | Liquidación por compra incluye por viajar | {{ now()->format('d/m/Y H:i') }} | Control: {{ $control->porcentaje_ejecutado }}%
</div>

</body></html>
