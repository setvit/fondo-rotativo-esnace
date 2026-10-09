<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Cierre Mensual SEPTIEMBRE 2026 - Conciliado BANECUADOR Exacto - Estado Cuenta 3-00167809-0</h2></x-slot>
    <div class="py-6"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        @if(session('success'))<div class="bg-green-100 border-2 border-green-600 p-4 rounded font-bold">{{ session('success') }}</div>@endif

        <div class="bg-white shadow-lg rounded-lg p-8 border-2 border-black">
            <div class="text-center mb-4">
                <h2 class="font-black text-sm">BANECUADOR B.P.<br>Consulta de Movimientos de Cuenta Corriente - FR-ESTACION NAVAL CENTRO<br>Cuenta: 3-00167809-0 - SEPTIEMBRE 2026 - Conciliado Exacto</h2>
            </div>

            <!-- ESTADO CUENTA BANECUADOR IGUALITO -->
            <div class="mt-4">
                <h4 class="font-black text-xs bg-black text-white p-2">ESTADO DE CUENTA BANECUADOR OFICIAL - 01/09/2026 al 30/09/2026 - 7 TRANSACCIONES - TOTAL $9,567.79 + IVA $0.66 = $9,568.45</h4>
                <table class="w-full text-[8px] border">
                    <thead class="bg-gray-200"><tr><th class="p-1 border">FECHA</th><th class="p-1 border">DESCRIPCION</th><th class="p-1 border">REFERENCIA</th><th class="p-1 border">DEBITO</th><th class="p-1 border">IVA</th><th class="p-1 border">S. CONTABLE</th><th class="p-1 border">S. DISPONIBLE</th></tr></thead>
                    <tbody>
                        <tr><td class="p-1 border">07/09/2026</td><td class="p-1 border">N/D CC COMISION EMISION TARJETA DE DEBITO N/ 367724757</td><td class="p-1 border">367724757</td><td class="p-1 border text-right">$4.37</td><td class="p-1 border text-right">$0.66</td><td class="p-1 border text-right">$9,994.97</td><td class="p-1 border text-right">$9,994.97</td></tr>
                        <tr><td class="p-1 border">21/09/2026</td><td class="p-1 border">N/D CTA.CTE. PREAUTORIZACION INTERNACIONAL MA 427278449 - ALICANTE ESPAÑA</td><td class="p-1 border">427278449</td><td class="p-1 border text-right">$2,193.09</td><td class="p-1 border text-right">$0.00</td><td class="p-1 border text-right">$7,801.88</td><td class="p-1 border text-right">$7,801.88</td></tr>
                        <tr><td class="p-1 border">24/09/2026</td><td class="p-1 border">N/D CTA.CTE. CONSUMO NACIONAL MASTERCARD N/D 442201661 - COM-20260923182516 CAPELO $318.55 LIQUIDADA</td><td class="p-1 border">442201661</td><td class="p-1 border text-right">$318.55</td><td class="p-1 border text-right">$0.00</td><td class="p-1 border text-right">$7,483.33</td><td class="p-1 border text-right">$7,483.33</td></tr>
                        <tr class="bg-blue-50"><td class="p-1 border">25/09/2026</td><td class="p-1 border font-bold">N/D CTA.CTE. CONSUMO INTERNACIONAL MASTERCARD 447404188 - COM-20260925151104 BUSAN PASAJE $5,438.70 (figura cuadro)</td><td class="p-1 border">447404188</td><td class="p-1 border text-right font-black">$5,438.70</td><td class="p-1 border text-right">$0.00</td><td class="p-1 border text-right">$2,044.63</td><td class="p-1 border text-right">$2,044.63</td></tr>
                        <tr class="bg-red-50"><td class="p-1 border">28/09/2026</td><td class="p-1 border font-bold">N/D CTA.CTE. CONSUMO NACIONAL MASTERCARD N/D 449284260 - COM-20260925151104 BUSAN TASAS $350.00 KIWI cobro posterior NO figura cuadro</td><td class="p-1 border">449284260</td><td class="p-1 border text-right font-black bg-red-100">$350.00</td><td class="p-1 border text-right">$0.00</td><td class="p-1 border text-right">$1,694.63</td><td class="p-1 border text-right">$1,694.63</td></tr>
                        <tr><td class="p-1 border">29/09/2026</td><td class="p-1 border">N/D CTA.CTE. CONSUMO NACIONAL MASTERCARD N/D 458666437 - COM-20260929175110 LIMA $777.78</td><td class="p-1 border">458666437</td><td class="p-1 border text-right">$777.78</td><td class="p-1 border text-right">$0.00</td><td class="p-1 border text-right">$916.85</td><td class="p-1 border text-right">$916.85</td></tr>
                        <tr><td class="p-1 border">30/09/2026</td><td class="p-1 border">N/D CTA.CTE. CONSUMO NACIONAL MASTERCARD N/D 466884295 - COM-20260930144832 $485.30 LIQUIDADA</td><td class="p-1 border">466884295</td><td class="p-1 border text-right">$485.30</td><td class="p-1 border text-right">$0.00</td><td class="p-1 border text-right">$431.55</td><td class="p-1 border text-right">$431.55</td></tr>
                        <tr class="bg-black text-white font-black"><td colspan="3" class="p-1 border text-right">TOTALES - 7 TRANSACCIONES:</td><td class="p-1 border text-right">$9,567.79</td><td class="p-1 border text-right">$0.66</td><td class="p-1 border text-right"></td><td class="p-1 border text-right"></td></tr>
                    </tbody>
                </table>
                <p class="text-[8px] mt-1 bg-yellow-100 border p-1">Descuento 4.37 + 0.66 = 5.03 valor tarjeta débito BanEcuador N/ 367724757 - Tarjeta 267737457 - Saldo inicial $10,000.00 - $9,994.97 después comisión tarjeta = Saldo final $431.55 - Total débitos $9,567.79 + IVA $0.66 = $9,568.45 total con comisión</p>
            </div>

            <div class="mt-6">
                <h4 class="font-black text-xs bg-green-600 text-white p-2">2. COMISIONES LIQUIDADAS Y COMPLETADAS CON PASES - 2 comis $803.85 - Coincide con BanEcuador 318.55 + 485.30</h4>
                <table class="w-full text-[9px] border"><thead class="bg-green-100"><tr><th class="p-1 border">CÓDIGO</th><th class="p-1 border">VALOR</th><th class="p-1 border">BANECUADOR REF</th><th class="p-1 border">ESTADO</th></tr></thead>
                <tbody>
                <tr><td class="p-1 border">COM-20260930144832 GYE-UIO-GYE</td><td class="p-1 border text-right">$485.30</td><td class="p-1 border">466884295 - 30/09/2026</td><td class="p-1 border bg-green-100">LIQUIDADA - PASES ABORDAR OK</td></tr>
                <tr><td class="p-1 border">COM-20260923182516 GYE-UIO-GYE CAPELO STALIN</td><td class="p-1 border text-right">$318.55</td><td class="p-1 border">442201661 - 24/09/2026</td><td class="p-1 border bg-green-100">LIQUIDADA - PASE ABORDAR OK</td></tr>
                <tr class="bg-yellow-100 font-black"><td class="p-1 border text-right" colspan="1">TOTAL LIQUIDADAS:</td><td class="p-1 border text-right">$803.85</td><td class="p-1 border" colspan="2"></td></tr>
                </tbody></table>
            </div>

            <div class="mt-6">
                <h4 class="font-black text-xs bg-yellow-500 text-black p-2 border-2 border-black">3. COMISIONES POR LIQUIDAR CON FACTURA SIN PASES - 3 comis $8,759.57 - Coincide BanEcuador $2,193.09 + $5,438.70 + $350 + $777.78 = $8,759.57</h4>
                <table class="w-full text-[9px] border"><thead class="bg-yellow-100"><tr><th class="p-1 border">CÓDIGO</th><th class="p-1 border">PASAJE</th><th class="p-1 border">TASAS KIWI</th><th class="p-1 border">TOTAL</th><th class="p-1 border">BANECUADOR REF</th></tr></thead>
                <tbody>
                <tr><td class="p-1 border">COM-20260929175110 LIMA</td><td class="p-1 border text-right">$777.78</td><td class="p-1 border text-right">$0</td><td class="p-1 border text-right">$777.78</td><td class="p-1 border">458666437 - 29/09</td></tr>
                <tr class="bg-blue-50"><td class="p-1 border">COM-20260925151104 BUSAN - 2 PAX CODESC</td><td class="p-1 border text-right">$5,438.70</td><td class="p-1 border text-right bg-red-100 font-black">$350.00 - 449284260 - 28/09 - NO figura cuadro</td><td class="p-1 border text-right font-black">$5,788.70</td><td class="p-1 border">447404188 (pasaje) + 449284260 (tasas)</td></tr>
                <tr><td class="p-1 border">COM-20260921140224 ALICANTE ESPAÑA</td><td class="p-1 border text-right">$2,193.09</td><td class="p-1 border text-right">$0</td><td class="p-1 border text-right">$2,193.09</td><td class="p-1 border">427278449 - 21/09</td></tr>
                <tr class="bg-yellow-100 font-black"><td class="p-1 border text-right" colspan="1">TOTAL SIN PASES:</td><td class="p-1 border text-right">$8,409.57</td><td class="p-1 border text-right">$350.00</td><td class="p-1 border text-right">$8,759.57</td><td class="p-1 border"></td></tr>
                </tbody></table>
            </div>

            <div class="mt-6">
                <h4 class="font-black text-xs bg-black text-white p-2">4. CONCILIACIÓN BANCARIA EXACTA - IGUALITO ESTADO CUENTA BANECUADOR</h4>
                <table class="w-full text-[11px] border-2 border-black">
                    <tr><td class="p-2 border">Saldo Inicial Cuenta Corriente 3-00167809-0 FR-ESTACION NAVAL CENTRO - 01/09/2026:</td><td class="p-2 border text-right font-black">$10,000.00</td></tr>
                    <tr><td class="p-2 border">(-) N/D Comisión Emisión Tarjeta Débito 367724757 - 07/09/2026:</td><td class="p-2 border text-right">$4.37 + IVA $0.66 = $5.03</td></tr>
                    <tr><td class="p-2 border">(-) Comisiones Liquidadas y Cerradas 2 comis $803.85 (485.30 + 318.55):</td><td class="p-2 border text-right">$803.85</td></tr>
                    <tr><td class="p-2 border">(-) Comisiones con Factura sin Pases 3 comis $8,759.57 (777.78 + 5,438.70 + 350 + 2,193.09):</td><td class="p-2 border text-right">$8,759.57</td></tr>
                    <tr class="bg-gray-200 font-black"><td class="p-2 border">Total Débitos BanEcuador (sin IVA):</td><td class="p-2 border text-right">$9,567.79</td></tr>
                    <tr><td class="p-2 border">IVA Comisión Tarjeta:</td><td class="p-2 border text-right">$0.66</td></tr>
                    <tr class="bg-gray-200 font-black"><td class="p-2 border">Total Débitos + IVA:</td><td class="p-2 border text-right">$9,568.45</td></tr>
                    <tr><td class="p-2 border">Saldo Contable / Disponible Final BanEcuador 30/09/2026:</td><td class="p-2 border text-right font-black bg-green-100">$431.55</td></tr>
                    <tr class="bg-yellow-300 font-black"><td class="p-2 border">VALOR A REPONER PARA COMPLETAR $10,000.00 (con IVA):</td><td class="p-2 border text-right">$9,568.45</td></tr>
                    <tr class="bg-yellow-100 font-black"><td class="p-2 border">VALOR A REPONER SIN IVA (solo comisiones $9,563.42 + comisión tarjeta $4.37):</td><td class="p-2 border text-right">$9,567.79</td></tr>
                    <tr class="bg-blue-100 font-black"><td class="p-2 border">VALOR A REPONER SOLO COMISIONES (sin comisión tarjeta):</td><td class="p-2 border text-right">$9,563.42</td></tr>
                </table>
                <p class="text-[8px] mt-1">Cálculo igualito BanEcuador: $10,000.00 inicial - $4.37 comisión tarjeta - $0.66 IVA - $2,193.09 ALICANTE - $318.55 LIQUIDADA - $5,438.70 BUSAN pasaje - $350 BUSAN tasas - $777.78 LIMA - $485.30 LIQUIDADA = $431.55 saldo final. Total transacciones 7. Tarjeta débito 367724757 / 267737457.</p>
            </div>

            <div class="mt-6">
                <h4 class="font-black text-xs bg-blue-800 text-white p-2">5. RESUMEN POR REPARTOS - 07 PAX - $9,563.42 COMISIONES + $4.37 TARJETA + $0.66 IVA</h4>
                <table class="w-full text-[9px] border-2 border-blue-800">
                    <thead class="bg-blue-100"><tr><th class="p-2 border">REPARTO</th><th class="p-2 border">PAX</th><th class="p-2 border">COMISIÓN / VALOR</th><th class="p-2 border">TOTAL</th></tr></thead>
                    <tbody>
                        <tr><td class="p-2 border">COOPNA/COMSUB</td><td class="p-2 border text-center">2</td><td class="p-2 border">COM-20260930144832 $485.30 / 2</td><td class="p-2 border text-right">$485.30</td></tr>
                        <tr><td class="p-2 border">COOPNA</td><td class="p-2 border text-center">1</td><td class="p-2 border">COM-20260923182516 $318.55 CAPELO STALIN</td><td class="p-2 border text-right">$318.55</td></tr>
                        <tr><td class="p-2 border">COOPNA LIMA</td><td class="p-2 border text-center">1</td><td class="p-2 border">COM-20260929175110 $777.78</td><td class="p-2 border text-right">$777.78</td></tr>
                        <tr class="bg-blue-50"><td class="p-2 border">CODESC BUSAN</td><td class="p-2 border text-center">2</td><td class="p-2 border">$5,438.70 pasaje + $350 tasas = $5,788.70</td><td class="p-2 border text-right">$5,788.70</td></tr>
                        <tr><td class="p-2 border">CUINMA ALICANTE</td><td class="p-2 border text-center">1</td><td class="p-2 border">COM-20260921140224 $2,193.09</td><td class="p-2 border text-right">$2,193.09</td></tr>
                        <tr class="bg-black text-white font-black"><td class="p-2 border">TOTAL COMISIONES</td><td class="p-2 border text-center">7 PAX</td><td class="p-2 border">5 comis</td><td class="p-2 border text-right">$9,563.42</td></tr>
                        <tr><td class="p-2 border" colspan="3">+ Comisión emisión tarjeta débito 4.37 + IVA 0.66 = 5.03</td><td class="p-2 border text-right">$5.03</td></tr>
                        <tr class="bg-yellow-300 font-black"><td class="p-2 border" colspan="3">TOTAL + TARJETA</td><td class="p-2 border text-right">$9,568.45</td></tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-8 grid grid-cols-2 gap-12 text-center">
                <div class="border-t-2 border-black pt-2"><p class="font-black text-[9px]">TNFG-IG-IF TUSA VITAR EDUARDO<br>CUSTODIO FONDO ROTATIVO<br>Firma<br>etusa@armada.mil.ec - CI 1003869730</p></div>
                <div class="border-t-2 border-black pt-2"><p class="font-black text-[9px]">JEFE LOGÍSTICA ESNACE<br>Firma<br>jlogistica@esnace.mil.ec</p></div>
            </div>
        </div>
    </div></div>
</x-app-layout>
