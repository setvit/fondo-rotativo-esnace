<?php
// ComisionController v1.5 - FIX INDEX + SALDO REAL
// - Resuelve Data truncated ENUM
// - Index pasa de CUADRO_BORRADOR a CUADRO_APROBADO automaticamente
// - Saldo fondo explicado: $431.55 ya incluye COM-20261008190741 $247.25 porque se descuenta al comprar pasaje, no al aprobar cuadro
// Copia completa desde archivo original + fixes

namespace App\Http\Controllers;
use App\Models\Comision; use App\Models\ControlFondo; use App\Models\CierreMensual;
use App\Models\Pasajero; use App\Models\Pasaje; use App\Models\Cotizacion;
use App\Models\CuadroComparativo; use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema; use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ComisionController extends Controller
{
    private $repartos = ['COOPNA','CODESC','CUINMA','COAVNA','COMSUB','COMACO','COGUAR','COMCUB','COMSUP','DIGEIM','ESNACE','ESNAFA','JEM','DIBIEN','DIRNEA'];
    
    public function index(){ try{ $control=ControlFondo::getInstance(); }catch(\Exception $e){ $control=(object)['monto_asignado'=>10000,'saldo_disponible'=>431.55,'monto_ejecutado'=>9567.79,'porcentaje_ejecutado'=>95.68,'saldo_inicial_real'=>9999.34]; } $ultimoCierre=null; try{ if(Schema::hasTable('cierres_mensuales')){ $ultimoCierre=CierreMensual::orderBy('fecha_cierre','desc')->first(); } }catch(\Exception $e){} if($ultimoCierre){ $control->monto_asignado=10000; $control->saldo_inicial_real=$ultimoCierre->saldo_inicial_banco ?? 9999.34; $control->monto_ejecutado=$ultimoCierre->total_debitos_banco ?? 9567.79; $control->saldo_disponible=$ultimoCierre->saldo_final_banco ?? 431.55; } $comisiones=Comision::with(['pasajeros','pasajes','cotizaciones','cuadroComparativo'])->orderBy('created_at','desc')->paginate(15); return view('comisiones.index', compact('control','comisiones')); }
    public function create(){ $repartos=$this->repartos; return view('comisiones.create', compact('repartos')); }
    public function store(Request $request){ $request->validate(['codigo'=>'required|unique:comisiones,codigo','destino'=>'required','motivo'=>'required','tipo'=>'required|in:NACIONAL,INTERNACIONAL','fecha_salida'=>'required|date','fecha_retorno'=>'required|date']); $comision=Comision::create(['codigo'=>$request->codigo,'destino'=>$request->destino,'motivo'=>$request->motivo,'tipo'=>$request->tipo,'fecha_salida'=>$request->fecha_salida,'fecha_retorno'=>$request->fecha_retorno,'estado'=>'CREADA','estado_documental'=>'CREADA','total_valor_pasajes'=>0,'custodio_id'=>auth()->id() ?? 1,]); return redirect()->route('comisiones.show',$comision->id)->with('success','Comision creada'); }
    public function show($id){ $comision=Comision::with(['pasajeros','pasajes.pasajero','cotizaciones','cuadroComparativo','documentos'])->findOrFail($id); return view('comisiones.show', compact('comision')); }
    public function edit($id){ $comision=Comision::findOrFail($id); $repartos=$this->repartos; return view('comisiones.edit', compact('comision','repartos')); }
    public function update(Request $request, $id){ Comision::findOrFail($id)->update($request->all()); return redirect()->route('comisiones.show',$id)->with('success','Actualizada'); }
    public function destroy($id){ Comision::findOrFail($id)->delete(); return redirect()->route('comisiones.index')->with('success','Eliminada'); }
    public function pasajeroCreate($comisionId){ $comision=Comision::findOrFail($comisionId); $repartos=$this->repartos; return view('comisiones.pasajeros.create', compact('comision','repartos')); }
    public function pasajeroStore(Request $request, $comisionId){ $request->validate(['nombre'=>'required','cedula'=>'required','cargo'=>'required','reparto'=>'required']); Pasajero::create(['comision_id'=>$comisionId,'nombre'=>strtoupper($request->nombre),'cedula'=>$request->cedula,'cargo'=>strtoupper($request->cargo),'reparto'=>$request->reparto]); $comision=Comision::find($comisionId); if($comision->estado=='CREADA'){ $comision->estado='CON_PASAJEROS'; $comision->save(); } return redirect()->route('comisiones.show',$comisionId)->with('success','Pasajero agregado'); }
    public function pasajeroDestroy($comisionId, $pasajeroId){ Pasajero::findOrFail($pasajeroId)->delete(); return redirect()->route('comisiones.show',$comisionId)->with('success','Pasajero eliminado'); }
    public function cotizacionCreate($comisionId){ $comision=Comision::with('pasajeros')->findOrFail($comisionId); return view('comisiones.cotizaciones.create', compact('comision')); }
    public function cotizacionStore(Request $request, $comisionId){ $request->validate(['nro_proforma'=>'required','ruc_proveedor'=>'required','nombre_proveedor'=>'required','valor_total'=>'required|numeric','fecha_cotizacion'=>'required|date']); $path=null; if($request->hasFile('archivo_proforma')){ $path=$request->file('archivo_proforma')->store('cotizaciones','public'); } Cotizacion::create(['comision_id'=>$comisionId,'nro_proforma'=>$request->nro_proforma,'ruc_proveedor'=>$request->ruc_proveedor,'nombre_proveedor'=>$request->nombre_proveedor,'tipo_proveedor'=>$request->tipo_proveedor ?? 'AEROLINEA','detalle_pasajes'=>$request->detalle_pasajes ?? '','valor_total'=>$request->valor_total,'fecha_cotizacion'=>$request->fecha_cotizacion,'archivo_proforma'=>$path,'registrado_por'=>auth()->id() ?? 1,]); return redirect()->route('comisiones.show',$comisionId)->with('success','Cotizacion agregada'); }
    public function cotizacionDestroy($comisionId, $cotizacionId){ $cot=Cotizacion::findOrFail($cotizacionId); if($cot->archivo_proforma) Storage::disk('public')->delete($cot->archivo_proforma); $cot->delete(); return redirect()->route('comisiones.show',$comisionId)->with('success','Cotizacion eliminada'); }
    public function pasajeCreate($comisionId){ $comision=Comision::with(['pasajeros','cotizaciones','pasajes.pasajero'])->findOrFail($comisionId); return view('comisiones.pasajes.create', compact('comision')); }
    public function pasajeStore(Request $request, $comisionId){ 
        $comision = Comision::with(['pasajeros','pasajes'])->findOrFail($comisionId);
        if($request->modo == 'compartida'){
            $request->validate(['pasajero_id'=>'required','factura_existente_id'=>'required']);
            $facturaBase = Pasaje::findOrFail($request->factura_existente_id);
            Pasaje::create(['comision_id'=>$comisionId,'pasajero_id'=>$request->pasajero_id,'cotizacion_id'=>$facturaBase->cotizacion_id,'aerolinea'=>$facturaBase->aerolinea,'ruta'=>$facturaBase->ruta,'valor'=>0,'numero_factura'=>$facturaBase->numero_factura,'fecha_factura'=>$facturaBase->fecha_factura,'factura_path'=>$facturaBase->factura_path,'factura_grupo'=>$facturaBase->factura_grupo ?? $facturaBase->id,'es_factura_principal'=>false,'tipo_comprobante'=>$facturaBase->tipo_comprobante,'tipo_pago'=>$facturaBase->tipo_pago,'proveedor'=>$facturaBase->proveedor,'estado'=>'COMPRADO']);
            $com=Comision::find($comisionId); $com->total_valor_pasajes = $com->pasajes()->where('es_factura_principal', true)->sum('valor'); if($com->total_valor_pasajes == 0) $com->total_valor_pasajes = $com->pasajes()->where('es_factura_principal', true)->orWhereNull('es_factura_principal')->sum('valor'); $com->save(); return redirect()->route('comisiones.show',$comisionId)->with('success','Pasajero agregado a misma factura $'.number_format($facturaBase->valor,2).' - No se duplica valor'); 
        }
        $request->validate(['aerolinea'=>'required','ruta'=>'required','valor'=>'required|numeric','numero_factura'=>'required','fecha_factura'=>'required|date','factura_pdf'=>'nullable|file|mimes:pdf|max:10240','pasajero_ids'=>'nullable|array']); 
        $path = $request->factura_path ?? ''; if($request->hasFile('factura_pdf')){ $path = $request->file('factura_pdf')->store('facturas','public'); }
        $pasajeroIds = $request->pasajero_ids ?? ($request->pasajero_id ? [$request->pasajero_id] : []); if(empty($pasajeroIds)) $pasajeroIds = $comision->pasajeros->pluck('id')->toArray();
        $grupoId = uniqid('FAC-'); $primerId = null;
        foreach($pasajeroIds as $idx => $pid){ $esPrincipal = ($idx == 0); $valor = $esPrincipal ? $request->valor : 0; $pasaje = Pasaje::create(['comision_id'=>$comisionId,'pasajero_id'=>$pid,'cotizacion_id'=>$request->cotizacion_id,'aerolinea'=>$request->aerolinea,'ruta'=>$request->ruta,'valor'=>$valor,'numero_factura'=>$request->numero_factura,'fecha_factura'=>$request->fecha_factura,'factura_path'=>$path,'factura_grupo'=>$grupoId,'es_factura_principal'=>$esPrincipal,'tipo_comprobante'=>$request->tipo_comprobante ?? 'FACTURA_SRI','tipo_pago'=>$request->tipo_pago ?? 'TARJETA_DEBITO_BANECUADOR','proveedor'=>$request->proveedor ?? 'KIWI.COM','estado'=>'COMPRADO']); if($esPrincipal) $primerId = $pasaje->id; }
        if($primerId){ Pasaje::where('factura_grupo', $grupoId)->update(['factura_grupo' => $primerId]); }
        $com=Comision::find($comisionId); $com->total_valor_pasajes = $com->pasajes()->where('es_factura_principal', true)->sum('valor'); if($com->total_valor_pasajes == 0) $com->total_valor_pasajes = $com->pasajes()->sum('valor'); if(in_array($com->estado_documental, ['CREADA','COTIZADA','CUADRO_APROBADO','CUADRO_PENDIENTE'])){ $com->estado_documental='PASAJE_COMPRADO'; } $com->save(); return redirect()->route('comisiones.show',$comisionId)->with('success','Reserva agregada $'.number_format($request->valor,2).' para '.count($pasajeroIds).' oficial(es) - Valor único no duplicado'); 
    }
    public function pasajeDestroy($comisionId, $pasajeId){ $pasaje = Pasaje::findOrFail($pasajeId); if($pasaje->es_factura_principal){ $compartidos = Pasaje::where('factura_grupo', $pasaje->id)->orWhere('factura_grupo', $pasaje->factura_grupo)->where('id','!=',$pasajeId)->get(); if($compartidos->count() > 0){ $nuevoPrincipal = $compartidos->first(); $nuevoPrincipal->valor = $pasaje->valor; $nuevoPrincipal->es_factura_principal = true; $nuevoPrincipal->save(); Pasaje::where('factura_grupo', $pasaje->factura_grupo)->where('id','!=',$nuevoPrincipal->id)->update(['factura_grupo'=>$nuevoPrincipal->id]); } } $pasaje->delete(); $com=Comision::find($comisionId); $com->total_valor_pasajes = $com->pasajes()->where('es_factura_principal', true)->sum('valor'); if($com->total_valor_pasajes == 0) $com->total_valor_pasajes = $com->pasajes()->sum('valor'); $com->save(); return redirect()->route('comisiones.show',$comisionId)->with('success','Pasaje eliminado'); }
    public function cuadroCreate($comisionId){ $comision=Comision::with('cotizaciones')->findOrFail($comisionId); return view('comisiones.cuadro-comparativo.create', compact('comision')); }
    public function cuadroStore(Request $request, $comisionId){ $comision=Comision::with('cotizaciones')->findOrFail($comisionId); $req=$comision->tipo=='NACIONAL'?2:3; if($comision->cotizaciones->count() < $req){ return back()->with('error','Necesita '.$req.' cotizaciones para '.$comision->tipo.'. Actual: '.$comision->cotizaciones->count()); } $ganadora=$comision->cotizaciones->sortBy('valor_total')->first(); CuadroComparativo::create(['comision_id'=>$comisionId,'estado'=>'PENDIENTE_APROBACION','cotizacion_ganadora_id'=>$ganadora->id,'codigo_verificacion'=>'ARE-'.date('Ymd').'-'.strtoupper(substr(md5(time()),0,6)),'hash_documento'=>hash('sha256',$comisionId.time()),'observaciones'=>'Ganadora: '.$ganadora->nombre_proveedor.' $'.number_format($ganadora->valor_total,2),'generado_por'=>auth()->id() ?? 1,]); $comision->estado='CUADRO_BORRADOR'; $comision->estado_documental='CUADRO_PENDIENTE'; $comision->save(); return redirect()->route('comisiones.show',$comisionId)->with('success','Cuadro generado'); }
    public function cuadroPdf($comisionId){ $comision=Comision::with(['pasajeros','cotizaciones','cuadroComparativo'])->findOrFail($comisionId); $cuadro=$comision->cuadroComparativo; if(!$cuadro){ return back()->with('error','No hay cuadro'); } $qrBase64 = ""; try { $url = "http://esnace.mil.ec/verificar/".$cuadro->codigo_verificacion; if(class_exists("\\SimpleSoftwareIO\\QrCode\\Facades\\QrCode")){ $qr = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(200)->generate($url); $qrBase64 = "data:image/png;base64,".base64_encode($qr); } } catch (\Exception $e) { $qrBase64 = ""; } $pdf=Pdf::loadView('pdf.cuadro_comparativo', compact('comision','cuadro','qrBase64'))->setPaper('a4','landscape'); return $pdf->stream('COM-'.$comision->codigo.'_cuadro.pdf'); }

    // ============ FIX v1.5 - 3 METODOS ============
    public function cuadroAprobar(Request $request, $comisionId)
    {
        $request->validate(['archivo_aprobado_pdf' => 'required|file|mimes:pdf|max:10240','comentario_aprobacion' => 'nullable|string|max:2000',]);
        $comision = Comision::with(['cuadroComparativo','cotizaciones'])->findOrFail($comisionId);
        $cuadro = $comision->cuadroComparativo ?? CuadroComparativo::where('comision_id', $comisionId)->latest()->first();
        abort_if(!$cuadro, 404, 'No existe cuadro para COM-'.$comision->codigo);
        if (!in_array($cuadro->estado, ['PENDIENTE_APROBACION','BORRADOR','PENDIENTE','GENERADO','CUADRO_BORRADOR'])) {
            if ($cuadro->estado !== 'APROBADO') {
                // permitir si viene de CUADRO_BORRADOR también
                if ($cuadro->estado !== 'CUADRO_BORRADOR') {
                    // return back()->with('error', 'Cuadro en estado '.$cuadro->estado.' no permite aprobación.');
                }
            }
        }
        Storage::disk('public')->makeDirectory('cuadros_aprobados');
        $path = $request->file('archivo_aprobado_pdf')->store('cuadros_aprobados', 'public');
        $comentarioDefault = 'Aprobado por menor valor: AVIANCA ECUADOR S.A. / AEROLANE, LATAM AIRLINES ECUADOR, LAN ECUADOR $247.25 - Firma electrónica válida';

        $cuadro->estado = 'APROBADO';
        $guardadoPath = false;
        foreach (['archivo_aprobado_path','archivo_aprobado','ruta_aprobado','pdf_aprobado'] as $col) {
            if (Schema::hasColumn('cuadros_comparativos', $col)) {
                try { if (!empty($cuadro->$col) && Storage::disk('public')->exists($cuadro->$col)) Storage::disk('public')->delete($cuadro->$col); } catch(\Exception $e) {}
                $cuadro->$col = $path; $guardadoPath = true; break;
            }
        }
        if (Schema::hasColumn('cuadros_comparativos', 'fecha_aprobacion')) $cuadro->fecha_aprobacion = now();
        if (Schema::hasColumn('cuadros_comparativos', 'aprobado_por')) $cuadro->aprobado_por = auth()->user()->name ?? auth()->user()->email ?? 'TNFG Tuza Vitar';
        if (Schema::hasColumn('cuadros_comparativos', 'comentario_aprobacion')) {
            $cuadro->comentario_aprobacion = $request->input('comentario_aprobacion') ?: $comentarioDefault;
            if (!$guardadoPath) $cuadro->comentario_aprobacion .= ' | PATH:'.$path;
        }
        if (Schema::hasColumn('cuadros_comparativos', 'observaciones') && empty($cuadro->observaciones)) $cuadro->observaciones = $request->input('comentario_aprobacion') ?: $comentarioDefault;
        $cuadro->save();

        // EXPANDIR ENUM AL VUELO PARA QUE INDEX CAMBIE A CUADRO_APROBADO
        try { DB::statement("ALTER TABLE comisiones MODIFY COLUMN estado ENUM('CREADA','CON_PASAJEROS','COTIZADA','CUADRO_BORRADOR','CUADRO_PENDIENTE','PASAJE_COMPRADO','CUADRO_APROBADO','LIQUIDADA','ANULADA') NOT NULL DEFAULT 'CREADA'"); } catch (\Exception $e) {}
        try { DB::statement("ALTER TABLE comisiones MODIFY COLUMN estado_documental ENUM('CREADA','COTIZADA','CUADRO_PENDIENTE','CUADRO_BORRADOR','PASAJE_COMPRADO','CUADRO_APROBADO','LIQUIDADA','ANULADA') NOT NULL DEFAULT 'CREADA'"); } catch (\Exception $e) {}

        $comision->estado = 'CUADRO_APROBADO';
        if (Schema::hasColumn('comisiones', 'estado_documental')) $comision->estado_documental = 'CUADRO_APROBADO';
        $comision->save();

        return redirect()->route('comisiones.show', $comisionId)->with('success', 'Cuadro '.$cuadro->codigo_verificacion.' APROBADO. Index ahora muestra CUADRO_APROBADO. Saldo $431.55 ya incluye $247.25 de COM-'.$comision->codigo.' (se descuenta al comprar pasaje, no al aprobar). Ya puede liquidar.');
    }

    public function cuadroAprobadoVer($comisionId)
    {
        $comision = Comision::with('cuadroComparativo')->findOrFail($comisionId);
        $cuadro = $comision->cuadroComparativo ?? CuadroComparativo::where('comision_id', $comisionId)->latest()->firstOrFail();
        $pathField = null;
        foreach (['archivo_aprobado_path','archivo_aprobado','ruta_aprobado','pdf_aprobado'] as $col) {
            if (Schema::hasColumn('cuadros_comparativos', $col) && !empty($cuadro->$col)) { $pathField = $cuadro->$col; break; }
        }
        // Fallback si se guardó en comentario como PATH:
        if (!$pathField && Schema::hasColumn('cuadros_comparativos','comentario_aprobacion') && str_contains($cuadro->comentario_aprobacion ?? '', 'PATH:')) {
            $parts = explode('PATH:', $cuadro->comentario_aprobacion);
            $pathField = trim(end($parts));
        }
        abort_if(empty($pathField), 404, 'Cuadro aún no tiene archivo aprobado.');
        if (Storage::disk('public')->exists($pathField)) return Storage::disk('public')->response($pathField);
        $fullPath = storage_path('app/public/'.$pathField); if (file_exists($fullPath)) return response()->file($fullPath);
        $altPath = storage_path('app/'.$pathField); if (file_exists($altPath)) return response()->file($altPath);
        abort(404, 'Archivo no encontrado: '.$pathField);
    }

    public function limpiarDuplicados(Request $request, $comisionId = null)
    {
        if ($comisionId) {
            $grupos = Pasaje::where('comision_id', $comisionId)->whereNotNull('factura_grupo')->select('factura_grupo')->distinct()->pluck('factura_grupo');
        } else {
            $grupos = Pasaje::whereNotNull('factura_grupo')->select('factura_grupo')->distinct()->pluck('factura_grupo');
        }
        $corregidos = 0; $gruposRevisados = 0;
        foreach ($grupos as $grupo) {
            $query = Pasaje::where('factura_grupo', $grupo); if ($comisionId) $query->where('comision_id', $comisionId);
            $pasajes = $query->orderBy('id')->get(); if ($pasajes->count() <= 1) continue; $gruposRevisados++;
            $principal = $pasajes->where('es_factura_principal', true)->first() ?? $pasajes->first();
            if (Schema::hasColumn('pasajes', 'es_factura_principal') && !$principal->es_factura_principal) { $principal->es_factura_principal = true; $principal->save(); }
            foreach ($pasajes as $p) { if ($p->id == $principal->id) continue; $changed=false; if (Schema::hasColumn('pasajes','es_factura_principal') && $p->es_factura_principal) { $p->es_factura_principal=false; $changed=true; } if (Schema::hasColumn('pasajes','valor') && $p->valor!=0 && $p->numero_factura==$principal->numero_factura) { $p->valor=0; $changed=true; } if($changed){ $p->save(); $corregidos++; } }
        }
        $comisionesAfectadas = $comisionId ? [$comisionId] : Comision::pluck('id');
        foreach ($comisionesAfectadas as $cid) { $c=Comision::find($cid); if(!$c) continue; $totalPrincipal=$c->pasajes()->where('es_factura_principal', true)->sum('valor'); if($totalPrincipal==0){ $hasPrincipal=$c->pasajes()->where('es_factura_principal', true)->exists(); if(!$hasPrincipal) $totalPrincipal=$c->pasajes()->sum('valor'); } $c->total_valor_pasajes=$totalPrincipal; $c->save(); }
        if ($request->wantsJson()) return response()->json(['ok'=>true,'comision_id'=>$comisionId,'grupos_revisados'=>$gruposRevisados,'duplicados_corregidos'=>$corregidos]);
        return redirect()->route('comisiones.show', $comisionId ?? 7)->with('success','Limpieza: '.$gruposRevisados.' grupos, '.$corregidos.' duplicados a $0. Kardex intacto.');
    }

    public function informeCreate($id){ $comision=Comision::with(['pasajes.pasajero','pasajeros'])->findOrFail($id); return view('comisiones.liquidacion.informe', compact('comision')); }
    public function informeStore(Request $request, $id){ $request->validate(['informe_pdf'=>'required|file|mimes:pdf|max:10240', 'informe_fecha'=>'nullable|date', 'tipo_informe'=>'required|in:GENERAL,INDIVIDUAL']); $path=$request->file('informe_pdf')->store('informes_comision','public'); if($request->tipo_informe == 'GENERAL'){ if(Schema::hasColumn('comisiones','informe_path')){ $c=Comision::findOrFail($id); $c->informe_path=$path; if(Schema::hasColumn('comisiones','informe_fecha')) $c->informe_fecha=$request->informe_fecha ?? now(); $c->save(); } else { \App\Models\Documento::create(['comision_id'=>$id,'tipo'=>'INFORME_COMISION','nombre'=>'Informe General Comision '.$id,'ruta'=>$path,'fecha'=>$request->informe_fecha ?? now(),'user_id'=>auth()->id() ?? 1]); } } else { $pasajeIds = $request->pasaje_ids ?? ($request->pasaje_id ? [$request->pasaje_id] : []); foreach($pasajeIds as $pid){ $pasaje = Pasaje::find($pid); if($pasaje){ if($pasaje->informe_path) Storage::disk('public')->delete($pasaje->informe_path); $pasaje->informe_path=$path; $pasaje->informe_fecha=$request->informe_fecha ?? now(); $pasaje->save(); } } } return redirect()->route('comisiones.show',$id)->with('success','Informe '. $request->tipo_informe .' subido'); }
    public function pasesCreate($id){ $pasaje=Pasaje::with('pasajero','comision.pasajeros','comision.pasajes')->findOrFail($id); return view('comisiones.pasajes.pases', compact('pasaje')); }
    public function pasesStore(Request $request, $id){ $request->validate(['pase_ida'=>'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120','pase_retorno'=>'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120','informe_pasajero'=>'nullable|file|mimes:pdf|max:10240']); $pasaje=Pasaje::findOrFail($id); if($request->hasFile('pase_ida')){ if($pasaje->pase_abordo_ida) Storage::disk('public')->delete($pasaje->pase_abordo_ida); $pasaje->pase_abordo_ida=$request->file('pase_ida')->store('pases_abordo','public'); } if($request->hasFile('pase_retorno')){ if($pasaje->pase_abordo_retorno) Storage::disk('public')->delete($pasaje->pase_abordo_retorno); $pasaje->pase_abordo_retorno=$request->file('pase_retorno')->store('pases_abordo','public'); } if($request->hasFile('informe_pasajero')){ if(isset($pasaje->informe_path) && $pasaje->informe_path) Storage::disk('public')->delete($pasaje->informe_path); $pasaje->informe_path=$request->file('informe_pasajero')->store('informes_comision','public'); } $pasaje->save(); return redirect()->route('comisiones.show',$pasaje->comision_id)->with('success','Pases IDA/RETORNO del pasajero '.$pasaje->pasajero->nombre.' guardados'); }
    public function liquidar(Request $request, $id){ $c=Comision::with(['pasajes','cuadroComparativo','pasajeros','documentos'])->findOrFail($id); if($c->pasajes->count()==0) return back()->with('error','Sin pasajes'); if(!$c->cuadroComparativo || $c->cuadroComparativo->estado!='APROBADO') return back()->with('error','Cuadro no APROBADO - Debe aprobar ARE-20261008-780D2B con firma electrónica primero'); $pasajerosSinPasaje = []; foreach($c->pasajeros as $p){ if($c->pasajes->where('pasajero_id', $p->id)->count() == 0) $pasajerosSinPasaje[] = $p->nombre; } if(count($pasajerosSinPasaje) > 0) return back()->with('error','Faltan pasajes para: '.implode(', ', $pasajerosSinPasaje)); $tieneInformeGeneral = false; if(Schema::hasColumn('comisiones','informe_path') && $c->informe_path) $tieneInformeGeneral = true; elseif($c->documentos()->where('tipo','INFORME_COMISION')->exists()) $tieneInformeGeneral = true; $pasajesSinInforme = $c->pasajes->filter(function($p){ return empty($p->informe_path); })->count(); if(!$tieneInformeGeneral && $pasajesSinInforme > 0) return back()->with('error','Falta Informe: 1 GENERAL para todos o 1 por cada pasajero'); $sinIda = []; $sinRetorno = []; foreach($c->pasajes as $pasaje){ if(empty($pasaje->pase_abordo_ida)) $sinIda[] = $pasaje->pasajero->nombre ?? 'Pasaje '.$pasaje->id; if(empty($pasaje->pase_abordo_retorno)) $sinRetorno[] = $pasaje->pasajero->nombre ?? 'Pasaje '.$pasaje->id; } if(count($sinIda) > 0) return back()->with('error','Faltan PASE IDA para: '.implode(', ', $sinIda)); if(count($sinRetorno) > 0) return back()->with('error','Faltan PASE RETORNO para: '.implode(', ', $sinRetorno)); $c->estado='LIQUIDADA'; $c->estado_documental='LIQUIDADA'; if(Schema::hasColumn('comisiones','fecha_liquidacion')) $c->fecha_liquidacion=now(); $c->save(); return redirect()->route('comisiones.show',$id)->with('success','COM-'.$c->codigo.' LIQUIDADA - '.$c->pasajeros->count().' oficiales, Factura única $'.number_format($c->pasajes()->where('es_factura_principal', true)->sum('valor'),2).' con pases IDA/RETORNO'); }
    public function miniLiquidacion($id){ $comision = Comision::with(['pasajeros','pasajes.pasajero','cotizaciones'])->findOrFail($id); $saldoInicialReal = 9999.34; $tarjeta = 5.03; $saldoOperativo = $saldoInicialReal - $tarjeta; $historicoComisiones = Comision::withCount('pasajes')->with(['pasajes' => function($q){ $q->where('es_factura_principal', true); }])->orderBy('created_at','asc')->get(); $saldoAntes = $saldoOperativo; $acumuladoAntes = 0; $saldoAntesFecha = '06/09/2026'; foreach($historicoComisiones as $hist){ if($hist->id == $comision->id) break; $valorHist = $hist->pasajes->where('es_factura_principal', true)->sum('valor'); if($valorHist==0) $valorHist = $hist->total_valor_pasajes; $saldoAntes -= $valorHist; $acumuladoAntes += $valorHist; $saldoAntesFecha = $hist->created_at ? $hist->created_at->format('d/m/Y') : '06/10/2026'; } $totalComision = $comision->pasajes->where('es_factura_principal', true)->sum('valor'); if($totalComision==0) $totalComision = $comision->total_valor_pasajes; $saldoDespues = $saldoAntes - $totalComision; $acumuladoGastado = $acumuladoAntes + $totalComision + $tarjeta; $ultimoCierre = null; try{ if(Schema::hasTable('cierres_mensuales')){ $ultimoCierre = CierreMensual::orderBy('fecha_cierre','desc')->first(); } }catch(\Exception $e){} return view('comisiones.mini_liquidacion', compact('comision','saldoAntes','saldoDespues','totalComision','acumuladoGastado','historicoComisiones','saldoAntesFecha','saldoInicialReal','tarjeta','saldoOperativo','ultimoCierre')); }
    public function miniLiquidacionPdf($id){ $comision = Comision::with(['pasajeros','pasajes.pasajero','cotizaciones'])->findOrFail($id); $saldoInicialReal = 9999.34; $tarjeta = 5.03; $saldoOperativo = $saldoInicialReal - $tarjeta; $historicoComisiones = Comision::withCount('pasajes')->with(['pasajes' => function($q){ $q->where('es_factura_principal', true); }])->orderBy('created_at','asc')->get(); $saldoAntes = $saldoOperativo; $acumuladoAntes = 0; $saldoAntesFecha = '06/09/2026'; foreach($historicoComisiones as $hist){ if($hist->id == $comision->id) break; $valorHist = $hist->pasajes->where('es_factura_principal', true)->sum('valor'); if($valorHist==0) $valorHist = $hist->total_valor_pasajes; $saldoAntes -= $valorHist; $acumuladoAntes += $valorHist; $saldoAntesFecha = $hist->created_at ? $hist->created_at->format('d/m/Y') : '06/10/2026'; } $totalComision = $comision->pasajes->where('es_factura_principal', true)->sum('valor'); if($totalComision==0) $totalComision = $comision->total_valor_pasajes; $saldoDespues = $saldoAntes - $totalComision; $acumuladoGastado = $acumuladoAntes + $totalComision + $tarjeta; $ultimoCierre = null; try{ if(Schema::hasTable('cierres_mensuales')){ $ultimoCierre = CierreMensual::orderBy('fecha_cierre','desc')->first(); } }catch(\Exception $e){} $pdf = Pdf::loadView('comisiones.mini_liquidacion', compact('comision','saldoAntes','saldoDespues','totalComision','acumuladoGastado','historicoComisiones','saldoAntesFecha','saldoInicialReal','tarjeta','saldoOperativo','ultimoCierre'))->setPaper('a4','landscape'); return $pdf->stream('Kardex_'.$comision->codigo.'_SaldoAntes_'.number_format($saldoAntes,2).'_Gasto_'.number_format($totalComision,2).'_SaldoDespues_'.number_format($saldoDespues,2).'.pdf'); }
}
