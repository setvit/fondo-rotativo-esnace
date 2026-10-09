<?php
namespace App\Http\Controllers;
use App\Models\Comision;
use App\Models\Cotizacion; // <-- ESTE ES EL QUE TE FALTA
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CotizacionController extends Controller
{
    public function create(Comision $comision)
    {
        return view('comisiones.cotizaciones.create', compact('comision'));
    }

    public function store(Request $request, Comision $comision)
    {
        $request->validate([
            'nro_proforma' => 'required|string|max:50',
            'ruc_proveedor' => 'required|string|size:13',
            'nombre_proveedor' => 'required|string|max:150',
            'tipo_proveedor' => 'required|in:AEROLINEA,AGENCIA',
            'detalle_pasajes' => 'required|string',
            'valor_total' => 'required|numeric|min:0',
            'fecha_cotizacion' => 'required|date',
            'archivo_proforma' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120'
        ]);

        $path = $request->file('archivo_proforma')->store('cotizaciones/' . $comision->id, 'public');

        $comision->cotizaciones()->create([
            'nro_proforma' => $request->nro_proforma,
            'ruc_proveedor' => $request->ruc_proveedor,
            'nombre_proveedor' => $request->nombre_proveedor,
            'tipo_proveedor' => $request->tipo_proveedor,
            'detalle_pasajes' => $request->detalle_pasajes,
            'valor_total' => $request->valor_total,
            'fecha_cotizacion' => $request->fecha_cotizacion,
            'archivo_proforma' => $path,
            'registrado_por' => Auth::id()
        ]);
        
        return redirect()->route('comisiones.show', $comision)->with('success', 'Cotización registrada');
    }



   /* public function destroy(Comision $comision, Cotizacion $cotizacion)
    {
        Storage::disk('public')->delete($cotizacion->archivo_proforma);
        $cotizacion->delete();
        return redirect()->route('comisiones.show', $comision)->with('success', 'Cotización eliminada');
    }*/

    public function destroy(Comision $comision, Cotizacion $cotizacion)
    {
    // Si existe cuadro comparativo, bórralo porque ya no tiene 3 cotizaciones válidas
        if ($comision->cuadroComparativo) 
        {
            Storage::disk('public')->delete('cuadros/' . $comision->codigo . '_cuadro_comparativo.pdf');
            $comision->cuadroComparativo()->delete();
        }
    
        // Validar que el archivo existe antes de borrarlo
        if ($cotizacion->archivo_proforma && Storage::disk('public')->exists($cotizacion->archivo_proforma)) 
        {
            Storage::disk('public')->delete($cotizacion->archivo_proforma);
        }
        $cotizacion->delete();

        return redirect()->route('comisiones.show', $comision)->with('success', 'Cotización eliminada. Carga 3 cotizaciones nuevamente para generar el cuadro.');
        $comision->load('cotizaciones');
    }
}
