
{{-- resources/views/components/alerta-fondo.blade.php --}}
@php
    $validacion = session('validacion') ?? $validacion ?? null;
@endphp

@if($validacion && $validacion['alerta'] !== 'OK')
<div class="alert alert-{{ $validacion['alerta'] === 'SOBREGIRO' ? 'danger' : 'warning' }} border-2">
    <h5 class="alert-heading">
        @if($validacion['alerta'] === 'SOBREGIRO')
            🚨 FONDO EN SOBREGIRO - {{ $validacion['fondo']->reparto }} 
        @else
            ⚠️ ALERTA DE SALDO BAJO
        @endif
    </h5>
    <p>{{ $validacion['mensaje'] }}</p>
    <hr>
    <ul class="mb-0">
        <li><strong>Reparto:</strong> {{ $validacion['fondo']->reparto }} | {{ $validacion['fondo']->estructura }} | {{ $validacion['fondo']->tipo_pasaje }}</li>
        <li><strong>Saldo Anterior:</strong> ${{ number_format($validacion['saldo_anterior'], 2) }}</li>
        <li><strong>Valor Pasaje:</strong> ${{ number_format(request()->valor_pasaje ?? 0, 2) }}</li>
        <li><strong>Saldo Nuevo:</strong> ${{ number_format($validacion['saldo_nuevo'], 2) }} 
            @if($validacion['es_sobregiro'])
                <span class="badge bg-danger">NEGATIVO -${{ number_format($validacion['valor_sobregiro'], 2) }}</span>
            @endif
        </li>
        <li><strong>Fondo Global COOPNA $10,000:</strong> Quedará con ${{ number_format(DB::table('control_fondo_global')->value('saldo_global') - (request()->valor_pasaje ?? 0), 2) }}</li>
    </ul>

    @if($validacion['es_sobregiro'])
    <div class="mt-3">
        <label><input type="checkbox" name="confirmar_sobregiro" value="1" required> Entiendo que esta compra dejará a {{ $validacion['fondo']->reparto }} en NEGATIVO y afectará mi fondo rotativo de $10,000. Deseo continuar.</label>
    </div>
    @endif
</div>
@endif
