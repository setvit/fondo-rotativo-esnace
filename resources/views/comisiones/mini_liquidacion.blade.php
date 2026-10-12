<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Kardex {{ $comision->codigo }}</title>
<style>
@page{size:A4 landscape; margin:15mm 10mm 15mm 10mm;}
body{font-family:Arial,Helvetica,sans-serif; font-size:11px; margin:0; padding:0; background:#fff; color:#000;}
.header{border:2px solid #000; padding:8px; margin-bottom:10px;}
.header-top{display:flex; justify-content:space-between; align-items:center;}
.escudo{width:60px; height:60px; border:1px solid #000; text-align:center; line-height:60px; font-size:8px; font-weight:900;}
.header-center{text-align:center; flex:1;}
.header-center h1{font-size:13px; margin:0; font-weight:900;}
.header-center h2{font-size:11px; margin:2px 0; font-weight:700;}
.table{width:100%; border-collapse:collapse; margin:8px 0;}
.table th{border:1px solid #000; background:#d9d9d9; padding:4px 3px; font-size:9px; font-weight:900; text-align:center;}
.table td{border:1px solid #000; padding:3px; font-size:8px;}
.text-right{text-align:right;}
.text-center{text-align:center;}
.bg-black{background:#000; color:#fff; font-weight:900;}
.bg-yellow{background:#ffffcc; font-weight:900; border:2px solid #000;}
.bg-gray{background:#e5e7eb; font-weight:900;}
.card{border:2px solid #000; margin-bottom:10px;}
.card-header{background:#000; color:#fff; padding:5px 8px; font-weight:900; font-size:10px;}
.footer{text-align:center; border-top:3px solid #000; margin-top:15px; padding-top:8px; font-weight:900; font-size:10px; line-height:1.3;}
.small{font-size:7px;}
</style>
</head>
<body>


@php
$logoArmadaPath = public_path('images/logo_armada.png');
$logoCoopnaPath = public_path('images/logo_coopna.png');
$logoArmadaB64 = file_exists($logoArmadaPath) ? 'data:image/png;base64,'.base64_encode(file_get_contents($logoArmadaPath)) : '';
$logoCoopnaB64 = file_exists($logoCoopnaPath) ? 'data:image/png;base64,'.base64_encode(file_get_contents($logoCoopnaPath)) : '';
@endphp
<div class="header" style="border:2px solid #000; padding:5px;">
<table width="100%" style="border:none; border-collapse:collapse;">
<tr>
<td width="12%" style="border:none; text-align:left; vertical-align:top;">
@if($logoArmadaB64)<img src="{{ $logoArmadaB64 }}" style="width:70px; height:70px;">@endif
</td>
<td width="76%" style="border:none; text-align:center; vertical-align:middle;">
<h1 style="font-size:12px; margin:0;">ARMADA DEL ECUADOR - COMANDO DE OPERACIONES NAVALES</h1>
<h1 style="font-size:11px; margin:2px 0;">FONDO ROTATIVO PASAJES AÉREOS - KARDEX POR COMISIÓN - MINI LIQUIDACIÓN</h1>
<h2 style="font-size:9px; margin:2px 0;">Comisión: {{ $comision->codigo }} | Destino: {{ $comision->destino }} | Tipo: {{ $comision->tipo }} | Total REAL: ${{ number_format($totalComision,2) }} único | Cuenta: 3-00167809-0 | Saldo Final: 1.55</h2>
</td>
<td width="12%" style="border:none; text-align:right; vertical-align:top;">
@if($logoCoopnaB64)<img src="{{ $logoCoopnaB64 }}" style="width:70px; height:70px;">@endif
</td>
</tr>
</table>
</div>

</div>

<!-- RESUMEN FONDO -->
<div class="card">
    <div class="card-header">RESUMEN FONDO ROTATIVO A LA FECHA - KARDEX - SALDO ANTES, GASTO ESTA COMISIÓN Y SALDO DESPUÉS PARA SIGUIENTE</div>
    <table class="table" style="margin:0;">
        <tr><th style="width:65%; text-align:left;">CONCEPTO</th><th>VALOR</th><th>SALDO</th></tr>
        <tr><td>Saldo Inicial Real BanEcuador 06/09/2026 - Cuenta 3-00167809-0</td><td class="text-right">$9,999.34</td><td class="text-right">$9,999.34</td></tr>
        <tr><td>Comisión Emisión Tarjeta 367724757 - 09/07/2026</td><td class="text-right">-$5.03</td><td class="text-right">$9,994.31 operativo</td></tr>
        <tr class="bg-gray"><td>Saldo del Fondo ANTES de esta comisión <strong>{{ $comision->codigo }}</strong> al {{ $saldoAntesFecha }} - Antes de comprar</td><td class="text-right"></td><td class="text-right" style="font-size:11px;">${{ number_format($saldoAntes,2) }}</td></tr>
        <tr><td>Valor Gastado en ESTA comisión {{ $comision->codigo }} - {{ $comision->destino }} - {{ $comision->pasajes->where('es_factura_principal',true)->count() ?: $comision->pasajes->count() }} pasaje(s) REAL único</td><td class="text-right" style="font-weight:900;">${{ number_format($totalComision,2) }}</td><td class="text-right"></td></tr>
        <tr class="bg-black"><td>Saldo DISPONIBLE DESPUÉS de esta comisión {{ $comision->codigo }} para seguir gastando en siguiente comisión</td><td class="text-right"></td><td class="text-right" style="font-size:12px;">${{ number_format($saldoDespues,2) }}</td></tr>
        <tr><td>Total Acumulado Gastado hasta esta comisión (incluye tarjeta $5.03 + esta comisión) - 7 trans $9,567.79</td><td class="text-right">${{ number_format($acumuladoGastado,2) }}</td><td class="text-right"></td></tr>
    </table>
</div>

<!-- DETALLE PASAJES ESTA COMISION -->
<div class="card">
    <div class="card-header">1. PASAJES DE ESTA COMISIÓN {{ $comision->codigo }} - SALDO ANTES, DEBITO Y SALDO DESPUÉS POR PASAJE - Factura Compartida ${{ number_format($totalComision,2) }} único</div>
    <table class="table" style="margin:0;">
        <thead><tr><th>FECHA</th><th>PASAJERO</th><th>RUTA / DESTINO</th><th>AEROLÍNEA</th><th>FACTURA</th><th>PRINCIPAL</th><th>SALDO ANTES</th><th>DEBITO REAL</th><th>S. DISPONIBLE DESPUÉS</th></tr></thead>
        <tbody>
            @php $sTemp = $saldoAntes; @endphp
            @forelse($comision->pasajes->sortBy('es_factura_principal')->reverse() as $pje)
                @php
                    $antes = $sTemp;
                    $debito = $pje->es_factura_principal ? $pje->valor : 0;
                    if($pje->es_factura_principal) $sTemp -= $pje->valor;
                @endphp
                <tr>
                    <td class="text-center">{{ $pje->created_at ? $pje->created_at->format('d/m/Y') : '06/10/2026' }}</td>
                    <td>{{ $pje->pasajero->nombre ?? 'PAX' }} - {{ $pje->pasajero->reparto ?? '' }}</td>
                    <td>{{ $pje->ruta ?? $comision->destino }}</td>
                    <td class="text-center">{{ $pje->aerolinea ?? '' }}</td>
                    <td class="text-center" style="font-size:7px;">{{ $pje->numero_factura ?? '' }}</td>
                    <td class="text-center">{{ $pje->es_factura_principal ? 'SI $'.$pje->valor : 'NO $0 compartida' }}</td>
                    <td class="text-right">${{ number_format($antes,2) }}</td>
                    <td class="text-right" style="font-weight:900;">${{ number_format($debito,2) }}</td>
                    <td class="text-right" style="font-weight:900; background:#f2f2f2;">${{ number_format($sTemp,2) }}</td>
                </tr>
            @empty
                <tr><td colspan="9" class="text-center">Sin pasajes - Ejemplo: BUSAN $5,438.70 + $350 tasas, ALICANTE $2,193.09, LIMA $777.78, LIQUIDADAS $318.55 y $485.30</td></tr>
            @endforelse
            <tr class="bg-black"><td colspan="6" style="text-align:right;">TOTAL REAL ESTA COMISIÓN {{ $comision->codigo }} (no duplicado):</td><td></td><td class="text-right">${{ number_format($totalComision,2) }}</td><td class="text-right">${{ number_format($saldoDespues,2) }}</td></tr>
        </tbody>
    </table>
</div>

<!-- KARDEX HISTORICO -->
<div class="card">
    <div class="card-header">2. KARDEX HISTÓRICO COMPLETO - TODAS LAS COMISIONES - CUANTO TENÍA, CUANTO GASTÓ Y CUANTO QUEDÓ PARA LA SIGUIENTE</div>
    <table class="table" style="margin:0;">
        <thead><tr><th>#</th><th>FECHA</th><th>CÓDIGO</th><th>DESTINO</th><th>PAX</th><th>GASTO REAL</th><th>SALDO ANTES</th><th>SALDO DESPUÉS</th><th>DISPONIBLE SIGUIENTE</th></tr></thead>
        <tbody>
            @php $sK = 9999.34 - 5.03; @endphp
            @foreach($historicoComisiones as $idx => $hist)
                @php
                    $vHist = $hist->pasajes->where('es_factura_principal', true)->sum('valor');
                    if($vHist==0) $vHist = $hist->total_valor_pasajes;
                    $aK = $sK;
                    $sK -= $vHist;
                    $esAct = $hist->id == $comision->id;
                @endphp
                <tr class="{{ $esAct ? 'bg-yellow' : '' }}">
                    <td class="text-center">{{ $idx+1 }}</td>
                    <td class="text-center">{{ $hist->created_at ? $hist->created_at->format('d/m/Y') : '' }}</td>
                    <td>{{ $hist->codigo }} @if($esAct) <- ESTA @endif</td>
                    <td>{{ Str::limit($hist->destino,20) }}</td>
                    <td class="text-center">{{ $hist->pasajes_count }}</td>
                    <td class="text-right">${{ number_format($vHist,2) }}</td>
                    <td class="text-right">${{ number_format($aK,2) }}</td>
                    <td class="text-right" style="font-weight:900;">${{ number_format($sK,2) }}</td>
                    <td class="text-right">${{ number_format($sK,2) }}</td>
                </tr>
            @endforeach
            <tr class="bg-black"><td colspan="5" style="text-align:right;">TOTAL 7 TRANS $9,567.79 + IVA $0.66 - SALDO FINAL:</td><td class="text-right">${{ number_format(9994.31 - $sK,2) }}</td><td></td><td class="text-right">${{ number_format($sK,2) }}</td><td class="text-right">${{ number_format($sK,2) }}</td></tr>
        </tbody>
    </table>
    <div style="background:#f2f2f2; border:1px solid #000; padding:4px; font-size:7px; font-weight:700; margin:3px;">
        BanEcuador: $9,999.34 inicial real - $5.03 tarjeta 367724757 - $2,193.09 COMSUB ALICANTE - $318.55 LIQUIDADA - $5,438.70 BUSAN pasaje - $350 BUSAN tasas - $777.78 LIMA - $485.30 LIQUIDADA = $431.55 saldo final conciliado. Total transacciones 7. Total gastos $9,567.79 sin IVA desglosado. Todos los valores tienen IVA incluido. Tarjeta $5.03. COMSUB ALICANTE corregido. Kardex muestra por cada comisión cuanto se tenía antes, cuanto se gastó y cuanto quedó disponible para la siguiente comisión. Factura compartida: valor $0 para 2do pasajero no duplica total, solo principal suma. Igual que VER EXACTO del cierre mensual - Cuenta 3-00167809-0 - Inicial Real $9,999.34 - Saldo $431.55.
    </div>
</div>

<div class="footer">
    ARMADA DEL ECUADOR<br>
    COMANDO DE OPERACIONES NAVALES<br>
    FONDO ROTATIVO PASAJES AÉREOS - KARDEX POR COMISIÓN - MINI LIQUIDACIÓN<br>
    -Guayaquil-
</div>

</body>
</html>
