<?php include("db.php"); ?>
<?php include("filtro.php"); ?>
<?php
require_once("db.php");
// funcion que llama la funcion de db.php que genera los estados 
function generarOpcionesEstado($conn)
{
    $estado = obtenerEstados($conn);

    foreach ($estado as $estado) {
       // se llena la lista con los valores que llegaron
        echo "<option value='" . $estado['id'] . "'>" . $estado['tipo'] . "</option>";
    }
}
?>
<?php 
//metodo para generar reporte
//para generar el reporte es necesario requeir el archivo autoload.php
require 'vendor/autoload.php';
require_once("db.php");
//se deben de usar las librerias Spreadsheet y Xlsx
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// se verifica lo que llega desde el boton crear
if (isset($_POST['crear'])) {
    // se obtienen los datos del metodo generarofertas del archivo db.php
    $ofertas = obtenerOfertas($conn);

    // se crea un nuevo objeto Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // se agrega encabezados a la hoja de calculo
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Objeto');
    $sheet->setCellValue('C1', 'Actividad');
    $sheet->setCellValue('D1', 'Descripción');
    $sheet->setCellValue('E1', 'Moneda');
    $sheet->setCellValue('F1', 'Presupuesto');
    $sheet->setCellValue('G1', 'Fecha Inicio');
    $sheet->setCellValue('H1', 'Hora Inicio');
    $sheet->setCellValue('I1', 'Fecha Cierre');
    $sheet->setCellValue('J1', 'Estado');

    // Llenar la hoja de calculo con los datos 
    $row = 2; // Comenzar desde la fila 2
    foreach ($ofertas as $oferta) {
        $sheet->setCellValue('A' . $row, $oferta['id']);
        $sheet->setCellValue('B' . $row, $oferta['objeto']);
        $sheet->setCellValue('C' . $row, $oferta['actividad']);
        $sheet->setCellValue('D' . $row, $oferta['descripcion']);
        $sheet->setCellValue('E' . $row, $oferta['moneda_tipo']);
        $sheet->setCellValue('F' . $row, $oferta['presupuesto']);
        $sheet->setCellValue('G' . $row, $oferta['fechainicio']);
        $sheet->setCellValue('H' . $row, $oferta['horainicio']);
        $sheet->setCellValue('I' . $row, $oferta['fechacierre']);
        $sheet->setCellValue('J' . $row, $oferta['estado_tipo']);
        $row++;
    }

    // se configura la respuesta HTTP para descargar el archivo Excel
    $filename = 'reporte_ofertas.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    // se guarda la hoja de calculo
    $writer = new Xlsx($spreadsheet);
    ob_end_clean();
    $writer->save('php://output');
  
}
?>

<?php include('includes/header.php'); ?>

<div class="container mt-4">
    <h1>Búsqueda de Ofertas</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="idoferta" class="sr-only">ID de Oferta:</label>
                <input type="text" class="form-control" id="idoferta" name="idoferta" placeholder="ID de Oferta">
            </div>
            <div class="form-group col-md-3">
                <label for="objeto" class="sr-only">Objeto:</label>
                <input type="text" class="form-control" id="objeto" name="objeto" placeholder="Objeto">
            </div>
            <div class="form-group col-md-3">
                <label for="estado" class="sr-only">Estado:</label>
                <select class="form-control" id="estado" name="estado">
                    <option value="todos" selected>Todos</option>
                    <?php generarOpcionesEstado($conn); ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <div class="btn-group" role="group">
                    <button type="submit" class="btn btn-primary" type="button">Buscar</button>
                    <button name="crear" class="btn btn-success" style="margin-left: 5px;">Generar
                        Reporte</button>
                </div>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table id="tablaoferta" class="table table-bordered" style="margin-top: 20px;">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th class="col-sm-4">Objeto</th>
                    <th class="col-sm-4">Descripción</th>
                    <th class="col-sm-2">Fecha Inicio</th>
                    <th class="col-sm-2">Fecha Cierre</th>
                    <th class="col-sm-2">Presupuesto</th>
                    <th class="col-sm-2">Estado</th>
                    <th class="col-sm-1">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ofertasFiltradas as $oferta) : ?>
                <tr>
                    <td><?php echo $oferta['id']; ?></td>
                    <td class="col-sm-4"><?php echo $oferta['objeto']; ?></td>
                    <td class="col-sm-4"><?php echo $oferta['descripcion']; ?></td>
                    <td class="col-sm-2"><?php echo $oferta['fechainicio']; ?></td>
                    <td class="col-sm-2"><?php echo $oferta['fechacierre']; ?></td>
                    <td class="col-sm-2"><?php echo $oferta['presupuesto']; ?></td>
                    <td class="col-sm-2"><?php echo $oferta['estado_tipo']; ?></td>
                    <td class="col-sm-1">
                        <?php if ($oferta['idconfirmar'] != 1) : ?>
                        <a href="#" class="publicar-oferta" data-id="<?php echo $oferta['id']; ?>"
                            data-confirmar="<?php echo $oferta['idconfirmar']; ?>">Publicar</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
    <div class="text-center">
        <nav aria-label="Page navigation">
            <ul class="pagination">

            </ul>
        </nav>
    </div>
</div>


<?php include('includes/footer.php'); ?>
<script src="paginacion.js"></script>
<script src="publicar.js"></script>