
    $(document).ready(function() {
        $('#tablaoferta').DataTable({
            "paging": true, // Habilitar paginación
            "lengthChange": false, // Ocultar control de cantidad de filas por página
            "searching": false, // Ocultar caja de búsqueda
            "ordering": true, // Habilitar ordenación de columnas
            "info": true, // Mostrar información de registros
            "autoWidth": false, // Deshabilitar ajuste automático del ancho de las columnas
            "language": {
                "paginate": {
                    "previous": "Anterior", // Texto para el botón de página anterior
                    "next": "Siguiente" // Texto para el botón de página siguiente
                }
            }
        });
    });

