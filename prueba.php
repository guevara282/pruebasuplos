<?php
//estado de la oferta al crearse debe ser 1 para que sea activa
$estado =1;

include('db.php');
//verificar si se envian datos desde el formulario
if (isset($_POST['objeto'])) {
    // Obtener datos del formulario
    $objeto = $_POST["objeto"];
    $descripcion = $_POST["descripcion"];
    $moneda = $_POST["moneda"];
    $presupuesto = $_POST["presupuesto"];
    $actividad = $_POST["actividad"];
    $fechainicio = $_POST["fechainicio"];
    $fechacierre = $_POST["fechacierre"];
    $horainicio = $_POST["horainicio"];
    $horacierre = $_POST["horacierre"];
    
    // Crear la consulta SQL
    $query = "INSERT INTO oferta (objeto, descripcion, actividad, moneda, presupuesto, fechainicio, fechacierre, horainicio, horacierre, idestado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la consulta
    $stmt = mysqli_prepare($conn, $query);
    
    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt) {
        // Vincular los datos
        mysqli_stmt_bind_param($stmt, "sssiissssi", $objeto, $descripcion, $actividad, $moneda, $presupuesto, $fechainicio, $fechacierre, $horainicio, $horacierre, $estado);

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            //si fue exitosa obtener el id de la oferta que se creo
            $idoferta = mysqli_insert_id($conn);
         //verificar si se envian archivos
          if (!empty($_FILES['archivo1']['name'][0])) {
             //contar numero de archivos
             $i=1;
             while (true) {
                                          
              try {
                if (count($_FILES['archivo'.$i]['name'])>=1) {
                             
                                  
                    // Obtener el título y contenido de los archivos
                    $titulo = $_POST["titulo".$i];
                    $contenido = $_POST['contenido'.$i];
                   
                   // Definir la carpeta de destino del servidor
                   $carpeta_destino = "F:/xampp/htdocs/phpprueba/doctemp/";
                  
                       // Obtener el nombre y la extensión del archivo
                       $nombre_archivo = basename($_FILES["archivo".$i]["name"][0]);
                       var_dump("nombre archivo",$nombre_archivo);
                       $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));
                    
                            // Verificar si la extensión del archivo es válida
                          if (in_array($extension, array("pdf", "doc", "docx"))) {
                           // Crear la consulta SQL para la inserción
                           $query = "INSERT INTO documento (titulo, contenido, archivo, idoferta) VALUES (?, ?, ?, ?)";
      
                           // Preparar la consulta
                           $stmt = mysqli_prepare($conn, $query);
      
                           // Verificar si la preparación de la consulta fue exitosa
                           if ($stmt) {
                                // Mover el archivo a la carpeta de destino
                                 if (move_uploaded_file($_FILES["archivo".$i]["tmp_name"][0], $carpeta_destino . $nombre_archivo)) {
                                     // Vincular los datos
                                     mysqli_stmt_bind_param($stmt, "sssi", $titulo, $contenido, $nombre_archivo, $idoferta);
                                    $resultado = mysqli_stmt_execute($stmt);
                                    if ($resultado) {
                                        echo "Archivo subido correctamente.";
                                        echo "<h2>Archivo subido correctamente</h2>";
                                        $i++;
                                      } else {
                                        echo "Error al subir archivo a la base de datos.";
                                        echo "<h2>Error al subir archivo a la base de datos</h2>";
                                        break;
                                      }
                                  } else {
                                      echo "Error al mover el archivo.";
                                      echo "<h2>Error al mover el archivo</h2>";
                                      break;
                                  }
                              } else {
                                  echo "Error al preparar la consulta.";
                                  echo "<h2>Error al preparar la consulta</h2>";
                                  break;
                              }
                          } else {
                              echo "Solo se permiten archivos PDF, DOC y DOCX.";
                              echo "<h2>Solo se permiten archivos PDF, DOC y DOCX</h2>";
                              break;
                          }
      
                    }else{
                      break;
                    }
              } catch (\Throwable $th) {
                header('Location: index.php');
                break;
              }
             
             }
                                              
            } else {
                echo "No se seleccionó ningún archivo.";
            }
           
        } else {
            $_SESSION['message'] = 'Error al guardar el evento';
            $_SESSION['message_type'] = 'danger';
            header('Location: index.php');
        }

        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['message'] = 'Error al preparar la consulta';
        $_SESSION['message_type'] = 'danger';
        header('Location: index.php');
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
}
?>