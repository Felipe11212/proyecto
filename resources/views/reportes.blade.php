<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas</title>
    
    <!-- Ícono de pestaña -->
    <link rel="icon" href="{{ asset('imgs/logo amarillo.jpg') }}" type="image/x-icon">
    
    <!-- Bootstrap y estilos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<!-- Fondo personalizado -->
<body style="background-image: url('{{ asset('imgs/image.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">

<!-- ENCABEZADO -->
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
                    <a href="inventario" class="btn7">Bodega <i class="bi bi-box-seam"></i></a>
                    <a href="grafica" class="btn7">Gráficos <i class="bi bi-easel"></i></a>
                    <a class="aqui">Reportes <i class="bi bi-table"></i></a>
                    <a href="carrito" class="btn7">Ventas <i class="bi bi-file-earmark-spreadsheet"></i></a>
                </div>

                <span class="nombre-empresa">MicroStock-Graficos</span>
            </div>
        </div>
    </div>
</header>

<!-- DESCRIPCIÓN DE LA SECCIÓN -->
<br><br>
<strong>
    Bienvenido al apartado de Reportes de MicroStock.<br>
    Aquí puedes consultar un resumen detallado de las ventas realizadas,<br>
    junto con estadísticas como los productos más vendidos.<br>
    También puedes exportar esta información en PDF para respaldos o presentaciones.
</strong>

<!-- CONTENIDO PRINCIPAL -->
<center>
    <br><br><br><br>
    <h1>Historial de Ventas</h1>

    <!-- TABLA DE VENTAS -->
    <div class="tabla-reporte">
        <table border="3" cellpadding="20">
            <thead>
                <tr>
                    <th>Fecha y Hora</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ventas as $v)
                <tr>
                    <td>{{ $v->fecha_compra }}</td>
                    <td>{{ $v->nombre_producto }}</td>
                    <td>{{ $v->cantidad }}</td>
                    <td>${{ number_format($v->total, 0) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <br><br>
    <h1>Productos Más Vendidos</h1>

    <!-- TOP 5 PRODUCTOS -->
    <div class="tabla-carrito">
        @php
        $top = $ventas->groupBy('nombre_producto')->map(function ($items) {
            return $items->sum('cantidad');
        })->sortDesc()->take(5);
        @endphp

        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Unidades Vendidas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($top as $nombre => $cantidad)
                <tr>
                    <td>{{ $nombre }}</td>
                    <td>{{ $cantidad }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- BOTÓN DE EXPORTACIÓN -->
    <br><br>
    <a class="btn4" href="{{ route('reportes.pdf') }}">📄 Descargar PDF</a>
</center>

</body>
</html>

