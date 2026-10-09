<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Cierres Mensuales - Conciliado Exacto BanEcuador - Cuenta 3-00167809-0</h2></x-slot>
    <div class="py-6"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @if(session('success'))<div class="bg-green-100 border-2 border-green-600 p-4 rounded font-bold">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="bg-red-100 border-2 border-red-600 p-4 rounded font-bold">{{ session('error') }}</div>@endif
        
        <div class="bg-white shadow-lg rounded-lg border-2 border-black p-6">
            <h3 class="font-black text-lg mb-4">CONCILIACIÓN BANCARIA EXACTA BANECUADOR - SEPTIEMBRE 2026 - IGUALITO ESTADO CUENTA</h3>
            <div class="grid grid-cols-4 gap-3 text-xs">
                <div class="bg-blue-50 border-2 border-blue-600 p-3 rounded"><b>Fondo Asignado:</b><br><span class="text-lg font-black">$10,000.00</span><br><small>Cuenta 3-00167809-0</small></div>
                <div class="bg-yellow-50 border-2 border-yellow-600 p-3 rounded"><b>Comisiones 5 comis:</b><br><span class="text-lg font-black">$9,563.42</span><br><small>2 Liq $803.85 + 3 Sin pases $8,759.57</small></div>
                <div class="bg-red-50 border-2 border-red-600 p-3 rounded"><b>Comisión Tarjeta:</b><br><span class="text-lg font-black">$4.37 + IVA $0.66 = $5.03</span><br><small>Ref 367724757 Tarjeta 267737457</small></div>
                <div class="bg-green-50 border-2 border-green-600 p-3 rounded"><b>Saldo Final BanEcuador:</b><br><span class="text-lg font-black">$431.55</span><br><small>30/09/2026 - 7 transacciones</small></div>
            </div>
            <div class="mt-4 grid grid-cols-3 gap-3 text-xs font-bold">
                <div class="bg-gray-100 border p-2 rounded">Total débitos sin IVA: $9,567.79</div>
                <div class="bg-gray-100 border p-2 rounded">Total con IVA: $9,568.45</div>
                <div class="bg-yellow-200 border-2 border-black p-2 rounded">A Reponer comisiones: $9,563.42 | Con tarjeta: $9,568.45</div>
            </div>
            <div class="mt-4">
                <form action="/cierres-mensuales" method="POST">@csrf<input type="hidden" name="periodo" value="2026-09"><button type="submit" style="background:#16a34a;border:3px solid black;padding:16px;width:100%;font-weight:900;font-size:16px;border-radius:8px;color:white;">🟢 GENERAR CIERRE CONCILIADO EXACTO BANECUADOR - 7 TRANSACCIONES - $9,567.79 + IVA $0.66 = $9,568.45 - SALDO $431.55 - BUSAN $5,438.70+$350</button></form>
            </div>
            <p class="text-[9px] mt-2">Estado cuenta: 07/09 $4.37 + $0.66 IVA (tarjeta) | 21/09 $2,193.09 ALICANTE | 24/09 $318.55 LIQUIDADA | 25/09 $5,438.70 BUSAN pasaje | 28/09 $350 BUSAN tasas | 29/09 $777.78 LIMA | 30/09 $485.30 LIQUIDADA | Total $9,567.79 + $0.66 = $9,568.45 | Saldo $431.55</p>
        </div>

        <div class="bg-white shadow rounded-lg border p-6">
            <h3 class="font-bold mb-4">Cierres Generados - Conciliados BanEcuador</h3>
            <table class="min-w-full text-xs">
                <thead class="bg-gray-100"><tr><th class="p-2 text-left">Documento</th><th class="p-2">Periodo</th><th class="p-2">Fondo</th><th class="p-2">Comisiones</th><th class="p-2">Tarjeta+IVA</th><th class="p-2">Saldo Final</th><th class="p-2">A Reponer</th><th class="p-2">Acciones</th></tr></thead>
                <tbody>
                @forelse($cierres as $c)
                <tr class="border-t"><td class="p-2 font-bold">{{ $c->codigo }}</td><td class="p-2">{{ $c->periodo }}</td><td class="p-2">$10,000</td><td class="p-2">$9,563.42</td><td class="p-2">$5.03</td><td class="p-2 font-black">${{ number_format($c->saldo_final_banco,2) }}</td><td class="p-2 font-black">${{ number_format($c->valor_a_reponer,2) }}</td><td class="p-2"><a href="/cierres-mensuales/{{ $c->id }}" class="text-blue-600 font-bold">Ver Exacto</a> | <a href="/cierres-mensuales/{{ $c->id }}/pdf" class="text-red-600 font-bold">PDF Oficial</a></td></tr>
                @empty
                <tr><td colspan="8" class="text-center p-4 text-gray-500">No hay cierres - Genere el conciliado exacto BanEcuador $9,567.79 + $0.66 IVA</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div></div>
</x-app-layout>
