<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Comisiones - Fondo Rotativo</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- TARJETA FONDO --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6" style="line-height:2;">
                    <div><strong>Asignado:</strong> ${{ number_format($fondo->monto_asignado ?? 10000, 2) }}</div>
                    <div><strong>Ejecutado:</strong> ${{ number_format($fondo->monto_ejecutado ?? 0, 2) }}</div>
                    <div><strong>Saldo:</strong> ${{ number_format($fondo->saldo_disponible ?? $fondo->monto_asignado, 2) }}</div>
                    <div><strong>Ejecutado:</strong> {{ number_format($fondo->porcentaje_ejecutado ?? 0, 2) }}%</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                        <h3 style="font-weight:bold;font-size:18px;">Listado de Comisiones</h3>
                        <a href="{{ route('comisiones.create') }}" style="background:#2563eb;color:white;padding:10px 20px;border-radius:6px;text-decoration:none;font-weight:bold;">
                            + Nueva Comisión
                        </a>
                    </div>

                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr style="background:#f9fafb;text-align:left;">
                                <th style="padding:12px;">Código</th>
                                <th style="padding:12px;">Destino</th>
                                <th style="padding:12px;">Tipo</th>
                                <th style="padding:12px;">Estado Documental</th>
                                <th style="padding:12px;">Cuadro</th>
                                <th style="padding:12px;">Valor</th>
                                <th style="padding:12px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($comisiones as $comision)
                            <tr style="border-bottom:1px solid #e5e7eb;">
                                <td style="padding:12px;font-weight:bold;">{{ $comision->codigo }}</td>
                                <td style="padding:12px;">{{ $comision->destino }}</td>
                                <td style="padding:12px;">{{ $comision->tipo }}</td>
                                <td style="padding:12px;">
                                    @php
                                        $doc = $comision->estado_documental ?? 'INCOMPLETO';
                                    @endphp
                                    @if($doc == 'CUADRO_PENDIENTE_APROBACION' || $doc == 'CUADRO_PENDIENTE')
                                        <span style="background:#fef3c7;color:#92400e;border:1px solid #f59e0b;padding:4px 10px;border-radius:12px;font-size:11px;font-weight:bold;">⏳ PENDIENTE APROBACIÓN</span>
                                    @elseif($doc == 'CUADRO_APROBADO')
                                        <span style="background:#dcfce7;color:#166534;border:1px solid #22c55e;padding:4px 10px;border-radius:12px;font-size:11px;font-weight:bold;">✅ APROBADA</span>
                                    @elseif($doc == 'CUADRO_RECHAZADO')
                                        <span style="background:#fee2e2;color:#991b1b;border:1px solid #ef4444;padding:4px 10px;border-radius:12px;font-size:11px;font-weight:bold;">❌ RECHAZADA</span>
                                    @else
                                        <span style="background:#fef3c7;color:#92400e;padding:4px 10px;border-radius:12px;font-size:11px;font-weight:bold;">{{ $doc }}</span>
                                    @endif
                                </td>
                                <td style="padding:12px;">
                                    @if($comision->cuadroComparativo)
                                        <span style="font-size:11px;">{{ $comision->cuadroComparativo->codigo_verificacion }}</span><br>
                                        <small style="font-size:10px;color:#6b7280;">{{ $comision->cuadroComparativo->estado }}</small>
                                    @else
                                        <span style="color:#9ca3af;font-size:11px;">Sin cuadro</span>
                                    @endif
                                </td>
                                <td style="padding:12px;">${{ number_format($comision->total_valor_pasajes, 2) }}</td>
                                <td style="padding:12px;">
                                    @if(($doc == 'CUADRO_PENDIENTE_APROBACION') && auth()->user()->hasRole('JEFE_LOGISTICA'))
                                        <a href="{{ route('comisiones.show', $comision) }}" style="background:#f59e0b;color:white;padding:6px 12px;border-radius:4px;text-decoration:none;font-weight:bold;font-size:12px;">⚠️ REVISAR</a>
                                    @else
                                        <a href="{{ route('comisiones.show', $comision) }}" style="color:#2563eb;font-weight:bold;text-decoration:none;">Ver</a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" style="text-align:center;padding:20px;color:#6b7280;">No hay comisiones registradas</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>