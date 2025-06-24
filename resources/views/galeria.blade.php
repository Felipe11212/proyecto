<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- Adaptabilidad a dispositivos móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Galería</title>

    <!-- Enlace a estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/galeria.css') }}">

    <!-- Iconos de Bootstrap (usado para íconos como flechas, etc.) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Ícono en la pestaña del navegador -->
    <link rel="icon" href="{{ asset('imgs/logo azul.jpg') }}">
</head>
<body>

    <!-- Separación visual superior -->
    <br><br>

    <!-- Título principal con estilos separados por color -->
    <p class="heading">
        Galería De 
        <span style="color: rgb(121, 179, 255)">Micro</span>
        <span style="color: rgb(101, 102, 167)">Stock</span>
    </p>

    <!-- Más espacio entre título y galería -->
    <br><br><br>

    <!-- Primera fila de la galería -->
    <div class="gallery-image">
        <!-- Imagen 1 -->
        <div class="img-box">
            <img src="{{ asset('imgs/im2.jpg') }}" alt="Inicios" />
            <div class="transparent-box">
                <div class="caption">
                    <p>Inicios</p>
                    <p class="opacity-low">Organización.</p>
                </div>
            </div> 
        </div>

        <!-- Imagen 2 -->
        <div class="img-box">
            <img src="{{ asset('imgs/im1.jpg') }}" alt="Sistema" />
            <div class="transparent-box">
                <div class="caption">
                    <p>Sistema</p>
                    <p class="opacity-low">Digitalización de entorno.</p>
                </div>
            </div>
        </div>

        <!-- Imagen 3 -->
        <div class="img-box">
            <img src="{{ asset('imgs/im3.jpg') }}" alt="Estructura" />
            <div class="transparent-box">
                <div class="caption">
                    <p>Estructura</p>
                    <p class="opacity-low">Inventario visual.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Segunda fila de la galería -->
    <div class="gallery-image">
        <!-- Imagen 4 -->
        <div class="img-box">
            <img src="{{ asset('imgs/im4.jpg') }}" alt="Proyección" />
            <div class="transparent-box">
                <div class="caption">
                    <p>Proyección</p>
                    <p class="opacity-low">Futuro de la creación.</p>
                </div>
            </div> 
        </div>

        <!-- Imagen 5 -->
        <div class="img-box">
            <img src="{{ asset('imgs/im5.jpg') }}" alt="Imaginación" />
            <div class="transparent-box">
                <div class="caption">
                    <p>Imaginación</p>
                    <p class="opacity-low">Ilustración del proyecto.</p>
                </div>
            </div> 
        </div>

        <!-- Imagen 6 -->
        <div class="img-box">
            <img src="{{ asset('imgs/im6.jpg') }}" alt="Estadísticas" />
            <div class="transparent-box">
                <div class="caption">
                    <p>Estadísticas</p>
                    <p class="opacity-low">Previos porcentajes.</p>
                </div>
            </div> 
        </div>
    </div>

    <!-- Botón de regreso a la página principal -->
    <a href="{{ route('inicio') }}" class="btn-circle">Volver A Inicio</a>

    <!-- Separación antes del pie de página -->
    <br><br><br><br><br>

    <!-- Pie de página -->
    <div class="copyright text-center">
        <p>© 2025 MicroStock. Todos los derechos reservados.</p>
    </div>
</body>
</html>

