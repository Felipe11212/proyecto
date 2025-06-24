<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    // Muestra productos disponibles con opción de agregar al carrito
    public function ver()
    {
        $productos = DB::table('productos')->get();
        return view('carrito', compact('productos'));
    }

    // Agrega un producto al carrito con la cantidad seleccionada
    public function agregar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|integer',
            'cantidad' => 'required|integer|min:1',
        ]);

        $producto = DB::table('productos')->where('id', $request->producto_id)->first();
        if (!$producto) {
            return back()->with('error', 'Producto no existe');
        }
        if ($producto->cantidad < $request->cantidad) {
            return back()->with('error', 'Cantidad mayor al stock disponible');
        }

        $carrito = session()->get('carrito', []);

        // Si ya existe, suma cantidades
        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad'] += $request->cantidad;
        } else {
            $carrito[$producto->id] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => $request->cantidad
            ];
        }

        session()->put('carrito', $carrito);

        return back()->with('success', 'Producto agregado al carrito');
    }

    // Actualiza cantidad de un producto del carrito
    public function actualizar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|integer',
            'cantidad' => 'required|integer|min:1'
        ]);

        $carrito = session()->get('carrito', []);
        if (isset($carrito[$request->producto_id])) {
            $carrito[$request->producto_id]['cantidad'] = $request->cantidad;
            session()->put('carrito', $carrito);
        }

        return back()->with('success', 'Cantidad actualizada');
    }

    // Quita un solo producto del carrito
    public function eliminar($id)
    {
        $carrito = session()->get('carrito', []);
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return back()->with('success', 'Producto eliminado del carrito');
    }

    // Confirma compra y descuenta cantidades del inventario
    public function confirmar()
{
    $carrito = session()->get('carrito', []);

    if (empty($carrito)) {
        return back()->with('error', 'El carrito está vacío');
    }

    DB::transaction(function () use ($carrito) {
        foreach ($carrito as $item) {
            // 1. Restar stock
            DB::table('productos')
                ->where('id', $item['id'])
                ->decrement('cantidad', $item['cantidad']);

            // 2. Registrar la venta
            DB::table('ventass')->insert([
                'producto_id' => $item['id'],
                'nombre_producto' => $item['nombre'],
                'cantidad' => $item['cantidad'],
                'total' => $item['precio'] * $item['cantidad'],
                'fecha_compra' => \Carbon\Carbon::now('America/Bogota')

            ]);
        }
    });

    session()->forget('carrito');
    return redirect()->route('carrito.ver')->with('success', 'Compra realizada con éxito');
}


    // Vacía el carrito
    public function vaciar()
    {
        session()->forget('carrito');
        return back()->with('success', 'Carrito vaciado');
    }
}
