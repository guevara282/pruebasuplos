<?php include("db.php"); ?>

<?php include('includes/header.php'); ?>

<main class="container p-4">
    <div class="row">
        <div class="col-md-4">

            <div class="card card-body">

                <div class="form-group">
                    <h1>Procesos/Eventos</h1>
                    <div>
                        <input id="accederBtn" name="save_task" class="btn btn-success btn-block" value="Acceder">
                    </div>
                    <div class="card card-body" id="botonesOcultos" style="display: none;">
                        <div class="btn-group btn-group-horizontal">
                            <form action="eventoparticiapioncerrada.php" method="POST">
                                <input type="submit" name="crear" class="btn btn-success btn-block" value="Crear">
                            </form>
                            <form action="">
                                <input type="submit" name="copiar" class="btn btn-success btn-block"
                                    style="margin-left: 5px;" value="Copiar">
                            </form>
                            <form action="buscador.php">
                                <input type="submit" name="consultar" class="btn btn-success btn-block"
                                    style="margin-left: 10px;" value="Consultar">
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-8">

        </div>
    </div>
</main>
<script src="script.js"></script>
<?php include('includes/footer.php'); ?>