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
</head>
<body>
    <?php include_once('../includes/menu_admin.php');
        session_start();
        
    
    ?>
    <main class="">
    <div class="jumbotron jumbotron-fluid mt-5">
        <div class="container">
            <h1 class="display-4">Bienvenido(a): <?php echo $_SESSION['nombAdmi']," ", $_SESSION['apelAdmi'];?></h1>
            <p class="lead">Usuario: <?php echo $_SESSION['user_id'];?>.</p>
        </div>
    </div>

    </main>
</body>
    <script src="../javascript/jquery.min.js"></script>
    <script src="../javascript/popper.js"></script>
    <script src="../javascript/bootstrap.min.js"></script>
</html>