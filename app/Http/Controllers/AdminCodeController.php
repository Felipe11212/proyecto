<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrador;

class AdminCodeController extends Controller
{
    public function mostrarFormulario()
    {
        return view('admin.codigo');
    }

    public function verificarCodigo(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string',
        ]);

        $admin = Administrador::where('codigo_secreto', $request->codigo)->first();

        if ($admin) {
            return redirect()->route('admin.dashboard')->with('success', 'Bienvenido, ' . $admin->nombre);
        } else {
            return back()->with('error', 'Código incorrecto');
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}


