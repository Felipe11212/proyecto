function buscarProducto() {
    const input = document.getElementById("busqueda").value.toLowerCase();
    const filas = document.querySelectorAll("tbody tr");
    let coincidenciasEncontradas = false;
    let primeraCoincidencia = null;

    filas.forEach(fila => {
        const texto = fila.cells[1].textContent.toLowerCase(); // Compara con el nombre del producto
        if (texto.includes(input)) {
            fila.style.backgroundColor = "black"; // Resalta coincidencia
            if (!primeraCoincidencia) {
                primeraCoincidencia = fila; // Encuentra la primera coincidencia
            }
            coincidenciasEncontradas = true;
        } else {
            fila.style.backgroundColor = ""; // Quita el resalte si no coincide
        }
    });

    // Si no se encuentra ninguna coincidencia
    if (!coincidenciasEncontradas) {
        alert("No se encontraron productos que coincidan con la búsqueda.");
    } else {
        // Desplaza hasta la primera coincidencia si existe
        if (primeraCoincidencia) {
            primeraCoincidencia.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
}