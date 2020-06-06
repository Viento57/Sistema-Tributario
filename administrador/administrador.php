<?php 
    include_once("validar_session.php");

  $caducidad = 60 * 2 + time(); 

  if(isset($_COOKIE["intentos"])){
    setcookie("intentos", 1, $caducidad); 
  }else{
    setcookie("intentos", 1, $caducidad); 
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="images/png" href="../imagenes/stopwatch.png"/><title>Sistema tributario predial</title>
    <link rel="stylesheet" href="../estilos/bootstrap.css">
    <link rel="stylesheet" href="../estilos/style.css">
    <link rel="stylesheet" href="../estilos/card.css">
</head>
<body>
    <?php include_once('../includes/menu_admin.php');
        
    ?>
    <main class="">
    <div class="jumbotron jumbotron-fluid mt-5" style="box-shadow: 0px 0px 0px -100px #FFFFFF, 
0px 0px 9px -3px #000000;">
        <div class="container row mx-4">
            <div class="col-md-4">
              <!-- <img src="./upload_image/profile.jpg" width="200px" alt=""> -->
            </div>
            <div class="col-md-8">
              <h1 class="display-4">Bienvenido(a): <?php echo $_SESSION['nombAdmi']," ", $_SESSION['apelAdmi'];?></h1>
              <p class="lead">Usuario: <?php echo $_SESSION['user_id'];?>.</p>
            
            
<!--               <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-col">
                            <input type="file" name="file" id="file" class="form-control" accept=".jpg">
                        </div>
                        <div class="form-col">
                            <input type="submit" name="import" class="btn btn-warning btn-block" value="Cambiar foto de perfil" class="form-control">
                        </div>
                    </form> -->
            </div>
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
    $formatos= array('image/jpeg');
    $extension = substr($nombre, strrpos($nombre, '.'));
    

    if(isset($_FILES['file']['name'])){
        $_FILES['file']['name'] = 'profile.jpg';
        $nombrearchivo = $_FILES['file']['name'];
        $nombretmpArchivo = $_FILES['file']['tmp_name'];
        $ext = substr($nombrearchivo, strrpos($nombrearchivo, '.'));
        if (in_array($_FILES["file"]["type"],$formatos)) {
                if (move_uploaded_file($nombretmpArchivo, "upload_image/$nombrearchivo")) {
                    echo "<div class='alert alert-success'>felicitaciones, archivo subido exitosamente</div><br>";
                    return true;
                }else{
                return false;
            }
        }else{
          echo "<div class='alert alert-success'>Formato no valido.</div><br>";
        }
        

    }
  }

?>