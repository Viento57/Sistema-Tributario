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
    <link rel="shortcut icon" type="images/png" href="../imagenes/stopwatch.png"/><title>Sistema tributario predial</title>
    <link rel="stylesheet" href="../estilos/bootstrap.css">
    <link rel="stylesheet" href="../estilos/style.css">
    <link rel="stylesheet" href="../estilos/style_load.css">
</head>
<body>
    <div class="loader-contain" id="loader">
        <div class="loader"></div>
    </div>

    <?php include_once('../includes/menu_admin.php');
    ?>
    <main class="">
        <div class="jumbotron jumbotron-fluid mt-4">
            <h3>Usuario:
                <?php echo $_SESSION['nombAdmi'];?>
            </h3>
            <hr>
            <button class="btn btn-outline-primary m-4" class="btn btn-primary" data-toggle="modal" data-target="#addCont">Añadir predio +</button>
            <div class="container table-responsive" id="containerTableCont">

            </div>
            <div id="error">
            </div>
            
        </div>
    </main>
    <!-- Modal añadir pred-->
<div class="modal fade" id="addCont" tabindex="-1" role="dialog" aria-labelledby="contModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ContModalLabel">Añadir un predio</h5>
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
                <label for="nombCont">Nombre:</label>
                <input type="text" name="nombCont" id="nombCont_" class="form-control form-control-sm" disabled>
            </div>
            <div class="form-col col-6">
                <label for="DNICont">DNI:</label>
                <input type="text" name="DNICont" id="DNICont_" class="form-control form-control-sm" disabled>
            </div>
            <div class="form-col col-6">
                <label for="nombCont" class="d-none">Código:</label>
                <input type="hidden" name="nombCont" id="idCont_" class="form-control form-control-sm" disabled>
            </div>
        </div>
        <div class="form-group form-row">
            <label for="estadoPred" class="d-none">Estado:</label>
            <input type="hidden" name="estadoPred" id="estadoPred" value="Bueno" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="nombCont">Tipo:</label>
            <select type="text" name="nombCont" id="tipoPred" class="form-control form-control-sm">
                <option value="casa_habitacion">casa habitacion</option>
                <option value="negocios">Tienda, depósito, centro de recreación</option>
                <option value="edificios_oficinas">Edificios, oficinas</option>
                <option value="sitios_publicos">Clínicas, hospitales, cines, industrias, colegios</option>
            </select>
        </div>
        <div class="form-group form-row">
            <label for="usoPred">Uso:</label>
            <input type="text" name="usoPred" id="usoPred" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="condPred">Estado de predio:</label>
            <select type="text" name="condPred" id="condPred" class="form-control form-control-sm">
                <option value="muybueno">Muy bueno</option>
                <option value="bueno">Bueno</option>
                <option value="regular">Regular</option>
                <option value="malo">Malo</option>
            </select>
        </div>
        <div class="form-group form-row">
            <label for="porPred">Porcen. Prop. Pred.:</label>
            <input type="number" name="porPred" id="porPred" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="DirPred">Dirección:</label>
            <input type="text" name="DirPred" id="DirPred" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="porPred">Área Pred.:</label>
            <input type="number" name="areaPred" id="areaPred" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="valorPred">Valor terreno:</label>
            <input type="number" name="valorPred" id="valorPred" class="form-control form-control-sm">
        </div>
        <hr>
            Datos de construccion
        <hr>
        <div class="form-group form-row">
            <label for="anioPred">Año de construcción:</label>
            <input type="date" name="anioPred" id="anioPred" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="materialPred">Material de construcción:</label>
            <select name="material" id="materialPred" class="form-control form-control-sm">
                <option value="adobe">Adobe</option>
                <option value="concreto">Concreto</option>
                <option value="ladrillo">Ladrillo</option>
            </select>
        </div>
        <div class="form-group form-row">
            <label for="porCon">Porcentaje de area construida:</label>
            <input type="number" name="porCon" id="porCon" class="form-control form-control-sm" min ="0" max="100">
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="addPredio()" >Guardar</button>
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
            <label for="estadoPredUpd">Estado:</label>
            <input type="text" name="estadoPredUpd" id="estadoPredUpd" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="nombContUpd">Tipo:</label>
            <select type="text" name="nombContUpd" id="tipoPredUpd" class="form-control form-control-sm">
            <option value="casa_habitacion">casa habitacion</option>
                <option value="negocios">Tienda, depósito, centro de recreación</option>
                <option value="edificios_oficinas">Edificios, oficinas</option>
                <option value="sitios_publicos">Clínicas, hospitales, cines, industrias, colegios</option>
            </select>
        </div>
        <div class="form-group form-row">
            <label for="usoPredUpd">Uso:</label>
            <input type="text" name="usoPredUpd" id="usoPredUpd" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="condPredUpd">Cond. Prop. Pred.:</label>
            <select type="text" name="condPredUpd" id="condPredUpd" class="form-control form-control-sm">
                <option value="muybueno">Muy bueno</option>
                <option value="bueno">Bueno</option>
                <option value="regular">Regular</option>
                <option value="malo">Malo</option>
            </select>
        </div>
        <div class="form-group form-row">
            <label for="porPredUpd">Porcen. Prop. Pred.:</label>
            <input type="number" name="porPredUpd" id="porPredUpd" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="porPredUpd">Área Pred.:</label>
            <input type="number" name="areaPredUpd" id="areaPredUpd" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="valorPredUpd">Valor terreno:</label>
            <input type="number" name="valorPredUpd" id="valorPredUpd" class="form-control form-control-sm">
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
    <script src="../javascript/predio.js"></script>
</html>