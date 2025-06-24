<?php 
namespace App\Http\Controllers; // Define el espacio de nombres del controlador

use Illuminate\Http\Request; // Importa la clase Request para manejar peticiones HTTP
use Illuminate\Support\Facades\DB; // Importa el facade DB para trabajar con la base de datos sin Eloquent

class ProductoController extends Controller // Define la clase del controlador extendiendo el controlador base de Laravel
{
    // Método que muestra todos los productos
    public function index()
    {
        // Obtiene todos los registros de la tabla 'productos'
        $productos = DB::table('productos')->get();
        // Retorna la vista 'inventario' y le pasa los productos
        return view('inventario', compact('productos'));
    }

    // Método para almacenar un nuevo producto
    public function store(Request $request)
    {
        // Valida los datos del formulario antes de insertarlos
        $validated = $request->validate([
            'nombre' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'caducidad' => 'required|date',
            'fabricacion' => 'required|date',
            'descripcion' => 'required|string',
        ]);

        // Inserta el producto en la base de datos
        DB::table('productos')->insert($validated);
        // Redirecciona al índice del inventario
        return redirect()->route('inventario.index');
    }

    // Método que muestra el formulario de edición para un producto específico
    public function edit($id)
    {
        // Obtiene el producto con el ID proporcionado
        $productoEditar = DB::table('productos')->where('id', $id)->first();
        // Obtiene todos los productos (para mostrarlos junto al formulario)
        $productos = DB::table('productos')->get();
        // Retorna la vista con los productos y el producto a editar
        return view('inventario', compact('productos', 'productoEditar'));
    }

    // Método que actualiza un producto existente
    public function update(Request $request, $id)
    {
        // Actualiza los campos permitidos en el producto con el ID dado
        DB::table('productos')->where('id', $id)->update($request->only([
            'nombre', 'precio', 'cantidad', 'caducidad', 'fabricacion', 'descripcion'
        ]));

        // Redirecciona al índice del inventario
        return redirect()->route('inventario.index');
    }

    // Método que elimina un producto de la base de datos
    public function destroy($id)
    {
        // Elimina el producto con el ID proporcionado
        DB::table('productos')->where('id', $id)->delete();
        // Redirecciona al índice del inventario
        return redirect()->route('inventario.index');
    }
}

