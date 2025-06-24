<!DOCTYPE html>
<html>
<head>
    <title>Carrito de compras</title>

    <!-- Ícono en la pestaña del navegador -->
    <link rel="icon" href="{{ asset('imgs/logo amarillo.jpg') }}" type="image/x-icon">

    <!-- Estilos de Bootstrap y Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/carrito.css') }}">
</head>

<!-- Fondo del cuerpo con imagen -->
<body style="background-image: url('{{ asset('imgs/carrito.png') }}'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">

    <!-- ENCABEZADO -->
    <header class="encabezado">
        <div class="logo">
            <div class="izquierda">
                <div class="menu">
                    <!-- Botón con logo -->
                    <button class="menu-button">
                        <img src="{{ asset('imgs/logo_amarillo.png') }}" alt="Logo de la empresa" class="logo-img">
                    </button>

                    <!-- Menú lateral -->
                    <div class="dropdown">
                        <a href="welcome" class="btn7">Inicio <i class="bi bi-house"></i></a>
                        <a href="inventario" class="btn7">Bodega <i class="bi bi-box-seam"></i></a>
                        <a href="grafica">Gráficos <i class="bi bi-easel"></i></a>
                        <a href="reportes">Reportes <i class="bi bi-table"></i></a>
                        <a class="aqui btn7">Ventas <i class="bi bi-file-earmark-spreadsheet"></i></a>
                    </div>

                    <!-- Nombre de la empresa -->
                    <span class="nombre-empresa">MicroStock-Graficos</span>
                </div>
            </div>
        </div>
    </header> 
    <!-- FIN ENCABEZADO -->

    <h1 class="text-center text-light mt-4">Productos disponibles</h1>

    <!-- Mensajes de éxito o error -->
    @if(session('success'))
        <p style="color:green; text-align:center">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color:red; text-align:center">{{ session('error') }}</p>
    @endif

    <center>
    <div class="tabla-carrito mt-3">
        <table border="1" cellpadding="4" class="table table-striped table-hover bg-light">
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Cantidad a agregar</th>
            </tr>

            @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>${{ $producto->precio }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>
                        @if($producto->cantidad > 0)
                            <!-- Agregar producto al carrito -->
                            <form action="{{ route('carrito.agregar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                <input type="number" name="cantidad" min="1" max="{{ $producto->cantidad }}" value="1" class="form-control d-inline" style="width: 80px;">
                                <button class='btn2 btn btn-success btn-sm' type="submit">Agregar</button>
                            </form>
                        @else
                            <em>Agotado</em>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <hr class="text-light">
    <h2 class="text-light">Carrito actual</h2>

    <!-- Inicializa el total -->
    @php $total = 0; @endphp

    @if(session('carrito') && count(session('carrito')) > 0)
        <table border="1" cellpadding="5" class="table table-bordered table-light mt-3">
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Editar</th>
            </tr>

            @foreach(session('carrito') as $item)
                @php
                    $sub = $item['precio'] * $item['cantidad'];
                    $total += $sub;
                @endphp
                <tr>
                    <td>{{ $item['nombre'] }}</td>
                    <td>${{ $item['precio'] }}</td>
                    <td>{{ $item['cantidad'] }}</td>
                    <td>${{ $sub }}</td>
                    <td>
                        <!-- Actualizar cantidad -->
                        <form action="{{ route('carrito.actualizar') }}" method="POST" style="display:inline-block">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $item['id'] }}">
                            <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1" style="width: 50px;" class="form-control d-inline">
                            <button class="btn3 btn btn-primary btn-sm mt-1">Actualizar</button>
                        </form>

                        <!-- Quitar producto -->
                        <form action="{{ route('carrito.eliminar', $item['id']) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn4 btn btn-danger btn-sm mt-1">Quitar</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            <!-- Total -->
            <tr>
                <td colspan="3"><h3>Total</h3></td>
                <td colspan="2"><h4>${{ $total }}</h4></td>
            </tr>
        </table>

        <!-- Botones de acción -->
        <form action="{{ route('carrito.confirmar') }}" method="POST" style="display:inline">
            @csrf
            <button class="btn1 btn btn-success">Confirmar compra</button>
        </form>

        <form action="{{ route('carrito.vaciar') }}" method="POST" style="display:inline">
            @csrf
            <button class="btn1 btn btn-warning">Vaciar carrito</button>
        </form>
    @else
        <p class="text-light">No hay productos en el carrito.</p>
    @endif

    <br><br><br>
</body>
</html>

