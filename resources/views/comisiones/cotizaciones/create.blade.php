<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Subir Cotización - {{ $comision->codigo }} - {{ $comision->destino }} - {{ $comision->pasajeros->count() }} PAX</h2></x-slot>
    <div class="py-12"><div class="max-w-5xl mx-auto sm:px-6 lg:px-8"><div class="bg-white p-8 shadow-sm rounded-lg">
        <form method="POST" action="{{ route('comisiones.cotizaciones.store',$comision->id) }}" enctype="multipart/form-data">@csrf
            <div class="space-y-6">
                <div class="grid grid-cols-3 gap-6">
                    <div><label class="block text-sm font-medium">Nro Proforma *</label><input type="text" name="nro_proforma" required value="PROFORMA-COMSUB-{{ str_pad($comision->cotizaciones->count()+1,3,'0',STR_PAD_LEFT) }}-2026" class="mt-1 block w-full rounded-md border-gray-300"></div>
                    <div><label class="block text-sm">RUC Proveedor *</label><input type="text" name="ruc_proveedor" required placeholder="1790727203001" class="mt-1 block w-full rounded-md border-gray-300"></div>
                    <div><label class="block text-sm">Tipo Proveedor *</label><select name="tipo_proveedor" required class="mt-1 block w-full rounded-md border-gray-300"><option value="AEROLINEA" selected>AEROLINEA</option><option value="AGENCIA">AGENCIA</option></select></div>
                </div>
                <div class="grid grid-cols-3 gap-6">
                    <div class="col-span-2"><label class="block text-sm">Nombre Proveedor *</label><input type="text" name="nombre_proveedor" required placeholder="AVIANCA ECUADOR S.A." class="mt-1 block w-full rounded-md border-gray-300"></div>
                    <div><label class="block text-sm">Valor Total *</label><input type="number" step="0.01" name="valor_total" required placeholder="2193.09" class="mt-1 block w-full rounded-md border-gray-300"></div>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div><label class="block text-sm">Fecha Cotización *</label><input type="date" name="fecha_cotizacion" required value="{{ date('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300"></div>
                    <div><label class="block text-sm">Archivo Proforma PDF</label><input type="file" name="archivo_proforma" accept=".pdf,.jpg,.png" class="mt-1 block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-gray-800 file:text-white"></div>
                </div>
                <div><label class="block text-sm">Detalle Pasajes</label><textarea name="detalle_pasajes" rows="3" class="mt-1 block w-full rounded-md border-gray-300">Pasaje aéreo para {{ $comision->pasajeros->count() }} PAX - {{ $comision->destino }}</textarea></div>
                <div class="flex gap-4 pt-4"><button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-md">Subir Cotización</button><a href="{{ route('comisiones.show',$comision->id) }}" class="bg-gray-300 px-6 py-2 rounded-md">Volver</a></div>
            </div>
        </form>
    </div></div></div>
</x-app-layout>
