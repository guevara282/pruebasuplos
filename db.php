<?php


$conn = mysqli_connect(
  'localhost',
  'root',
  '',
  'php_mysql_crud'
) or die(mysqli_erro($mysqli));

// funcion para obtener el tipo de moneda
function obtenerMonedas($conn) {
  $sql = "SELECT id, tipo FROM moneda"; 
  $result = $conn->query($sql);

  $monedas = array();

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $monedas[] = $row;
      }
  }

  return $monedas;
}
//funcion para obtener las ofertas
function obtenerOfertas($conn) {
   
  $sql = "SELECT o.id, o.objeto, o.descripcion, o.actividad, o.descripcion, o.moneda, o.presupuesto, o.fechainicio, o.horainicio, o.fechacierre, e.tipo AS estado_tipo, m.tipo AS moneda_tipo FROM oferta o INNER JOIN estado e ON o.idestado = e.id INNER JOIN moneda m ON o.moneda=m.id"; 

  $result = $conn->query($sql);

  $ofertas = array();

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $ofertas[] = $row;
      }
  }

  return $ofertas;
}
//funcion para obtener los estados de las ofertas
function obtenerEstados($conn) {
  $sql = "SELECT id, tipo FROM estado"; 
  $result = $conn->query($sql);

  $estados = array();

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $estados[] = $row;
      }
  }

  return $estados;
}

?>
