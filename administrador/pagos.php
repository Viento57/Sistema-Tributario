<?php 
    include_once('../includes/funciones.php');
    include_once('../includes/sql.php');

    if(isset($_POST['pays'])){
        echo pays();
    }
    if(isset($_POST['pay'])){
        echo addPays();
    }
?>