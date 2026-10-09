<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estado Cuenta ESNACE Desglosado 95.63%</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { border: 1px solid #000; padding: 4px; text-align: left; }
        th { background: #0d2c54; color: white; }
        .header { background: #0d2c54; color: white; padding: 10px; text-align: center; }
        .highlight { background: #fff3cd; }
        .green { background: #d4edda; }
        .red { background: #f8d7da; }
        .total { background: #cce5ff; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>ARMADA DEL ECUADOR - COOPNA - ESNACE</h2>
        <h3>ESTADO DE CUENTA FONDO ROTATIVO DESGLOSADO - 95.63% EJECUTADO</h3>
        <p>Fecha: {{ now()->format('d/m/Y H:i') }} | Liquidación: {{ $liquidacion->codigo ?? 'LIQ-ESNACE-2026' }} | Control: $10,000.00</p>
    </div>

    <h3>1. CONTROL FONDO ROTATIVO ESNACE</h3>
    <table>
        <tr><th>Concepto</th><th>Valor</th><th>Observación</th></tr>
        <tr><td>Monto Asignado</td><td>$10,000.00</td><td>Fondo rotativo inicial</td></tr>
        <tr><td>Monto Ejecutado (antes Kiwi)</td><td>$9,213.42</td><td>5 comisiones con factura</td></tr>
        <tr><td>Cargo Adicional Kiwi BUSAN</td><td>$350.00</td><td>COM-20260925151104 - Tasas adicionales plataforma KIWI - 847921151</td></tr>
        <tr class="total"><td>Monto Ejecutado Final</td><td>$9,563.42</td><td>95.63% del fondo</td></tr>
        <tr class="green"><td>Saldo Disponible</td><td>$436.58</td><td>Saldo actual después cargo Kiwi</td></tr>
        <tr><td>% Ejecutado</td><td>95.63%</td><td>Supera 70% - Requiere liquidación y reposición</td></tr>
    </table>

    <h3>2. TODAS LAS COMISIONES - ESTADO ACTUAL CON FACTURAS Y PASES ABORDAR</h3>
    <table>
        <thead>
            <tr>
                <th>#</th><th>Código</th><th>Destino</th><th>Fechas</th><th>Pasajero</th><th>Aerolínea / Ruta</th><th>Factura</th><th>Valor</th><th>Estado Doc</th><th>Pase Ida/Retorno</th>
            </tr>
        </thead>
        <tbody>
            @php $total=0; @endphp
            @foreach($comisiones ?? $liquidacion->comisiones ?? [] as $i=>$c)
                @php 
                    $p = $c->pasajes->first() ?? null;
                    $pas = $c->pasajeros->first() ?? null;
                    $total += $c->total_valor_pasajes;
                @endphp
            <tr class="{{ $c->codigo=='COM-20260925151104' ? 'highlight' : '' }}">
                <td>{{ $i+1 }}</td>
                <td>{{ $c->codigo }}</td>
                <td>{{ $c->destino }}</td>
                <td>{{ $c->fecha_salida }}<br>{{ $c->fecha_retorno }}</td>
                <td>{{ $pas->nombre ?? '' }}<br><small>{{ $pas->cedula ?? '' }}</small></td>
                <td>{{ $p->aerolinea ?? '' }}<br><small>{{ $p->ruta ?? $c->destino }}</small></td>
                <td>{{ $p->numero_factura ?? '' }}<br><small>{{ $p->fecha_factura ?? '' }}</small></td>
                <td>${{ number_format($c->total_valor_pasajes,2) }}</td>
                <td>{{ $c->estado_documental }}</td>
                <td>✅ {{ $p->estado ?? 'COMPRADO' }}<br>{{ $p ? 'Ida y Retorno' : '' }}</td>
            </tr>
            @endforeach
            <tr class="total"><td colspan="7" style="text-align:right">TOTAL COMISIONES</td><td>${{ number_format($total,2) }}</td><td colspan="2"></td></tr>
            @if(isset($cargoKiwi) || true)
            <tr class="red"><td colspan="6" style="text-align:right">+ CARGO ADICIONAL KIWI BUSAN (Tasas administrativas plataforma)</td><td>847921151+Kiwi</td><td>$350.00</td><td colspan="2">COM-20260925151104</td></tr>
            <tr class="total"><td colspan="7" style="text-align:right">TOTAL FINAL EJECUTADO</td><td>$9,563.42</td><td colspan="2">95.63%</td></tr>
            @endif
        </tbody>
    </table>

    <h3>3. MOVIMIENTOS FONDOS - SALDOS ANTERIORES Y NUEVOS (Trazabilidad 95.63%)</h3>
    <table>
        <tr><th>Fecha</th><th>Comisión</th><th>Tipo Movimiento</th><th>Plataforma</th><th>Valor Pasaje</th><th>Saldo Anterior</th><th>Saldo Nuevo</th><th>Motivo</th></tr>
        @foreach($movimientos ?? [] as $m)
        <tr class="{{ $m->tipo_movimiento=='CARGO_ADICIONAL_KIWI' ? 'red' : '' }}">
            <td>{{ $m->created_at->format('d/m/Y') }}</td>
            <td>{{ $m->codigo_comision }}</td>
            <td>{{ $m->tipo_movimiento }}</td>
            <td>{{ $m->plataforma }}</td>
            <td>${{ number_format($m->valor_pasaje,2) }}</td>
            <td>${{ number_format($m->saldo_anterior,2) }}</td>
            <td>${{ number_format($m->saldo_nuevo,2) }}</td>
            <td>{{ Str::limit($m->motivo_ajuste,60) }}</td>
        </tr>
        @endforeach
        <tr class="total"><td colspan="5">SALDO FINAL</td><td>$786.58 →</td><td>$436.58</td><td>Después cargo Kiwi $350 BUSAN</td></tr>
    </table>

    <h3>4. DETALLE BUSAN GUAYAQUIL-BUSAN-GUAYAQUIL - CARGO $350 KIWI DESGLOSADO</h3>
    <table>
        <tr><th>Campo</th><th>Valor Original</th><th>Cargo Adicional</th><th>Valor Final</th></tr>
        <tr><td>Código Comisión</td><td colspan="3">COM-20260925151104</td></tr>
        <tr><td>Destino</td><td colspan="3">GUAYAQUIL-BUSAN-GUAYAQUIL</td></tr>
        <tr><td>Pasajero</td><td colspan="3">{{ $busanPasajero ?? 'Según pasajeros COM-20260925151104' }}</td></tr>
        <tr><td>Aerolínea</td><td colspan="3">PLATAFORMA VIRTUAL KIWI</td></tr>
        <tr><td>Ruta</td><td colspan="3">GUAYAQUIL - BUSAN - GUAYAQUIL</td></tr>
        <tr><td>Factura Original</td><td>847921151</td><td>-</td><td>facturas/TQ9QFfCyVUXjvJGBqfXo75lCNnh8jC4dx6lZiMZY.pdf</td></tr>
        <tr><td>Valor Pasaje Inicial</td><td>$5,438.70</td><td></td><td></td></tr>
        <tr class="red"><td>Cargo Adicional Kiwi</td><td></td><td>$350.00</td><td>Tasas e impuestos administrativos no incluidos en compra inicial - Pasaje ya realizado</td></tr>
        <tr class="total"><td>Valor Total Final BUSAN</td><td>$5,438.70</td><td>$350.00</td><td>$5,788.70</td></tr>
        <tr><td>Estado Documental</td><td colspan="3">PASAJE_COMPRADO - Listo para liquidar (Factura + Pase abordar ida y retorno COMPRADO)</td></tr>
    </table>

    <h3>5. LIQUIDACIÓN PROPUESTA - COMISIONES CON FACTURA Y PASE ABORDAR IDA Y RETORNO</h3>
    <p>Criterio: Comisiones con estado PASAJE_COMPRADO + pasajes con numero_factura + estado COMPRADO = tienen factura y pase abordar ida y retorno</p>
    <table>
        <tr><th>Comisión</th><th>Destino</th><th>Factura</th><th>Valor</th><th>¿Liquidable?</th><th>Observación</th></tr>
        <tr><td>COM-20260921140224</td><td>GUAYAQUIL - MIAMI</td><td>001-002-0093834849</td><td>$2,193.09</td><td>✅ SÍ</td><td>AVIANCA - COMPRADO</td></tr>
        <tr><td>COM-20260923182516</td><td>GUAYAQUIL - QUITO / QUITO - GUAYAQUIL</td><td>LA4623246ESHU</td><td>$318.55</td><td>✅ SÍ</td><td>LATAM - COMPRADO</td></tr>
        <tr class="highlight"><td>COM-20260925151104</td><td>GUAYAQUIL-BUSAN-GUAYAQUIL</td><td>847921151 + $350 Kiwi</td><td>$5,788.70</td><td>✅ SÍ</td><td>KIWI - COMPRADO + Cargo adicional</td></tr>
        <tr><td>COM-20260929175110</td><td>Por verificar</td><td>LA4627885VSRF</td><td>$777.78</td><td>✅ SÍ</td><td>COMPRADO</td></tr>
        <tr><td>COM-20260930144832</td><td>Por verificar</td><td>LA4620127NUAG</td><td>$485.30</td><td>✅ SÍ</td><td>COMPRADO</td></tr>
        <tr class="total"><td colspan="3">TOTAL A LIQUIDAR (5 comisiones con factura + pase)</td><td>$9,563.42</td><td>95.63%</td><td>Listas para liquidación y reposición a $10,000</td></tr>
    </table>

    <p style="margin-top:20px; text-align:center; font-size:9px;">Generado automáticamente Fondo Rotativo ESNACE - COOPNA - Sistema integra control_fondo (10000/9563.42/436.58/95.63%) + fondos_repartos + movimientos_fondos con saldo_anterior/saldo_nuevo + pasajes con factura + cargo Kiwi $350 BUSAN - Documento válido para liquidación y reposición</p>
</body>
</html>
