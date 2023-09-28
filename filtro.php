<?php
require_once("db.php");

// funcion que filtra los datos de la tabla por los criterios de busqueda
function obtenerOfertasFiltradas($conn) {
    $sql = "SELECT o.id, o.objeto, o.descripcion, o.actividad, o.presupuesto, o.fechainicio, o.fechacierre, o.idconfirmar, e.tipo AS estado_tipo FROM oferta o INNER JOIN estado e ON o.idestado = e.id";

    // Inicializa un array para almacenar las condiciones de busqueda
    $conditions = array();

    // Verifica si se enviaron datos de búsqueda para idoferta
    if (!empty($_POST['idoferta'])) {
        $conditions[] = "o.id = " . $_POST['idoferta'];
    }

    // Verifica si se enviaron datos de busqueda para objeto
    if (!empty($_POST['objeto'])) {
        $conditions[] = "o.objeto LIKE '%" . $_POST['objeto'] . "%'";
    }

    // Verifica si se envio el estado como criterio de busqueda
    if (!empty($_POST['estado']) && $_POST['estado'] !== 'todos') {
        // Si el valor del estado no es "todos", se agrega como condicion
        $conditions[] = "o.idestado = " . $_POST['estado'];
    }

    // Verifica si hay alguna condición de busqueda
    if (!empty($conditions)) {
        // Une todas las condiciones con "AND"
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    // Ejecuta la consulta
    $result = $conn->query($sql);

    $ofertas = array();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ofertas[] = $row;
        }
    }

    return $ofertas;
}

// se llama a la funcion que se acabo de crear para obtenerla en la vista
$ofertasFiltradas = obtenerOfertasFiltradas($conn);
?>