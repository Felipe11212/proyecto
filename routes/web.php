<?php

use Illuminate\Support\Facades\Route;




// Página de inicio
//  (welcome.blade.php)
Route::get('/welcome', function () {
    return view('welcome');
})->name('inicio');



// Página de login
// (login.blade.php)
Route::get('/login', function () {
    return view('login'); // Asegúrate de tener el archivo resources/views/auth/login.blade.php
})->name('login');



// Página de ¿Quiénes somos?
// (somos.blade.php)
Route::get('/somos', function () {
    return view('somos'); // resources/views/quienes_somos.blade.php
})->name('somos');



// Página de galería
// (galeria.blade.php)
Route::get('/galeria', function () {
    return view('galeria'); // resources/views/galeria.blade.php
})->name('galeria');



//pagina del inventario
// (inventario.blade.php)


//pagina de la graficas
// (grafica.blade.php)
Route::get('/grafica', function () {
    return view('grafica');
});
Route::post('/grafica', function () {
    return view('grafica');
});

// Procesar login
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.post');

// Procesar registro
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register.post');


// ruta del invenatrio
use App\Http\Controllers\ProductoController;

Route::get('/inventario', [ProductoController::class, 'index'])->name('inventario.index');
Route::post('/inventario', [ProductoController::class, 'store'])->name('inventario.store');
Route::get('/inventario/{id}/edit', [ProductoController::class, 'edit'])->name('inventario.edit');
Route::put('/inventario/{id}', [ProductoController::class, 'update'])->name('inventario.update');
Route::delete('/inventario/{id}', [ProductoController::class, 'destroy'])->name('inventario.destroy');



// Rutas del carrito
use App\Http\Controllers\CarritoController;

Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::get('/carrito', [CarritoController::class, 'ver'])->name('carrito.ver');
Route::post('/carrito/confirmar', [CarritoController::class, 'confirmar'])->name('carrito.confirmar');
Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
Route::post('/carrito/actualizar', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');



// ruta de los reportes
use App\Http\Controllers\ReporteController;

Route::get('/reportes', [ReporteController::class,'index'])->name('reportes.index');
Route::get('/reportes/pdf', [ReporteController::class,'exportPdf'])->name('reportes.pdf');
Route::get('/reportes/excel', [ReporteController::class,'exportExcel'])->name('reportes.excel');


