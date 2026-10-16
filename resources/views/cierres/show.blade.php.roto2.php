<x-app-layout>
@php
    $montoAsignado = $montoAsignado ?? 10000.00;
    $tarjetaTotal = $tarjetaTotal ?? 5.03;
    $fechaCierre = $fechaCierre ?? \Carbon\Carbon::create(2026,9,30);
    $fechaElaboracion = $fechaElaboracion ?? \Carbon\Carbon::create(2026,10,6);
    $mesNombre = mb_strtoupper(\Carbon\Carbon::parse($fechaCierre)->locale('es')->translatedFormat('F'), 'UTF-8');
    $anioCierre = \Carbon\Carbon::parse($fechaCierre)->format('Y');
@endphp
<style>
    @page { size: A4 portrait; margin: 10mm 10mm 8mm 10mm; }
    @media print {
        body { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        .no-print { display: none !important; }
    }
    html, body { margin:0; padding:0; height:100%; }
</style>
<div style="padding:6px; font-family:Arial, sans-serif; font-size:11px; width:100%; min-height:97vh; display:flex; flex-direction:column; justify-content:space-between;">

<div>
<div style="text-align:center; font-weight:bold; font-size:14px; line-height:1.25; margin-bottom:8px;">
ARMADA DEL ECUADOR<br>
COMANDO DE OPERACIONES NAVALES<br>
FONDO ROTATIVO PASAJES AÉREOS<br>
CIERRE MES DE: {{ $mesNombre }} {{ $anioCierre }}<br>
-Guayaquil-
</div>

<p style="text-align:center; font-size:10px; margin:4px 0 8px 0;">
Código: {{ $cierre->codigo ?? 'ESNACE-COOPNA-FR-2026-09' }} | 
Fecha Cierre: {{ $fechaCierre->format('d/m/Y') }} | 
Fecha Elaboración: {{ $fechaElaboracion->format('d/m/Y') }} | 
Cuenta: 3-00167809-0 - 7 trans ${{ number_format($totalGeneral,2) }} | Saldo: ${{ number_format($saldoFinal,2) }}
</p>

<div class="no-print" style="margin:6px 0;">
<a href="{{ route('cierres.pdf',$cierre->id) }}" style="background:#000; color:white; padding:5px 12px; text-decoration:none; font-weight:bold; font-size:11px;">PDF OFICIAL VERTICAL FULL</a>
<a href="{{ route('cierres.index') }}" style="border:1px solid #000; padding:4px 12px; text-decoration:none; color:#000; margin-left:4px; font-size:11px;">Volver</a>
</div>

<div style="background:#000; color:white; padding:5px 8px; font-weight:bold; font-size:12px;">1. ESTADO DE CUENTA BANECUADOR B.P. - 7 TRANSACCIONES</div>
<table style="width:100%; border-collapse:collapse; border:1px solid #000; font-size:10px; line-height:1.3;">
<thead>
<tr style="background:#ccc; font-weight:bold;">
<th style="border:1px solid #000; padding:5px 4px; width:10%;">FECHA</th>
<th style="border:1px solid #000; padding:5px 4px; width:44%;">DESCRIPCION</th>
<th style="border:1px solid #000; padding:5px 4px; width:14%;">REFERENCIA/CHEQUE</th>
<th style="border:1px solid #000; padding:5px 4px; width:8%;">DEBITO</th>
<th style="border:1px solid #000; padding:5px 4px; width:6%;">IVA</th>
<th style="border:1px solid #000; padding:5px 4px; width:9%;">S. CONTABLE</th>
<th style="border:1px solid #000; padding:5px 4px; width:9%;">S. DISPONIBLE</th>
</tr>
</thead>
<tbody>
@foreach($kardex as $k)
<tr style="{{ $k['es_inicial'] ? 'font-weight:bold; background:#f0f0f0;' : '' }}">
<td style="border:1px solid #000; padding:6px 4px;">{{ $k['fecha'] }}</td>
<td style="border:1px solid #000; padding:6px 4px; font-size:9px;">{{ $k['descripcion'] }}</td>
<td style="border:1px solid #000; padding:6px 4px;">{{ $k['ref'] }}</td>
<td style="border:1px solid #000; padding:6px 4px; text-align:right; font-weight:bold;">{{ $k['debito'] > 0 ? '$'.number_format($k['debito_base'] ?? $k['debito'],2) : '' }}</td>
<td style="border:1px solid #000; padding:6px 4px; text-align:right;">{{ ($k['iva'] ?? 0) > 0 ? '$'.number_format($k['iva'],2) : '0.00' }}</td>
<td style="border:1px solid #000; padding:6px 4px; text-align:right; font-weight:bold;">${{ number_format($k['s_contable'],2) }}</td>
<td style="border:1px solid #000; padding:6px 4px; text-align:right; font-weight:bold;">${{ number_format($k['s_disponible'],2) }}</td>
</tr>
@endforeach
<tr style="background:#000; color:white; font-weight:bold; font-size:11px;">
<td colspan="3" style="padding:6px 4px; text-align:right;">TOTAL DE TRANSACCIONES: 7 - TOTALES: </td>
<td style="padding:6px 4px; text-align:right;">${{ number_format($totalGeneral - ($tarjetaIva ?? 0.66),2) }}</td>
<td style="padding:6px 4px; text-align:right;">${{ number_format($tarjetaIva ?? 0.66,2) }}</td>
<td style="padding:6px 4px; text-align:right;">${{ number_format($saldoFinal,2) }}</td>
<td style="padding:6px 4px; text-align:right;">${{ number_format($saldoFinal,2) }}</td>
</tr>
</tbody>
</table>
</div>

{{-- FIRMAS QUE LLENAN ABAJO --}}
<div>
<table style="width:100%; border-collapse:collapse; margin-top:30px; font-size:11px;">
<tr>
<td style="width:50%; padding:20px 15px 0 15px; vertical-align:top;">
<div style="border-top:1px solid #000; padding-top:8px; text-align:center; width:90%; margin:0 auto;">
<strong style="font-size:11px;">TNFG-IG-IF TUSA VITAR EDUARDO STALIN</strong><br>
<span style="font-size:9px;">ADMINISTRADOR DEL FONDO ROTATIVO DE PASAJES</span>
</div>
</td>
<td style="width:50%; padding:20px 15px 0 15px; vertical-align:top;">
<div style="border-top:1px solid #000; padding-top:8px; text-align:center; width:90%; margin:0 auto;">
<strong style="font-size:11px;">SERPUB. PATRICIA NUÑEZ E.</strong><br>
<span style="font-size:9px;">CONTADORA</span>
</div>
</td>
</tr>
<tr>
<td colspan="2" style="padding-top:40px; text-align:center;">
<div style="border-top:1px solid #000; padding-top:8px; text-align:center; width:48%; margin:0 auto;">
<strong style="font-size:11px;">CPCB-AB VEGA CRESPO RUTH</strong><br>
<span style="font-size:9px;">COORDINADOR TÉCNICO DE ABASTECIMIENTOS Y FINANZAS 2</span>
</div>
</td>
</tr>
</table>
<div style="height:20px;"></div>
</div>

</div>
</x-app-layout>
