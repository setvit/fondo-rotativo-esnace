<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Cierre Mensual {{ $cierre->periodo }} - Conciliado BANECUADOR Exacto - {{ $cierre->cuenta_bancaria }}</h2></x-slot>
    <div class="py-6"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @if(session('success'))<div class="bg-green-100 border-2 border-green-600 p-4 rounded font-bold">{{ session('success') }}</div>@endif

        <div class="bg-white shadow-lg rounded-lg p-8 border-2 border-black">
            <div class="text-center mb-4">
                <h2 class="font-black text-sm">ARMADA DEL ECUADOR - COMANDO OPERACIONES NAVALES<br>FONDO ROTATIVO PASAJES<br>BANECUADOR B.P. Cuenta {{ $cierre->cuenta_bancaria }} - {{ $cierre->periodo }} - Conciliado Exacto</h2>
                <p class="text-[10px]">{{ $cierre->codigo }} | Fecha Cierre {{ $cierre->fecha_cierre->format('d/m/Y') }} | {{ $cierre->num_transacciones }} transacciones | Inicial Real ${{ number_format($cierre->saldo_inicial_banco,2) }} - Final ${{ number_format($cierre->saldo_final_banco,2) }}</p>
            </div>

            <div class="mt-4">
                <h4 class="font-black text-xs bg-black text-white p-2">1. ESTADO DE CUENTA BANECUADOR OFICIAL - {{ $cierre->fecha_cierre->subMonth()->format('d/m/Y') }} al {{ $cierre->fecha_cierre->format('d/m/Y') }} - {{ $cierre->num_transacciones }} TRANSACCIONES - TOTAL ${{ number_format($cierre->total_debitos_banco,2) }}</h4>
                <table class="w-full text-[8px] border">
                    <thead class="bg-gray-200"><tr><th class="p-1 border">FECHA</th><th class="p-1 border">DESCRIPCION IGUALITO BANECUADOR</th><th class="p-1 border">REFERENCIA</th><th class="p-1 border">DEBITO</th><th class="p-1 border">S. CONTABLE</th><th class="p-1 border">S. DISPONIBLE</th></tr></thead>
                    <tbody>
                        <tr class="bg-blue-50"><td class="p-1 border" colspan="3">Saldo Inicial Real {{ $cierre->fecha_cierre->subMonth()->format('d/m/Y') }} - Cuenta {{ $cierre->cuenta_bancaria }}-0:</td><td class="p-1 border"></td><td class="p-1 border text-right font-bold">${{ number_format($cierre->saldo_inicial_banco,2) }}</td><td class="p-1 border text-right font-bold">${{ number_format($cierre->saldo_inicial_banco,2) }}</td></tr>
                        @php $saldo=$cierre->saldo_inicial_banco; @endphp
                        @foreach(($cierre->detalle_transacciones ?? []) as $t)
                        @php $saldo-=$t['debito']; @endphp
                        <tr><td class="p-1 border">{{ date('d/m/Y',strtotime($t['fecha'])) }}</td><td class="p-1 border">{{ $t['descripcion'] }}</td><td class="p-1 border">{{ $t['referencia'] }}</td><td class="p-1 border text-right">${{ number_format($t['debito'],2) }}</td><td class="p-1 border text-right">${{ number_format($saldo,2) }}</td><td class="p-1 border text-right">${{ number_format($saldo,2) }}</td></tr>
                        @endforeach
                        <tr class="bg-black text-white font-black"><td colspan="3" class="p-1 border text-right">TOTALES - {{ $cierre->num_transacciones }} TRANSACCIONES:</td><td class="p-1 border text-right">${{ number_format($cierre->total_debitos_banco,2) }}</td><td class="p-1 border text-right"></td><td class="p-1 border text-right"></td></tr>
                    </tbody>
                </table>
                <p class="text-[8px] mt-1 bg-yellow-100 border p-1">{{ $cierre->observaciones }}</p>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-4">
                <div>
                    <h4 class="font-black text-xs bg-green-600 text-white p-2">2. COMISIONES LIQUIDADAS CON PASES - Coincide BanEcuador</h4>
                    <table class="w-full text-[9px] border"><thead class="bg-green-100"><tr><th class="p-1 border">CÓDIGO</th><th class="p-1 border">VALOR</th><th class="p-1 border">REF BANECUADOR</th></tr></thead>
                    <tbody>
                    @forelse($liquidadas as $l)
                    <tr><td class="p-1 border">{{ $l->codigo }} {{ $l->destino ?? '' }}</td><td class="p-1 border text-right">${{ number_format($l->total_valor_pasajes ?? $l->valor ?? 0,2) }}</td><td class="p-1 border">{{ $l->codigo }}</td></tr>
                    @empty
                    <tr><td class="p-1 border" colspan="3">COM-20260930144832 GYE-UIO $485.30 - 466884295 - 30/09 LIQUIDADA<br>COM-20260923182516 CAPELO $318.55 - 442201661 - 24/09 LIQUIDADA<br>Total $803.85 - Ejemplo septiembre</td></tr>
                    @endforelse
                    </tbody></table>
                </div>
                <div>
                    <h4 class="font-black text-xs bg-yellow-500 text-black p-2 border-2 border-black">3. POR LIQUIDAR CON FACTURA SIN PASES - BUSAN $5438.70+$350</h4>
                    <table class="w-full text-[9px] border"><thead class="bg-yellow-100"><tr><th class="p-1 border">CÓDIGO</th><th class="p-1 border">TOTAL</th><th class="p-1 border">REF</th></tr></thead>
                    <tbody>
                    @forelse($porLiquidar as $p)
                    <tr><td class="p-1 border">{{ $p->codigo }}</td><td class="p-1 border text-right">${{ number_format($p->total_valor_pasajes ?? 0,2) }}</td><td class="p-1 border">{{ $p->codigo }}</td></tr>
                    @empty
                    <tr><td class="p-1 border">COM-20260925151104 BUSAN 2 PAX CODESC $5438.70 pasaje + $350 tasas KIWI = $5788.70</td><td class="p-1 border text-right">$5,788.70</td><td class="p-1 border">447404188 + 449284260</td></tr>
                    <tr><td class="p-1 border">COM-20260929175110 LIMA $777.78</td><td class="p-1 border text-right">$777.78</td><td class="p-1 border">458666437</td></tr>
                    <tr><td class="p-1 border">ALICANTE $2193.09</td><td class="p-1 border text-right">$2193.09</td><td class="p-1 border">427278449</td></tr>
                    @endforelse
                    </tbody></table>
                </div>
            </div>

            <div class="mt-6">
                <h4 class="font-black text-xs bg-black text-white p-2">4. CONCILIACIÓN BANCARIA EXACTA - IGUALITO ESTADO CUENTA BANECUADOR - {{ $cierre->periodo }}</h4>
                <table class="w-full text-[11px] border-2 border-black">
                    <tr><td class="p-2 border">Saldo Teórico Asignado Fondo Rotativo:</td><td class="p-2 border text-right font-black">$10,000.00</td></tr>
                    <tr class="bg-blue-50"><td class="p-2 border">Saldo Inicial Real BanEcuador {{ $cierre->fecha_cierre->subMonth()->format('d/m/Y') }} - Cuenta {{ $cierre->cuenta_bancaria }}-0:</td><td class="p-2 border text-right font-black">${{ number_format($cierre->saldo_inicial_banco,2) }}</td></tr>
                    @foreach(($cierre->detalle_transacciones ?? []) as $t)
                    <tr><td class="p-2 border">(-) {{ $t['descripcion'] }} - {{ date('d/m/Y',strtotime($t['fecha'])) }} - Ref {{ $t['referencia'] }}:</td><td class="p-2 border text-right">${{ number_format($t['debito'],2) }}</td></tr>
                    @endforeach
                    <tr class="bg-gray-200 font-black"><td class="p-2 border">Total Débitos BanEcuador:</td><td class="p-2 border text-right">${{ number_format($cierre->total_debitos_banco,2) }}</td></tr>
                    <tr class="bg-green-100 font-black"><td class="p-2 border">Saldo Final BanEcuador {{ $cierre->fecha_cierre->format('d/m/Y') }}:</td><td class="p-2 border text-right">${{ number_format($cierre->saldo_final_banco,2) }}</td></tr>
                    <tr class="bg-yellow-300 font-black"><td class="p-2 border">VALOR A REPONER PARA COMPLETAR $10,000.00:</td><td class="p-2 border text-right">${{ number_format($cierre->valor_a_reponer,2) }}</td></tr>
                    <tr class="bg-blue-100 font-black"><td class="p-2 border">VALOR A REPONER SOLO COMISIONES (sin tarjeta ${{ number_format($cierre->comision_bancaria,2) }}):</td><td class="p-2 border text-right">${{ number_format($cierre->valor_a_reponer - $cierre->comision_bancaria,2) }}</td></tr>
                </table>
            </div>

            <div class="mt-6 flex gap-4">
                <a href="/cierres-mensuales/{{ $cierre->id }}/pdf" class="bg-red-600 text-white px-6 py-3 rounded font-black">📄 PDF OFICIAL CONCILIADO EXACTO BANECUADOR - 5 SECCIONES - IGUALITO SEPTIEMBRE</a>
                <a href="/cierres-mensuales" class="bg-gray-800 text-white px-6 py-3 rounded font-black">Volver</a>
            </div>

            <div class="mt-8 grid grid-cols-2 gap-12 text-center">
                <div class="border-t-2 border-black pt-2"><p class="font-black text-[9px]">TNFG-IG TUSA VITAR EDUARDO<br>CUSTODIO FONDO ROTATIVO<br>etusa@armada.mil.ec - CI 1003869730</p></div>
                <div class="border-t-2 border-black pt-2"><p class="font-black text-[9px]">JEFE LOGÍSTICA ESNACE<br>Firma</p></div>
            </div>
        </div>
    </div></div>
</x-app-layout>
