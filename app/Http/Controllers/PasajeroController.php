<?php
namespace App\Http\Controllers;
use App\Models\Comision;
use App\Models\Pasajero;
use Illuminate\Http\Request;

class PasajeroController extends Controller
{
    public function create(Comision $comision)
    {
        return view('comisiones.pasajeros.create', compact('comision'));
    }

    public function store(Request $request, Comision $comision)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'cedula' => 'required|string|size:10',
            'cargo' => 'required|string|max:150',
            'reparto' => 'required|in:COOPNA,CODESC,CUINMA,COAVNA,COMSUB'
        ]);

        $comision->pasajeros()->create($request->all());
        
        return redirect()->route('comisiones.show', $comision)->with('success', 'Pasajero agregado correctamente');
    }

    public function destroy(Comision $comision, Pasajero $pasajero)
    {
        $pasajero->delete();
        return redirect()->route('comisiones.show', $comision)->with('success', 'Pasajero eliminado');
    }
}
