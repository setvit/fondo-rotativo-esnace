<?php
namespace App\Http\Controllers;
use App\Models\Comision;
use App\Models\Pasaje;
use App\Models\ControlFondo;
use Illuminate\Http\Request;

class PasajeController extends Controller {
    public function create(Comision $comision){
        $comision->load('pasajeros');
        return view('comisiones.pasajes.create', compact('comision'));
    }
    
    public function store(Request $request, Comision $comision){
        if(str_contains($request->valor, ',')){
            $request->merge(['valor' => str_replace(',', '.', $request->valor)]);
        }

        $request->validate([
            'pasajero_id' => 'required|exists:pasajeros,id',
            'aerolinea' => 'required|string',
            'ruta' => 'required|string',
            'valor' => 'required|numeric|min:0',
            'numero_factura' => 'required|string',
            'fecha_factura' => 'required|date',
            'factura_pdf' => 'required|file|mimes:pdf|max:10240'
        ]);
        
        $path = $request->file('factura_pdf')->store('facturas','public');
        
        Pasaje::create([
            'comision_id' => $comision->id,
            'pasajero_id' => $request->pasajero_id,
            'cotizacion_id' => $comision->cuadroComparativo->cotizacion_ganadora_id ?? null,
            'aerolinea' => $request->aerolinea,
            'ruta' => $request->ruta,
            'valor' => $request->valor,
            'numero_factura' => $request->numero_factura,
            'fecha_factura' => $request->fecha_factura,
            'factura_path' => $path,
            'estado' => 'COMPRADO'
        ]);
        
        if($fondo = ControlFondo::getInstance()){
            $fondo->actualizarMontos($request->valor);
        }
        
        $total = $comision->pasajes()->sum('valor');
        $comision->update([
            'estado_documental' => 'PASAJE_COMPRADO',
            'total_valor_pasajes' => $total
        ]);
        
        return redirect()->route('comisiones.show', $comision)->with('success','✈️ Pasaje de '.$request->pasajero_id.' comprado - $'.number_format($request->valor,2));
    }
}