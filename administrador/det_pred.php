<?php
    include_once('../includes/funciones.php');
    include_once('../includes/sql.php');

    $result = detailsPred_det($_GET['cod']);
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
</head>
<body>
    <?php include_once('../includes/menu_admin.php');
        session_start();
    ?>
    <main class="">
    <div class="jumbotron jumbotron-fluid mt-5" style="box-shadow: 0px 0px 0px -100px #FFFFFF, 
0px 0px 9px -3px #000000;">
        <div class="container">
            <?php     foreach($db->while_loop($result) as $valor){ ?>
            <div class="card" style="width: 25rem;">
                <div class="card-header">
                    <h5 class="card-title">Información del predio:</h5>
                </div>
                <div class="card-body">
                    <p class="card-text"><span class="font-weight-bold">Propietario: </span><?php echo $valor['nombCont']?></p>
                    <p class="card-text"><span class="font-weight-bold">DNI: </span><?php echo $valor['DNI']?></p>
                    <p class="card-text"><span class="font-weight-bold">Área(M2): </span><?php echo $valor['areaM2Pred']?></p>
                    <p class="card-text"><span class="font-weight-bold">Estado de conservación: </span><?php echo $valor['estadoConservacionCons']?></p>
                    <p class="card-text"><span class="font-weight-bold">Tipo de predio: </span><?php echo $valor['TipoPred']?></p>
                    <p class="card-text"><span class="font-weight-bold">Área cons.(%): </span><?php echo $valor['areaCons']?>%</p>
                    <p class="card-text"><span class="font-weight-bold">Material de const.: </span><?php echo $valor['materialpred']?></p>
                    <p class="card-text"><span class="font-weight-bold">Año de construcción: </span><?php echo $valor['anioCons']?></p>
                    <p class="card-text"><span class="font-weight-bold">Uso de predio: </span><?php echo $valor['UsoPred']?></p>
                    <p class="card-text"><span class="font-weight-bold">Título de propiedad: </span>
                        <?php 
                            $codigoA = $_GET['cod'];
                            if($valor['archivo'] === '---'){
                                echo "Sin archivo.";
                            }else{
                                echo "<a target='_blank' href='uploads/$codigoA.pdf' class='badge badge-warning'>ver</a>";
                            }
                        ?>
                    </p>
                </div>
                <div class="card-footer text-muted">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-col">
                            <input type="file" name="file" id="file" class="form-control" accept=".pdf">
                        </div>
                        <div class="form-col">
                            <input type="submit" name="import" class="btn btn-warning btn-block" value="Subir o reemplazar existente" class="form-control">
                        </div>
                    </form>
                </div>
            </div>
            <?php }?>
        </div>
    </div>

    </main>
</body>
    <script src="../javascript/jquery.min.js"></script>
    <script src="../javascript/popper.js"></script>
    <script src="../javascript/bootstrap.min.js"></script>
</html>
<?php 

if(isset($_POST['import'])){
    if(subir_archivo("nombre")){
      unset($_POST['import']);  
    }
}
function subir_archivo($codigo_doc){
    $nombre = $_FILES['file']['name'];
    $formatos= array('application/pdf');
    $extension = substr($nombre, strrpos($nombre, '.'));
    

    if(isset($_FILES['file']['name'])){
        $codigoA =  $_GET['cod'];
        $_FILES['file']['name'] = $codigoA.'.pdf';
        $nombrearchivo = $_FILES['file']['name'];
        $nombretmpArchivo = $_FILES['file']['tmp_name'];
        $ext = substr($nombrearchivo, strrpos($nombrearchivo, '.'));
        if (in_array($_FILES["file"]["type"],$formatos)) {
            include_once("../includes/conexion.php");
                if (move_uploaded_file($nombretmpArchivo, "uploads/$nombrearchivo")) {
                    echo "<div class='alert alert-success'>felicitaciones, archivo subido exitosamente</div><br>";
                    

                            $sql = "UPDATE predio SET archivo = 'uploads/$nombrearchivo' WHERE idPred='$codigoA';";
                            global $db;
                            
                            if(!$result = $db->query($sql)){
                               die("El archivo no cumple el formato!!
                               ");
                               return false; 
                            }
                        }else{
                            echo "<div class='alert alert-danger'>Numero de columnas incorrecto!!</div>";
                        }
                    }
                
                    return true;
                }else{
                return false;
            }
        

    }


?>
