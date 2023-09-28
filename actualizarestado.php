<?php
require_once("db.php"); 
// verifica si se recibe el id
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $ofertaId = $_POST["id"];

    // Realiza la actualizacion del campo en la base de datos
    $sql = "UPDATE oferta SET idconfirmar = '1' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ofertaId);

    if ($stmt->execute()) {
        echo "Exito"; 
    } else {
        echo "Error"; 
    }

    $stmt->close();
    $conn->close();
}
?>