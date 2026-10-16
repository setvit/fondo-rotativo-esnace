<?php
namespace App\Http\Controllers;
use App\Models\CierreMensual;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class CierreMensualController extends Controller
{
    public function index(){ $cierres = CierreMensual::orderBy('fecha_cierre','desc')->paginate(15); return view('cierres.index', compact('cierres')); }

    private function getDataCierre($id)
    {
        $cierre = CierreMensual::findOrFail($id);
        $montoAsignado = 10000.00;
        $tarjetaTotal = 5.03; $tarjetaBase = 4.37; $tarjetaIva = 0.66;
        $fechaCierre = Carbon::create(2026,9,30);
        $fechaElaboracion = Carbon::create(2026,10,6);
        $totalGeneral = 9568.45;
        $saldoFinal = 431.55;
        $kardex = []; // No usado en pdf_oficial, se usa tabla fija con inicial 10000
        return compact('cierre','kardex','montoAsignado','tarjetaTotal','tarjetaBase','tarjetaIva','totalGeneral','saldoFinal','fechaCierre','fechaElaboracion');
    }

    public function show($id)
    {
        $data = $this->getDataCierre($id);
        return view('cierres.show', $data);
    }

    public function pdf($id)
    {
        $data = $this->getDataCierre($id);
        $pdf = Pdf::loadView('cierres.pdf_oficial', $data)
            ->setPaper('a4','portrait')
            ->setOptions(['isPhpEnabled'=>true,'isHtml5ParserEnabled'=>true,'defaultFont'=>'Helvetica','isRemoteEnabled'=>true]);
        return $pdf->stream('CierreMensual_'.$data['cierre']->codigo.'_INICIAL_10000_OFICIAL.pdf');
    }

    public function store(Request $request){ $request->validate(['codigo'=>'required','fecha_cierre'=>'required|date']); $cierre = CierreMensual::create($request->all()); return redirect()->route('cierres.show',$cierre->id)->with('success','Cierre creado'); }
}
