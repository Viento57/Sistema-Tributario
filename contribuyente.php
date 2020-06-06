<?php 

    include_once('./includes/funciones.php');
    include_once('./includes/sql.php');

    $result = repCont2(remove_junk($_POST['DNI']));
    $result2 = repContTrim2(remove_junk($_POST['DNI']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="images/png" href="./imagenes/stopwatch.png"/><title>Pagos prediales</title>
    <link rel="stylesheet" href="./estilos/bootstrap.css">
    <link rel="stylesheet" href="./estilos/style.css">

    <link rel="stylesheet" href="./library/jquery.dataTables.min.css">
    <link rel="stylesheet" href="./library/buttons.dataTables.min.css">
</head>
<body>
<nav class="navbar bg-warning">
        <a class="navbar-brand"><h3>Bienvenido</h3></a>
        <a href="index.php" class="btn btn-primary">Volver</a>
    </nav>
    <main class="">
    <div class="jumbotron jumbotron-fluid mt-5" style="box-shadow: 0px 0px 0px -100px #FFFFFF,0px 0px 9px -3px #000000;">
        <div class="container table-responsive" id="containerTableCont">
        <h4>Historial de pagos. DNI: <?php echo $_POST['DNI'];?></h4>
        <table class="table table-striped" id="reporte">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Pago del año:</th>
                <th scope="col">Fecha de pago:</th>
                <th scope="col">Monto que se pagó:</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                foreach($db->while_loop($result) as $valor){
            ?>
            <tr>
                <th scope="row"><?php echo $valor['idPago'];?></th>
                <td><?php echo $valor['anio'];?></td>
                <td><?php echo $valor['fechaPagoImpuPred'];?></td>
                <td><?php echo $valor['montoPagoImpuPred'];?></td>
            </tr>

            <?php            
                }
            ?>              
            </tbody>
        </table>
        
        </div>
        <h3>Pagos trimestrales:</h3>
        <div class="container table-responsive" id="containerTableCont">
        <table class="table table-striped" id="reporte2">
            <thead>
                <tr>
                <th scope="col">Año:</th>
                <th scope="col">1er Pago:</th>
                <th scope="col">Fecha de pago:</th>
                <th scope="col">2do Pago:</th>
                <th scope="col">Fecha de pago:</th>
                <th scope="col">3er Pago:</th>
                <th scope="col">Fecha de pago:</th>
                <th scope="col">4to Pago:</th>
                <th scope="col">Fecha de pago:</th>
                <th scope="col">Total:</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                foreach($db->while_loop($result2) as $valor){
            ?>
            <tr>
                <td><?php echo $valor['anio'];?></td>
                <td><?php echo $valor['1pago'];?></td>
                <td><?php echo ($valor['1fecha'] !== '0000-00-00') ? $valor['1fecha'] : '----';?></td>
                <td><?php echo $valor['2pago'];?></td>
                <td><?php echo ($valor['2fecha'] !== '0000-00-00') ? $valor['2fecha'] : '----';?></td>
                <td><?php echo $valor['3pago'];?></td>
                <td><?php echo ($valor['3fecha'] !== '0000-00-00') ? $valor['3fecha'] : '----';?></td>
                <td><?php echo $valor['4pago'];?></td>
                <td><?php echo ($valor['4fecha'] !== '0000-00-00') ? $valor['4fecha'] : '----';?></td>
                <td><?php echo ($valor['1pago'] + $valor['2pago'] + $valor['3pago'] + $valor['4pago']);?></td>
            </tr>

            <?php            
                }
            ?>              
            </tbody>
        </table>
        </div>
    </div>

    </main>
</body>
    <script src="./javascript/jquery.min.js"></script>
    <script src="./library/jquery-3.3.1.js"></script>
    <script src="./library/jquery.dataTables.min.js"></script>
    <script src="./library/dataTables.buttons.min.js"></script>
    <script src="./library/buttons.flash.min.js"></script>
    <script src="./library/jszip.min.js"></script>
    <script src="./library/pdfmake.min.js"></script>
    <script src="./library/vfs_fonts.js"></script>
    <script src="./library/buttons.html5.min.js"></script>
    <script src="./library/buttons.print.min.js"></script>
    <script src="./library/configuration.js"></script>
    <script src="./javascript/popper.js"></script>
    <script src="./javascript/bootstrap.min.js"></script>
</html>



