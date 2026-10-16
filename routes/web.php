<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ComisionController;
use App\Http\Controllers\CierreMensualController;

Route::get('/', function () { return view('welcome'); });

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/comisiones', [ComisionController::class, 'index'])->name('comisiones.index');
    Route::get('/comisiones/create', [ComisionController::class, 'create'])->name('comisiones.create');
    Route::post('/comisiones', [ComisionController::class, 'store'])->name('comisiones.store');
    Route::get('/comisiones/{id}', [ComisionController::class, 'show'])->name('comisiones.show');
    Route::get('/comisiones/{id}/edit', [ComisionController::class, 'edit'])->name('comisiones.edit');
    Route::put('/comisiones/{id}', [ComisionController::class, 'update'])->name('comisiones.update');
    Route::delete('/comisiones/{id}', [ComisionController::class, 'destroy'])->name('comisiones.destroy');
    Route::get('/comisiones/{comision}/pasajeros/create', [ComisionController::class, 'pasajeroCreate'])->name('comisiones.pasajeros.create');
    Route::post('/comisiones/{comision}/pasajeros', [ComisionController::class, 'pasajeroStore'])->name('comisiones.pasajeros.store');
    Route::delete('/comisiones/{comision}/pasajeros/{pasajero}', [ComisionController::class, 'pasajeroDestroy'])->name('comisiones.pasajeros.destroy');
    Route::get('/comisiones/{comision}/pasajes/create', [ComisionController::class, 'pasajeCreate'])->name('comisiones.pasajes.create');
    Route::post('/comisiones/{comision}/pasajes', [ComisionController::class, 'pasajeStore'])->name('comisiones.pasajes.store');
    Route::delete('/comisiones/{comision}/pasajes/{pasaje}', [ComisionController::class, 'pasajeDestroy'])->name('comisiones.pasajes.destroy');
    Route::post('/comisiones/{comision}/pasajes/limpiar', [ComisionController::class, 'limpiarDuplicados'])->name('comisiones.pasajes.limpiar');
    Route::get('/comisiones/{comision}/cotizaciones/create', [ComisionController::class, 'cotizacionCreate'])->name('comisiones.cotizaciones.create');
    Route::post('/comisiones/{comision}/cotizaciones', [ComisionController::class, 'cotizacionStore'])->name('comisiones.cotizaciones.store');
    Route::delete('/comisiones/{comision}/cotizaciones/{cotizacion}', [ComisionController::class, 'cotizacionDestroy'])->name('comisiones.cotizaciones.destroy');
    Route::get('/comisiones/{comision}/cuadros/create', [ComisionController::class, 'cuadroCreate'])->name('comisiones.cuadros.create');
    Route::post('/comisiones/{comision}/cuadros', [ComisionController::class, 'cuadroStore'])->name('comisiones.cuadros.store');
    Route::get('/comisiones/{comision}/cuadro/pdf', [ComisionController::class, 'cuadroPdf'])->name('comisiones.cuadro.pdf');
    Route::post('/comisiones/{comision}/cuadro/aprobar', [ComisionController::class, 'cuadroAprobar'])->name('comisiones.cuadro.aprobar');
    Route::get('/comisiones/{comision}/cuadro/aprobado/ver', [ComisionController::class, 'cuadroAprobadoVer'])->name('comisiones.cuadro.aprobado.ver');
    Route::get('/comisiones/{id}/informe', [ComisionController::class, 'informeCreate'])->name('comisiones.informe.create');
    Route::post('/comisiones/{id}/informe', [ComisionController::class, 'informeStore'])->name('comisiones.informe.store');
    Route::get('/pasajes/{id}/pases', [ComisionController::class, 'pasesCreate'])->name('pasajes.pases.create');
    Route::post('/pasajes/{id}/pases', [ComisionController::class, 'pasesStore'])->name('pasajes.pases.store');
    Route::post('/comisiones/{id}/liquidar', [ComisionController::class, 'liquidar'])->name('comisiones.liquidar');
    Route::get('/comisiones/{id}/mini-liquidacion', [ComisionController::class, 'miniLiquidacion'])->name('comisiones.mini');
    Route::get('/comisiones/{id}/mini-liquidacion/pdf', [ComisionController::class, 'miniLiquidacionPdf'])->name('comisiones.mini.pdf');
    Route::get('/cierres-mensuales', [CierreMensualController::class, 'index'])->name('cierres.index');
    Route::post('/cierres-mensuales', [CierreMensualController::class, 'store'])->name('cierres.store');
    Route::get('/cierres-mensuales/{id}', [CierreMensualController::class, 'show'])->name('cierres.show');
    Route::get('/cierres-mensuales/{id}/pdf', [CierreMensualController::class, 'pdf'])->name('cierres.pdf');
});

require __DIR__.'/auth.php';
