<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\VentasExport;
use Maatwebsite\Excel\Facades\Excel;

class ReporteController extends Controller
{
    // Mostrar el reporte de ventas
    public function index()
    {
        $ventas = DB::table('ventass')->orderBy('fecha_compra', 'desc')->get();
        return view('reportes', compact('ventas'));
    
    }

    // Exportar a PDF
    public function exportPdf()
    {
        $ventas = DB::table('ventass')->orderBy('fecha_compra', 'desc')->get();
        $productos = DB::table('productos')->get(); 
        $pdf = Pdf::loadView('reportes_pdf', compact('ventas' , 'productos'));
        return $pdf->download('reporte_ventas.pdf');
    }


}
