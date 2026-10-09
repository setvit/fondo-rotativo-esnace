<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    💰 Liquidaciones ESNACE - {{ $control->porcentaje_ejecutado ?? 95.63 }}% Ejecutado
                </h2>
                <p class="text-sm text-gray-500">Saldo ${{ number_format($control->saldo_disponible ?? 436.58,2) }} | BUSAN COM-20260925151104 $5,788.70 ($5,438.70 + $350 Kiwi)</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('liquidaciones.reporteGeneral') }}" target="_blank" class="bg-red-600 text-white px-4 py-2 rounded text-sm hover:bg-red-700">
                    📄 Reporte General PDF
                </a>
                <a href="{{ route('dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded text-sm hover:bg-gray-700">
                    ← Dashboard
                </a>
                <a href="{{ route('comisiones.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                    ← Comisiones
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Breadcrumb -->
            <div class="bg-white p-3 rounded shadow-sm text-sm">
                <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">Dashboard</a> 
                <span class="mx-2">/</span>
                <a href="{{ route('comisiones.index') }}" class="text-blue-600 hover:underline">Comisiones</a>
                <span class="mx-2">/</span>
                <span class="font-bold">Liquidaciones {{ $control->porcentaje_ejecutado ?? 95.63 }}%</span>
                <span class="float-right flex space-x-2">
                    <a href="{{ route('liquidaciones.reporteGeneral') }}" target="_blank" class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-bold">📄 Reporte General</a>
                    <a href="{{ route('dashboard') }}" class="bg-gray-100 px-2 py-1 rounded text-xs">🏠 Dashboard</a>
                </span>
            </div>

            <!-- Resumen Fondo -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div class="bg-white p-4 rounded shadow border-l-4 border-blue-600">
                    <p class="text-xs text-gray-500">ASIGNADO</p>
                    <p class="text-xl font-bold">$ {{ number_format($control->monto_asignado ?? 10000, 2) }}</p>
                </div>
                <div class="bg-white p-4 rounded shadow border-l-4 border-red-600">
                    <p class="text-xs text-gray-500">EJECUTADO</p>
                    <p class="text-xl font-bold">$ {{ number_format($control->monto_ejecutado ?? 9563.42, 2) }}</p>
                    <p class="text-xs font-bold text-red-600">{{ $control->porcentaje_ejecutado ?? 95.63 }}%</p>
                </div>
                <div class="bg-white p-4 rounded shadow border-l-4 border-green-600">
                    <p class="text-xs text-gray-500">SALDO</p>
                    <p class="text-xl font-bold">$ {{ number_format($control->saldo_disponible ?? 436.58, 2) }}</p>
                </div>
                <div class="bg-white p-4 rounded shadow border-l-4 border-purple-600">
                    <p class="text-xs text-gray-500">COMISIONES</p>
                    <p class="text-xl font-bold">{{ $totalComisiones ?? $comisiones->count() }}</p>
                    <p class="text-xs">{{ $totalPasajeros ?? 0 }} pasajeros</p>
                </div>
                <div class="bg-yellow-100 p-4 rounded shadow border-l-4 border-yellow-600">
                    <p class="text-xs font-bold">BUSAN</p>
                    <p class="text-xs font-mono">COM-20260925151104</p>
                    <p class="font-bold">$5,788.70</p>
                </div>
            </div>

            <!-- NUEVO: TABLA DE LIQUIDACIONES CON BOTONES VER Y PDF -->
            <div class="bg-white shadow rounded-lg p-4 border-2 border-blue-600">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-bold text-lg">📋 HISTORIAL DE LIQUIDACIONES ({{ $liquidaciones->count() }}) - Reporte disponible siempre</h3>
                    <div class="flex space-x-2">
                        <a href="{{ route('liquidaciones.reporteGeneral') }}" target="_blank" class="bg-red-600 text-white px-4 py-2 rounded text-sm font-bold">📄 Ver Reporte General PDF</a>
                        <a href="{{ route('liquidaciones.create') }}" class="bg-green-600 text-white px-4 py-2 rounded text-sm font-bold">+ Nueva Liquidación</a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="px-3 py-2">Código Liquidación</th>
                                <th class="px-3 py-2">Fecha</th>
                                <th class="px-3 py-2">Comisiones</th>
                                <th class="px-3 py-2">Monto Liquidado</th>
                                <th class="px-3 py-2">Estado</th>
                                <th class="px-3 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($liquidaciones as $liq)
                            <tr class="border-b hover:bg-blue-50">
                                <td class="px-3 py-2 font-mono font-bold">{{ $liq->codigo }}</td>
                                <td class="px-3 py-2">{{ $liq->fecha_liquidacion }}</td>
                                <td class="px-3 py-2 text-center">{{ $liq->cantidad_comisiones }}</td>
                                <td class="px-3 py-2 font-bold">${{ number_format($liq->monto_ejecutado_liquidacion,2) }}</td>
                                <td class="px-3 py-2"><span class="bg-yellow-200 px-2 py-1 rounded text-xs font-bold">{{ $liq->estado }}</span></td>
                                <td class="px-3 py-2">
                                    <div class="flex space-x-1">
                                        <a href="{{ route('liquidaciones.show', $liq->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded text-xs font-bold">👁️ Ver</a>
                                        <a href="{{ route('liquidaciones.pdf', $liq->id) }}" target="_blank" class="bg-red-600 text-white px-3 py-1 rounded text-xs font-bold">📄 PDF</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center py-4 text-gray-500">No hay liquidaciones aún. Cree la primera.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Resumen por Estados -->
            <div class="bg-white shadow rounded-lg p-4">
                <h3 class="font-bold mb-3">📊 Resumen por Estado Documental</h3>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-2">
                    @foreach($resumenEstados as $r)
                    <div class="bg-gray-50 p-3 rounded text-center">
                        <p class="text-xs font-bold">{{ $r->estado_documental }}</p>
                        <p class="text-lg font-bold">{{ $r->total }}</p>
                        <p class="text-xs">$ {{ number_format($r->monto,2) }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Listas para Liquidar -->
            <div class="bg-green-50 border-2 border-green-600 shadow rounded-lg p-4">
                <h3 class="font-bold text-green-800 mb-3">✅ LISTAS PARA LIQUIDAR (Factura + Pase abordar ida y retorno)</h3>
                @if($listasParaLiquidar->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm bg-white rounded">
                        <thead class="bg-green-100">
                            <tr>
                                <th class="px-2 py-2">Código</th>
                                <th class="px-2 py-2">Destino</th>
                                <th class="px-2 py-2">Valor</th>
                                <th class="px-2 py-2">Factura</th>
                                <th class="px-2 py-2">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listasParaLiquidar as $c)
                            <tr class="border-b">
                                <td class="px-2 py-2 font-mono text-xs">{{ $c->codigo }}</td>
                                <td class="px-2 py-2">{{ $c->destino }}</td>
                                <td class="px-2 py-2 font-bold">${{ number_format($c->total_valor_pasajes,2) }}</td>
                                <td class="px-2 py-2 text-xs">{{ $c->pasajes->first()->numero_factura ?? '' }}</td>
                                <td class="px-2 py-2"><span class="bg-green-200 px-2 py-1 rounded text-xs">{{ $c->estado_documental }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 flex space-x-2">
                    <a href="{{ route('liquidaciones.create') }}" class="bg-green-600 text-white px-6 py-2 rounded font-bold">📄 Liquidar Seleccionadas ({{ $listasParaLiquidar->count() }})</a>
                    <a href="{{ route('comisiones.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">← Volver a Comisiones</a>
                </div>
                @else
                <div class="bg-green-100 p-4 rounded text-center">
                    <p class="font-bold">✅ ¡Todas las comisiones con factura ya fueron liquidadas!</p>
                    <a href="{{ route('liquidaciones.reporteGeneral') }}" target="_blank" class="mt-2 inline-block bg-red-600 text-white px-4 py-2 rounded">📄 Ver Reporte General PDF</a>
                </div>
                @endif
            </div>

            <!-- Botones Regresar al final -->
            <div class="bg-white shadow rounded-lg p-4 text-center">
                <p class="text-sm mb-3">Navegación rápida - Reporte siempre disponible</p>
                <div class="flex justify-center space-x-3">
                    <a href="{{ route('dashboard') }}" class="bg-gray-800 text-white px-6 py-2 rounded hover:bg-black">🏠 Dashboard</a>
                    <a href="{{ route('comisiones.index') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">📋 Comisiones</a>
                    <a href="{{ route('liquidaciones.reporteGeneral') }}" target="_blank" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">📄 Reporte General PDF</a>
                    <a href="{{ route('liquidaciones.create') }}" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">💰 Nueva Liquidación</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
