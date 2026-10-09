<x-app-layout>
<x-slot name="header"><h2 class="font-semibold text-xl">Subir Informe - COM-{{ $comision->codigo }} - {{ $comision->pasajeros->count() }} oficial(es) juntos</h2></x-slot>
<div class="py-6"><div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

<div class="bg-blue-50 p-4 rounded border">
<p><strong>Comision:</strong> COM-{{ $comision->codigo }} {{ $comision->destino }} | <strong>{{ $comision->pasajeros->count() }} pasajeros van juntos</strong> en misma reserva facturas/{{ $comision->pasajes->first()->factura_path ?? '' }}</p>
<p class="text-sm">Pasajeros: @foreach($comision->pasajeros as $p) {{ $p->nombre }} ({{ $p->reparto }}){{ !$loop->last ? ', ' : '' }} @endforeach</p>
<p class="text-xs mt-2">Regla: Reserva puede ser compartida (1 factura para 2 oficiales), Informe puede ser 1 GENERAL para todos o 1 por cada oficial, pero PASES IDA/RETORNO son fijos por cada pasajero.</p>
</div>

<div class="bg-white p-6 shadow-sm rounded-lg border-2 border-purple-300">
<h5 class="font-bold mb-3">Informe GENERAL (1 solo para {{ $comision->pasajeros->count() }} oficiales juntos) - Recomendado</h5>
<form method="POST" action="{{ route('comisiones.informe.store',$comision->id) }}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="tipo_informe" value="GENERAL">
<div class="mb-3"><label class="block font-bold">Fecha Informe General</label><input type="date" name="informe_fecha" class="w-full border p-2 rounded" value="{{ date('Y-m-d') }}" required></div>
<div class="mb-3"><label class="block font-bold">PDF Informe General (para todos los oficiales juntos)</label><input type="file" name="informe_pdf" accept=".pdf" required class="w-full border p-2 rounded"></div>
<button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded font-bold">Subir Informe GENERAL para {{ $comision->pasajeros->count() }} oficiales</button>
</form>
</div>

<div class="bg-white p-6 shadow-sm rounded-lg border">
<h5 class="font-bold mb-3">Informes INDIVIDUALES por pasajero (opcional, si no usa general)</h5>
<p class="text-xs mb-3">Si prefiere, suba 1 informe por cada oficial ({{ $comision->pasajes->count() }} pasajes)</p>
@foreach($comision->pasajes as $pas)
<div class="border p-3 rounded mb-2">
<p class="font-bold">{{ $pas->pasajero->nombre ?? 'Pasaje '.$pas->id }} - ${{ $pas->valor }}</p>
<form method="POST" action="{{ route('comisiones.informe.store',$comision->id) }}" enctype="multipart/form-data" class="flex gap-2 items-end">
@csrf
<input type="hidden" name="tipo_informe" value="INDIVIDUAL">
<input type="hidden" name="pasaje_id" value="{{ $pas->id }}">
<input type="hidden" name="pasaje_ids[]" value="{{ $pas->id }}">
<div class="flex-1"><label class="text-xs">Fecha</label><input type="date" name="informe_fecha" class="w-full border p-1 rounded text-sm" value="{{ date('Y-m-d') }}"></div>
<div class="flex-1"><label class="text-xs">PDF Individual</label><input type="file" name="informe_pdf" accept=".pdf" required class="w-full border p-1 rounded text-sm"></div>
<button type="submit" class="bg-gray-700 text-white px-3 py-1 rounded text-sm">Subir individual</button>
</form>
@if(isset($pas->informe_path) && $pas->informe_path)<p class="text-xs text-green-600">Ya tiene: {{ $pas->informe_path }}</p>@endif
</div>
@endforeach
</div>

<div class="mt-4"><a href="{{ route('comisiones.show',$comision->id) }}" class="bg-gray-500 text-white px-4 py-2 rounded">Volver a COM-{{ $comision->codigo }}</a></div>

</div></div>
</x-app-layout>
