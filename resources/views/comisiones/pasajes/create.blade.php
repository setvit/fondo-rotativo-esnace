<x-app-layout>
<x-slot name="header"><h2 class="font-semibold text-xl">Agregar Pasaje/Reserva - COM-{{ $comision->codigo }} - {{ $comision->destino }} ({{ $comision->pasajeros->count() }} oficiales)</h2></x-slot>
<div class="py-6"><div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

@php
  $facturasExistentes = $comision->pasajes->where('es_factura_principal', true);
  if($facturasExistentes->count()==0) $facturasExistentes = $comision->pasajes; // fallback
  $pasajerosSinPasaje = $comision->pasajeros->filter(function($p) use ($comision){ return $comision->pasajes->where('pasajero_id', $p->id)->count()==0; });
@endphp

@if($facturasExistentes->count() > 0)
<div class="bg-blue-50 p-6 rounded-lg border-2 border-blue-300">
<h5 class="font-bold text-blue-800">Facturas ya existentes en esta comision - Usar misma factura para otro oficial (sin duplicar valor)</h5>
<p class="text-sm mb-3">Si 2 oficiales van juntos con 1 sola factura de ${{ number_format($facturasExistentes->first()->valor ?? 0,2) }}, use esta opcion para el 2do, 3ro, N pasajero. Solo pide pasajero, no RUC/valor.</p>
@foreach($facturasExistentes as $fac)
<div class="bg-white p-3 rounded border mb-2 flex justify-between items-center">
<div><strong>{{ $fac->numero_factura }}</strong> - {{ $fac->aerolinea }} {{ $fac->ruta }} - <strong>${{ number_format($fac->valor,2) }}</strong> - Factura compartida grupo {{ $fac->factura_grupo ?? $fac->id }} - Pasajeros con esta factura: {{ $comision->pasajes->where('factura_grupo', $fac->factura_grupo ?? $fac->id)->count() }} @if($fac->factura_path) <a href="{{ Storage::url($fac->factura_path) }}" target="_blank" class="text-blue-600 text-xs">Ver PDF</a> @endif</div>
@if($pasajerosSinPasaje->count()>0)
<form method="POST" action="{{ route('comisiones.pasajes.store',$comision->id) }}" class="flex gap-2">
@csrf
<input type="hidden" name="modo" value="compartida">
<input type="hidden" name="factura_existente_id" value="{{ $fac->id }}">
<select name="pasajero_id" required class="border p-1 rounded text-sm">
<option value="">Seleccione pasajero sin pasaje</option>
@foreach($pasajerosSinPasaje as $ps)<option value="{{ $ps->id }}">{{ $ps->nombre }} - {{ $ps->cedula }}</option>@endforeach
</select>
<button class="bg-blue-600 text-white px-3 py-1 rounded text-sm">Agregar a misma factura (valor $0, no duplica)</button>
</form>
@endif
</div>
@endforeach
@if($pasajerosSinPasaje->count()==0)<p class="text-green-600 text-sm">Todos los {{ $comision->pasajeros->count() }} oficiales ya tienen pasaje con factura compartida</p>@endif
</div>
@endif

<div class="bg-white p-6 rounded-lg border">
<h5 class="font-bold">Nueva Reserva/Factura Completa (1ra vez o factura diferente)</h5>
<p class="text-xs text-gray-500 mb-3">Use esto solo para la primera factura o si es una compra separada. Si selecciona varios pasajeros, crea 1 registro por pasajero con misma factura pero valor solo en el principal para no duplicar.</p>
<form method="POST" action="{{ route('comisiones.pasajes.store',$comision->id) }}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="modo" value="nueva">
<div class="grid grid-cols-2 gap-4">
<div class="col-span-2">
<label class="block font-bold">Pasajeros que van juntos en esta misma factura (seleccione 1 o varios que comparten $ valor)</label>
<div class="border p-2 rounded max-h-32 overflow-y-auto">
@foreach($comision->pasajeros as $pas)
<label class="block"><input type="checkbox" name="pasajero_ids[]" value="{{ $pas->id }}" {{ $pasajerosSinPasaje->contains('id',$pas->id) ? 'checked' : '' }}> {{ $pas->nombre }} - {{ $pas->reparto }} @if($comision->pasajes->where('pasajero_id',$pas->id)->count()>0) (ya tiene) @endif</label>
@endforeach
</div>
<p class="text-xs">Si marca 2 oficiales, se crean 2 registros con misma factura, pero solo 1 con valor ${{ '$' }} total, el otro con $0 para no duplicar. Total comision sigue siendo ${{ '$' }} unico.</p>
</div>

<div><label class="block font-bold">Aerolinea</label><input type="text" name="aerolinea" required class="w-full border p-2 rounded" placeholder="LATAM AIRLINES"></div>
<div><label class="block font-bold">Ruta</label><input type="text" name="ruta" required class="w-full border p-2 rounded" placeholder="GUAYAQUIL - QUITO / QUITO - GUAYAQUIL"></div>
<div><label class="block font-bold">Valor TOTAL de la factura (para todos los seleccionados, no por pasajero)</label><input type="number" step="0.01" name="valor" required class="w-full border p-2 rounded" placeholder="485.30"></div>
<div><label class="block font-bold">Numero Factura</label><input type="text" name="numero_factura" required class="w-full border p-2 rounded" placeholder="LA4620127NUAG"></div>
<div><label class="block font-bold">Fecha Factura</label><input type="date" name="fecha_factura" required class="w-full border p-2 rounded" value="{{ date('Y-m-d') }}"></div>
<div><label class="block font-bold">Proveedor</label><input type="text" name="proveedor" class="w-full border p-2 rounded" value="KIWI.COM"></div>
<div class="col-span-2"><label class="block font-bold">PDF Factura/Reserva (mismo para todos si van juntos)</label><input type="file" name="factura_pdf" accept=".pdf" class="w-full border p-2 rounded"></div>
</div>
<button type="submit" class="mt-4 bg-green-600 text-white px-6 py-2 rounded font-bold">Guardar Reserva Compartida - Valor unico</button>
<a href="{{ route('comisiones.show',$comision->id) }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Volver</a>
</form>
</div>

</div></div>
</x-app-layout>
