<?php

  include_once("includes/session.php");
  include_once("includes/funciones.php");
  unset($_SESSION['user_id']);
  unset($_SESSION["apelAdmi"]);
  unset($_SESSION['nombAdmi']);



  $caducidad = 60 * 2 + time(); 

  if(isset($_COOKIE["intentos"])){
    $suma = $_COOKIE["intentos"] + 1;
    setcookie("intentos", $suma, $caducidad); 
  }else{
    setcookie("intentos", 1, $caducidad); 
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="images/png" href="imagenes/stopwatch.png"/>
    <title>Sistema tributario predial</title>
    
    <link rel="stylesheet" href="estilos/bootstrap.css">
    <link rel="stylesheet" href="estilos/style.css">
    <style>
        *{
        }
    </style>
</head>
<body>
    <nav class="navbar bg-warning">
        <a class="navbar-brand"><h3>Bienvenido</h3></a>
        <form class="form-inline" action="contribuyente.php" method="POST">
                Es un contribuyente? ingrese su DNI:  
            <input class="form-control mr-sm-2" type="search" placeholder="DNI" name="DNI" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>               
    </nav>
    <main class="container-fluid d-flex justify-content-center flex-column">
        <div class="border-right border-left border-top rounded-top bg-secondary p-4 col-md-4 mt-5 d-flex mx-auto">
            <img src="imagenes/sanji_log_icon.png" width="150px" alt="adas" class="mx-auto">
            <?php 
                if(isset($_SESSION['Error'])){
                    $output  = "<div class=\"alert alert-danger\">";
                    $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
                    if(isset($_COOKIE["intentos"]) and $_COOKIE["intentos"] != NULL and $_COOKIE["intentos"] < 4 ){
                        $output .= "Tienes :" . ( 4 - $_COOKIE["intentos"] ."intentos más.");    
                    }
                    $output .= remove_junk(first_character($_SESSION['Error']));
                    $output .= "</div>";

                    echo $output;
                  }
            ?>
        </div>
        <div class="border-left border-right border-bottom rounded-bottom p-4 col-md-4 d-flex mx-auto">
            <?php 
                if ( isset($_COOKIE["intentos"]) and $_COOKIE["intentos"] > 3) {
                    echo "<div class='alert alert-primary'>Demasiados intentos :( intentelo en 2 minutos.</div>";
                }else{
                 ?>
                                 <form action="auth.php" class="col-md-12" method="POST"> 
                    <div class="form-label-group">
                        <input type="text" class="form-control" name="usuario" required id="inputText">
                        <label for="usuario" class="float-label">usuario</label>
                    </div>
                    <div class="form-label-group mt-4">
                        <input type="password" class="form-control" name="password" required id="inputPassword">
                        <label for="usuario" class="float-label">Contraseña</label>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-secondary col-md-12" type="submit">Ingresar</button>
                    </div>
                </form>

            <?php
                }
            ?>
            
            
            
        </div>
    </main>
<!--    <footer class="bg-warning navbar fixed-bottom">
        <span class="font-italic">...</span>
    </footer>-->
</body>
    <script src="javascript/jquery.min.js"></script>
    <script src="javascript/popper.js"></script>
    <script src="javascript/bootstrap.min.js"></script>
</html>