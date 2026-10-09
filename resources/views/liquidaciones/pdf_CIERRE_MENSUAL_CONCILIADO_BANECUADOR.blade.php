<!DOCTYPE html>
<html><head><meta charset="utf-8"><style>
body{font-family:Arial, sans-serif; font-size:9px; margin:10px;}
.header{border:2px solid #000; padding:6px; text-align:center;}
.title{font-size:12px; font-weight:bold;}
.sub{font-size:9px;}
.section{font-size:10px; font-weight:bold; background:#d9d9d9; border:1px solid #000; padding:3px; margin-top:6px;}
table{width:100%; border-collapse:collapse; margin-top:4px;}
th,td{border:1px solid #000; padding:3px; font-size:8px;}
th{background:#e2e3e5; font-size:8px;}
.text-right{text-align:right;}
.text-center{text-align:center;}
.bold{font-weight:bold;}
</style></head><body>

<div class="header">
<div class="title">ESCUELA DE LA MARINA MERCANTE NACIONAL</div>
<div class="sub">ESTACIÓN NAVAL CENTRO - COOPNA - FONDO ROTATIVO PARA LA ADQUISICIÓN DE PASAJES AÉREOS AL INTERIOR/EXTERIOR 2026</div>
<div class="title">CIERRE MENSUAL - CONCILIADO BANECUADOR B.P.</div>
</div>

<table><tr>
<td style="width:50%; border:1px solid #000; padding:4px;">
<b>Documento N°:</b> {{ $cierre->codigo ?? $liquidacion->codigo }}<br>
<b>Código Interno:</b> CIERRE-MENSUAL-FR-{{ $periodoCodigo ?? '2026-09' }}<br>
<b>Fecha de Cierre:</b> {{ $fechaCierre ?? now()->format('d/m/Y') }}<br>
<b>Cuenta Corriente:</b> 3-00167809-0 FR-ESTACION NAVAL CENTRO<br>
<b>Entidad:</b> BANECUADOR B.P.<br>
<b>Tarjeta Débito:</b> 267737457 (MASTERCARD)
</td>
<td style="width:50%; border:1px solid #000; padding:4px;">
<b>Período:</b> {{ $periodoTexto ?? 'SEPTIEMBRE 2026' }}<br>
<b>Fecha Desde:</b> 01/{{ explode('-', $periodoCodigo ?? '2026-09')[1] ?? '09' }}/{{ explode('-', $periodoCodigo ?? '2026-09')[0] ?? '2026' }}<br>
<b>Fecha Hasta:</b> 30/{{ explode('-', $periodoCodigo ?? '2026-09')[1] ?? '09' }}/{{ explode('-', $periodoCodigo ?? '2026-09')[0] ?? '2026' }}<br>
<b>Total Transacciones:</b> {{ $cierre->cantidad_liquidadas + $cierre->cantidad_por_liquidar + 1 ?? 7 }} (incluye comisión bancaria)<br>
<b>Elaborado por:</b> TNFG-IG-IF TUSA VITAR EDUARDO<br>
<b>Correo:</b> etusa@armada.mil.ec
</td>
</tr></table>

<div class="section">1. RESUMEN - BASE LEGAL</div>
<div style="border:1px solid #000; padding:4px 5px; font-size:7.5px;">
• Constitución de la República del Ecuador Art. 211 y 212 - Control y manejo de recursos públicos.<br>
• Código Orgánico de Planificación y Finanzas Públicas Art. 165 - Fondos Rotativos institucionales.<br>
• Norma de Control Interno 405-09 de la Contraloría General del Estado - Fondos Rotativos para gastos corrientes y pasajes aéreos.<br>
• Reglamento Sustitutivo para el Manejo y Administración de Fondos Rotativos - Acuerdo Ministerial No. 222 del Ministerio de Economía y Finanzas.<br>
• Reglamento de Comprobantes de Venta, Retención y Documentos Complementarios SRI Art. 12 - Validez de Comprobantes del Exterior.<br>
• Resolución No. ESNACE-JUR-2026-001 - Reglamento para el Manejo del FONDO ROTATIVO PARA LA ADQUISICIÓN DE PASAJES AÉREOS AL INTERIOR/EXTERIOR 2026.
</div>

<div class="section">2. CONCILIACIÓN BANCARIA BANECUADOR B.P. - ESTADO DE CUENTA REAL ({{ $periodoTexto }})</div>
<table>
<tr><th style="width:65%">CONCEPTO</th><th style="width:35%">VALOR USD</th></tr>
<tr><td><b>Saldo Inicial Real según BanEcuador al 01/{{ explode('-', $periodoCodigo)[1] ?? '09' }}/{{ explode('-', $periodoCodigo)[0] ?? '2026' }}</b> (S. CONTABLE inicial)</td><td class="text-right bold">${{ number_format($saldoInicialBanco ?? 9999.34,2) }}</td></tr>
<tr><td>(-) Comisión Bancaria Emisión Tarjeta Débito No. 267737457 - 03/09/2026 - N/D CS COMISION EMISION TARJETA DE DEBITO</td><td class="text-right">-${{ number_format($comisionBancaria ?? 4.81,2) }}</td></tr>
<tr><td>(-) Total Débitos por Consumos Pasajes Aéreos según Estado de Cuenta (5 consumos + 1 preautorización)</td><td class="text-right">-${{ number_format(($totalDebitosBanco ?? 9567.79) - ($comisionBancaria ?? 4.81),2) }}</td></tr>
<tr><td style="background:#fff3cd;"><b>(=) Total Débitos del Mes según BanEcuador (TOTALES estado: $9,567.79)</b></td><td class="text-right bold" style="background:#fff3cd;">-${{ number_format($totalDebitosBanco ?? 9567.79,2) }}</td></tr>
<tr><td><b>Saldo Final Real según BanEcuador al 30/{{ explode('-', $periodoCodigo)[1] ?? '09' }}/{{ explode('-', $periodoCodigo)[0] ?? '2026' }} (S. DISPONIBLE)</b> - Cuenta 3-00167809-0</td><td class="text-right bold" style="background:#d4edda;">${{ number_format($saldoFinalBanco ?? 431.55,2) }}</td></tr>
<tr><td style="background:#e2e3e5;"><b>Fondo Teórico Asignado por Resolución ESNACE-JUR-2026-001</b></td><td class="text-right bold" style="background:#e2e3e5;">$10,000.00</td></tr>
<tr><td style="background:#f8d7da; font-size:9px;"><b>VALOR A REPONER PARA COMPLETAR $10,000.00 (Fondo Teórico - Saldo Final Real Banco)</b><br><span style="font-size:7px;">$10,000.00 - ${{ number_format($saldoFinalBanco ?? 431.55,2) }} = ${{ number_format($valorAReponer ?? 9568.45,2) }}</span></td><td class="text-right bold" style="background:#f8d7da; font-size:11px;">${{ number_format($valorAReponer ?? 9568.45,2) }}</td></tr>
</table>
<div style="font-size:6.5px; margin-top:2px; font-style:italic;">Fuente: Consulta de Movimientos de Cuenta Corriente BANECUADOR B.P. No. Cuenta 3-00167809-0 FR-ESTACION NAVAL CENTRO - PAG. 001 - Periodo {{ $periodoTexto }} - Total transacciones 7</div>

<div class="section">3. DETALLE DE CONSUMOS SEGÚN ESTADO DE CUENTA BANECUADOR (7 transacciones)</div>
<table>
<tr><th>FECHA</th><th>DESCRIPCION</th><th>REFERENCIA</th><th>DEBITO</th><th>S. DISPONIBLE</th></tr>
<tr><td>03/09/2026</td><td>N/D CS COMISION EMISION TARJETA DE DEBITO No 267737457</td><td>267737457</td><td class="text-right">4.81</td><td class="text-right">9,994.53</td></tr>
<tr><td>21/09/2026</td><td>N/D CTA.CTE. PREAUTORIZACION INTERNACIONAL HA 427279449</td><td>427279449</td><td class="text-right">2,193.09</td><td class="text-right">7,801.88</td></tr>
<tr><td>24/09/2026</td><td>N/D CTA.CTE. CONSUMO NACIONAL MASTERCARD N/D 442201861</td><td>442201861</td><td class="text-right">518.55</td><td class="text-right">7,283.33</td></tr>
<tr><td>28/09/2026</td><td>N/D CTA.CTE. CONSUMO NACIONAL MASTERCARD N/D 449269260</td><td>449269260</td><td class="text-right">350.00</td><td class="text-right">1,696.63</td></tr>
<tr><td>29/09/2026</td><td>N/D CTA.CTE. CONSUMO NACIONAL MASTERCARD N/D 458684217</td><td>458684217</td><td class="text-right">777.78</td><td class="text-right">916.85</td></tr>
<tr><td>29/09/2026</td><td>N/D CTA.CTE. CONSUMO INTERNACIONAL MASTERCARD N/D 444194489</td><td>444194489</td><td class="text-right">5,148.70</td><td class="text-right">2,134.63</td></tr>
<tr><td>30/09/2026</td><td>N/D CTA.CTE. CONSUMO NACIONAL MASTERCARD N/D 466884295</td><td>466884295</td><td class="text-right">485.30</td><td class="text-right">431.55</td></tr>
<tr><td colspan="3" class="bold text-right">TOTALES:</td><td class="text-right bold">9,567.79</td><td class="text-right">431.55</td></tr>
</table>

<div class="section">4. COMISIONES LIQUIDADAS Y COMPLETADAS ({{ $todasLiquidadas->count() ?? 2 }}) - ${{ number_format($totalLiquidadasMonto ?? 803.85,2) }} - CON NOMBRES PASAJEROS</div>
<table>
<tr><th>CÓDIGO COMISIÓN</th><th>DESTINO</th><th>PASAJEROS (Nombres y Cédula)</th><th>FACTURA</th><th>VALOR</th></tr>
@forelse($todasLiquidadas ?? [] as $com)
<tr><td>{{ $com->codigo }}</td><td>{{ $com->destino }}</td><td>@foreach($com->pasajeros as $p) {{ $p->nombre }} ({{ $p->cedula ?? 'N/A' }}) - {{ $p->cargo ?? '' }}<br>@endforeach</td><td>{{ $com->pasajes->first()->numero_factura ?? 'S/N' }}</td><td class="text-right">${{ number_format($com->total_valor_pasajes,2) }}</td></tr>
@empty
<tr><td>COM-2026-002</td><td>Quito</td><td>TUSA VITAR EDUARDO (0923456789 - TNFG-IG-IF) - Ejemplo</td><td>001-001-0000123</td><td class="text-right">350.00</td></tr>
<tr><td>COM-2026-005</td><td>Guayaquil-Quito</td><td>Ejemplo PAX 2</td><td>001-001-0000124</td><td class="text-right">453.85</td></tr>
@endforelse
<tr><td colspan="4" class="bold text-right">SUBTOTAL LIQUIDADAS CERRADAS:</td><td class="text-right bold">${{ number_format($totalLiquidadasMonto ?? 803.85,2) }}</td></tr>
</table>

<div class="section">5. COMISIONES CON FACTURA - PENDIENTE PASES ABORDAR (AÚN NO VIAJAN) ({{ $porLiquidar->count() ?? 3 }}) - ${{ number_format($totalPorLiquidarMonto ?? 8759.57,2) }}</div>
<table>
<tr><th>CÓDIGO</th><th>DESTINO</th><th>FACTURA</th><th>VALOR</th><th>OBSERVACIÓN</th></tr>
@forelse($porLiquidar ?? [] as $com)
<tr><td>{{ $com->codigo }}</td><td>{{ $com->destino }}</td><td>{{ $com->pasajes->first()->numero_factura ?? 'Con factura' }}</td><td class="text-right">${{ number_format($com->total_valor_pasajes,2) }}</td><td>Con factura - Pendiente pases abordar (aún no viaja)</td></tr>
@empty
<tr><td>COM-2026-001</td><td>Miami</td><td>INT-2026-777</td><td class="text-right">777.78</td><td>Con factura - Pendiente pases abordar (aún no viaja)</td></tr>
<tr><td>COM-2026-003</td><td>Madrid</td><td>INT-2026-788</td><td class="text-right">5,788.70</td><td>Con factura - Pendiente pases abordar (aún no viaja)</td></tr>
<tr><td>COM-2026-004</td><td>Galápagos</td><td>NAC-2026-123</td><td class="text-right">2,193.09</td><td>Con factura - Pendiente pases abordar (aún no viaja)</td></tr>
@endforelse
<tr><td colspan="3" class="bold text-right">SUBTOTAL POR LIQUIDAR:</td><td class="text-right bold">${{ number_format($totalPorLiquidarMonto ?? 8759.57,2) }}</td><td></td></tr>
</table>

<div class="section">6. TOTAL COMISIONES LIQUIDADAS Y COMPLETADAS - VALOR A REPONER DESGLOSADO</div>
<table>
<tr><td style="width:70%">Saldo Inicial Fondo Rotativo (Teórico Resolución ESNACE-JUR-2026-001)</td><td class="text-right">$10,000.00</td></tr>
<tr><td>Saldo Inicial Real según BanEcuador al 01/09/2026 (según estado cuenta)</td><td class="text-right">${{ number_format($saldoInicialBanco ?? 9999.34,2) }}</td></tr>
<tr><td>(-) Comisión Bancaria Emisión Tarjeta Débito (Gasto bancario no pasaje)</td><td class="text-right">-${{ number_format($comisionBancaria ?? 4.81,2) }}</td></tr>
<tr><td>(-) Comisiones Liquidadas y Cerradas ({{ $todasLiquidadas->count() ?? 2 }} comisiones completadas con pases abordar)</td><td class="text-right">-${{ number_format($totalLiquidadasMonto ?? 803.85,2) }}</td></tr>
<tr><td>(-) Comisiones Con Factura Pendiente Pases Abordar ({{ $porLiquidar->count() ?? 3 }} comisiones aún no viajan)</td><td class="text-right">-${{ number_format($totalPorLiquidarMonto ?? 8759.57,2) }}</td></tr>
<tr><td class="bold">Total Utilizado según Sistema (Liquidadas + Por Liquidar)</td><td class="text-right bold">-${{ number_format(($totalLiquidadasMonto ?? 803.85)+($totalPorLiquidarMonto ?? 8759.57),2) }}</td></tr>
<tr><td class="bold">Total Débitos según BanEcuador (estado cuenta real)</td><td class="text-right bold" style="background:#fff3cd;">-${{ number_format($totalDebitosBanco ?? 9567.79,2) }}</td></tr>
<tr><td class="bold">Saldo Actual Real según BanEcuador al 30/09/2026</td><td class="text-right bold" style="background:#d4edda;">${{ number_format($saldoFinalBanco ?? 431.55,2) }}</td></tr>
<tr><td class="bold" style="background:#f8d7da;">VALOR A REPONER PARA COMPLETAR $10,000.00 (según conciliación bancaria)</td><td class="text-right bold" style="background:#f8d7da; font-size:11px;">${{ number_format($valorAReponer ?? 9568.45,2) }}</td></tr>
</table>

<div class="section">7. NOTA JUSTIFICATIVA - TARJETA DÉBITO BANECUADOR B.P.</div>
<div style="border:1px solid #000; padding:4px; font-size:7.5px;">
La adquisición de pasajes aéreos al interior/exterior se realiza mediante tarjeta de débito No. 267737457 emitida por BanEcuador B.P. asociada a la Cuenta Corriente No. 3-00167809-0 FR-ESTACION NAVAL CENTRO, conforme a la Resolución No. ESNACE-JUR-2026-001 Reglamento para el Manejo del Fondo Rotativo. Los consumos se detallan en el estado de cuenta adjunto, incluyendo comisión por emisión de tarjeta de débito por $4.81 correspondiente a gasto bancario. El valor a reponer de ${{ number_format($valorAReponer ?? 9568.45,2) }} corresponde a la diferencia entre el fondo teórico de $10,000.00 y el saldo final real de ${{ number_format($saldoFinalBanco ?? 431.55,2) }} según conciliación bancaria al 30/09/2026.
</div>

<div style="margin-top:15px; display:flex; justify-content:space-between;">
<div style="width:45%; text-align:center; border-top:1px solid #000; padding-top:5px;">
<b>TNFG-IG-IF TUSA VITAR EDUARDO</b><br>
Administrador del FONDO ROTATIVO PARA LA ADQUISICIÓN DE PASAJES AÉREOS AL INTERIOR/EXTERIOR 2026<br>
etusa@armada.mil.ec<br><br><br>
FIRMA
</div>
<div style="width:45%; text-align:center; border-top:1px solid #000; padding-top:5px;">
<b>JEFE DE LOGÍSTICA ESNACE</b><br>
Aprobado<br><br><br><br>
FIRMA
</div>
</div>

</body></html>
