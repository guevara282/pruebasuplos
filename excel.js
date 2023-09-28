document.addEventListener("DOMContentLoaded", function () {
    // se recibe los campos de la vista
    const busquedaInput = document.getElementById("actividad");
    const resultadosDatalist = document.getElementById("resultadosList");

    // se maneja el evento de cambio en el campo de busqueda
    busquedaInput.addEventListener("input", function () {
        // se obtiene el valor ingresado
        const busqueda = busquedaInput.value;

        // se llama la funcion que realiza la busqueda y el llenado
        buscarActividades(busqueda);
    });

    // funcion para buscar las actividades y llenar el datalist
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

            // se obtiene la primera hoja del excel
            const primeraHoja = workbook.Sheets[workbook.SheetNames[0]];

            // se convierte la hoja de excel a un array de objetos
            const actividades = XLSX.utils.sheet_to_json(primeraHoja);

            // se limpia el datalist para agregar los nuevos datos 
            resultadosDatalist.innerHTML = "";

            // se recorre el array y agrega el valor de NombreProducto que es donde esta la actividad y se agrega al datalist  
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
