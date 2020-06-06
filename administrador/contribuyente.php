<?php
    include_once('../includes/funciones.php');
    include_once('../includes/sql.php');

    $result = selectCont();
    $result2 = selectCont();
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
            <button class="btn btn-outline-primary m-4" class="btn btn-primary" data-toggle="modal" data-target="#addCont">Añadir contribuyente +</button>
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
        <h5 class="modal-title" id="ContModalLabel">Añadir un contribuyente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group form-row">
            <label for="idTipoCont">Tipo de contribuyente:</label>
            <select type="date" name="idTipoCont" id="idTipoCont" class="form-control form-control-sm">
                <?php 
                    foreach($db->while_loop($result) as $valor){
                        echo '<option value='.$valor['idTipoCont'].'>'.$valor['tipoCont'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="form-group form-row" id="razonSocial">
            <label for="RazoSociCont">Razón social:</label>
            <input type="text" name="RazoSociCont" id="RazoSociCont" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="nombCont">Nombre:</label>
            <input type="text" name="nombCont" id="nombCont" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="apelCont">Apellidos:</label>
            <input type="text" name="apelCont" id="apelCont" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="DNI">DNI:</label>
            <input type="number" name="DNI" id="DNI" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="dirC">Direccion:</label>
            <input type="text" name="dirC" id="dirC" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="dirC">Correo:</label>
            <input type="text" name="corC" id="corC" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="fechNaciCont">Fecha de nacimiento:</label>
            <input type="date" name="fechNaciCont" id="fechNaciCont" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="sexoCont">Género:</label>
            <select type="date" name="sexoCont" id="sexoCont" class="form-control form-control-sm">
                <option value="M" selected>Masculino</option>
                <option value="M">Femenino</option>
            </select>
        </div>
        <div class="form-group form-row">
            <label for="nacionalidadCont">Nacionalidad:</label>
            <input type="text" name="nacionalidadCont" id="nacionalidadCont" class="form-control form-control-sm">
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="addContribuyente()" >Guardar</button>
      </div>
    </div>
  </div>
</div>
    <!-- Modal editar cont-->
<div class="modal fade" id="addContUpd" tabindex="-1" role="dialog" aria-labelledby="contModalLabelUpd" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ContModalLabelUpd">Añadir un contribuyente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
      <div class="form-group form-row">
            <label for="idTipoContUpd">Tipo de contribuyente:</label>
            <select type="date" name="idTipoContUpd" id="idTipoContUpd" class="form-control form-control-sm">
                <?php 
                    foreach($db->while_loop($result2) as $valor){
                        echo '<option value='.$valor['idTipoCont'].'>'.$valor['tipoCont'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="form-group form-row">
            <label for="nombContUpd">Nombre:</label>
            <input type="text" name="nombContUpd" id="nombContUpd" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="apelContUpd">Apellidos:</label>
            <input type="text" name="apelContUpd" id="apelContUpd" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="DNIUpd">DNI:</label>
            <input type="text" name="DNIUpd" id="DNIUpd" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="RazoSociContUpd">Razón social:</label>
            <input type="text" name="RazoSociContUpd" id="RazoSociContUpd" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="fechNaciContUpd">Fecha de nacimiento:</label>
            <input type="date" name="fechNaciContUpd" id="fechNaciContUpd" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="corContUpd">Correo:</label>
            <input type="text" name="corContUpd" id="corContUpd" class="form-control form-control-sm">
        </div>
        <div class="form-group form-row">
            <label for="sexoContUpd">Género:</label>
            <select type="date" name="sexoContUpd" id="sexoContUpd" class="form-control form-control-sm">
                <option value="M" selected>Masculino</option>
                <option value="F">Femenino</option>
            </select>
        </div>
        <div class="form-group form-row">
            <label for="nacionalidadContUpd">Nacionalidad:</label>
            <input type="text" name="nacionalidadContUpd" id="nacionalidadContUpd" class="form-control form-control-sm">
        </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="updateContDetails()" >Guardar</button>
        <input type="hidden" name="userId" id="userIdUpd">
      </div>
    </div>
  </div>
</div>

</body>
    <script src="../javascript/jquery.min.js"></script>
    <script src="../javascript/popper.js"></script>
    <script src="../javascript/bootstrap.min.js"></script>
    <script src="../javascript/contribuyente.js"></script>
</html>