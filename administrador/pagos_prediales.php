<?php 
    include_once("validar_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="images/png" href="../imagenes/stopwatch.png"/><title>Pagos prediales</title>
    <link rel="stylesheet" href="../estilos/bootstrap.css">
    <link rel="stylesheet" href="../estilos/style.css">
</head>
<body>
    <?php include_once('../includes/menu_admin.php');
    ?>
    <main class="">
    <div class="jumbotron jumbotron-fluid mt-5" style="box-shadow: 0px 0px 0px -100px #FFFFFF,0px 0px 9px -3px #000000;">
        <div class="container">
            <h3><u>Pagos prediales <span class="badge badge-primary" id="year"><?php echo date("Y");?></span></u></h3>
            <div class="card">
                <h6 class="card-header">
                    Buscar: <input type="search" class="form-control form-control-sm" id="busqueda_contribuyente" placeholder="DNI" >
                    <br>
                    <input type="button" name="button_search" onclick="impuestoPredios()" id="button_search" class="btn btn-warning" value="Buscar predios">
                </h6>
                <div class="card-body table-responsive" id="dataCont">

                </div>
            </div>
        </div>
    </div>

    </main>
</body>
    <script src="../javascript/jquery.min.js"></script>
    <script src="../javascript/popper.js"></script>
    <script src="../javascript/bootstrap.min.js"></script>
    <script src="../javascript/pagos_prediales.js"></script>
</html>