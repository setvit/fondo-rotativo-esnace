@extends('layouts.app')
@section('content')
<div class="container">
    <h5>Generar Cuadro Comparativo - Comisión {{ $comision->codigo }} - {{ $comision->destino }}</h5>
    <div class="alert alert-info">
        Tiene {{ $comision->cotizaciones->count() }} cotizaciones. Se seleccionará la de menor valor como ganadora.
        <ul>
            @foreach($comision->cotizaciones->sortBy('valor_total') as $cot)
                <li>{{ $cot->nro_proforma }} - {{ $cot->nombre_proveedor }} - ${{ number_format($cot->valor_total,2) }} {{ $loop->first ? '(GANADORA)' : '' }}</li>
            @endforeach
        </ul>
    </div>
    <form method="POST" action="{{ route('comisiones.cuadros.store',$comision->id) }}">
        @csrf
        <button type="submit" class="btn btn-warning">Generar Cuadro Comparativo</button>
        <a href="{{ route('comisiones.show',$comision->id) }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
