<x-app-layout>
<x-slot name="header"><h2 class="font-semibold text-xl">Pases + Informe - {{ $pasaje->pasajero->nombre ?? 'Pasaje '.$pasaje->id }} - COM-{{ $pasaje->comision->codigo ?? $pasaje->comision_id }}</h2></x-slot>
<div class="py-6"><div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
<div class="bg-white p-6 shadow-sm rounded-lg">
<p class="mb-2"><strong>Comision:</strong> COM-{{ $pasaje->comision->codigo ?? $pasaje->comision_id }} {{ $pasaje->comision->destino ?? '' }} | <strong>Pasajero:</strong> {{ $pasaje->pasajero->nombre ?? $pasaje->pasajero_id }} | <strong>Ruta:</strong> {{ $pasaje->ruta }} | <strong>Valor:</strong> ${{ $pasaje->valor }}</p>
<p class="mb-4">Reserva compartida PDF: @if($pasaje->factura_path)<a href="{{ Storage::url($pasaje->factura_path) }}" target="_blank" class="text-blue-600 font-bold">{{ $pasaje->factura_path }}</a> (misma factura puede servir para 2 oficiales que van juntos)@else Sin reserva @endif</p>

<form method="POST" action="{{ route('pasajes.pases.store',$pasaje->id) }}" enctype="multipart/form-data">
@csrf
<div class="mb-4 border p-3 rounded bg-yellow-50">
<label class="block font-bold">Pase Abordo IDA (OBLIGATORIO - por cada pasajero fijo)</label>
<input type="file" name="pase_ida" accept=".pdf,.jpg,.jpeg,.png" class="w-full border p-2 rounded bg-white" {{ empty($pasaje->pase_abordo_ida) ? 'required' : '' }}>
@if($pasaje->pase_abordo_ida)<p class="text-sm text-green-600">Actual IDA: <a href="{{ Storage::url($pasaje->pase_abordo_ida) }}" target="_blank" class="font-bold">{{ $pasaje->pase_abordo_ida }}</a></p>@else<p class="text-red-600 text-sm">Falta IDA - Obligatorio</p>@endif
</div>
<div class="mb-4 border p-3 rounded bg-yellow-50">
<label class="block font-bold">Pase Abordo RETORNO (OBLIGATORIO - por cada pasajero fijo)</label>
<input type="file" name="pase_retorno" accept=".pdf,.jpg,.jpeg,.png" class="w-full border p-2 rounded bg-white" {{ empty($pasaje->pase_abordo_retorno) ? 'required' : '' }}>
@if($pasaje->pase_abordo_retorno)<p class="text-sm text-green-600">Actual RETORNO: <a href="{{ Storage::url($pasaje->pase_abordo_retorno) }}" target="_blank" class="font-bold">{{ $pasaje->pase_abordo_retorno }}</a></p>@else<p class="text-red-600 text-sm">Falta RETORNO - Obligatorio</p>@endif
</div>
<div class="mb-4 border p-3 rounded bg-purple-50">
<label class="block font-bold">Informe Individual de este pasajero (opcional si ya subió informe GENERAL para todos)</label>
<input type="file" name="informe_pasajero" accept=".pdf" class="w-full border p-2 rounded bg-white">
@if(isset($pasaje->informe_path) && $pasaje->informe_path)<p class="text-sm text-purple-600">Informe individual actual: <a href="{{ Storage::url($pasaje->informe_path) }}" target="_blank">{{ $pasaje->informe_path }}</a></p>@endif
<p class="text-xs text-gray-500">Si 2 oficiales van juntos puede subir 1 informe GENERAL para ambos, o 1 individual por cada uno. Este campo es para el individual de {{ $pasaje->pasajero->nombre ?? '' }}</p>
</div>
<button type="submit" class="bg-green-600 text-white px-6 py-2 rounded font-bold">Guardar Pases IDA/RETORNO + Informe</button>
<a href="{{ route('comisiones.show',$pasaje->comision_id) }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Volver</a>
</form>
</div>
</div></div>
</x-app-layout>
