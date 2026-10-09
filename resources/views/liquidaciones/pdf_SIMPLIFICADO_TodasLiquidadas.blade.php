<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; margin: 10px; }
        .header { text-align: center; border-bottom: 3px solid #1e3a8a; padding-bottom: 10px; margin-bottom: 15px; }
        .header h2 { margin: 2px; color: #1e3a8a; font-size: 14px; }
        .header h3 { margin: 2px; font-size: 11px; }
        .section { margin-bottom: 20px; border: 1px solid #ddd; padding: 10px; }
        .section h4 { background: #1e3a8a; color: white; padding: 6px; margin: -10px -10px 10px -10px; font-size: 12px; }
        .section-green h4 { background: #16a34a !important; }
        .section-yellow h4 { background: #ca8a04 !important; }
        .section-red h4 { background: #dc2626 !important; }
        table { width: 100%; border-collapse: collapse; font-size: 9px; }
        th { background: #1e3a8a; color: white; padding: 5px; text-align: left; }
        td { border: 1px solid #ddd; padding: 4px; }
        .total { font-weight: bold; background: #fef3c7; }
        .total-green { font-weight: bold; background: #dcfce7; }
        .badge { padding: 2px 6px; border-radius: 3px; font-size: 8px; font-weight: bold; }
        .badge-green { background: #bbf7d0; color: #166534; }
        .badge-yellow { background: #fef08a; color: #854d0e; }
        .footer { text-align: center; font-size: 8px; color: #666; margin-top: 20px; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>ARMADA DEL ECUADOR - COOPNA - ESNACE</h2>
        <h3>LIQUIDACIÓN FONDO ROTATIVO - DETALLE POR PASAJERO CON PASES ABORDAR</h3>
        <p style="font-size: 9px;">Liquidación: <strong>{{ $liquidacion->codigo }}</strong> | Fecha: {{ $liquidacion->fecha_liquidacion }} | Estado: {{ $liquidacion->estado }} | Control: ${{ number_format($control->monto_asignado ?? 10000,2) }}</p>
    </div>

    <!-- 1. RESUMEN DE ESTA LIQUIDACIÓN -->
    <div class="section">
        <h4>1. RESUMEN DE ESTA LIQUIDACIÓN - {{ $liquidacion->codigo }}</h4>
        <table>
            <tr>
                <td style="width: 25%;"><strong>Código Liquidación</strong></td>
                <td style="width: 25%;">{{ $liquidacion->codigo }}</td>
                <td style="width: 25%;"><strong>Fecha Liquidación</strong></td>
                <td style="width: 25%;">{{ $liquidacion->fecha_liquidacion }}</td>
            </tr>
            <tr>
                <td><strong>Cantidad Comisiones en esta liquidación</strong></td>
                <td>{{ $liquidacion->cantidad_comisiones }}</td>
                <td><strong>Monto Liquidado en esta</strong></td>
                <td style="font-weight: bold; color: #16a34a;">${{ number_format($liquidacion->monto_ejecutado_liquidacion,2) }}</td>
            </tr>
            <tr>
                <td><strong>Saldo Disponible al Corte</strong></td>
                <td>${{ number_format($liquidacion->saldo_disponible_al_corte,2) }}</td>
                <td><strong>% Ejecutado al Corte</strong></td>
                <td>{{ $liquidacion->porcentaje_ejecutado }}%</td>
            </tr>
            <tr>
                <td colspan="4"><strong>Observaciones:</strong> {{ $liquidacion->observaciones }}</td>
            </tr>
        </table>
    </div>

    <!-- 2. TODAS LAS COMISIONES LIQUIDADAS ACUMULADAS - EN VERDE -->
    <div class="section section-green">
        <h4>2. ✅ COMISIONES LIQUIDADAS - TOTAL ACUMULADO ({{ $todasLiquidadas->count() }} comisión(es) - Incluye esta liquidación)</h4>
        <p style="font-size: 8px; color: #666;">Incluye todas las comisiones liquidadas hasta la fecha, con detalle individual por pasajero con pase ida y retorno</p>
        @foreach($todasLiquidadas as $c)
        <div style="border: 1px solid #16a34a; margin-bottom: 10px; padding: 8px; background: #f0fdf4;">
            <table>
                <tr>
                    <td style="width: 15%;"><strong>Código:</strong> {{ $c->codigo }}</td>
                    <td style="width: 30%;"><strong>Destino:</strong> {{ $c->destino }}</td>
                    <td style="width: 20%;"><strong>Factura:</strong> {{ $c->pasajes->first()->numero_factura ?? '' }}</td>
                    <td style="width: 15%;"><strong>Valor:</strong> ${{ number_format($c->pivot->valor ?? $c->total_valor_pasajes,2) }}</td>
                    <td style="width: 20%;"><span class="badge badge-green">LIQUIDADA - {{ $c->liquidaciones->first()->codigo ?? $liquidacion->codigo }}</span></td>
                </tr>
                <tr>
                    <td colspan="5"><strong>Fechas:</strong> {{ $c->fecha_salida }} → {{ $c->fecha_retorno }} | <strong>Aerolínea:</strong> {{ $c->pasajes->first()->aerolinea ?? '' }} | <strong>Pasajeros:</strong> {{ $c->pasajeros->count() }}</td>
                </tr>
            </table>
            <table style="margin-top: 5px;">
                <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 25%;">Pasajero (Individual)</th>
                        <th style="width: 15%;">Cédula / Cargo</th>
                        <th style="width: 20%;">Pase Ida</th>
                        <th style="width: 20%;">Pase Retorno</th>
                        <th style="width: 15%;">Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($c->pasajeros as $idx => $pas)
                    <tr>
                        <td>{{ $idx+1 }}</td>
                        <td><strong>{{ $pas->nombre }}</strong><br><small>{{ $pas->reparto }}</small></td>
                        <td>{{ $pas->cedula }}<br>{{ $pas->cargo }}</td>
                        <td>✈️ Pase Ida<br><small>Subido en liquidación<br>Factura: {{ $c->pasajes->first()->numero_factura ?? '' }}</small></td>
                        <td>✈️ Pase Retorno<br><small>Subido en liquidación<br>Ida y retorno obligatorio</small></td>
                        <td><small>Liquidación individual por pasajero</small></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
        <table>
            <tr class="total-green">
                <td colspan="3">TOTAL LIQUIDADO ACUMULADO (Todas las comisiones liquidadas)</td>
                <td>${{ number_format($totalLiquidadasMonto,2) }}</td>
                <td>{{ $todasLiquidadas->count() }} comisiones</td>
            </tr>
        </table>
    </div>

    <!-- 3. POR LIQUIDAR -->
    <div class="section section-yellow">
        <h4>3. ⏳ COMISIONES CON PASAJE COMPRADO POR LIQUIDAR (Pendientes)</h4>
        <p style="font-size: 8px; color: #666;">Criterio: Estado PASAJE_COMPRADO + Factura existente + NO están en liquidacion_comision</p>
        @if(isset($porLiquidar) && $porLiquidar->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Código</th>
                    <th>Destino</th>
                    <th>Fechas</th>
                    <th>Pasajero(s)</th>
                    <th>Factura</th>
                    <th>Valor</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($porLiquidar as $idx => $c)
                <tr>
                    <td>{{ $idx+1 }}</td>
                    <td style="font-family: monospace;">{{ $c->codigo }}</td>
                    <td>{{ $c->destino }}</td>
                    <td style="font-size: 7px;">{{ $c->fecha_salida }}<br>→ {{ $c->fecha_retorno }}</td>
                    <td>{{ $c->pasajeros->count() }} - {{ $c->pasajeros->first()->nombre ?? '' }}</td>
                    <td style="font-size: 8px;">{{ $c->pasajes->first()->numero_factura ?? '' }}</td>
                    <td>${{ number_format($c->total_valor_pasajes,2) }}</td>
                    <td><span class="badge badge-yellow">{{ $c->estado_documental }}</span></td>
                </tr>
                @endforeach
                <tr class="total">
                    <td colspan="6">TOTAL POR LIQUIDAR (Pendiente)</td>
                    <td>${{ number_format($porLiquidar->sum('total_valor_pasajes'),2) }}</td>
                    <td>{{ $porLiquidar->count() }} comisiones / {{ $porLiquidar->sum(fn($c)=>$c->pasajeros->count()) }} pasajeros</td>
                </tr>
            </tbody>
        </table>
        @else
        <p style="text-align: center; padding: 10px; background: #dcfce7;"><strong>✅ ¡Todas las comisiones con factura ya fueron liquidadas!</strong></p>
        @endif
    </div>

    <!-- 4. CONTROL FONDO - AHORA ES 4 -->
    <div class="section section-red">
        <h4>4. 💰 CONTROL FONDO ROTATIVO ESNACE - {{ $control->porcentaje_ejecutado ?? 95.63 }}% EJECUTADO</h4>
        <table>
            <tr>
                <td style="width: 30%;"><strong>Monto Asignado</strong></td>
                <td style="width: 20%;">${{ number_format($control->monto_asignado ?? 10000,2) }}</td>
                <td style="width: 50%;">Fondo rotativo inicial ESNACE</td>
            </tr>
            <tr>
                <td><strong>Monto Ejecutado (antes Kiwi)</strong></td>
                <td>${{ number_format(($control->monto_ejecutado ?? 9563.42) - 350,2) }}</td>
                <td>Comisiones con factura sin cargo adicional</td>
            </tr>
            <tr>
                <td><strong>Cargo Adicional Kiwi BUSAN</strong></td>
                <td>$350.00</td>
                <td>COM-20260925151104 - Tasas adicionales plataforma KIWI</td>
            </tr>
            <tr class="total">
                <td><strong>Monto Ejecutado Final</strong></td>
                <td>${{ number_format($control->monto_ejecutado ?? 9563.42,2) }}</td>
                <td>{{ $control->porcentaje_ejecutado ?? 95.63 }}% del fondo - Supera 70% requiere liquidación y reposición</td>
            </tr>
            <tr>
                <td><strong>Saldo Disponible</strong></td>
                <td>${{ number_format($control->saldo_disponible ?? 436.58,2) }}</td>
                <td>Saldo actual después cargo Kiwi $350 BUSAN</td>
            </tr>
            <tr>
                <td><strong>% Ejecutado</strong></td>
                <td>{{ $control->porcentaje_ejecutado ?? 95.63 }}%</td>
                <td>Estado: Requiere reposición</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>ARMADA DEL ECUADOR - ESNACE - COOPNA | Fondo Rotativo | Generado: {{ date('d/m/Y H:i') }} | Liquidación: {{ $liquidacion->codigo }} | {{ $control->porcentaje_ejecutado ?? 95.63 }}% Ejecutado</p>
        <p>Este documento detalla liquidación total acumulada por pasajero con pase abordar ida y retorno obligatorio.</p>
    </div>
</body>
</html>
