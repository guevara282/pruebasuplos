document.addEventListener("DOMContentLoaded", function () {
    // Elementos HTML
    const busquedaInput = document.getElementById("actividad");
    const resultadosDatalist = document.getElementById("resultadosList");

    // Manejar el evento de cambio en el campo de búsqueda
    busquedaInput.addEventListener("input", function () {
        // Obtener el valor ingresado por el usuario
        const busqueda = busquedaInput.value;

        // Realizar la búsqueda y mostrar resultados en el datalist
        buscarActividades(busqueda);
    });

    // Función para buscar actividades y llenar el datalist
    function buscarActividades(busqueda) {
        // Realiza la búsqueda en el archivo Excel (reemplaza 'ruta/al/archivo.xlsx' con la ubicación de tu archivo Excel)
        const rutaArchivoExcel = 'files/actividad.xlsx'; // Cambia la ruta a tu archivo Excel
        const xhr = new XMLHttpRequest();
        xhr.open("GET", rutaArchivoExcel, true);
        xhr.responseType = "arraybuffer";

        xhr.onload = function (e) {
            const arrayBuffer = xhr.response;
            const data = new Uint8Array(arrayBuffer);
            const workbook = XLSX.read(data, { type: "array" });

            // Obtener la primera hoja de Excel
            const primeraHoja = workbook.Sheets[workbook.SheetNames[0]];

            // Convertir la hoja de Excel a un array de objetos
            const actividades = XLSX.utils.sheet_to_json(primeraHoja);

            // Limpiar el datalist
            resultadosDatalist.innerHTML = "";

            // Itera a través de cada registro y agrega el valor de 'NombreProducto' al datalist
            for (let i = 0; i < actividades.length; i++) {
                const nombreProducto = actividades[i].NombreProducto; // Reemplaza 'NombreProducto' con el nombre real de la columna
                if (nombreProducto) {
                    const opcion = document.createElement("option");
                    opcion.value = nombreProducto;
                    resultadosDatalist.appendChild(opcion);
                }
            }
        };

        xhr.send();
    }
});
