<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = DB::table('productos')->get();
        return view('inventario', compact('productos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'caducidad' => 'required|date',
            'fabricacion' => 'required|date',
            'descripcion' => 'required|string',
        ]);

        DB::table('productos')->insert($validated);
        return redirect()->route('inventario.index');
    }

    public function edit($id)
    {
        $productoEditar = DB::table('productos')->where('id', $id)->first();
        $productos = DB::table('productos')->get();
        return view('inventario', compact('productos', 'productoEditar'));
    }

    public function update(Request $request, $id)
    {
        DB::table('productos')->where('id', $id)->update($request->only([
            'nombre', 'precio', 'cantidad', 'caducidad', 'fabricacion', 'descripcion'
        ]));

        return redirect()->route('inventario.index');
    }

    public function destroy($id)
    {
        DB::table('productos')->where('id', $id)->delete();
        return redirect()->route('inventario.index');
    }
}
