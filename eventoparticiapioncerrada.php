<?php include("db.php"); ?>

<?php
require_once ("db.php");
// funcion para obtener el tipo de moneda
function generarOpcionesMoneda($conn) {
    $monedas = obtenerMonedas($conn);
    foreach ($monedas as $moneda) {
        echo "<option value='" . $moneda['id'] . "'>" . $moneda['tipo'] . "</option>";
    }
}
?>

<?php include('includes/header.php'); ?>

<form action="prueba.php" method="POST" enctype="multipart/form-data">
    <div class="container mt-4">
        <ul class="nav nav-tabs" id="myTabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#info">Información Básica</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#cronograma">Cronograma</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#documentos">Documentos</a>
            </li>
        </ul>

        <div class="tab-content mt-3">
            <div class="tab-pane active" id="info">

                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Información</h2>
                            <div class="form-group">
                                <label for="objeto">Objeto:</label>
                                <input type="text" class="form-control" id="objeto" name="objeto" placeholder="Objeto"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción/Alcance:</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4"
                                    placeholder="Descripción/Alcance"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="moneda">Moneda:</label>
                                    <select class="form-control" id="moneda" name="moneda">
                                        <?php generarOpcionesMoneda($conn); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="presupuesto">Presupuesto:</label>
                                    <input type="number" class="form-control" id="presupuesto" name="presupuesto"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2>Actividad</h2>
                            <div class="form-group ">
                                <label for="actividad">Buscar Actividad:</label>
                                <input type="text" class="form-control" id="actividad" name="actividad"list="resultadosList" placeholder="Buscar Actividad"
                                    required>
                                <datalist id="resultadosList">
                                
                                </datalist>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="cronograma">
                <h2>Cronograma</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <h2>Fecha Inicio</h2>
                            <div class="form-group">
                                <label for="fechainicio">Fecha:</label>
                                <?php 
                                date_default_timezone_set('America/Bogota');
                                $fechamin = date("Y-m-d"); ?>
                                <input type="date" class="form-control" id="fechainicio" name="fechainicio"
                                    min="<?php echo $fechamin; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h2>Hora Inicio</h2>
                            <div class="form-group">
                                <label for="horainicio">Hora:</label>
                                <input type="time" class="form-control" id="horainicio" name="horainicio" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h2>Fecha Cierre</h2>
                            <div class="form-group">
                                <label for="fechacierre">Fecha:</label>
                                <?php
                                $fechamin = date("Y-m-d"); 
                               ?>
                                <input type="date" class="form-control" id="fechacierre" name="fechacierre"
                                    min="<?php echo $fechamin; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h2>Hora Cierre</h2>
                            <div class="form-group">
                                <label for="horacierre">Hora:</label>
                                <input type="time" class="form-control" id="horacierre" name="horacierre" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="fechaError" style="color: red;"></div>
            </div>

            <div class="tab-pane" id="documentos">
                <h2>Tabla de Datos</h2>
                <div class="container">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Título </th>
                                <th>Contenido</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="fileTableBody">
                            <td>1</td>
                            <td><input type="text" class="form-control" id="titulo" name="titulo1" placeholder="titulo"
                                    required /></td>
                            <td><input type="text" class="form-control" id="contenido" name="contenido1" /></td>
                            <td>
                                <input type="file" id="archivo" name="archivo1[]" />
                                <button onclick="eliminarFila(this)">Eliminar</button>
                            </td>
                        </tbody>
                    </table>
                    <button type="buton" class="btn btn-success" data-toggle="modal" onclick="agregarFila()">Agregar
                        Archivo</button>
                </div>

            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</form>
<script src="filas.js"></script>
<script src="excel.js" ></script>
<?php include('includes/footer.php'); ?>