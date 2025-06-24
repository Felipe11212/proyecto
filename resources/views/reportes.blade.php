<!DOCTYPE html>
<html>

<head><title>Reporte de Ventas</title>
    <title>Inventario</title>
     <link rel="icon" href="{{ asset('imgs/logo amarillo.jpg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

</head>

<body style="background-image: url('{{ asset('imgs/image.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">>

<header class="encabezado">
    <div class="logo">
        <div class="izquierda">
             <div class="menu">
        <button class="menu-button">
              <img src="{{ asset('imgs/logo_amarillo.png') }}" alt="Logo de la empresa" class="logo-img">
             </button>

       <div class="dropdown">
    <a href="welcome" class="btn7">inicio <i class="bi bi-house"></i></a>
    <a href="inventario" class="btn7">Bodega <i class="bi bi-box-seam"></i></a>
    <a href="grafica">Graficos <i class="bi bi-easel"></i></i></a>
    <a class="aqui" >Reportes <i class="bi bi-table"></i></i></a>
    <a href="carrito" class="btn7">Ventas <i class="bi bi-file-earmark-spreadsheet"></i></a>
</div>


          
            <span class="nombre-empresa">MicroStock-Graficos</span>
        </div>
    </div>

</header> 
<br><br>
<strong>Bienvenido al apartado de Reportes de MicroStock.<br>
En esta sección puedes consultar un resumen detallado de las ventas realizadas, junto con estadísticas por producto como cantidad vendida y<br>
 precios.<br>
Además, puedes exportar esta información en formato PDF para respaldos, análisis o presentación de resultados.</strong>
<br><br>
 <center>
    <br><br> <br><br>
    <h1>Historial de Ventas</h1>
<div class="tabla-reporte">
<table border="3" cellpadding="20">
    <th>Fecha y hora</th><th>Producto</th><th>Cantidad</th><th>Total</th>
    @foreach($ventas as $v)
    <tr>
        <td>{{ $v->fecha_compra }}</td>
        <td>{{ $v->nombre_producto }}</td>
        <td>{{ $v->cantidad }}</td>
        <td>${{ $v->total }}</td>
    </tr>
    @endforeach
</table>
</div>


<div class="tabla-reporte">
<br>
 <h1>productos mas vendidos</h1>

<div class="tabla-carrito">

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
</div></div>

<a class="btn4" href="{{ route('reportes.pdf') }}">📄 Descargar PDF</a> 
</body>
</html>
