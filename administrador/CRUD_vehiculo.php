<?php 
    include_once('../includes/funciones.php');
    include_once('../includes/sql.php');

    if(isset($_POST['usuario'])){
        echo listVehi();
    }

    if(isset($_POST['nomCont'])){
        $cons = remove_junk($_POST['nomCont']);
        echo searchCont($cons);
    }
    if(isset($_POST['id_del'])){
        $id = remove_junk($_POST['id_del']);
        deleteVehi($id);
    }
    if(isset($_POST['idCont_'])){
        $a = remove_junk($_POST['idCont_']);
        $b = remove_junk($_POST['b']);
        $c = remove_junk($_POST['c']);
        $d = remove_junk($_POST['d']);
        $e = remove_junk($_POST['e']);
        $f = remove_junk($_POST['f']);
        $g = remove_junk($_POST['g']);
        $h = remove_junk($_POST['h']);
        $i = remove_junk($_POST['i']);
        addVehi($a, $b, $c, $d, $e, $f, $g, $h, $i);
    }
    if(isset($_POST['id'])){
        $id_pred = remove_junk($_POST['id']);
        echo detailsVehi($id_pred);
    }else{
        $response['status'] = 200;
        $response['message'] = "Invalid request!";
    }
    if(isset($_POST['a'])){
        $a = remove_junk($_POST['a']);
        $b = remove_junk($_POST['b']);
        $c = remove_junk($_POST['c']);
        $d = remove_junk($_POST['d']);
        $e = remove_junk($_POST['e']);
        $f = remove_junk($_POST['f']);
        $g = remove_junk($_POST['g']);
        $h = remove_junk($_POST['h']);
        $i = remove_junk($_POST['i']);
        updVehi($a, $b, $c, $d, $e, $f, $g, $h, $i);
    }

?>