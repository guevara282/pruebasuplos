<?php
require 'vendor/autoload.php';

if (isset($_POST['busqueda'])) {
    $busqueda = $_POST['busqueda'];

    // Ruta al archivo Excel en formato XLSX (asegúrate de que la ruta sea correcta)
    $rutaArchivoExcel = 'files/actividad.xlsx';

    // Cargar el archivo Excel
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($rutaArchivoExcel);

    // Seleccionar la hoja de Excel (por ejemplo, la primera hoja)
    $worksheet = $spreadsheet->getActiveSheet();

    // Obtener todas las filas de la columna que deseas buscar (por ejemplo, columna H)
    $columnaBusqueda = $worksheet->getColumnIterator('H')->current();

    // Inicializar un arreglo para almacenar los resultados
    $resultados = array();

    // Recorrer las celdas de la columna y buscar coincidencias
    foreach ($columnaBusqueda->getCellIterator() as $celda) {
        $valorCelda = $celda->getValue();

        // Si se encuentra una coincidencia, agregarla a los resultados
        if (stripos($valorCelda, $busqueda) !== false) {
            $resultados[] = $valorCelda;
        }
    }

    // Mostrar los resultados
    if (count($resultados) > 0) {
        echo "<ul>";
        foreach ($resultados as $resultado) {
            echo "<li>$resultado</li>";
        }
        echo "</ul>";
    } else {
        echo "No se encontraron resultados.";
    }
}
?>
