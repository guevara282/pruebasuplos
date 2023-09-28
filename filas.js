let filaCounter = 2; // Comenzar desde 2 para incluir la fila por defecto

//funcion para agregar una nueva fila al formulario al darle al boton agregar
function agregarFila() {
    const tablaBody = document.getElementById('fileTableBody');
    const filas = tablaBody.querySelectorAll('tr');

    // Verificar si todas las filas tienen archivos cargados si tienen deja agregar una nueva fila, si no tienen no deja agregar una nueva fila
    let todasLasFilasTienenArchivos = true;

    filas.forEach((fila, index) => {
        const archivoInput = fila.querySelector('input[type="file"]');
        if (!archivoInput.files.length) {
            todasLasFilasTienenArchivos = false;
        }
    });
    // si todas las filas tienen archivos agrega una nueva fila
    if (todasLasFilasTienenArchivos) {
        const nuevaFila = document.createElement('tr');

        nuevaFila.innerHTML = `
            <td>${filaCounter}</td>
            <td><input type="text" class="form-control" id="titulo${filaCounter}" name="titulo${filaCounter}"  required/></td>
            <td><input type="text" class="form-control" id="contenido${filaCounter}" name="contenido${filaCounter}" /></td>
            <td>
                <input type="file" name="archivo${filaCounter}[]" />
                <button onclick="eliminarFila(this)">Eliminar</button>
            </td>
        `;
        
        tablaBody.appendChild(nuevaFila);
        filaCounter++;
    } else {
        alert('Cargue un archivo en todas las filas antes de agregar una nueva fila.');
    }
}
// funcion para eliminar fila al darle al boton eliminar
function eliminarFila(button) {
    const fila = button.parentNode.parentNode;
    fila.remove();
}