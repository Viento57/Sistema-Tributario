<?php 
    include_once('../includes/funciones.php');
    include_once('../includes/sql.php');

    if(isset($_POST['DNI'])){
        $DNI = remove_junk($_POST['DNI']);

        $codigo = get_codByDNI($DNI);

        echo calcPredial($codigo['idCont']);
    }

    if(isset($_POST["anio"]) and isset($_POST["monto"]) and isset($_POST["DNIp"])){
        $anio = remove_junk($_POST["anio"]);
        $monto = remove_junk($_POST["monto"]);
        $dni = remove_junk($_POST["DNIp"]);
        echo insertPago($anio, $monto, $dni);
    }
    if(isset($_POST["anioT"]) and isset($_POST["montoT"]) and isset($_POST["DNIpT"])){
        $anio = remove_junk($_POST["anioT"]);
        $monto = remove_junk($_POST["montoT"]);
        $dni = remove_junk($_POST["DNIpT"]);
        echo insertPagoTrim($anio, $monto, $dni);
    }
    if(isset($_POST["anioTC"]) and isset($_POST["montoTC"]) and isset($_POST["DNIpTC"]) and isset($_POST["numPago"])){
        $anio = remove_junk($_POST["anioTC"]);
        $monto = remove_junk($_POST["montoTC"]);
        $dni = remove_junk($_POST["DNIpTC"]);
        $num = remove_junk($_POST["numPago"]);
        echo updatePagoTrim($anio, $monto, $dni, $num);
    }
?>