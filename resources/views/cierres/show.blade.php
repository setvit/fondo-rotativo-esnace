<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Cierre Mensual - {{ $cierre->codigo ?? 'ESNACE-COOPNA-FR-2026-09' }}</title>
<style>
    body { font-family: Helvetica, Arial, sans-serif; font-size: 13px; margin:15px; background:#fff; }
    .titulo { text-align:center; font-weight:bold; font-size:18px; line-height:1.25; }
    .sub { text-align:center; font-size:13px; margin:8px 0 12px 0; }
    .btn-pdf { background:#000; color:#fff; border:none; padding:8px 16px; font-weight:bold; cursor:pointer; text-decoration:none; display:inline-block; }
    .btn-volver { background:#fff; border:1px solid #000; padding:8px 16px; margin-left:10px; cursor:pointer; text-decoration:none; color:#000; display:inline-block; }
    .seccion { background:#000; color:#fff; font-weight:bold; padding:8px 12px; margin-top:18px; font-size:14px; }
    table { width:100%; border-collapse:collapse; }
    th { background:#d9d9d9; border:1px solid #000; padding:8px 6px; font-size:12px; text-align:center; }
    td { border:1px solid #000; padding:7px 6px; font-size:12px; }
    .total-row { background:#000; color:#fff; font-weight:bold; }
    .total-row td { background:#000; color:#fff; }
    .firma { border-top:1px solid #000; padding-top:8px; text-align:center; width:80%; margin:0 auto; margin-top:60px; }
    .firma strong { font-size:13px; }
    .firma span { font-size:11px; }
    .text-right { text-align:right; }
    .bg-gris { background:#f2f2f2; }
</style>
</head>
<body>

<div class="titulo">
ARMADA DEL ECUADOR<br>
COMANDO DE OPERACIONES NAVALES<br>
FONDO ROTATIVO PASAJES AÉREOS<br>
CIERRE MES DE: SEPTIEMBRE 2026<br>
-Guayaquil-
</div>
<div class="sub">
Código: {{ $cierre->codigo ?? 'ESNACE-COOPNA-FR-2026-09' }} | Fecha Cierre: 30/09/2026 | Fecha Elaboración: 06/10/2026 | Cuenta: 3-00167809-0 - 7 trans $9,568.45 | Saldo: $431.55
</div>

<div style="margin:10px 0;">
{{-- RUTA CORREGIDA - Usa el método pdf() del controlador, no pdfOficial que no existe --}}
<a href="{{ url('/cierres-mensuales/'.$cierre->id.'/pdf') }}" target="_blank" class="btn-pdf">PDF OFICIAL VERTICAL FULL</a>
<a href="{{ url('/cierres-mensuales') }}" class="btn-volver">Volver</a>
</div>

<div class="seccion">1. ESTADO DE CUENTA BANECUADOR B.P. - 7 TRANSACCIONES</div>
<table>
<thead>
<tr>
<th style="width:10%;">FECHA</th>
<th style="width:38%;">DESCRIPCION</th>
<th style="width:14%;">REFERENCIA/CHEQUE</th>
<th style="width:10%;">DEBITO</th>
<th style="width:6%;">IVA</th>
<th style="width:11%;">S. CONTABLE</th>
<th style="width:11%;">S. DISPONIBLE</th>
</tr>
</thead>
<tbody>
<tr style="font-weight:bold;" class="bg-gris">
<td>01/09/2026</td>
<td>Saldo Inicial - Fondo Rotativo $10,000.00 - Cuenta 3-00167809-0 FR-ESTACION NAVAL CENTRO</td>
<td></td>
<td></td>
<td class="text-right">0.00</td>
<td class="text-right">$10,000.00</td>
<td class="text-right">$10,000.00</td>
</tr>
<tr>
<td>07/09/2026</td>
<td>COMISION EMISION TARJETA DE DEBITO N/D 367724757 - Base $4.37 + IVA $0.66 = $5.03</td>
<td>367724757</td>
<td class="text-right"><strong>$4.37</strong></td>
<td class="text-right">$0.66</td>
<td class="text-right">$9,994.97</td>
<td class="text-right">$9,994.97</td>
</tr>
<tr>
<td>21/09/2026</td>
<td>COM-20260921140224 - ESPAÑA - ALICANTE - N/D 427278449 - COMSUB ALICANTE - PREAUTORIZACION INTERNACIONAL MA</td>
<td>427278449</td>
<td class="text-right"><strong>$2,193.09</strong></td>
<td class="text-right">0.00</td>
<td class="text-right">$7,801.88</td>
<td class="text-right">$7,801.88</td>
</tr>
<tr>
<td>24/09/2026</td>
<td>COM-20260923182516 - GUAYAQUIL-QUITO-GUAYAQUIL - N/D 442201661 - COMISION GUAYAQUIL-QUITO-GUAYAQUIL - CONSUMO NACIONAL MASTERCARD</td>
<td>442201661</td>
<td class="text-right"><strong>$318.55</strong></td>
<td class="text-right">0.00</td>
<td class="text-right">$7,483.33</td>
<td class="text-right">$7,483.33</td>
</tr>
<tr>
<td>25/09/2026</td>
<td>N/D CTA.CTE. BUSAN - CONSUMO INTERNACIONAL MASTERCARD - PASAJE N/D 447404188</td>
<td>447404188</td>
<td class="text-right"><strong>$5,438.70</strong></td>
<td class="text-right">0.00</td>
<td class="text-right">$2,044.63</td>
<td class="text-right">$2,044.63</td>
</tr>
<tr>
<td>28/09/2026</td>
<td>N/D CTA.CTE. BUSAN - CONSUMO NACIONAL MASTERCARD - TASAS N/D 449284260</td>
<td>449284260</td>
<td class="text-right"><strong>$350.00</strong></td>
<td class="text-right">0.00</td>
<td class="text-right">$1,694.63</td>
<td class="text-right">$1,694.63</td>
</tr>
<tr>
<td>29/09/2026</td>
<td>COM-20260929175110 - GUAYAQUIL-LIMA-GUAYAQUIL - N/D 458666437 - LIMA - CONSUMO NACIONAL MASTERCARD</td>
<td>458666437</td>
<td class="text-right"><strong>$777.78</strong></td>
<td class="text-right">0.00</td>
<td class="text-right">$916.85</td>
<td class="text-right">$916.85</td>
</tr>
<tr>
<td>30/09/2026</td>
<td>COM-20260930144832 - GUAYAQUIL-QUITO-GUAYAQUIL - N/D 466884295 - COM-20261008190741 GUAYAQUIL-QUITO-GUAYAQUIL 1 PAX FACTURA COMPARTIDA - CONSUMO NACIONAL MASTERCARD</td>
<td>466884295</td>
<td class="text-right"><strong>$485.30</strong></td>
<td class="text-right">0.00</td>
<td class="text-right">$431.55</td>
<td class="text-right">$431.55</td>
</tr>
<tr class="total-row">
<td colspan="3" style="text-align:right; padding-right:15px;">TOTAL DE TRANSACCIONES: 7 - TOTALES:</td>
<td class="text-right">$9,567.79</td>
<td class="text-right">$0.66</td>
<td class="text-right">$431.55</td>
<td class="text-right">$431.55</td>
</tr>
</tbody>
</table>

<div style="margin-top:80px; display:flex; justify-content:space-between;">
<div style="width:48%;">
<div class="firma">
<strong>TNFG-IG-IF TUSA VITAR EDUARDO STALIN</strong><br>
<span>ADMINISTRADOR DEL FONDO ROTATIVO DE PASAJES</span>
</div>
</div>
<div style="width:48%;">
<div class="firma">
<strong>SERPUB. PATRICIA NUÑEZ E.</strong><br>
<span>CONTADORA</span>
</div>
</div>
</div>

<div style="margin-top:60px; width:50%; margin-left:auto; margin-right:auto;">
<div class="firma">
<strong>CPCB-AB VEGA CRESPO RUTH</strong><br>
<span>COORDINADOR TÉCNICO DE ABASTECIMIENTOS Y FINANZAS 2</span>
</div>
</div>

</body>
</html>
