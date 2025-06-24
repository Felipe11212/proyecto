<!DOCTYPE html>
<html>
<head>
    <title>Reporte Ventas PDF</title>

    <!-- Estilo básico para las tablas del PDF -->
    <style>
        table {
            width: 100%;                      /* Ocupar todo el ancho */
            border-collapse: collapse;        /* Colapsar bordes de tabla */
        }
        th, td {
            border: 1px solid black;          /* Bordes negros */
            padding: 4px;                     /* Espaciado interno */
        }
    </style>
</head>

<body>
<!-- Encabezado del PDF con logo y datos de fecha -->
<div style="text-align: center; margin-bottom: 20px;">
    <!-- Logo de la empresa desde la carpeta public/imgs -->
    <img src="{{ public_path('imgs/logo_amarillo.png') }}" width="80" alt="Logo" style="margin-bottom: 5px;">
    
    <!-- Título de la empresa y reporte -->
    <h1 style="margin: 0;">MicroStock</h1>
    <h3 style="margin: 0;">Reporte de Ventas y Productos</h3>

    <!-- Fecha actual en zona horaria de Bogotá -->
    <p>Generado el {{ now('America/Bogota')->format('d/m/Y h:i A') }}</p>

    <hr>
</div>

<!-- Tabla: Historial de ventas -->
<center>
<h2>Reporte de Ventas</h2>
<table>
    <tr>
        <th>Fecha</th>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Total</th>
    </tr>

    <!-- Recorrer cada venta -->
    @foreach($ventas as $v)
    <tr>
        <td>{{ $v->fecha_compra }}</td>
        <td>{{ $v->nombre_producto }}</td>
        <td>{{ $v->cantidad }}</td>
        <td>{{ $v->total }}</td>
    </tr>
    @endforeach
</table>

<!-- Tabla: Detalles de productos del inventario -->
<h1 class="nombre-empresa">Estadísticas por Producto</h1>
<div class="fondot">
<table border="1" style="width:90%; background-color: white; margin: 20px auto; border-collapse: collapse;">
    <thead>
        <tr style="background-color: #f2f2f2; font-weight: bold;">
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Caducidad</th>
            <th>Días restantes</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $hoy = new DateTime(); // Obtener la fecha actual
        ?>
        @foreach ($productos as $p)
            <?php
            $fechaCaducidad = new DateTime($p->caducidad); // Fecha de caducidad del producto
            $diasRestantes = $hoy->diff($fechaCaducidad)->days; // Diferencia en días
            $estado = ''; // Variable para mostrar estado

            // Evaluar estado del producto según la caducidad
            if ($fechaCaducidad > $hoy) {
                $estado = 'Vigente';
            } elseif ($fechaCaducidad == $hoy) {
                $estado = '¡Vence hoy!';
            } else {
                $estado = 'Vencido';
                $diasRestantes *= -1; // Convertir días a negativos si ya caducó
            }
            ?>
            <!-- Mostrar fila de producto -->
            <tr>
                <td>{{ $p->nombre }}</td>
                <td>{{ $p->cantidad }}</td>
                <td>${{ number_format($p->precio, 2) }}</td>
                <td>{{ $p->caducidad }}</td>
                <td>{{ $diasRestantes }}</td>
                <td>{{ $estado }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>

<!-- Tabla: Top 5 productos más vendidos -->
<h3>Top 5 Productos más Vendidos</h3>
@php
// Agrupar ventas por producto, sumar cantidades, ordenar y tomar los 5 más vendidos
$top = $ventas->groupBy('nombre_producto')->map(function ($items) {
    return $items->sum('cantidad');
})->sortDesc()->take(5);
@endphp

<table style="width: 100%;">
    <tr>
        <th>Producto</th>
        <th>Unidades Vendidas</th>
    </tr>
    @foreach ($top as $nombre => $cantidad)
        <tr>
            <td>{{ $nombre }}</td>
            <td>{{ $cantidad }}</td>
        </tr>
    @endforeach
</table>

<!-- Pie de página del PDF con información de contacto -->
<hr>
<p style="text-align: center; font-size: 12px; color: gray;">
    Este reporte ha sido generado automáticamente por el sistema MicroStock.<br>
    Contacto: soporte@microstock.com | Tel: +57 123 456 7890
</p>

</body>
</html>

