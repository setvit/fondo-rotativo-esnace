<x-app-layout>
<x-slot name="header">
<div style="background:#001f3f; margin:-24px; padding:20px 24px; color:white; display:flex; justify-content:space-between; align-items:center;">
<div>
<h2 style="font-weight:bold; font-size:18px; margin:0;">Detalle {{ $comision->codigo }} - {{ $comision->destino }} - {{ $comision->pasajeros->count() }} oficiales, 1 factura ${{ number_format($comision->pasajes->where('es_factura_principal',true)->unique('factura_grupo')->sum('valor') ?: $comision->total_valor_pasajes,2) }} compartida</h2>
<p style="font-size:11px; margin:4px 0 0 0; color:#FFD700;">ARMADA DEL ECUADOR | ESNACE | Fondo Rotativo</p>
</div>
<div style="display:flex; gap:8px;"><a href="{{ route('comisiones.mini',$comision->id) }}" style="background:#FFD700; color:#001f3f; padding:6px 14px; border-radius:6px; text-decoration:none; font-weight:bold; font-size:12px; border:2px solid white;">📊 KARDEX PDF</a><a href="{{ route('comisiones.index') }}" style="background:white; color:#001f3f; padding:6px 14px; border-radius:6px; text-decoration:none; font-weight:bold; font-size:12px;">← Volver</a></div>
</div>
</x-slot>

<div style="padding:24px; background:#e5e7eb; min-height:100vh;">
<div style="max-width:1280px; margin:0 auto; display:flex; flex-direction:column; gap:16px;">

@php 
$totalReal = $comision->pasajes->where('es_factura_principal',true)->unique('factura_grupo')->sum('valor'); 
if($totalReal==0) $totalReal = $comision->total_valor_pasajes;
$ganadora = $comision->cotizaciones->sortBy('valor_total')->first();
@endphp

<!-- DETALLE -->
<div style="background:white; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1); border-left:6px solid #001f3f; overflow:hidden;">
<div style="background: linear-gradient(90deg, #001f3f, #1e3a5f); color:white; padding:12px 20px; display:flex; justify-content:space-between;">
<span style="font-weight:bold; font-size:14px;">📋 Detalle Comisión - {{ $comision->codigo }}</span>
<span style="background:#FFD700; color:#001f3f; padding:2px 10px; border-radius:12px; font-size:11px; font-weight:bold;">{{ $comision->estado }}</span>
</div>
<div style="padding:16px 20px; font-size:13px; color:#374151;">
<div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:12px;">
<div><strong>Destino:</strong> <span style="color:#001f3f; font-weight:bold;">{{ $comision->destino }}</span></div>
<div><strong>Tipo:</strong> <span style="background:#dbeafe; color:#001f3f; padding:2px 8px; border-radius:4px; font-weight:bold;">{{ $comision->tipo }}</span></div>
<div><strong>Doc:</strong> {{ $comision->estado_documental }}</div>
<div><strong>Fechas:</strong> {{ $comision->fecha_salida }} al {{ $comision->fecha_retorno }}</div>
<div><strong>Total REAL:</strong> <span style="background:#001f3f; color:white; padding:3px 10px; border-radius:4px; font-weight:bold;">${{ number_format($totalReal,2) }}</span> <small>(no duplicado)</small></div>
<div><strong>Pasajeros:</strong> {{ $comision->pasajeros->count() }} | Registros: {{ $comision->pasajes->count() }}</div>
</div>
</div>
</div>


<!-- KARDEX MINI LIQUIDACION - AGREGADO SIN TOCAR LO DEMAS -->
<div style="background:white; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1); border-left:6px solid #FFD700; border-top:3px solid #001f3f; overflow:hidden;">
<div style="background: linear-gradient(90deg, #001f3f, #000); color:white; padding:12px 20px; display:flex; justify-content:space-between; align-items:center;">
<span style="font-weight:bold; font-size:14px;">📊 KARDEX FONDO ROTATIVO - Mini Liquidación por Comisión</span>
<a href="{{ route('comisiones.mini',$comision->id) }}" style="background:#FFD700; color:#001f3f; padding:6px 14px; border-radius:6px; text-decoration:none; font-weight:bold; font-size:11px;">Ver Kardex PDF</a>
</div>
<div style="padding:12px 20px; font-size:12px; color:#374151; background:#fffbeb; border:1px dashed #fbbf24; margin:12px; border-radius:6px;">
<strong>Kardex:</strong> Saldo Inicial Real $9,999.34 - Tarjeta $5.03 = $9,994.31 operativo. Esta comisión <strong>{{ $comision->codigo }}</strong> - Total REAL ${{ number_format($totalReal,2) }} único (no duplicado). 
<a href="{{ route('comisiones.mini',$comision->id) }}" style="color:#001f3f; font-weight:bold; text-decoration:underline;">Clic aquí para ver cuanto tenía antes, cuanto gastó y cuanto le quedó disponible para la siguiente comisión - Igual que VER EXACTO del cierre mensual</a>
</div>
</div>


<!-- PASAJEROS -->
<div style="background:white; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1); border-left:6px solid #6b7280; overflow:hidden;">
<div style="background: linear-gradient(90deg, #374151, #6b7280); color:white; padding:12px 20px; display:flex; justify-content:space-between;">
<span style="font-weight:bold; font-size:14px;">👥 Pasajeros ({{ $comision->pasajeros->count() }}) - Cada uno necesita pase IDA/RETORNO fijo, factura compartida ${{ number_format($totalReal,2) }} único</span>
<a href="{{ route('comisiones.pasajeros.create',$comision->id) }}" style="background:white; color:#374151; padding:4px 12px; border-radius:4px; text-decoration:none; font-weight:bold; font-size:11px;">+ Pasajero</a>
</div>
<table style="width:100%; font-size:12px; border-collapse:collapse;">
<thead><tr style="background:#f3f4f6; color:#374151;"><th style="padding:10px; text-align:left; border-bottom:2px solid #d1d5db;">Nombre</th><th style="padding:10px;">Cédula</th><th style="padding:10px;">Cargo/Reparto</th><th style="padding:10px;">Pasaje compartido</th><th style="padding:10px;">Pases</th></tr></thead>
<tbody>
@foreach($comision->pasajeros as $p)
  @php $pasajeDeEste = $comision->pasajes->where('pasajero_id', $p->id)->first(); @endphp
  <tr style="border-bottom:1px solid #e5e7eb;">
    <td style="padding:10px; font-weight:bold;">{{ $p->nombre }}</td>
    <td style="padding:10px; font-family:monospace;">{{ $p->cedula }}</td>
    <td style="padding:10px;">{{ $p->cargo }} - {{ $p->reparto }}</td>
    <td style="padding:10px;">
      @if($pasajeDeEste)
        @if($pasajeDeEste->es_factura_principal)
          <span style="background:#dcfce7; color:#166534; padding:2px 8px; border-radius:10px; font-weight:bold;">✓ Principal ${{ $pasajeDeEste->valor }}</span>
        @else
          <span style="background:#dbeafe; color:#1e40af; padding:2px 8px; border-radius:10px;">✓ Compartida $0</span>
        @endif
        <br><span style="font-size:10px; font-family:monospace; color:#6b7280;">{{ $pasajeDeEste->numero_factura }}</span>
      @else
        <span style="background:#fee2e2; color:#991b1b; padding:2px 8px; border-radius:10px;">✗ Sin pasaje</span>
      @endif
    </td>
    <td style="padding:10px;">
      @if($pasajeDeEste)
        @if($pasajeDeEste->pase_abordo_ida && $pasajeDeEste->pase_abordo_retorno)
          <span style="background:#001f3f; color:white; padding:2px 8px; border-radius:10px; font-size:10px;">✓ IDA+RET</span>
        @else
          <span style="background:#fef3c7; color:#92400e; padding:2px 8px; border-radius:10px; font-size:10px;">Falta pases</span>
        @endif
      @else
        -
      @endif
    </td>
  </tr>
@endforeach
</tbody>
</table>
</div>

<!-- COTIZACIONES -->
<div style="background:white; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1); border-left:6px solid #d1d5db; overflow:hidden;">
<div style="background: linear-gradient(90deg, #f9fafb, #e5e7eb); color:#374151; padding:12px 20px; display:flex; justify-content:space-between; border-bottom:1px solid #d1d5db;">
<span style="font-weight:bold; font-size:14px; color:#001f3f;">💰 Cotizaciones ({{ $comision->cotizaciones->count() }}/{{ $comision->tipo=='NACIONAL'?2:3 }})</span>
<a href="{{ route('comisiones.cotizaciones.create',$comision->id) }}" style="background:#001f3f; color:white; padding:6px 14px; border-radius:6px; text-decoration:none; font-weight:bold; font-size:11px;">+ Cotización</a>
</div>
<table style="width:100%; font-size:12px; border-collapse:collapse;">
<thead><tr style="background:#f9fafb; color:#6b7280;"><th style="padding:10px; text-align:left;">Proforma</th><th style="padding:10px;">RUC</th><th style="padding:10px;">Proveedor</th><th style="padding:10px; text-align:right;">Valor</th><th style="padding:10px;">PDF</th></tr></thead>
<tbody>
@foreach($comision->cotizaciones as $c)
<tr style="border-bottom:1px solid #f3f4f6;">
<td style="padding:8px 10px; font-family:monospace; font-size:11px;">{{ $c->nro_proforma }}</td>
<td style="padding:8px 10px; font-family:monospace;">{{ $c->ruc_proveedor }}</td>
<td style="padding:8px 10px;">{{ $c->nombre_proveedor }}</td>
<td style="padding:8px 10px; text-align:right; font-weight:bold;">${{ number_format($c->valor_total,2) }}</td>
<td style="padding:8px 10px; text-align:center;">
  @if($c->archivo_proforma)
    <a href="{{ Storage::url($c->archivo_proforma) }}" target="_blank" style="background:#001f3f; color:white; padding:2px 8px; border-radius:4px; text-decoration:none; font-size:10px;">Ver</a>
  @endif
</td>
</tr>
@endforeach
</tbody>
</table>
</div>

<!-- PASAJES -->
<div style="background:white; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1); border-left:6px solid #1e40af; overflow:hidden;">
<div style="background: linear-gradient(90deg, #001f3f, #2563eb); color:white; padding:12px 20px; display:flex; justify-content:space-between;">
<span style="font-weight:bold; font-size:14px;">✈️ Pasajes / Reservas - Factura Única ${{ number_format($totalReal,2) }} compartida</span>
<a href="{{ route('comisiones.pasajes.create',$comision->id) }}" style="background:white; color:#001f3f; padding:6px 12px; border-radius:6px; text-decoration:none; font-weight:bold; font-size:11px;">+ Pasaje/Reserva</a>
</div>
@php $grupos = $comision->pasajes->groupBy('factura_grupo'); if($grupos->count()==0 || $grupos->keys()->first()==null) $grupos = $comision->pasajes->groupBy('numero_factura'); @endphp
@foreach($grupos as $grupoId => $pasajesGrupo)
@php $valorGrupo = $pasajesGrupo->where('es_factura_principal',true)->sum('valor'); if($valorGrupo==0) $valorGrupo = $pasajesGrupo->first()->valor ?? 0; @endphp
<div style="margin:12px; border:1px solid #dbeafe; border-radius:6px; overflow:hidden; background:#f8fafc;">
<div style="background: linear-gradient(90deg, #eff6ff, #dbeafe); padding:10px 14px; font-size:12px; border-bottom:1px solid #bfdbfe;">
<strong style="color:#001f3f;">Factura: {{ $pasajesGrupo->first()->numero_factura ?? '' }}</strong> - {{ $pasajesGrupo->first()->aerolinea ?? '' }} - Valor TOTAL único: ${{ number_format($valorGrupo,2) }} - Para {{ $pasajesGrupo->count() }} registro(s) / {{ $comision->pasajeros->count() }} oficial(es) juntos
</div>
<table style="width:100%; font-size:12px; border-collapse:collapse; background:white;">
<thead><tr style="background:#f1f5f9; color:#475569;"><th style="padding:8px;">Oficial</th><th style="padding:8px;">Valor</th><th style="padding:8px;">Pases</th><th style="padding:8px;">Acciones</th></tr></thead>
<tbody>
@foreach($pasajesGrupo as $pas)
<tr style="border-bottom:1px solid #f1f5f9;">
<td style="padding:8px; font-weight:bold;">{{ $pas->pasajero->nombre ?? 'ID '.$pas->pasajero_id }}</td>
<td style="padding:8px;">
  @if($pas->es_factura_principal)
    <span style="background:#001f3f; color:white; padding:3px 8px; border-radius:4px; font-weight:bold;">${{ $pas->valor }} principal</span>
  @else
    <span style="color:#2563eb;">$0 compartida (no duplica)</span>
  @endif
</td>
<td style="padding:8px; text-align:center;">
  @if($pas->pase_abordo_ida)
    <span style="background:#dcfce7; color:#166534; padding:2px 6px; border-radius:10px; font-size:10px;">✓ IDA</span>
  @endif
  @if($pas->pase_abordo_retorno)
    <span style="background:#dcfce7; color:#166534; padding:2px 6px; border-radius:10px; font-size:10px;">✓ RET</span>
  @endif
  @if(!$pas->pase_abordo_ida && !$pas->pase_abordo_retorno)
    <span style="background:#fef3c7; color:#92400e; padding:2px 6px; border-radius:10px; font-size:10px;">Falta pases</span>
  @endif
</td>
<td style="padding:8px; text-align:center;"><a href="{{ route('pasajes.pases.create',$pas->id) }}" style="background:#f59e0b; color:white; padding:4px 10px; border-radius:4px; text-decoration:none; font-weight:bold; font-size:10px;">Pases</a></td>
</tr>
@endforeach
</tbody>
</table>
</div>
@endforeach
</div>

<!-- CUADRO COMPARATIVO APROBACION - CON LOGISTICA -->
<div style="background:white; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1); border-left:6px solid {{ ($comision->cuadroComparativo && $comision->cuadroComparativo->estado=='APROBADO') ? '#16a34a' : '#f59e0b' }}; overflow:hidden;">
<div style="background: linear-gradient(90deg, {{ ($comision->cuadroComparativo && $comision->cuadroComparativo->estado=='APROBADO') ? '#065f46, #16a34a' : '#92400e, #f59e0b' }}); color:white; padding:12px 20px; display:flex; justify-content:space-between;">
<span style="font-weight:bold; font-size:14px;">
  @if($comision->cuadroComparativo && $comision->cuadroComparativo->estado=='APROBADO')
    ✅ Cuadro Comparativo APROBADO por Logística - Firma Electrónica
  @else
    ⏳ Cuadro Comparativo en BORRADOR - Pendiente Aprobación Logística
  @endif
</span>
<span style="background:white; color:{{ ($comision->cuadroComparativo && $comision->cuadroComparativo->estado=='APROBADO') ? '#065f46' : '#92400e' }}; padding:4px 12px; border-radius:12px; font-size:11px; font-weight:bold;">{{ $comision->cuadroComparativo->estado ?? 'SIN CUADRO' }}</span>
</div>
<div style="padding:16px 20px;">
@if($comision->cuadroComparativo)
  <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px; font-size:12px; margin-bottom:16px;">
    <div>
      <p><strong>Código:</strong> <span style="font-family:monospace; background:#f3f4f6; padding:2px 8px; border-radius:4px;">{{ $comision->cuadroComparativo->codigo_verificacion }}</span></p>
      <p><strong>Ganadora menor valor:</strong> <span style="background:#dcfce7; color:#166534; padding:2px 8px; border-radius:4px; font-weight:bold;">{{ $ganadora->nombre_proveedor ?? 'N/A' }} - ${{ number_format($ganadora->valor_total ?? 0,2) }}</span></p>
    </div>
    <div>
      @if($comision->cuadroComparativo->estado=='APROBADO')
        <p><strong>Aprobado por:</strong> {{ $comision->cuadroComparativo->aprobado_por }}</p>
        <p><strong>Fecha:</strong> {{ $comision->cuadroComparativo->fecha_aprobacion }}</p>
        <p><strong>Sumilla:</strong> {{ $comision->cuadroComparativo->comentario_aprobacion }}</p>
      @endif
    </div>
  </div>
  <div style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:16px;">
    <a href="{{ route('comisiones.cuadro.pdf',$comision->id) }}" target="_blank" style="background:#dc2626; color:white; padding:8px 16px; border-radius:6px; text-decoration:none; font-weight:bold; font-size:12px;">📄 VER CUADRO PDF BORRADOR</a>
    @if($comision->cuadroComparativo->archivo_aprobado_pdf)
      <a href="{{ route('comisiones.cuadro.aprobado.ver',$comision->id) }}" target="_blank" style="background:#16a34a; color:white; padding:8px 16px; border-radius:6px; text-decoration:none; font-weight:bold; font-size:12px; border:2px solid #065f46;">✅ VER CUADRO FIRMADO ELECTRONICAMENTE</a>
      <a href="{{ Storage::url($comision->cuadroComparativo->archivo_aprobado_pdf) }}" download style="background:#374151; color:white; padding:8px 16px; border-radius:6px; text-decoration:none; font-size:12px;">⬇ Descargar PDF Firmado</a>
    @endif
  </div>
  @if($comision->cuadroComparativo->estado!='APROBADO')
  <div style="padding:16px; background:#fffbeb; border:2px dashed #f59e0b; border-radius:8px;">
    <h4 style="font-weight:bold; color:#92400e; margin:0 0 12px 0; font-size:13px;">🔐 Aprobación Logística - Subir Cuadro Firmado Electrónicamente</h4>
    <p style="font-size:11px; color:#6b7280; margin-bottom:12px;">Suba el PDF con firma electrónica para aprobar por menor valor. Usuario: {{ auth()->user()->name }}</p>
    <form method="POST" action="{{ route('comisiones.cuadro.aprobar',$comision->id) }}" enctype="multipart/form-data" style="display:flex; gap:12px; align-items:end; flex-wrap:wrap;">
      @csrf
      <div>
        <label style="font-size:11px; font-weight:bold; display:block; margin-bottom:4px;">PDF Firmado Electrónicamente *</label>
        <input type="file" name="archivo_aprobado_pdf" accept="application/pdf" required style="font-size:12px; border:1px solid #d1d5db; padding:6px; border-radius:4px;">
      </div>
      <div style="flex:1; min-width:200px;">
        <label style="font-size:11px; font-weight:bold; display:block; margin-bottom:4px;">Comentario / Sumilla Aprobación</label>
        <input type="text" name="comentario_aprobacion" value="Aprobado por menor valor: {{ $ganadora->nombre_proveedor ?? '' }} ${{ $ganadora->valor_total ?? '' }} - Firma electrónica válida" style="width:100%; font-size:12px; border:1px solid #d1d5db; padding:6px; border-radius:4px;">
      </div>
      <button type="submit" style="background:#001f3f; color:#FFD700; padding:10px 20px; border-radius:6px; font-weight:bold; border:2px solid #FFD700; cursor:pointer; font-size:12px;">✅ APROBAR CUADRO - FIRMA ELECTRONICA</button>
    </form>
  </div>
  @endif
@else
  <p style="font-size:12px; color:#6b7280;">No hay cuadro. Necesita {{ $comision->tipo=='NACIONAL'?2:3 }} cotizaciones. Actual: {{ $comision->cotizaciones->count() }}</p>
  @if($comision->cotizaciones->count()>=($comision->tipo=='NACIONAL'?2:3))
    <a href="{{ route('comisiones.cuadros.create',$comision->id) }}" style="background:#f59e0b; color:white; padding:8px 16px; border-radius:6px; text-decoration:none; font-weight:bold; font-size:12px;">Generar Cuadro Borrador</a>
  @endif
@endif
</div>
</div>

<!-- LIQUIDACION - RESTAURADA CON LOGICA COMPLETA -->
<div style="background:white; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1); border-left:6px solid #001f3f; border-top:3px solid #FFD700; overflow:hidden;">
<div style="background: linear-gradient(90deg, #001f3f, #374151); color:white; padding:12px 20px;">
<span style="font-weight:bold; font-size:14px;">🧾 Liquidación - Factura compartida ${{ number_format($totalReal,2) }} único, Pases por pasajero fijos, Informe general o individual</span>
</div>
<div style="padding:16px 20px;">
@php 
$hasInformeGeneral = isset($comision->informe_path) && $comision->informe_path; 
$pasajesConInforme = $comision->pasajes->filter(function($p){ return isset($p->informe_path) && $p->informe_path; })->count();
$estadoCuadro = $comision->cuadroComparativo->estado ?? 'SIN_CUADRO';
$cuadroAprobado = $estadoCuadro=='APROBADO';
$pasesIDA = $comision->pasajes()->whereNotNull('pase_abordo_ida')->count();
$pasesRET = $comision->pasajes()->whereNotNull('pase_abordo_retorno')->count();
@endphp

<div style="background:#f9fafb; padding:12px; border-radius:6px; border:1px solid #e5e7eb; font-size:13px; margin-bottom:16px;">
Total REAL: <strong style="color:#001f3f; background:#e0f2fe; padding:2px 8px; border-radius:4px;">${{ number_format($totalReal,2) }}</strong> (no duplicado) | 
Informe: 
@if($hasInformeGeneral)
  <span style="background:#dcfce7; color:#166534; padding:2px 8px; border-radius:10px; font-weight:bold;">General ✓</span>
@else
  <span style="background:#fef3c7; color:#92400e; padding:2px 8px; border-radius:10px;">General: no - Individuales: {{ $pasajesConInforme }}/{{ $comision->pasajes->count() }}</span>
@endif
 | Pases IDA: <strong>{{ $pasesIDA }}/{{ $comision->pasajes->count() }}</strong> | RETORNO: <strong>{{ $pasesRET }}/{{ $comision->pasajes->count() }}</strong>
 | Cuadro: 
@if($cuadroAprobado)
  <span style="background:#dcfce7; color:#166534; padding:2px 8px; border-radius:10px; font-weight:bold;">APROBADO ✓</span>
@else
  <span style="background:#fee2e2; color:#991b1b; padding:2px 8px; border-radius:10px;">{{ $estadoCuadro }}</span>
@endif
</div>

<div style="display:grid; grid-template-columns: auto 1fr; gap:16px; align-items:start;">
<div style="background:#6b7280; border-radius:8px; padding:14px; min-width:280px;">
<a href="{{ route('comisiones.informe.create',$comision->id) }}" style="background:#4b5563; color:white; padding:10px 16px; border-radius:6px; text-decoration:none; font-weight:bold; font-size:13px; display:block; text-align:center; border:1px solid #9ca3af;">📄 Subir Informe GENERAL (1 para {{ $comision->pasajeros->count() }}) o INDIVIDUAL</a>
</div>

<div style="background:#fffbeb; border:1px solid #fde68a; border-radius:8px; padding:12px 14px; font-size:12px; line-height:1.6; color:#6b7280;">
Para liquidar {{ $comision->pasajeros->count() }} oficiales juntos necesita:<br>
1) {{ $comision->pasajeros->count() }}/{{ $comision->pasajes->count() }} pasajes (1 por oficial, misma factura ${{ number_format($totalReal,2) }} no duplicado)<br>
2) Cuadro {{ $cuadroAprobado ? 'APROBADO' : 'APROBADO (actual: '.$estadoCuadro.')' }} @if(!$cuadroAprobado) <span style="color:#dc2626; font-weight:bold;">❌ Pendiente aprobación Logística con firma electrónica</span> @else <span style="color:#16a34a;">✓</span> @endif<br>
3) Informe: 1 GENERAL para todos juntos O {{ $comision->pasajeros->count() }} individuales @if($hasInformeGeneral || $pasajesConInforme==$comision->pasajes->count()) ✓ @else ❌ @endif<br>
4) Pases IDA+RETORNO por cada oficial @if($pasesIDA==$comision->pasajes->count() && $pasesRET==$comision->pasajes->count()) ✓ @else ❌ Falta @endif
</div>
</div>

@php 
$puedeLiquidar = $comision->pasajes->count()>= $comision->pasajeros->count() 
  && $cuadroAprobado 
  && ($hasInformeGeneral || $pasajesConInforme==$comision->pasajes->count())
  && $pasesIDA==$comision->pasajes->count() 
  && $pasesRET==$comision->pasajes->count();
@endphp

<div style="margin-top:16px;">
@if($puedeLiquidar)
<form method="POST" action="{{ route('comisiones.liquidar',$comision->id) }}" onsubmit="return confirm('¿Liquidar {{ $comision->codigo }} por ${{ $totalReal }} único?')" style="display:inline;">
@csrf
<button type="submit" style="background:#001f3f; color:#FFD700; padding:12px 24px; border-radius:6px; font-weight:bold; border:2px solid #FFD700; cursor:pointer; font-size:14px;">✓ LIQUIDAR {{ $comision->pasajeros->count() }} OFICIALES - ${{ number_format($totalReal,2) }} ÚNICO - CUADRO APROBADO</button>
</form>
@else
<div style="background:#f3f4f6; color:#6b7280; padding:10px 16px; border-radius:6px; font-size:12px; border:1px dashed #d1d5db; display:inline-block;">
🔒 Liquidación bloqueada hasta que: @if(!$cuadroAprobado) Cuadro sea APROBADO por Logística con PDF firmado @endif
@if(!$hasInformeGeneral && $pasajesConInforme!=$comision->pasajes->count()) | Informe @endif
@if($pasesIDA!=$comision->pasajes->count() || $pasesRET!=$comision->pasajes->count()) | Pases IDA/RETORNO @endif
</div>
@endif
</div>

</div>
</div>

</div>
</div>
</x-app-layout>
