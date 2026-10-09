<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Agregar Pasajero - {{ $comision->codigo }}</h2></x-slot>
    <div class="py-12"><div class="max-w-4xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
        @php $repartos = $repartos ?? ['COOPNA','CODESC','CUINMA','COAVNA','COMSUB','COMACO','COGUAR','COMCUB','COMSUP','DIGEIM','ESNACE','ESNAFA','JEM','DIBIEN','DIRNEA']; @endphp
        <form method="POST" action="{{ route('comisiones.pasajeros.store',$comision->id) }}">@csrf
            <div class="space-y-4">
                <div><label class="block text-sm font-medium">Nombre Completo *</label><input type="text" name="nombre" required placeholder="CPCB-SS Rafael Coba Loor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm">Cédula *</label><input type="text" name="cedula" required maxlength="10" class="mt-1 block w-full rounded-md border-gray-300"></div>
                    <div><label class="block text-sm">Reparto *</label><select name="reparto" required class="mt-1 block w-full rounded-md border-gray-300">@foreach($repartos as $r)<option value="{{ $r }}" {{ $r=='COMSUB' ? 'selected' : '' }}>{{ $r }}</option>@endforeach</select></div>
                </div>
                <div><label class="block text-sm">Cargo *</label><input type="text" name="cargo" required placeholder="JEFE DEL DEPARTAMENTO" class="mt-1 block w-full rounded-md border-gray-300"></div>
                <div class="flex gap-4 pt-4"><button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-md">Agregar Pasajero</button><a href="{{ route('comisiones.show',$comision->id) }}" class="bg-gray-300 px-6 py-2 rounded-md">Volver</a></div>
            </div>
        </form>
    </div></div></div>
</x-app-layout>
