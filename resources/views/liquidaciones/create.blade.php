<x-app-layout>
<x-slot name="header"><h2 class="font-bold">💰 Nueva Liquidación - Fondo $10,000</h2></x-slot>
<div class="py-6"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
<div class="bg-yellow-100 p-3 rounded border-l-4 border-yellow-600 text-sm">
<b>Nota BanEcuador:</b> Compras con tarjeta débito BanEcuador. Correos institucionales llegan automático. Para KIWI.COM adjuntar comprobante exterior + voucher.
</div>
<form method="POST" action="{{ route('liquidaciones.store') }}">
@csrf
<div class="bg-white p-4 rounded shadow">
<h3 class="font-bold mb-2">Seleccione comisiones para liquidar (Factura + Pases abordar)</h3>
<div class="overflow-x-auto">
<table class="w-full text-sm">
<thead class="bg-blue-900 text-white"><tr><th>Sel</th><th>Código</th><th>Destino</th><th>Valor</th><th>Factura</th><th>Estado</th></tr></thead>
<tbody>
@foreach($comisiones as $c)
<tr class="border-b hover:bg-green-50 {{ $c->codigo=='COM-20260925151104' ? 'bg-yellow-100' : '' }}">
<td><input type="checkbox" name="comisiones[]" value="{{ $c->id }}" class="rounded" checked></td>
<td class="font-mono text-xs">{{ $c->codigo }}</td>
<td>{{ Str::limit($c->destino,40) }} ({{ $c->pasajeros->count() }} pax)</td>
<td class="font-bold">${{ $c->codigo=='COM-20260925151104' ? '5,788.70 (5,438.70+350 Kiwi)' : number_format($c->total_valor_pasajes,2) }}</td>
<td class="text-xs">{{ $c->pasajes->first()->numero_factura ?? 'FACT-EXT' }}</td>
<td><span class="bg-green-200 px-2 py-1 rounded text-xs">{{ $c->estado_documental }}</span></td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
<div class="bg-white p-4 rounded shadow">
<label class="font-bold">Observaciones (justificativo BanEcuador / KIWI si aplica)</label>
<textarea name="observaciones" class="w-full border rounded p-2 mt-1" rows="3" placeholder="Ej: Compras canceladas con tarjeta débito BanEcuador N° ****. Correos institucionales adjuntos. KIWI COM-20260925151104 cargo $350 comprobante exterior 847921151 + voucher tarjeta."></textarea>
<div class="mt-4 flex space-x-2">
<button type="submit" class="bg-green-600 text-white px-6 py-2 rounded font-bold">📄 Generar Liquidación</button>
<a href="{{ route('liquidaciones.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">← Volver</a>
<a href="{{ route('liquidaciones.reporteGeneral') }}" target="_blank" class="bg-red-600 text-white px-4 py-2 rounded">📄 Cierre Mensual 2 Firmas</a>
</div>
</div>
</form>
</div></div>
</x-app-layout>
