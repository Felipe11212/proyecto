<!DOCTYPE html>
<html>
<head>
    <title>Carrito de compras</title>
       <link rel="icon" href="{{ asset('imgs/logo amarillo.jpg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  
<link rel="stylesheet" href="{{ asset('css/carrito.css') }}">

</head>
<body style="background-image: url('{{ asset('imgs/carrito.png') }}'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">>
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
    <a href="reportes" >Reportes <i class="bi bi-table"></i></i></a>
    <a class="aqui" class="btn7">Ventas <i class="bi bi-file-earmark-spreadsheet"></i></a>
</div>


          
            <span class="nombre-empresa">MicroStock-Graficos</span>
        </div>
    </div>

</header> 

    <h1>Productos disponibles</h1>

@if(session('success'))<p style="color:green">{{ session('success') }}</p>@endif
@if(session('error'))<p style="color:red">{{ session('error') }}</p>@endif
<center>
<div class="tabla-carrito">
<table border="1" cellpadding="4">
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
                    <form action="{{ route('carrito.agregar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                        <input type="number" name="cantidad" min="1" max="{{ $producto->cantidad }}" value="1">
                        <button class='btn2'type="submit">Agregar</button>
                    </form>
                @else
                    <em>Agotado</em>
                @endif
            </td>
        </tr>
    @endforeach
</table>
</div>
<hr>
<h2>Carrito actual</h2>

@php $total = 0; @endphp
@if(session('carrito') && count(session('carrito')) > 0)

    <table border="1" cellpadding="5">
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
                    {{-- Actualizar cantidad --}}
                    <form action="{{ route('carrito.actualizar') }}" method="POST" style="display:inline">
                        @csrf
                        <input type="hidden" name="producto_id" value="{{ $item['id'] }}">
                        <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1" style="width: 50px;">
                        <button class="btn3" >Actualizar</button>
                    </form>

                    {{-- Eliminar producto --}}
                    <form action="{{ route('carrito.eliminar', $item['id']) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn4">Quitar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        <tr><br><br>
            <td colspan="3"><h3>Total</h3></td>
            <td colspan="2"><h4>${{ $total }}</h4></td>
        </tr>
    </table>

    <br>
    {{-- Confirmar compra --}}
    <form action="{{ route('carrito.confirmar') }}" method="POST" style="display:inline">
        @csrf
        <button class="btn1" type="submit">Confirmar compra</button>
    </form>

    {{-- Vaciar carrito --}}
    <form action="{{ route('carrito.vaciar') }}" method="POST" style="display:inline">
        @csrf
        <button class="btn1" type="submit">Vaciar carrito</button>
    </form>
@else
    <p>No hay productos en el carrito.</p>
@endif

<br><br><br>
</body>
</html>
