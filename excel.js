document.addEventListener("DOMContentLoaded", function () {
    // recibe los campos de la vista
    const busquedaInput = document.getElementById("actividad");
    const resultadosDatalist = document.getElementById("resultadosList");

    // se maneja el evento de cambio en el campo de actividad
    busquedaInput.addEventListener("input", function () {
        // se obtiene el valor ingresado por el usuario
        const busqueda = busquedaInput.value;

        // se le envia el parametro a buscar al metodo que realiza la busqueda y la insercion a la vista
        buscarActividades(busqueda);
    });

    // funcion para buscar actividades y llenar el datalist
    function buscarActividades(busqueda) {
        // se realiza la busqueda en el archivo excel 
        const rutaArchivoExcel = 'files/actividad.xlsx'; 
        const xhr = new XMLHttpRequest();
        xhr.open("GET", rutaArchivoExcel, true);
        xhr.responseType = "arraybuffer";

        xhr.onload = function (e) {
            const arrayBuffer = xhr.response;
            const data = new Uint8Array(arrayBuffer);
            const workbook = XLSX.read(data, { type: "array" });

            // se obtiene la primera hoja de Excel
            const primeraHoja = workbook.Sheets[workbook.SheetNames[0]];

            // se convierte la hoja de excel a un array de objetos
            const actividades = XLSX.utils.sheet_to_json(primeraHoja);

            // se limpiar el datalist para la insercion
            resultadosDatalist.innerHTML = "";

            // se itera a traves de cada registro y agrega el valor de que se obtiene de la columna NombreProducto al datalist
            for (let i = 0; i < actividades.length; i++) {
                const nombreProducto = actividades[i].NombreProducto; 
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