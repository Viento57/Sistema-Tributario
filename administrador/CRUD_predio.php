<?php 
    include_once('../includes/funciones.php');
    include_once('../includes/sql.php');

    if(isset($_POST['usuario'])){
        echo listPredio();
    }

    if(isset($_POST['nomCont'])){
        $cons = remove_junk($_POST['nomCont']);
        echo searchCont($cons);
    }
    if(isset($_POST['id_del'])){
        $id = remove_junk($_POST['id_del']);
        deletePredio($id);
    }
    if(isset($_POST['idCont_'])){
        $id = remove_junk($_POST['idCont_']);
        $est = remove_junk($_POST['estadoPred']);
        $tipo= remove_junk($_POST['tipoPred']);
        $uso= remove_junk($_POST['usoPred']);
        $cond = remove_junk($_POST['condPropPred']);
        $porcen = remove_junk($_POST['porcenPred']);
        $area = remove_junk($_POST['area']);
        $valor = remove_junk($_POST['valor']);
        $dir = remove_junk($_POST['dir']);

        $anioPred = remove_junk($_POST['anioPred']);
        $materialPred = remove_junk($_POST['materialPred']);
        $porCon = remove_junk($_POST['porCon']);
        
        echo addPred($est, $tipo, $uso, $cond, $porcen, $area, $valor, $id, $anioPred, $materialPred, $porCon, $dir);
    }
    if(isset($_POST['id'])){
        $id_pred = remove_junk($_POST['id']);
        echo detailsPred($id_pred);
    }else{
        $response['status'] = 200;
        $response['message'] = "Invalid request!";
    }
    if(isset($_POST['userIdUpd'])){
        $est = remove_junk($_POST['estadoPredUpd']);
        $tipo = remove_junk($_POST['tipoPredUpd']);
        $uso = remove_junk($_POST['usoPredUpd']);
        $cond = remove_junk($_POST['condPredUpd']);
        $por = remove_junk($_POST['porPredUpd']);
        $area = remove_junk($_POST['areaPredUpd']);    
        $valor = remove_junk($_POST['valorPredUpd']);
        $id = remove_junk($_POST['userIdUpd']);

        updPred($est, $tipo, $uso,$cond, $por, $area, $valor, $id);
    }

?>