<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">🧾 Cierres Mensuales - Conciliado Exacto BanEcuador - Cuenta 3-00167809-0</h2></x-slot>
    <div class="py-6"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @if(session('success'))<div class="bg-green-100 border-2 border-green-600 p-4 rounded font-bold">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="bg-red-100 border-2 border-red-600 p-4 rounded font-bold">{{ session('error') }}</div>@endif
        
        <div class="bg-white shadow-lg rounded-lg border-2 border-black p-6">
            <h3 class="font-black text-lg mb-4">CONCILIACIÓN BANCARIA EXACTA BANECUADOR - IGUALITO ESTADO CUENTA - MES A MES</h3>
            <p class="text-xs text-gray-600 mb-4">Ingrese igualito lo que ve en el estado de cuenta BanEcuador B.P. Cuenta 3-00167809-0. El sistema calcula saldo final y valor a reponer automático para que cuadre siempre.</p>
            
            <form action="/cierres-mensuales" method="POST" id="cierreForm">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3 text-xs">
                <div><label class="font-bold">Periodo (ej: SEPTIEMBRE 2026)</label><input name="periodo" value="SEPTIEMBRE 2026" required class="w-full border-2 border-black p-2 rounded"></div>
                <div><label class="font-bold">Mes (1-12)</label><input type="number" name="mes" value="9" min="1" max="12" required class="w-full border-2 border-black p-2 rounded"></div>
                <div><label class="font-bold">Año</label><input type="number" name="anio" value="2026" required class="w-full border-2 border-black p-2 rounded"></div>
                <div><label class="font-bold">Cuenta</label><input name="cuenta_bancaria" value="3-00167809-0" required class="w-full border-2 border-black p-2 rounded"></div>
                <div><label class="font-bold">Fecha Cierre</label><input type="date" name="fecha_cierre" value="2026-10-06" required class="w-full border-2 border-black p-2 rounded"></div>
                <div><label class="font-bold">Saldo Inicial Real BanEcuador</label><input type="number" step="0.01" name="saldo_inicial_banco" value="{{ $saldoSugerido }}" required class="w-full border-2 border-blue-600 p-2 rounded bg-blue-50"></div>
                <div><label class="font-bold">Comisión Tarjeta (si hay)</label><input type="number" step="0.01" name="comision_bancaria" value="5.03" class="w-full border-2 border-red-600 p-2 rounded bg-red-50"></div>
                <div><label class="font-bold">Fondo Teórico</label><input type="number" value="10000" disabled class="w-full border p-2 rounded bg-gray-100"></div>
            </div>

            <div class="mt-6 bg-gray-50 p-4 rounded border-2 border-black">
                <h4 class="font-black text-xs mb-2">TRANSACCIONES BANECUADOR - IGUALITO ESTADO CUENTA (Fecha | Descripción | Referencia | Débito)</h4>
                <div id="transacciones">
                    <div class="grid grid-cols-12 gap-2 mb-2 text-[10px] font-black bg-black text-white p-2 rounded">
                        <div class="col-span-2">FECHA</div><div class="col-span-5">DESCRIPCION IGUALITO BANECUADOR</div><div class="col-span-2">REFERENCIA</div><div class="col-span-2">DEBITO $</div><div class="col-span-1">X</div>
                    </div>
                    <div class="trans-row grid grid-cols-12 gap-2 mb-2">
                        <div class="col-span-2"><input type="date" name="transacciones[0][fecha]" value="2026-09-07" required class="w-full border p-1 text-xs rounded"></div>
                        <div class="col-span-5"><input name="transacciones[0][descripcion]" value="N/D CC COMISION EMISION TARJETA DE DEBITO N/ 367724757 - Tarjeta 267737457" required class="w-full border p-1 text-xs rounded"></div>
                        <div class="col-span-2"><input name="transacciones[0][referencia]" value="367724757" required class="w-full border p-1 text-xs rounded"></div>
                        <div class="col-span-2"><input type="number" step="0.01" name="transacciones[0][debito]" value="5.03" required class="w-full border p-1 text-xs rounded bg-red-50"></div>
                        <div class="col-span-1"><button type="button" onclick="this.closest('.trans-row').remove(); recalcular();" class="bg-red-600 text-white px-2 py-1 rounded text-xs">X</button></div>
                    </div>
                    <div class="trans-row grid grid-cols-12 gap-2 mb-2">
                        <div class="col-span-2"><input type="date" name="transacciones[1][fecha]" value="2026-09-21" required class="w-full border p-1 text-xs rounded"></div>
                        <div class="col-span-5"><input name="transacciones[1][descripcion]" value="N/D CTA.CTE. PREAUTORIZACION INTERNACIONAL MA 427278449 - ALICANTE ESPAÑA - COM-2026921140224 CPCB-SS Rafael Cobo Loor" required class="w-full border p-1 text-xs rounded"></div>
                        <div class="col-span-2"><input name="transacciones[1][referencia]" value="427278449" required class="w-full border p-1 text-xs rounded"></div>
                        <div class="col-span-2"><input type="number" step="0.01" name="transacciones[1][debito]" value="2193.09" required class="w-full border p-1 text-xs rounded"></div>
                        <div class="col-span-1"><button type="button" onclick="this.closest('.trans-row').remove(); recalcular();" class="bg-red-600 text-white px-2 py-1 rounded text-xs">X</button></div>
                    </div>
                    <div class="trans-row grid grid-cols-12 gap-2 mb-2">
                        <div class="col-span-2"><input type="date" name="transacciones[2][fecha]" value="2026-09-24" required class="w-full border p-1 text-xs rounded"></div>
                        <div class="col-span-5"><input name="transacciones[2][descripcion]" value="N/D CTA.CTE. CONSUMO NACIONAL MASTERCARD 442201661 - COM-20260923182516 CAPELO $318.55 LIQUIDADA" required class="w-full border p-1 text-xs rounded"></div>
                        <div class="col-span-2"><input name="transacciones[2][referencia]" value="442201661" required class="w-full border p-1 text-xs rounded"></div>
                        <div class="col-span-2"><input type="number" step="0.01" name="transacciones[2][debito]" value="318.55" required class="w-full border p-1 text-xs rounded bg-green-50"></div>
                        <div class="col-span-1"><button type="button" onclick="this.closest('.trans-row').remove(); recalcular();" class="bg-red-600 text-white px-2 py-1 rounded text-xs">X</button></div>
                    </div>
                </div>
                <button type="button" onclick="addTrans()" class="mt-2 bg-gray-800 text-white px-3 py-1 rounded text-xs">+ Agregar transacción BanEcuador (pasaje, tasas BUSAN $5438.70+$350)</button>
                
                <div class="mt-4 grid grid-cols-3 gap-3 text-xs font-bold">
                    <div class="bg-blue-100 border-2 border-blue-600 p-3 rounded">Total débitos sin IVA: <span id="totalSinIva">$0</span></div>
                    <div class="bg-red-100 border-2 border-red-600 p-3 rounded">Total con IVA/tarjeta: <span id="totalConIva">$0</span></div>
                    <div class="bg-green-100 border-2 border-green-600 p-3 rounded">Saldo Final Calculado: <span id="saldoFinal">$0</span> | A Reponer: <span id="aReponer">$0</span></div>
                </div>
            </div>

            <div class="mt-4"><label class="font-bold text-xs">Observaciones (para que cuadre exacto)</label><textarea name="observaciones" class="w-full border-2 border-black p-2 rounded text-xs" rows="2">BanEcuador: $10,000.00 inicial - $4.37 comisión tarjeta - $0.66 IVA - $2,193.09 ALICANTE - $318.55 LIQUIDADA - $5,438.70 BUSAN pasaje - $350 BUSAN tasas - $777.78 LIMA - $485.30 LIQUIDADA = $431.55 saldo final. Total transacciones 7. Tarjeta débito 367724757 / 267737457.</textarea></div>

            <div class="mt-4">
                <button type="submit" class="w-full bg-green-600 border-4 border-black p-4 rounded-lg font-black text-white text-sm">🟢 GENERAR CIERRE CONCILIADO EXACTO BANECUADOR - SALDO FINAL + A REPONER - BUSAN $5,438.70+$350 INCLUIDO</button>
            </div>
            </form>

            <p class="text-[9px] mt-2 text-gray-600">Estado cuenta: 07/09 $4.37 + $0.66 IVA (tarjeta) | 21/09 $2,193.09 ALICANTE | 24/09 $318.55 LIQUIDADA | 25/09 $5,438.70 BUSAN pasaje | 28/09 $350 BUSAN tasas | 29/09 $777.78 LIMA | 30/09 $485.30 LIQUIDADA | Total $9,567.79 + $0.66 = $9,568.45 | Saldo $431.55 - Ejemplo septiembre 2026</p>
        </div>

        <div class="bg-white shadow rounded-lg border p-6">
            <h3 class="font-bold mb-4">Cierres Generados - Conciliados BanEcuador - Mes a mes cuadre exacto</h3>
            <table class="min-w-full text-xs">
                <thead class="bg-gray-100"><tr><th class="p-2 text-left">Documento</th><th class="p-2">Periodo</th><th class="p-2">Fondo</th><th class="p-2">Comisiones</th><th class="p-2">Tarjeta+IVA</th><th class="p-2">Saldo Final</th><th class="p-2">A Reponer</th><th class="p-2">Acciones</th></tr></thead>
                <tbody>
                @forelse($cierres as $c)
                <tr class="border-t"><td class="p-2 font-bold">{{ $c->codigo }}</td><td class="p-2">{{ $c->periodo }}</td><td class="p-2">$10,000</td><td class="p-2">${{ number_format($c->total_ejecutado ?? ($c->valor_a_reponer - $c->comision_bancaria),2) }}</td><td class="p-2">${{ number_format($c->comision_bancaria,2) }}</td><td class="p-2 font-black bg-green-100">${{ number_format($c->saldo_final_banco,2) }}</td><td class="p-2 font-black bg-yellow-200">${{ number_format($c->valor_a_reponer,2) }}</td><td class="p-2"><a href="/cierres-mensuales/{{ $c->id }}" class="text-blue-600 font-bold underline">Ver Exacto</a> | <a href="/cierres-mensuales/{{ $c->id }}/pdf" class="text-red-600 font-bold underline">PDF Oficial</a></td></tr>
                @empty
                <tr><td colspan="8" class="text-center p-4 text-gray-500">No hay cierres - Ingrese transacciones BanEcuador arriba para generar mes a mes exacto $9,567.79 + $0.66 IVA</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div></div>

<script>
let idx=3;
function addTrans(){
 const container=document.getElementById('transacciones');
 const div=document.createElement('div');
 div.className='trans-row grid grid-cols-12 gap-2 mb-2';
 div.innerHTML=`<div class="col-span-2"><input type="date" name="transacciones[${idx}][fecha]" required class="w-full border p-1 text-xs rounded"></div><div class="col-span-5"><input name="transacciones[${idx}][descripcion]" placeholder="N/D CTA.CTE. CONSUMO INTERNACIONAL 447404188 - BUSAN PASAJE $5438.70" required class="w-full border p-1 text-xs rounded"></div><div class="col-span-2"><input name="transacciones[${idx}][referencia]" placeholder="447404188" required class="w-full border p-1 text-xs rounded"></div><div class="col-span-2"><input type="number" step="0.01" name="transacciones[${idx}][debito]" placeholder="5438.70" required oninput="recalcular()" class="w-full border p-1 text-xs rounded bg-blue-50"></div><div class="col-span-1"><button type="button" onclick="this.closest('.trans-row').remove(); recalcular();" class="bg-red-600 text-white px-2 py-1 rounded text-xs">X</button></div>`;
 container.appendChild(div); idx++; recalcular();
}
function recalcular(){
 let total=0;
 document.querySelectorAll('input[name^="transacciones"][name$="[debito]"]').forEach(el=>{ total+=parseFloat(el.value)||0; });
 const inicial=parseFloat(document.querySelector('input[name="saldo_inicial_banco"]').value)||10000;
 document.getElementById('totalSinIva').innerText='$'+(total-0.66).toFixed(2);
 document.getElementById('totalConIva').innerText='$'+total.toFixed(2);
 document.getElementById('saldoFinal').innerText='$'+(inicial-total).toFixed(2);
 document.getElementById('aReponer').innerText='$'+(10000-(inicial-total)).toFixed(2);
}
document.addEventListener('input', recalcular);
recalcular();
</script>
</x-app-layout>
