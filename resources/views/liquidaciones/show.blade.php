<x-app-layout>
<x-slot name="header"><h2 class="font-bold">👁️ Liquidación {{ $liquidacion->codigo }} - 2 Firmas</h2></x-slot>
<div class="py-6"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
<div class="bg-white p-4 rounded shadow flex justify-between">
<div><b>Código:</b> {{ $liquidacion->codigo }}<br><b>Fecha:</b> {{ $liquidacion->fecha_liquidacion }}<br><b>Estado:</b> {{ $liquidacion->estado }}</div>
<div class="flex space-x-2">
<a href="{{ route('liquidaciones.pdf', $liquidacion->id) }}" target="_blank" class="bg-red-600 text-white px-4 py-2 rounded">📄 PDF Individual</a>
<a href="{{ route('liquidaciones.reporteGeneral') }}" target="_blank" class="bg-blue-900 text-white px-4 py-2 rounded">📄 Cierre Mensual 2 Firmas (Contraloría)</a>
<a href="{{ route('liquidaciones.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">← Volver</a>
</div>
</div>
<div class="bg-white p-4 rounded shadow">
<h3 class="font-bold mb-2">Comisiones en esta liquidación - Total: ${{ number_format($liquidacion->monto_ejecutado_liquidacion,2) }}</h3>
<table class="w-full text-sm">
<thead class="bg-green-600 text-white"><tr><th>Código</th><th>Destino</th><th>Valor Liquidado</th><th>Comprobante</th></tr></thead>
<tbody>
@foreach($liquidacion->comisiones as $com)
<tr class="border-b"><td class="font-mono">{{ $com->codigo }}</td><td>{{ $com->destino }}</td><td class="font-bold">${{ number_format($com->pivot->valor,2) }}</td><td>{{ $com->pasajes->first()->numero_factura ?? 'COMPROBANTE EXTERIOR' }}</td></tr>
@endforeach
</tbody>
</table>
</div>
<div class="bg-yellow-100 p-4 rounded border-l-4 border-yellow-600 text-sm">
<b>Nota BanEcuador + Justificativo:</b> {{ $liquidacion->observaciones }}<br>
Todos los gastos fueron cancelados mediante tarjeta débito BanEcuador asociada al Fondo Rotativo ESNACE. Correos institucionales de notificación llegan automático a correo institucional. Para KIWI.COM se adjunta comprobante exterior + voucher.
</div>
</div></div>
</x-app-layout>
