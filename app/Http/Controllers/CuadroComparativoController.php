<?php
namespace App\Http\Controllers;

use App\Models\Comision;
use App\Models\CuadroComparativo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CuadroComparativoController extends Controller
{
    public function create($comisionId)
    {
        $comision = Comision::with(['cotizaciones','pasajeros'])->findOrFail($comisionId);
        $req = $comision->tipo=='NACIONAL'?2:3;
        if($comision->cotizaciones->count() < $req){
            return back()->with('error',"Necesita $req cotizaciones, tiene ".$comision->cotizaciones->count());
        }
        $codigo = 'CC-'.$comision->codigo.'-'.now()->format('YmdHis');
        $cuadro = CuadroComparativo::updateOrCreate(
            ['comision_id'=>$comision->id],
            ['codigo_verificacion'=>$codigo,'estado'=>'CUADRO_BORRADOR']
        );
        $comision->update(['estado'=>'CUADRO_BORRADOR']);
        return redirect()->route('comisiones.show',$comision->id)->with('success','Cuadro comparativo generado: '.$codigo);
    }

    public function pdf($comisionId)
    {
        $comision = Comision::with(['cotizaciones','pasajeros','cuadroComparativo'])->findOrFail($comisionId);
        // Genera PDF borrador - tu logica actual
        // Ejemplo simple:
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('cuadros.pdf', compact('comision'));
        return $pdf->stream('Cuadro-'.$comision->codigo.'.pdf');
    }

    public function aprobar(Request $request, $comisionId)
    {
        $comision = Comision::with(['cuadroComparativo','cotizaciones'])->findOrFail($comisionId);
        $cuadro = $comision->cuadroComparativo;
        if(!$cuadro){
            return back()->with('error','No hay cuadro comparativo generado');
        }

        $request->validate([
            'archivo_aprobado_pdf' => 'required|mimes:pdf|max:10240',
            'comentario_aprobacion' => 'nullable|string|max:500',
        ]);

        $path = $request->file('archivo_aprobado_pdf')->store('cuadros_aprobados','public');
        $ganadora = $comision->cotizaciones->sortBy('valor_total')->first();

        $cuadro->update([
            'estado' => 'APROBADO',
            'archivo_aprobado_pdf' => $path,
            'aprobado_por' => auth()->user()->name ?? 'LOGISTICA',
            'usuario_aprobacion_id' => auth()->id(),
            'fecha_aprobacion' => now(),
            'comentario_aprobacion' => $request->comentario_aprobacion ?? 'Aprobado por menor valor: '.($ganadora->nombre_proveedor??'').' $'.($ganadora->valor_total??''),
        ]);

        if($comision->estado == 'CUADRO_BORRADOR'){
            $comision->update(['estado' => 'CUADRO_APROBADO']);
        }

        return back()->with('success','✅ Cuadro APROBADO con firma electrónica - Ganador: '.($ganadora->nombre_proveedor??'').' por $'.($ganadora->valor_total??''));
    }

    public function verAprobado($comisionId)
    {
        $cuadro = CuadroComparativo::where('comision_id',$comisionId)->firstOrFail();
        if(!$cuadro->archivo_aprobado_pdf || !Storage::disk('public')->exists($cuadro->archivo_aprobado_pdf)){
            abort(404,'No hay PDF aprobado con firma electrónica');
        }
        return Storage::disk('public')->response($cuadro->archivo_aprobado_pdf);
    }
}
