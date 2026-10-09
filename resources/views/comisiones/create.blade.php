<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Nueva Comisión</h2></x-slot>
    <div class="py-12"><div class="max-w-4xl mx-auto sm:px-6 lg:px-8"><div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
        <form method="POST" action="{{ route('comisiones.store') }}">@csrf
            <div class="space-y-6">
                <div class="grid grid-cols-2 gap-6">
                    <div><label class="block text-sm font-medium">Código *</label><input type="text" name="codigo" value="COM-{{ date('YmdHis') }}" required class="mt-1 block w-full rounded-md border-gray-300"></div>
                    <div><label class="block text-sm">Destino *</label><input type="text" name="destino" required placeholder="GUAYAQUIL-QUITO-GUAYAQUIL" class="mt-1 block w-full rounded-md border-gray-300"></div>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div><label class="block text-sm">Tipo *</label><select name="tipo" required class="mt-1 block w-full rounded-md border-gray-300"><option value="NACIONAL">NACIONAL</option><option value="INTERNACIONAL">INTERNACIONAL</option></select></div>
                    <div><label class="block text-sm">Motivo *</label><input type="text" name="motivo" required value="VIAJE AUTORIZADO POR LA ESTACION NAVAL CENTRO" class="mt-1 block w-full rounded-md border-gray-300"></div>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div><label class="block text-sm">Fecha Salida *</label><input type="date" name="fecha_salida" required class="mt-1 block w-full rounded-md border-gray-300"></div>
                    <div><label class="block text-sm">Fecha Retorno *</label><input type="date" name="fecha_retorno" required class="mt-1 block w-full rounded-md border-gray-300"></div>
                </div>
                <div class="flex gap-4 pt-4"><button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-md">Crear</button><a href="{{ route('comisiones.index') }}" class="bg-gray-300 px-6 py-2 rounded-md">Volver</a></div>
            </div>
        </form>
    </div></div></div>
</x-app-layout>
