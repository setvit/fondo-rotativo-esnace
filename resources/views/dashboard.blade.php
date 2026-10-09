<x-app-layout>
<x-slot name="header">
<div class="flex justify-between items-center" style="background:#001f3f; margin:-24px; padding:24px; color:white;">
<h2 class="font-bold text-xl">ESNACE - Fondo Rotativo - Dashboard Ejecutivo</h2>
<span style="color:#FFD700; font-size:12px; font-weight:bold;">ARMADA DEL ECUADOR | COOPNA</span>
</div>
</x-slot>
<div style="padding:24px; background:#f3f4f6;">
<div style="max-width:1280px; margin:0 auto;">

<!-- 3 COLUMNAS EN ESPACIO NORMAL ARRIBA -->
<div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:16px; margin-bottom:24px;">
<div style="background: linear-gradient(135deg, #001f3f, #1e40af); color:white; padding:16px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1); border-left:4px solid #FFD700;">
<p style="font-size:10px; text-transform:uppercase; opacity:0.8; margin:0;">TOTAL COMISIONES</p><p style="font-size:28px; font-weight:bold; margin:4px 0;">6</p><p style="font-size:11px; opacity:0.7; margin:0;">2026 - Activas</p>
</div>
<div style="background: linear-gradient(135deg, #065f46, #10b981); color:white; padding:16px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
<p style="font-size:10px; text-transform:uppercase; opacity:0.8; margin:0;">LIQUIDADAS</p><p style="font-size:28px; font-weight:bold; margin:4px 0;">3</p><p style="font-size:11px; margin:0;">✓ Con pases IDA/RET</p>
</div>
<div style="background: linear-gradient(135deg, #92400e, #f59e0b); color:white; padding:16px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
<p style="font-size:10px; text-transform:uppercase; opacity:0.8; margin:0;">EN PROCESO</p><p style="font-size:28px; font-weight:bold; margin:4px 0;">3</p><p style="font-size:11px; margin:0;">CREADA + CUADRO</p>
</div>
<div style="background: linear-gradient(135deg, #4c1d95, #7c3aed); color:white; padding:16px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
<p style="font-size:10px; text-transform:uppercase; opacity:0.8; margin:0;">VALOR LIQUIDADO</p><p style="font-size:20px; font-weight:bold; margin:4px 0;">$ 2,996.94</p><p style="font-size:11px; opacity:0.8; margin:0;">No duplicado $ real</p>
</div>
<div style="background: linear-gradient(135deg, #1f2937, #6b7280); color:white; padding:16px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
<p style="font-size:10px; text-transform:uppercase; opacity:0.8; margin:0;">SALDO DISPONIBLE</p><p style="font-size:20px; font-weight:bold; margin:4px 0;">$ 431.55</p><p style="font-size:11px; opacity:0.8; margin:0;">Fondo rotativo</p>
</div>
<div style="background: linear-gradient(135deg, #7f1d1d, #ef4444); color:white; padding:16px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
<p style="font-size:10px; text-transform:uppercase; opacity:0.8; margin:0;">% EJECUCION</p><p style="font-size:28px; font-weight:bold; margin:4px 0;">95.63%</p><p style="font-size:11px; margin:0;">2026</p>
</div>
</div>

<div style="background:white; padding:20px; border-radius:8px; box-shadow:0 2px 4px rgba(0,0,0,0.1); border-top:4px solid #FFD700; margin-bottom:24px;">
<h3 style="font-weight:bold; font-size:16px; margin-bottom:12px; color:#001f3f;">Módulos del Sistema - ESNACE - Futuros módulos</h3>
<div style="display:grid; grid-template-columns: repeat(6, 1fr); gap:10px;">
<a href="{{ route('comisiones.index') }}" style="background:#001f3f; color:white; padding:12px; border-radius:8px; text-align:center; font-weight:bold; text-decoration:none; display:block;"><div style="font-size:20px;">📋</div><div style="font-size:12px; margin-top:4px;">Comisiones</div><div style="font-size:10px; opacity:0.7;">6 activas</div></a>
<a href="{{ route('comisiones.index') }}" style="background:#eff6ff; border:2px solid #3b82f6; color:#001f3f; padding:12px; border-radius:8px; text-align:center; text-decoration:none; display:block;"><div style="font-size:20px;">✈️</div><div style="font-weight:bold; font-size:12px;">Pasajes</div><div style="font-size:9px;">Factura compartida</div></a>
<a href="#" style="background:white; border:2px solid #d1d5db; padding:12px; border-radius:8px; text-align:center; text-decoration:none; display:block; color:#333;"><div style="font-size:20px;">💰</div><div style="font-weight:bold; font-size:12px;">Cotizaciones</div></a>
<a href="#" style="background:white; border:2px solid #d1d5db; padding:12px; border-radius:8px; text-align:center; text-decoration:none; display:block; color:#333;"><div style="font-size:20px;">📊</div><div style="font-weight:bold; font-size:12px;">Cuadro</div></a>
<a href="{{ route('cierres.index') }}" style="background:#f5f3ff; border:2px solid #8b5cf6; color:#4c1d95; padding:12px; border-radius:8px; text-align:center; text-decoration:none; display:block;"><div style="font-size:20px;">🧾</div><div style="font-weight:bold; font-size:12px;">Liquidaciones</div></a>
<a href="{{ route('cierres.index') }}" style="background:white; border:1px solid #ccc; padding:12px; border-radius:8px; text-align:center; text-decoration:none; display:block; color:#333;"><div style="font-size:20px;">📅</div><div style="font-weight:bold; font-size:12px;">Cierres</div></a>
</div>
</div>

<div style="background:white; padding:20px; border-radius:8px; box-shadow:0 2px 4px rgba(0,0,0,0.1); border-left:4px solid #001f3f;">
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
<h3 style="font-weight:bold; color:#001f3f;">Comisiones Actuales (6) - Total REAL $9,560.67 no duplicado</h3>
<a href="{{ route('comisiones.create') }}" style="background:#001f3f; color:white; padding:8px 16px; border-radius:6px; font-weight:bold; text-decoration:none;">+ Nueva Comisión</a>
</div>
<table style="width:100%; font-size:13px; border-collapse:collapse; border:1px solid #ddd;">
<thead><tr style="background:#001f3f; color:white;"><th style="padding:10px; text-align:left;">Código</th><th style="padding:10px; text-align:left;">Destino</th><th style="padding:10px;">Tipo</th><th style="padding:10px;">Valor REAL</th><th style="padding:10px;">Estado</th><th style="padding:10px;">Oficiales</th><th style="padding:10px;">Acción</th></tr></thead>
<tbody>
<tr style="border-bottom:1px solid #eee;"><td style="padding:10px; font-family:monospace; font-size:11px;">COM-20261008190741</td><td style="padding:10px; font-weight:bold;">GUAYAQUIL-QUITO-GUAYAQUIL</td><td style="padding:10px;"><span style="background:#3b82f6; color:white; padding:2px 8px; border-radius:10px; font-size:10px;">NACIONAL</span></td><td style="padding:10px; font-weight:bold;">$247.25</td><td style="padding:10px;"><span style="background:#f59e0b; color:white; padding:2px 8px; border-radius:10px; font-size:10px;">CUADRO_BORRADOR</span></td><td style="padding:10px;">1</td><td style="padding:10px;"><a href="#" style="background:#2563eb; color:white; padding:4px 10px; border-radius:4px; text-decoration:none; font-size:11px;">Ver</a></td></tr>
<tr style="border-bottom:1px solid #eee; background:#f0fdf4;"><td style="padding:10px; font-family:monospace; font-size:11px;">COM-20260930144832</td><td style="padding:10px; font-weight:bold;">GUAYAQUIL-QUITO-GUAYAQUIL <span style="background:#001f3f; color:white; font-size:9px; padding:1px 4px; border-radius:3px;">2 of. 1 factura</span></td><td style="padding:10px;"><span style="background:#3b82f6; color:white; padding:2px 8px; border-radius:10px; font-size:10px;">NACIONAL</span></td><td style="padding:10px; font-weight:bold; color:#16a34a;">$485.30 único</td><td style="padding:10px;"><span style="background:#16a34a; color:white; padding:2px 8px; border-radius:10px; font-size:10px;">LIQUIDADA</span></td><td style="padding:10px;">2 oficiales ✓</td><td style="padding:10px;"><a href="/comisiones/5" style="background:#2563eb; color:white; padding:4px 10px; border-radius:4px; text-decoration:none; font-size:11px;">Ver</a></td></tr>
<tr style="border-bottom:1px solid #eee;"><td style="padding:10px; font-family:monospace; font-size:11px;">COM-20260929175110</td><td style="padding:10px;">GUAYAQUIL-LIMA</td><td style="padding:10px;"><span style="background:#7c3aed; color:white; padding:2px 8px; border-radius:10px; font-size:10px;">INTERNACIONAL</span></td><td style="padding:10px; font-weight:bold;">$777.78</td><td style="padding:10px;"><span style="background:#fde047; padding:2px 8px; border-radius:10px; font-size:10px;">CREADA</span></td><td style="padding:10px;">1</td><td style="padding:10px;"><a href="#" style="background:#2563eb; color:white; padding:4px 10px; border-radius:4px; text-decoration:none; font-size:11px;">Ver</a></td></tr>
</tbody>
</table>
</div>

</div>
</div>
</x-app-layout>
