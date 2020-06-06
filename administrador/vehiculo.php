<?php
    include_once('../includes/funciones.php');
    include_once('../includes/sql.php');

?>
<?php 
    include_once("validar_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="images/png" href="imagenes/stopwatch.png"/><title>Sistema tributario predial</title>
    <link rel="stylesheet" href="../estilos/bootstrap.css">
    <link rel="stylesheet" href="../estilos/style.css">
    <link rel="stylesheet" href="../estilos/style_load.css">
</head>
<body>
    <div class="loader-contain" id="loader">
        <div class="loader"></div>
    </div>

    <?php include_once('../includes/menu_admin.php');
        session_start();
    ?>
    <main class="">
        <div class="jumbotron jumbotron-fluid mt-4">
            <h3>Usuario:
                <?php echo $_SESSION['nombAdmi'];?>
            </h3>
            <hr>
            <button class="btn btn-outline-primary m-4" class="btn btn-primary" data-toggle="modal" data-target="#addCont">Añadir vehículo +</button>
            <div class="container table-responsive" id="containerTableCont">
                
            </div>
            <div id="error">
            </div>
            
        </div>
    </main>
    <!-- Modal añadir cont-->
<div class="modal fade" id="addCont" tabindex="-1" role="dialog" aria-labelledby="contModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ContModalLabel">Añadir un vehículo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group form-row">
            <input id="findCont" type="search" name="nombCont" id="nombCont" class="form-control form-control-sm" placeholder="Ingrese el nombre, apellidos o razón social del contribuyente.">
            <div id="container_data_cont" class="table-responsive">
            </div>
        </div>
        <div class="form-group form-row">
            <div class="form-col col-6">
                <label for="nombCont">Propietario:</label>
                <input type="text" name="nombCont" id="nombCont_" class="form-control form-control-sm" disabled>
            </div>
            <div class="form-col col-6">
                <label for="nombCont">Código de propietario:</label>
                <input type="text" name="nombCont" id="idCont_" class="form-control form-control-sm" disabled>
            </div>
        </div>
        <div class="form-group form-row">
            <label for="placaVehi">Placa:</label>
            <input type="text" name="placaVehi" id="placaVehi" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="tarjVehi">Tarjeta de propiedad:</label>
            <input type="text" name="tarjVehi" id="tarjVehi" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="numMotor">Numero de motor:</label>
            <input type="text" name="numMotor" id="numMotor" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="fechAd">Fecha de adquisición:</label>
            <input type="date" name="fechAd" id="fechAd" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="orVehi">Origen:</label>
            <input type="text" name="orVehi" id="orVehi" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="adqVehi">Forma de adquisición:</label>
            <input type="text" name="adqVehi" id="adqVehi" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="precVehi">Precio del vehículo:</label>
            <input type="number" name="precVehi" id="precVehi" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="impVehi">Monto de impuesto:</label>
            <input type="number" name="impVehi" id="impVehi" class="form-control form-control-sm">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="addVehi()" >Guardar</button>
      </div>
    </div>
  </div>
</div>
    <!-- Modal editar cont-->
<div class="modal fade" id="addContUpd" tabindex="-1" role="dialog" aria-labelledby="contModalLabelUpd" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ContModalLabelUpd">Editar predio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group form-row">
            <label for="placaVehiUpd">Placa:</label>
            <input type="text" name="placaVehiUpd" id="placaVehiUpd" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="tarjVehiUpd">Tarjeta de propiedad:</label>
            <input type="text" name="tarjVehiUpd" id="tarjVehiUpd" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="numMotorUpd">Numero de motor:</label>
            <input type="text" name="numMotorUpd" id="numMotorUpd" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="fechAdUpd">Fecha de adquisición:</label>
            <input type="date" name="fechAdUpd" id="fechAdUpd" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="orVehiUpd">Origen:</label>
            <input type="text" name="orVehiUpd" id="orVehiUpd" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="adqVehiUpd">Forma de adquisición:</label>
            <input type="text" name="adqVehiUpd" id="adqVehiUpd" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="precVehi">Precio del vehículo:</label>
            <input type="number" name="precVehiUpd" id="precVehiUpd" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="impVehi">Monto de impuesto:</label>
            <input type="number" name="impVehiUpd" id="impVehiUpd" class="form-control form-control-sm">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="updatePredDetails()" >Guardar</button>
        <input type="hidden" name="userId" id="userIdUpd">
      </div>
    </div>
  </div>
</div>

</body>
    <script src="../javascript/jquery.min.js"></script>
    <script src="../javascript/popper.js"></script>
    <script src="../javascript/bootstrap.min.js"></script>
    <script src="../javascript/vehiculo.js"></script>
</html>