<!DOCTYPE html>
<html>
<head><title>Reporte Ventas PDF</title><style>table{width:100%;border-collapse:collapse}th,td{border:1px solid black;padding:4px}</style>

</head>
<body>
<div style="text-align: center; margin-bottom: 20px;">
    <img src="{{ public_path('imgs/logo_amarillo.png') }}" width="80" alt="Logo" style="margin-bottom: 5px;">
    <h1 style="margin: 0;">MicroStock</h1>
    <h3 style="margin: 0;">Reporte de Ventas y Productos</h3>
  <p>Generado el {{ now('America/Bogota')->format('d/m/Y h:i A') }}</p>

    <hr>
</div>


</header>

    <center>
<h2>Reporte de Ventas</h2>
<table>
    <tr><th>Fecha</th><th>Producto</th><th>Cantidad</th><th>Total</th></tr>
    @foreach($ventas as $v)
    <tr>
        <td>{{ $v->fecha_compra }}</td>
        <td>{{ $v->nombre_producto }}</td>
        <td>{{ $v->cantidad }}</td>
        <td>{{ $v->total }}</td>
    </tr>
    @endforeach
</table>

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
        $hoy = new DateTime();
        ?>
        @foreach ($productos as $p)
            <?php
            $fechaCaducidad = new DateTime($p->caducidad);
            $diasRestantes = $hoy->diff($fechaCaducidad)->days;
            $estado = '';

            if ($fechaCaducidad > $hoy) {
                $estado = 'Vigente';
            } elseif ($fechaCaducidad == $hoy) {
                $estado = '¡Vence hoy!';
            } else {
                $estado = 'Vencido';
                $diasRestantes *= -1;
            }
            ?>
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

<h3>Top 5 Productos más Vendidos</h3>
@php
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
<hr>
<p style="text-align: center; font-size: 12px; color: gray;">
    Este reporte ha sido generado automáticamente por el sistema MicroStock.<br>
    Contacto: soporte@microstock.com | Tel: +57 123 456 7890
</p>

</body>
</html>
