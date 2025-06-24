<!DOCTYPE html>
<html>
<head>
    <title>Inventario</title>
    <!-- Ícono de la pestaña -->
    <link rel="icon" href="{{ asset('imgs/logo amarillo.jpg') }}" type="image/x-icon">
    
    <!-- Bootstrap y Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<!-- Fondo con imagen fija -->
<body style="background-image: url('{{ asset('imgs/u1.png') }}'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">

<center>

<!-- ENCABEZADO DE LA PÁGINA -->
<header class="encabezado">
    <div class="logo">
        <div class="izquierda">
            <div class="menu">
                <!-- Botón del logo -->
                <button class="menu-button">
                    <img src="{{ asset('imgs/logo_amarillo.png') }}" alt="Logo de la empresa" class="logo-img">
                </button>

                <!-- Menú de navegación -->
                <div class="dropdown">
                    <a href="welcome" class="btn7">Inicio <i class="bi bi-house"></i></a>
                    <a class="aqui btn7">Bodega <i class="bi bi-box-seam"></i></a>
                    <a href="grafica" class="btn7">Gráficos <i class="bi bi-easel"></i></a>
                    <a href="reportes" class="btn7">Reportes <i class="bi bi-table"></i></a>
                    <a href="carrito" class="btn7">Ventas <i class="bi bi-file-earmark-spreadsheet"></i></a>
                </div>

                <!-- Nombre de la empresa -->
                <span class="nombre-empresa">MicroStock-Bodega</span>
            </div>
        </div>
    </div>
</header>

<br><br>
<!-- DESCRIPCIÓN -->
<strong>
    Bienvenido al apartado Bodega de MicroStock<br>
    Aquí puedes agregar, editar, eliminar y visualizar los productos del inventario.<br>
    Lleva un control preciso del stock y mantén tu sistema actualizado en tiempo real.
</strong>

<hr><hr>
<br><br>

<!-- TÍTULO -->
<h1>INVENTARIO</h1>

<!-- FORMULARIO DE AGREGAR / EDITAR -->
<div class="contenedor">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ isset($productoEditar) ? route('inventario.update', $productoEditar->id) : route('inventario.store') }}">
        @csrf
        @if (isset($productoEditar)) @method('PUT') @endif

        <!-- Campos del formulario -->
        <input type="text" name="nombre" placeholder="Nombre" class="form-control my-2"
               value="{{ old('nombre', $productoEditar->nombre ?? '') }}" required>

        <input type="number" step="0.01" name="precio" placeholder="Precio" class="form-control my-2"
               value="{{ old('precio', $productoEditar->precio ?? '') }}" required>

        <input type="number" name="cantidad" placeholder="Cantidad" class="form-control my-2"
               value="{{ old('cantidad', $productoEditar->cantidad ?? '') }}" required>

        <input type="date" name="fabricacion" class="form-control my-2"
               value="{{ old('fabricacion', $productoEditar->fabricacion ?? '') }}" required>

        <input type="date" name="caducidad" class="form-control my-2"
               value="{{ old('caducidad', $productoEditar->caducidad ?? '') }}" required>

        <input type="text" name="descripcion" placeholder="Descripción" class="form-control my-2"
               value="{{ old('descripcion', $productoEditar->descripcion ?? '') }}" required>
</div>

        <!-- Botón -->
        <button class='btn3'>
            {{ isset($productoEditar) ? 'Actualizar' : 'Agregar' }}
        </button>
    </form>

<br><br><br><br><br><br>

<!-- BUSCADOR DE PRODUCTOS -->
<div class="buscador">
    <input type="text" id="busqueda" placeholder="Buscar producto...">
    <button class="btn3" onclick="buscarProducto()">Buscar <i class="bi bi-search"></i></button>
</div>

<br><br>

<!-- TABLA DE PRODUCTOS -->
<table class='tabla-productos'>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Fabricación</th>
            <th>Caducidad</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($productos as $producto)
        <tr>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->precio }}</td>
            <td>{{ $producto->cantidad }}</td>
            <td>{{ $producto->fabricacion }}</td>
            <td>{{ $producto->caducidad }}</td>
            <td>{{ $producto->descripcion }}</td>
            <td>
                <!-- Botón Editar -->
                <a href="{{ route('inventario.edit', $producto->id) }}" class="btn3"><i class="bi bi-pencil"></i> Editar</a>

                <!-- Botón Eliminar -->
                <form action="{{ route('inventario.destroy', $producto->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('¿Eliminar producto?')" class="btn4">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</center>

<!-- SCRIPT DE BÚSQUEDA -->
<script>
function buscarProducto() {
    const input = document.getElementById("busqueda").value.trim().toLowerCase();
    const filas = document.querySelectorAll("tbody tr");
    let coincidencia = null;

    // Limpiar fondo de todas las filas
    filas.forEach(fila => {
        fila.style.backgroundColor = "";
    });

    // Buscar coincidencia en la columna de nombre
    for (let fila of filas) {
        const nombre = fila.cells[0].textContent.trim().toLowerCase();
        if (nombre.includes(input)) {
            coincidencia = fila;
            fila.style.backgroundColor = "#000000ae"; // Resalta la fila
            break;
        }
    }

    if (!coincidencia && input !== "") {
        alert("No se encontraron productos que coincidan con la búsqueda.");
    }

    // Scroll y quitar fondo después de 3 segundos
    if (coincidencia) {
        coincidencia.scrollIntoView({ behavior: 'smooth', block: 'center' });
        setTimeout(() => {
            coincidencia.style.backgroundColor = "";
        }, 3000);
    }
}
</script>

</body>
</html>
