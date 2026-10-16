<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
    @page { size: A4 portrait; margin: 4mm 4mm 4mm 4mm; }
    body { font-family: Helvetica, Arial, sans-serif; font-size: 7.5px; margin:0; padding:0; color:#000; line-height:1.35; }
    table { border-collapse: collapse; width:100%; }
    .header-table { border:0; margin-bottom:2mm; }
    .header-table td { border:0; vertical-align:middle; padding:0; }
    .logo { width:52px; height:52px; object-fit:contain; }
    .titulo-central { text-align:center; font-weight:bold; font-size:10.5px; line-height:1.25; }
    .sub-titulo { text-align:center; font-size:7.5px; margin:1mm 0 1.5mm 0; line-height:1.35; }
    .seccion { background:#000; color:#fff; font-weight:bold; font-size:8.5px; padding:2.8mm 3mm; margin-top:4.5mm; margin-bottom:1.2mm; }
    .tabla th { background:#d9d9d9; font-weight:bold; font-size:6.8px; border:0.6px solid #000; padding:2.2mm 2px; text-align:center; line-height:1.2; }
    .tabla td { border:0.6px solid #000; padding:2.2mm 2px; font-size:6.8px; line-height:1.3; }
    .total-row { background:#000; color:#fff; font-weight:bold; }
    .total-row td { background:#000; color:#fff; padding:2.8mm 2px; }
    .firma { border-top:0.7px solid #000; padding-top:3mm; text-align:center; width:82%; margin:0 auto; }
    .firma strong { font-size:7px; line-height:1.25; }
    .firma span { font-size:6px; line-height:1.2; }
    .footer-line { text-align:center; font-size:6.5px; margin-top:6mm; border-top:0.6px solid #333; padding-top:2.5mm; font-weight:bold; }
</style>
</head>
<body>
@php
    $mesNombre = mb_strtoupper(\Carbon\Carbon::parse($fechaCierre)->locale('es')->translatedFormat('F'), 'UTF-8');
    $anioCierre = \Carbon\Carbon::parse($fechaCierre)->format('Y');

    // LOGOS - EMBEBIDOS BASE64 PARA QUE SALGAN SI O SI EN DOMPDF
    $logoArmadaBase64 = null;
    $logoCoopnaBase64 = null;
    
    $pathArmada = public_path('images/logo_armada.png');
    $pathCoopna = public_path('images/logo_coopna.png');
    $pathCoopnaAlt = public_path('images/timon_coopna.png');
    
    if(file_exists($pathArmada)){
        $logoArmadaBase64 = 'data:image/png;base64,'.base64_encode(file_get_contents($pathArmada));
    }
    if(file_exists($pathCoopna)){
        $logoCoopnaBase64 = 'data:image/png;base64,'.base64_encode(file_get_contents($pathCoopna));
    } elseif(file_exists($pathCoopnaAlt)){
        $logoCoopnaBase64 = 'data:image/png;base64,'.base64_encode(file_get_contents($pathCoopnaAlt));
    }
@endphp

<table class="header-table">
<tr>
<td style="width:14%; text-align:left;">
@if($logoArmadaBase64)
<img src="{{ $logoArmadaBase64 }}" class="logo">
@else
<div style="width:52px; height:52px; border:0.5px solid #000; text-align:center; font-size:5px; padding-top:15px;">LOGO ARMADA</div>
@endif
</td>
<td style="width:72%;">
<div class="titulo-central">
ARMADA DEL ECUADOR<br>
COMANDO DE OPERACIONES NAVALES<br>
FONDO ROTATIVO PASAJES AÉREOS<br>
-Guayaquil-<br>
CIERRE MENSUAL {{ $mesNombre }} {{ $anioCierre }} - CONCILIADO BANECUADOR B.P.
</div>
<div class="sub-titulo">
Cuenta Corriente No. 3-00167809-0 - FR-ESTACION NAVAL CENTRO<br>
{{ $cierre->codigo ?? 'ESNACE-COOPNA-FR-2026-09' }} | Fecha Cierre: {{ $fechaCierre->format('d/m/Y') }} | Total Transacciones: 7
</div>
</td>
<td style="width:14%; text-align:right;">
@if($logoCoopnaBase64)
<img src="{{ $logoCoopnaBase64 }}" class="logo">
@else
<div style="width:52px; height:52px; border:0.5px solid #000; text-align:center; font-size:5px; padding-top:15px;">LOGO COOPNA</div>
@endif
</td>
</tr>
</table>

<div class="seccion">1. ESTADO DE CUENTA BANECUADOR B.P. OFICIAL - 7 TRANSACCIONES - INICIAL $10,000.00</div>
<table class="tabla">
<thead><tr><th style="width:9%;">FECHA</th><th style="width:40%;">DESCRIPCION - COMISION DE QUE ES + REFERENCIA</th><th style="width:12%;">REFERENCIA</th><th style="width:9%;">DEBITO</th><th style="width:5%;">IVA</th><th style="width:12.5%;">S. CONTABLE</th><th style="width:12.5%;">S. DISPONIBLE</th></tr></thead>
<tbody>
<tr style="font-weight:bold; background:#efefef;"><td>01/09/2026</td><td>Saldo Inicial - Fondo Rotativo $10,000.00 - Cuenta 3-00167809-0 FR-ESTACION NAVAL CENTRO</td><td></td><td></td><td>0.00</td><td style="text-align:right;">$10,000.00</td><td style="text-align:right;">$10,000.00</td></tr>
<tr><td>07/09/2026</td><td>COMISION EMISION TARJETA DE DEBITO N/D 367724757 - Base $4.37 + IVA $0.66 = $5.03</td><td>367724757</td><td style="text-align:right;">$4.37</td><td style="text-align:right;">$0.66</td><td style="text-align:right;">$9,994.97</td><td style="text-align:right;">$9,994.97</td></tr>
<tr><td>21/09/2026</td><td>COM-20260921140224 - ESPAÑA - ALICANTE - N/D 427278449 - COMSUB ALICANTE - PREAUT. INTERNACIONAL MA</td><td>427278449</td><td style="text-align:right;">$2,193.09</td><td style="text-align:right;">0.00</td><td style="text-align:right;">$7,801.88</td><td style="text-align:right;">$7,801.88</td></tr>
<tr><td>24/09/2026</td><td>COM-20260923182516 - GUAYAQUIL-QUITO-GUAYAQUIL - N/D 442201661 - CONSUMO NACIONAL MASTERCARD</td><td>442201661</td><td style="text-align:right;">$318.55</td><td style="text-align:right;">0.00</td><td style="text-align:right;">$7,483.33</td><td style="text-align:right;">$7,483.33</td></tr>
<tr><td>25/09/2026</td><td>COM-20260925151104 - BUSAN - PASAJE N/D 447404188 - CONSUMO INTERNACIONAL MASTERCARD</td><td>447404188</td><td style="text-align:right;">$5,438.70</td><td style="text-align:right;">0.00</td><td style="text-align:right;">$2,044.63</td><td style="text-align:right;">$2,044.63</td></tr>
<tr><td>28/09/2026</td><td>COM-20260925151104 - BUSAN - TASAS N/D 449284260 - CONSUMO NACIONAL MASTERCARD - TASAS</td><td>449284260</td><td style="text-align:right;">$350.00</td><td style="text-align:right;">0.00</td><td style="text-align:right;">$1,694.63</td><td style="text-align:right;">$1,694.63</td></tr>
<tr><td>29/09/2026</td><td>COM-20260929175110 - GUAYAQUIL-LIMA-GUAYAQUIL - N/D 458666437 - LIMA - CONSUMO NACIONAL MASTERCARD</td><td>458666437</td><td style="text-align:right;">$777.78</td><td style="text-align:right;">0.00</td><td style="text-align:right;">$916.85</td><td style="text-align:right;">$916.85</td></tr>
<tr><td>30/09/2026</td><td>COM-20260930144832 - GUAYAQUIL-QUITO-GUAYAQUIL - N/D 466884295 - COM-20261008190741 1 PAX FACTURA COMPARTIDA - CONSUMO NACIONAL MASTERCARD</td><td>466884295</td><td style="text-align:right;">$485.30</td><td style="text-align:right;">0.00</td><td style="text-align:right;">$431.55</td><td style="text-align:right;">$431.55</td></tr>
<tr class="total-row"><td colspan="3" style="text-align:right;">TOTALES - 7 TRANSACCIONES</td><td style="text-align:right;">$9,567.79</td><td style="text-align:right;">$0.66</td><td style="text-align:right;">$431.55</td><td style="text-align:right;">$431.55</td></tr>
</tbody>
</table>

<div class="seccion">2. COMISIONES LIQUIDADAS</div>
<table class="tabla">
<thead><tr><th style="width:58%;">DESCRIPCIÓN DE LA COMISIÓN - IDA Y RETORNO + PASAJERO(S)</th><th style="width:12%;">VALOR</th><th style="width:18%;">BANECUADOR REF</th><th style="width:12%;">ESTADO</th></tr></thead>
<tbody>
<tr><td>COM-20260930144832 - GUAYAQUIL-QUITO-GUAYAQUIL (Ida: GYE-UIO 30/09/2026 / Retorno: UIO-GYE 02/10/2026) - 1 PAX - COOPNA/COMSUB - FACTURA COMPARTIDA COM-20261008190741</td><td style="text-align:right;">$485.30</td><td>466884295 - 30/09</td><td>LIQUIDADA</td></tr>
<tr><td>COM-20260923182516 - GUAYAQUIL-QUITO-GUAYAQUIL (Ida: GYE-UIO 23/09/2026 / Retorno: UIO-GYE 24/09/2026) - 1 PAX - TNFG-IG CAPELO STALIN - COMSUB</td><td style="text-align:right;">$318.55</td><td>442201661 - 24/09</td><td>LIQUIDADA</td></tr>
<tr class="total-row"><td style="text-align:right;">TOTAL LIQUIDADAS:</td><td style="text-align:right;">$803.85</td><td colspan="2"></td></tr>
</tbody>
</table>

<div class="seccion">3. COMISIONES POR LIQUIDAR CON FACTURA SIN PASES</div>
<table class="tabla">
<thead><tr><th style="width:44%;">DESCRIPCIÓN DE LA COMISIÓN - IDA Y RETORNO + PASAJERO(S)</th><th style="width:12%;">PASAJE</th><th style="width:9%;">TASAS</th><th style="width:12%;">TOTAL</th><th style="width:23%;">REF BANECUADOR</th></tr></thead>
<tbody>
<tr><td>COM-20260929175110 - GUAYAQUIL-LIMA-GUAYAQUIL (Ida: GYE-LIM 29/09/2026 / Retorno: LIM-GYE 02/10/2026) - 1 PAX - COOPNA LIMA</td><td style="text-align:right;">$777.78</td><td style="text-align:right;">$0</td><td style="text-align:right;">$777.78</td><td>458666437</td></tr>
<tr><td>COM-20260925151104 - GUAYAQUIL-BUSAN-GUAYAQUIL (Ida: GYE-BUSAN 25/09/2026 / Retorno: BUSAN-GYE 28/09/2026) - 2 PAX - CODESC BUSAN - PASAJEROS CODESC</td><td style="text-align:right;">$5,438.70</td><td style="text-align:right;">$350.00</td><td style="text-align:right;">$5,788.70</td><td>447404188 - 449284260</td></tr>
<tr><td>COM-20260921140224 - ESPAÑA - ALICANTE (Ida: GYE-ALICANTE 21/09/2026 / Retorno: ALICANTE-GYE 05/10/2026) - 1 PAX - CPCB-SS COBA LOOR RAFAEL - COMSUB ALICANTE</td><td style="text-align:right;">$2,193.09</td><td style="text-align:right;">$0</td><td style="text-align:right;">$2,193.09</td><td>427278449</td></tr>
<tr class="total-row"><td style="text-align:right;">TOTAL SIN PASES:</td><td style="text-align:right;">$8,409.57</td><td style="text-align:right;">$350.00</td><td style="text-align:right;">$8,759.57</td><td></td></tr>
</tbody>
</table>

<div class="seccion">4. CONCILIACIÓN BANCARIA</div>
<table class="tabla">
<tbody>
<tr><td style="width:70%;">Saldo Inicial Fondo Rotativo 01/09/2026 - Cuenta 3-00167809-0: $10,000.00</td><td style="width:30%; text-align:right; font-weight:bold;">$10,000.00</td></tr>
<tr><td>(-) Tarjeta Débito 07/09/2026 Ref 367724757 - Base $4.37 + IVA $0.66 = $5.03: $5.03</td><td style="text-align:right;">$5.03</td></tr>
<tr><td>(-) Comisiones Liquidadas 2 comis $803.85 ( $485.30 + $318.55 ): $803.85</td><td style="text-align:right;">$803.85</td></tr>
<tr><td>(-) Comisiones por Liquidar 3 comis $8,759.57 ( $777.78 + $5,438.70 + $350 + $2,193.09 ): $8,759.57</td><td style="text-align:right;">$8,759.57</td></tr>
<tr><td>Total Gastos Pasajes + Tarjeta $5.03: $9,568.45</td><td style="text-align:right; font-weight:bold;">$9,568.45</td></tr>
<tr><td>Saldo Final BanEcuador 30/09/2026 = $10,000.00 - $9,568.45: $431.55</td><td style="text-align:right; font-weight:bold;">$431.55</td></tr>
<tr style="background:#d9d9d9; font-weight:bold;"><td>VALOR A REPONER PARA COMPLETAR $10,000.00: $9,568.45</td><td style="text-align:right;">$9,568.45</td></tr>
</tbody>
</table>

<div class="seccion">5. RESUMEN POR REPARTOS - 07 PAX</div>
<table class="tabla">
<thead><tr><th>REPARTO</th><th>PAX</th><th>COMISIÓN</th><th>TOTAL</th></tr></thead>
<tbody>
<tr><td style="text-align:center; font-weight:bold;">COOPNA</td><td style="text-align:center;">1</td><td>COM-20260930144832 - GYE-UIO-GYE</td><td style="text-align:right;">$485.30</td></tr>
<tr><td style="text-align:center; font-weight:bold;">COMSUB</td><td style="text-align:center;">1</td><td>COM-20260923182516 - GYE-UIO-GYE</td><td style="text-align:right;">$318.55</td></tr>
<tr><td style="text-align:center; font-weight:bold;">COOPNA</td><td style="text-align:center;">1</td><td>COM-20260929175110 - GYE-LIM-GYE</td><td style="text-align:right;">$777.78</td></tr>
<tr><td style="text-align:center; font-weight:bold;">CODESC</td><td style="text-align:center;">2</td><td>COM-20260925151104 - GYE-BUSAN-GYE</td><td style="text-align:right;">$5,788.70</td></tr>
<tr><td style="text-align:center; font-weight:bold;">COMSUB</td><td style="text-align:center;">1</td><td>COM-20260921140224 - ESPAÑA - ALICANTE</td><td style="text-align:right;">$2,193.09</td></tr>
<tr class="total-row"><td style="text-align:center;">TOTAL - 5 COMIS - 7 PAX</td><td style="text-align:center;">7</td><td></td><td style="text-align:right;">$9,563.42</td></tr>
<tr><td colspan="3">+ Tarjeta Débito $5.03 (Base $4.37 + IVA $0.66)</td><td style="text-align:right;">$5.03</td></tr>
<tr class="total-row"><td colspan="3">TOTAL + TARJETA = $10,000.00 - $431.55</td><td style="text-align:right;">$9,568.45</td></tr>
</tbody>
</table>

<table style="width:100%; margin-top:7mm; border:0;">
<tr>
<td style="width:33%; border:0; padding:6mm 2mm 0 2mm;"><div class="firma"><strong>TNFG-IG-IF TUSA VITAR E. STALIN</strong><br><span>ADMINISTRADOR DEL FONDO ROTATIVO DE PASAJES</span></div></td>
<td style="width:33%; border:0; padding:6mm 2mm 0 2mm;"><div class="firma"><strong>SERPUB. PATRICIA NUÑEZ E.</strong><br><span>CONTADORA</span></div></td>
<td style="width:34%; border:0; padding:6mm 2mm 0 2mm;"><div class="firma"><strong>CPCB-AB VEGA CRESPO RUTH</strong><br><span>COORDINADOR TÉCNICO DE ABASTECIMIENTOS Y FINANZAS 2</span></div></td>
</tr>
</table>

<div class="footer-line">
ARMADA DEL ECUADOR | COMANDO DE OPERACIONES NAVALES | FONDO ROTATIVO PASAJES AÉREOS | Guayaquil | Fecha Cierre: {{ $fechaCierre->format('d/m/Y') }} | Fecha Elaboración: {{ $fechaElaboracion->format('d/m/Y') }} | Sistema SYED 2026
</div>

</body>
</html>
