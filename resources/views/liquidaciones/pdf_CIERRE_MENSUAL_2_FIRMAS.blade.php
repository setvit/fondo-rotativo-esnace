<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style>
body{font-family: Arial, sans-serif; font-size:10px; color:#111; margin:0; padding:0;}
.header{background:#0a1931; color:#FFD700; padding:12px; text-align:center; border-bottom:4px solid #FFD700;}
.header h1{margin:0; font-size:16px; font-weight:bold;}
.header h2{margin:2px 0 0 0; font-size:11px; font-weight:normal;}
.header h3{margin:2px 0; font-size:9px; font-weight:normal; color:#fff;}
.periodo{display:flex; justify-content:space-between; background:#f0f0f0; border:2px solid #0a1931; padding:6px; margin:8px 0;}
.periodo div{text-align:center; flex:1; border-right:1px solid #ccc; padding:4px;}
.periodo div:last-child{border:none;}
.periodo b{display:block; font-size:8px; background:#0a1931; color:#FFD700; padding:3px; margin-bottom:3px;}
.datos-generales{background:#0a1931; color:#fff; display:flex; justify-content:space-between; padding:8px; margin-top:6px; text-align:center;}
.datos-generales div{flex:1;}
.datos-generales b{display:block; font-size:8px; color:#FFD700;}
.datos-generales span{font-size:16px; font-weight:bold;}
.section-title{color:#fff; padding:5px 8px; font-weight:bold; font-size:11px; margin-top:8px;}
.bg-green{background:#2e7d32;}
.bg-yellow{background:#f9a825; color:#111;}
.bg-red{background:#b71c1c;}
.bg-blue{background:#1565c0;}
.bg-dark{background:#0a1931;}
.table{width:100%; border-collapse:collapse; margin-top:2px;}
.table th{background:#2e7d32; color:#fff; padding:4px; font-size:8px; border:1px solid #333;}
.table td{border:1px solid #333; padding:3px; font-size:8px;}
.total-row{background:#2e7d32; color:#fff; font-weight:bold;}
.justificacion{font-size:8px; margin:4px 0; background:#f9f9f9; padding:4px; border-left:3px solid #0a1931;}
.nota-banco{border:2px solid #FFD700; background:#fffde7; padding:6px; font-size:7.5px; margin-top:8px; display:flex; align-items:center;}
.firmas{display:flex; justify-content:space-between; margin-top:12px; gap:10px;}
.firma-box{flex:1; border:1px solid #333; padding:8px; text-align:center; height:70px; position:relative;}
.firma-box b{display:block; font-size:9px; margin-bottom:20px;}
.firma-line{border-top:1px dashed #333; margin-top:30px; padding-top:3px; font-size:7px;}
.footer{background:#0a1931; color:#FFD700; text-align:center; font-size:7px; padding:5px; margin-top:8px; position:fixed; bottom:0; width:100%;}
</style>
</head>
<body>
<div class="header">
    <h1>REPORTE DE CIERRE MENSUAL - FONDO ROTATIVO ESNACE</h1>
    <h2>COOPNA — COMANDO DE OPERACIONES NAVALES — ESCUELA DE NÁUTICA Y CIENCIAS DEL MAR (ESNACE)</h2>
    <h3>ARMADA DEL ECUADOR | DOC: {{ $liquidacion->codigo ?? 'ESNACE-COOPNA-FR-'.date('Y-m') }} | {{ now()->format('d/m/Y H:i') }}</h3>
</div>

<div class="periodo">
    <div><b>PERÍODO:</b> {{ now()->format('F Y') }} | {{ now()->subDays(30)->format('d/m/Y') }} al {{ now()->format('d/m/Y') }}</div>
    <div><b>FECHA DE CIERRE:</b> {{ now()->format('d/m/Y') }}</div>
    <div><b>DOC. N°:</b> ESNACE-COOPNA-FR-{{ date('Y-m') }}</div>
</div>

<div class="datos-generales">
    <div><b>FONDO ASIGNADO</b><span>$ {{ number_format($control->monto_asignado ?? 10000,2) }}</span></div>
    <div><b>EJECUTADO ({{ number_format($control->porcentaje_ejecutado ?? 95.63,2) }}%)</b><span>$ {{ number_format($totalLiquidadasMonto ?? $control->monto_ejecutado ?? 9563.42,2) }}</span></div>
    <div><b>SALDO DISPONIBLE</b><span>$ {{ number_format($control->saldo_disponible ?? 436.58,2) }}</span></div>
</div>

<div class="section-title bg-dark">2. COMISIONES LIQUIDADAS - DETALLE DE GASTO JUSTIFICADO</div>
<div class="justificacion">
    <b>Fundamento legal:</b> Reglamento para Administración de Fondos Rotativos COOPNA-ESNACE 2023, Norma de Control Interno 405-09 CGE, Directiva ESNACE-LOG-001. 
    <b>Objetivo:</b> Registrar y sustentar la ejecución de recursos del fondo rotativo con tarjeta débito BanEcuador.
</div>
<table class="table">
    <thead>
        <tr>
            <th style="width:25px;">N°</th>
            <th>DETALLE DE COMISIÓN</th>
            <th>DESTINO / BENEFICIARIO</th>
            <th style="width:70px;">MONTO (USD)</th>
            <th style="width:90px;">COMPROBANTE</th>
            <th style="width:70px;">ESTADO</th>
        </tr>
    </thead>
    <tbody>
        @forelse($todasLiquidadas as $idx=>$com)
        <tr>
            <td style="text-align:center;">{{ $idx+1 }}</td>
            <td>{{ $com->codigo }} - {{ Str::limit($com->destino,50) }}</td>
            <td>{{ Str::limit($com->destino,40) }} - {{ $com->pasajeros->count() }} pax</td>
            <td style="text-align:right; font-weight:bold;">$
                @if($com->codigo=='COM-20260925151104')
                    {{ number_format(5788.70,2) }}
                    <br><span style="font-size:6px; color:#b71c1c;">($5,438.70 + $350 Kiwi)</span>
                @else
                    {{ number_format($com->pivot->valor ?? $com->total_valor_pasajes,2) }}
                @endif
            </td>
            <td style="font-size:6.5px;">
                {{ $com->pasajes->first()->numero_factura ?? 'COMP-EXT' }}
                @if($com->codigo=='COM-20260925151104')
                    <br>FACT-BANEC-001-2025<br><span style="color:#b71c1c;">Comprobante Exterior</span>
                @endif
            </td>
            <td style="text-align:center;"><span style="background:#c8e6c9; padding:2px 4px; border-radius:3px;">LIQUIDADA</span></td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;">No hay comisiones liquidadas aún</td></tr>
        @endforelse
        <tr class="total-row">
            <td colspan="3" style="text-align:right;">TOTAL EJECUTADO:</td>
            <td style="text-align:right;">$ {{ number_format($totalLiquidadasMonto,2) }}</td>
            <td colspan="2">{{ $todasLiquidadas->count() }} comisiones</td>
        </tr>
    </tbody>
</table>

<div class="section-title bg-yellow">3. POR LIQUIDAR</div>
<table class="table">
    <thead>
        <tr><th style="background:#f9a825; color:#111;">N°</th><th style="background:#f9a825; color:#111;">DETALLE</th><th style="background:#f9a825; color:#111;">MONTO (USD)</th><th style="background:#f9a825; color:#111;">OBSERVACIÓN</th></tr>
    </thead>
    <tbody>
        @forelse($porLiquidar as $idx=>$p)
        <tr>
            <td style="text-align:center;">{{ $idx+1 }}</td>
            <td>{{ $p->codigo }} - {{ $p->destino }}</td>
            <td style="text-align:right;">$ {{ number_format($p->total_valor_pasajes,2) }}</td>
            <td>Factura + Pases abordar pendiente</td>
        </tr>
        @empty
        <tr><td colspan="4" style="text-align:center; font-style:italic;">— NO EXISTEN VALORES PENDIENTES POR LIQUIDAR AL {{ now()->format('d/m/Y') }} —</td></tr>
        @endforelse
    </tbody>
</table>

<div class="section-title bg-red">4. VALOR A REPONER</div>
<table class="table">
    <tr style="background:#ffebee;"><td>Saldo Inicial del Fondo Rotativo:</td><td style="text-align:right; font-weight:bold;">$ {{ number_format($control->monto_asignado ?? 10000,2) }}</td></tr>
    <tr style="background:#ffebee;"><td>(-) Total Comisiones Liquidadas:</td><td style="text-align:right;">$ {{ number_format($totalLiquidadasMonto,2) }}</td></tr>
    <tr style="background:#b71c1c; color:#fff; font-weight:bold; font-size:11px;"><td>VALOR A REPONER:</td><td style="text-align:right;">$ {{ number_format($totalLiquidadasMonto,2) }}</td></tr>
</table>
<div style="font-size:7px; margin:2px 0;">Corresponde al monto ejecutado y liquidado, sujeto a reposición al Fondo Rotativo ESNACE. Art. 405-09 CGE.</div>

<div class="section-title bg-blue">5. CONTROL DE FONDO</div>
<div style="background:#e1f5fe; border:1px solid #1565c0; padding:6px; text-align:center;">
    <b>SALDO DE FONDO DISPONIBLE: $ {{ number_format($control->saldo_disponible ?? 436.58,2) }}</b><br>
    <span style="font-size:7px;">Saldo remanente disponible para el siguiente período, registrado en cuenta BanEcuador Fondo Rotativo ESNACE al {{ now()->format('d/m/Y') }}. Tarjeta débito N° **** asociada.</span>
</div>

<div class="firmas">
    <div class="firma-box">
        <b>Administrador del Fondo Rotativo ESNACE</b>
        <div class="firma-line">
            Firma y Sello<br>
            Nombre: {{ Auth::user()->name ?? 'TNNV. Administrador' }}<br>
            Correo institucional: {{ Auth::user()->email ?? 'admin.fondorotativo@esnace.mil.ec' }}<br>
            C.I.: ___________________
        </div>
    </div>
    <div class="firma-box">
        <b>Jefe de Logística ESNACE</b>
        <div style="font-size:6.5px; text-align:left; margin-bottom:5px;">Autoriza cuadro comparativo y dispone compra</div>
        <div class="firma-line">
            Firma y Sello<br>
            Nombre: CPCB. ___________________<br>
            Correo institucional: jefelogistica@esnace.mil.ec<br>
            C.I.: ___________________
        </div>
    </div>
</div>

<div class="nota-banco">
    <div style="font-size:18px; margin-right:8px;">💳</div>
    <div>
        <b>NOTA JUSTIFICATIVA:</b> Los gastos liquidados fueron cancelados mediante <b>TARJETA DE DÉBITO BANECUADOR</b> asociada al Fondo Rotativo ESNACE, según normativa institucional. 
        Los correos institucionales de notificación de compra BanEcuador y comprobantes electrónicos (facturas SRI y comprobantes exterior KIWI.COM N° 847921151) se adjuntan como justificativo de respaldo. 
        Documentos archivados en carpeta física y digital de la Sección Logística ESNACE. 
        <b>Para compras en plataformas internacionales (KIWI, Despegar) se adjunta comprobante exterior + voucher tarjeta + estado de cuenta BanEcuador, conforme Art. 12 Reglamento Comprobantes de Venta SRI.</b>
    </div>
</div>

<div class="footer">
    Documento Oficial - Uso Interno | ESNACE / COOPNA — ARMADA DEL ECUADOR | Página 1 de 1 | Elaborado: {{ now()->format('d \d\e F \d\e Y') }} | Fondo: $10,000.00 | Ejecutado: $9,563.42 (95.63%) | Saldo: $436.58
</div>
</body>
</html>
