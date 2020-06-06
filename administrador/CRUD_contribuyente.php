<?php 
    include_once('../includes/funciones.php');
    include_once('../includes/sql.php');

    if(isset($_POST['usuario'])){
        if(isset($_POST['type'])){
            echo listReporte();
        }else{
            echo listusuarios();
        }
    }
    if(isset($_POST['id_del'])){
        $id = remove_junk($_POST['id_del']);
        deleteCont($id);
    }
    if(isset($_POST['nombCont_add'])){
        $id = remove_junk($_POST['nombCont_add']);
        $apel = remove_junk($_POST['apelCont']);
        $raz = remove_junk($_POST['RazoSociCont']);
        $fech = remove_junk($_POST['fechNaciCont']);
        $sex = remove_junk($_POST['sexoCont']);
        $nac = remove_junk($_POST['nacionalidadCont']);    
        $idT = remove_junk($_POST['idTipoCont']);
        $DNI = remove_junk($_POST['DNI']);
        $dirC = remove_junk($_POST['dirC']);
        $corC = remove_junk($_POST['corC']);
        addCont($id, $apel, $raz,$fech, $sex, $nac, $idT, $DNI, $dirC, $corC);
    }
    if(isset($_POST['id'])){
        $id_area = remove_junk($_POST['id']);
        echo detailsCont($id_area);
    }else{
        $response['status'] = 200;
        $response['message'] = "Invalid request!";
    }
    if(isset($_POST['idCont'])){
        $nomb = remove_junk($_POST['nombCont']);
        $apel = remove_junk($_POST['apelCont']);
        $raz = remove_junk($_POST['RazoSociCont']);
        $fech = remove_junk($_POST['fechNaciCont']);
        $sex = remove_junk($_POST['sexoCont']);
        $nac = remove_junk($_POST['nacionalidadCont']);    
        $idT = remove_junk($_POST['idTipoCont']);
        $idC = remove_junk($_POST['idCont']);
        $DNI = remove_junk($_POST['DNI']);
        $cor = remove_junk($_POST['cor']);
        
        updCont($nomb, $apel, $raz,$fech, $sex, $nac, $idT, $idC, $DNI, $cor);
    }

?>