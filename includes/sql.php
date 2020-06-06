<?php
    require("conexion.php");
/*--------------------------------------------------------------*/
/* Loguearse con los datos proporcionados mediante $_POST 
/* del formulario
/*--------------------------------------------------------------*/
  function authenticate($username='', $password='') {
    global $db;
    $username = $db->escape($username);
    $password = $db->escape($password);
    $sql  = "SELECT * FROM administrador WHERE usuaAdmi ='{$username}' LIMIT 1";//solo va seleccionar un solo usuario
    $result = $db->query($sql);
    if($db->num_rows($result)){
      $user = $db->fetch_assoc($result);
      if($password === $user['contraseniaAdmi'] ){
        return $user;
      }
    }
   return false;
  }

  /*listado de usuarios*/
  function listusuarios(){
    global $db;
    $sql = "SELECT * FROM contribuyente INNER JOIN tipocontribuyente ON contribuyente.idTipoCont = tipocontribuyente.idTipoCont;";
    $data = '
    <table class="table table-sm table-dark table-striped table-bordered">
      <caption>Lista de contribuyentes</caption>
      <thead>
        <tr class="">
          <th scope="col">DNI</th>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">Razón social</th>
          <th scope="col">Fecha nacimiento</th>
          <th scope="col">Género</th>
          <th scope="col">Dirección</th>
          <th scope="col">nacionalidad</th>
          <th scope="col">Tipo</th>
          <th scope="col">Editar </th>
          <th scope="col">Borrar</th>
        </tr>
      </thead>
    <tbody>
    ';
    $result = $db->query($sql);
    foreach($db->while_loop($result) as $valor){
      $data .= '
      <tr>
        <td>'.$valor['DNI'].'</td>
        <td>'.$valor['nombCont'].'</td>
        <td>'.$valor['apelCont'].'</td>
        <td>'.$valor['RazoSociCont'].'</td>
        <td>'.$valor['fechNaciCont'].'</td>
        <td>'.$valor['sexoCont'].'</td>
        <td>'.$valor['dir_cont'].'</td>
        <td>'.$valor['nacionalidadCont'].'</td>
        <td>'.$valor['tipoCont'].'</td>
        <td>
            <button onclick="getContDetails('."'".$valor['idCont']."'".')" class="btn btn-success">Editar</button>
        </td>
        <td>
            <button onclick="deleteCont('."'".$valor['idCont']."'".')" class="btn btn-danger">Borrar</button>
        </td>
      </tr>
      ';
    }
    $data .= '
    </tbody>
      </table>
    ';
    return $data;
  }
  /*Listado de ususarios reporte*/
  function listReporte(){
    global $db;
    $sql = "SELECT * FROM contribuyente INNER JOIN tipocontribuyente ON contribuyente.idTipoCont = tipocontribuyente.idTipoCont;";
    $data = '
    <table class="table table-sm table-dark table-striped table-bordered">
      <caption>Lista de contribuyentes</caption>
      <thead>
        <tr class="">
          <th scope="col">DNI</th>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">Razón social</th>
          <th scope="col">Fecha nacimiento</th>
          <th scope="col">Dirección</th>
          <th scope="col">Tipo</th>
          <th scope="col">Ver reporte de pagos</th>
        </tr>
      </thead>
    <tbody>
    ';
    $result = $db->query($sql);
    foreach($db->while_loop($result) as $valor){
      $data .= '
      <tr>
        <td>'.$valor['DNI'].'</td>
        <td>'.$valor['nombCont'].'</td>
        <td>'.$valor['apelCont'].'</td>
        <td>'.$valor['RazoSociCont'].'</td>
        <td>'.$valor['fechNaciCont'].'</td>
        <td>'.$valor['dir_cont'].'</td>
        <td>'.$valor['tipoCont'].'</td>
        <td>
            <a href="reporte.php?persona='.$valor['idCont'].'" class="btn btn-success">Ver reporte</a>
        </td>
      </tr>
      ';
    }
    $data .= '
    </tbody>
      </table>
    ';
    return $data;
  }

  /*Borrar un contribuyente*/
function deleteCont($id){
  global $db;
  $sql = "DELETE FROM contribuyente WHERE idCont = '$id';";
  $db->query($sql);
}

/*listar los tipos de contribuyente*/
function selectCont(){
  global $db;
  $sql = "SELECT * FROM tipocontribuyente;";
  $result = $db->query($sql);

  return $result;
}
/*Añadir contribuyente*/
function addCont($a, $b, $c, $d, $e, $f, $g, $h,$i,$j){
  global $db;  
  $sql = "INSERT INTO contribuyente VALUES('$h','$a','$b', '$c', '$d', '$e', '$f', '$g', '$h','$i', '$j');";
  $db->query($sql);
}
/*Detalles de contribuyentes*/
function detailsCont($id){
  global $db;
  $query = "SELECT * FROM contribuyente INNER JOIN tipocontribuyente ON contribuyente.idTipoCont = tipocontribuyente.idTipoCont WHERE idCont = '$id';";
  if(!$result = $db->query($query)){
    exit(mysqli_error());
  }
  $response = array();
  if(mysqli_num_rows($result) > 0 ){
    while($row = mysqli_fetch_assoc($result)){
      $response = $row;
    }
  }else{
      $response['status'] = 200;
      $response['message'] = "Data not found!";
  }
  return json_encode($response);
}
/*Actualizar contribuyente*/
function updCont($a, $b, $c, $d, $e, $f, $g, $h, $i, $j){
  global $db;
  $sql = "Update contribuyente set DNI = '$i', nombCont = '$a',correo = '$j', apelCont ='$b', RazoSociCont = '$c', fechNaciCont = '$d', sexoCont = '$e', nacionalidadCont = '$f', idTipoCont = '$g' WHERE idCont = '$h';";
  $db->query($sql);
}


/*listado de predios*/
  function listPredio(){
    global $db;
    $sql = "SELECT * FROM predio INNER JOIN contribuyente ON predio.idCont = contribuyente.idCont;";
    $data = '
    <table class="table table-sm table-dark table-striped table-bordered">
      <caption>Lista de predios</caption>
      <thead>
        <tr class="">
          <th scope="col">Tipo</th>
          <th scope="col">Uso</th>
          <th scope="col">Estado del predio</th>
          <th scope="col">porcen. prop. predio</th>
          <th scope="col">Área(M2)</th>
          <th scope="col">Valor</th>
          <th scope="col">Dirección</th>
          <th scope="col">Contribuyente</th>
          <th scope="col">Editar</th>
          <th scope="col">Borrar</th>
          <th scope="col">Detalles</th>
        </tr>
      </thead>
    <tbody>
    ';
    $result = $db->query($sql);
    foreach($db->while_loop($result) as $valor){
      $data .= '
      <tr>
        <td>'.$valor['TipoPred'].'</td>
        <td>'.$valor['UsoPred'].'</td>
        <td>'.$valor['condPropPred'].'</td>
        <td>'.$valor['porcenPropPred'].'</td>
        <td>'.$valor['areaM2Pred'].'</td>
        <td>'.$valor['valorTerreno'].'</td>
        <td>'.$valor['direccion'].'</td>
        <td>'.$valor['nombCont'].'</td>
        <td>
            <button onclick="getContDetails('."'".$valor['idPred']."'".')" class="btn btn-success">Editar</button>
        </td>
        <td>
            <button onclick="deleteCont('."'".$valor['idPred']."'".')" class="btn btn-danger">Borrar</button>
        </td>
        <td>
            <a href="det_pred.php?cod='."".$valor['idPred']."".'" class="btn btn-warning">Detalles</a>
        </td>
      </tr>
      ';
    }
    $data .= '
    </tbody>
      </table>
    ';
    return $data;
  }

/*Borrar un predio*/
function deletePredio($id){
  global $db;
  $sql = "DELETE FROM datosconstruccion WHERE idPred = '$id';";
  $db->query($sql);
  $sql = "DELETE FROM predio WHERE idPred = '$id';";
  $db->query($sql);
}

/*Buscar un cliente con sus nombre, apellido o razon social*/
function searchCont($cons){
  global $db;
  $sql = "SELECT * FROM	contribuyente WHERE nombCont LIKE '%$cons%' OR apelCont LIKE '%$cons%' OR RazoSociCont LIKE '%$cons%' LIMIT 5;";

  $data = '
    <table class="table table-sm table-dark table-striped table-bordered">
    <tbody>
    ';
    $result = $db->query($sql);
    foreach($db->while_loop($result) as $valor){
      $data .= '
      <tr>
        <td>'.$valor['nombCont'].'</td>
        <td>'.$valor['apelCont'].'</td>
        <td>'.$valor['DNI'].'</td>
        <td>'.$valor['RazoSociCont'].'</td>
        <td>
            <button onclick="escoger('."'".$valor['idCont']."'".","."'".$valor['nombCont']."'".","."'".$valor['DNI']."'".')" class="btn btn-sm btn-success">+</button>
        </td>
      </tr>
      ';
    }
    $data .= '
    </tbody>
      </table>
    ';
    return $data;
}
function letraAleatoria(){
  $a = ["a", "b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t"];
  return $a[rand(0, sizeof($a)-1)].$a[rand(0, sizeof($a)-1)];
}

/*Añadir un predio*/
function addPred($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k, $l){
  global $db;  
  $clave = letraAleatoria() . sha1($f.$g);//optenemons la letra aleatoria
  $sql = "INSERT INTO predio VALUES('$clave','$a','$b', '$c', '$d', '$e', '$f', '$g', '$h', '$l', '---');";
  $db->query($sql);
  $antiguedad = $i;
  $areaConstruida = $k;
  $valorMetro = $g/$f;
  
  $sql = "INSERT INTO `datosconstruccion` (`idPred`, `nivelCons`, `clasificacionCons`, `estadoConservacionCons`, `anioCons`, `muroColum`, `techos`, `pisos`, `puertasVentanas`, `revistimiento`, `baños`, `instelecsani`, `valorUnitarioM2`, `incrementoCons`, `porcDepreciacionCons`, `valorUnitarioDepreciadoCons`, `areaCons`, `valorAreaCons`, `valorArcasComunesCons`, `valorTotalCons`, `categoria`, `materialpred`) VALUES ('$clave', '0', '$b', '$d', '$antiguedad', '', '', '', '', '', '', '', '$valorMetro', NULL, NULL, NULL, '$areaConstruida', NULL, NULL, NULL, '', '$j')";
  
  $db->query($sql);
  return  $sql;
}
/*Detelles predio*/
function detailsPred($id_pred){
  global $db;
  $query = "SELECT * FROM predio WHERE idPred = '$id_pred';";
  if(!$result = $db->query($query)){
    exit(mysqli_error());
  }
  $response = array();
  if(mysqli_num_rows($result) > 0 ){
    while($row = mysqli_fetch_assoc($result)){
      $response = $row;
    }
  }else{
      $response['status'] = 200;
      $response['message'] = "Data not found!";
  }
  return json_encode($response);
}
/*Actualizar predio*/
function updPred($est, $tipo, $uso,$cond, $por, $area, $valor, $id){
  global $db;
  $sql = "UPDATE predio SET EstadoPred = '$est', TipoPred = '$tipo', UsoPred='$uso', porcenPropPred='$por', areaM2Pred='$area', valorTerreno='$valor' WHERE idPred = '$id'";
  echo $db->query($sql);
}

/*Listar vehiculos*/
function listVehi(){
  global $db;
  $sql = "SELECT * FROM vehiculo INNER JOIN contribuyente ON vehiculo.idCont = contribuyente.idCont;";
  $data = '
  <table class="table table-sm table-dark table-striped table-bordered">
    <caption>Lista de predios</caption>
    <thead>
      <tr class="">
        <th scope="col">Placa</th>
        <th scope="col">Tarjeta de propiedad</th>
        <th scope="col">Numero Motor vehiculo</th>
        <th scope="col">Fecha de adquisición</th>
        <th scope="col">Origen vehiculo</th>
        <th scope="col">Forma de adquisicion</th>
        <th scope="col">Precio(S/.)</th>
        <th scope="col">Impuesto</th>
        <th scope="col">Propietario</th>
        <th scope="col">Editar</th>
        <th scope="col">Borrar</th>
      </tr>
    </thead>
  <tbody>
  ';
  $result = $db->query($sql);
  foreach($db->while_loop($result) as $valor){
    $data .= '
    <tr>
      <td>'.$valor['numePlacaVehi'].'</td>
      <td>'.$valor['numeTarjProp'].'</td>
      <td>'.$valor['numeMotoVehi'].'</td>
      <td>'.$valor['fechAdqui'].'</td>
      <td>'.$valor['origenVehi'].'</td>
      <td>'.$valor['FormAdquVehi'].'</td>
      <td>'.$valor['precioVehiSoles'].'</td>
      <td>'.$valor['montoImpuesto'].'</td>
      <td>'.$valor['nombCont'].'</td>
      <td>
          <button onclick="getContDetails('."'".$valor['numePlacaVehi']."'".')" class="btn btn-success">Editar</button>
      </td>
      <td>
          <button onclick="deleteCont('."'".$valor['numePlacaVehi']."'".')" class="btn btn-danger">Borrar</button>
      </td>
    </tr>
    ';
  }
  $data .= '
  </tbody>
    </table>
  ';
  return $data;
}
/*Añadir un vehiculo*/
function addVehi($a, $b, $c, $d, $e, $f, $g, $h, $i){
  global $db;  
  $sql = "INSERT INTO vehiculo VALUES('$b', '$c', '$d', '$e', '$f', '$g', '$h', '$i', '$a');";
  $db->query($sql);
}
/*Borrar un vehículo*/
function deleteVehi($id){
  global $db;
  $sql = "DELETE FROM vehiculo WHERE numePlacaVehi = '$id';";
  $db->query($sql);
}
/*Detalles vehiculos*/
function detailsVehi($id){
  global $db;
  $query = "SELECT * FROM vehiculo WHERE numePlacaVehi = '$id';";
  if(!$result = $db->query($query)){
    exit(mysqli_error());
  }
  $response = array();
  if(mysqli_num_rows($result) > 0 ){
    while($row = mysqli_fetch_assoc($result)){
      $response = $row;
    }
  }else{
      $response['status'] = 200;
      $response['message'] = "Data not found!";
  }
  return json_encode($response);
}
/*Actualizar vehiculo*/
function updVehi($a, $b, $c, $d, $e, $f, $g, $h, $i){
  global $db;
  $sql = "UPDATE vehiculo SET numePlacaVehi='$a', numeTarjProp='$b', numeMotoVehi='$c', fechAdqui='$d', origenVehi='$e', FormAdquVehi = '$f', precioVehiSoles='$g', montoImpuesto='$h' WHERE numePlacaVehi = '$i'";
  $db->query($sql);
}
/*Determinar la cantidad de años*/
function deterAnio($anio){
  global $db;
  $sql = "SELECT DISTINCT antiguedad FROM tabla_depreciacion;";

  $result = $db->query($sql);
  foreach($db->while_loop($result) as $valor){
    if(intval($valor['antiguedad']) >= 51){
      //Para los años mayores a 50 se cosidera el año 51
      return 51;
    }
    if(intval($valor['antiguedad']) >= $anio){
      return intval($valor['antiguedad']);
    }
  }
}

/*Calcular el autovaluo*/
//El valor del metro cuadrado del piso se obtiene de acuerdo al cuadro de valores unitarios de edificacion
function calculoPredial($area, $areaCons, $valorM2, $tipo, $material, $estCon, $anti){
  global $db;
  $arancel = 113;
  $anti = deterAnio(date("Y")-$anti);
  
  $sql = "SELECT * FROM tabla_depreciacion WHERE clasificacion='$tipo' AND antiguedad='$anti' AND material='$material' LIMIT 1;";
  $result = $db->query($sql);
  foreach($db->while_loop($result) as $valor){
    $porcentaje = intval($valor[$estCon])/100;
  }

  $valorUnitarioDepreciado = $valorM2 - ($valorM2 * $porcentaje);
  $areaCons = $area * ($areaCons/100);

  $valorConstruccion = $valorUnitarioDepreciado * $areaCons;
  $valorTerreno = $area * $arancel;

  $autovaluo = $valorConstruccion + $valorTerreno; 
  return $autovaluo;
}
/*Listar, sumar y calcular el impuesto predial*/
function calcPredial($rs){
  global $db;
  $sql = "SELECT
  predio.areaM2Pred,
  datosconstruccion.valorUnitarioM2,
  datosconstruccion.estadoConservacionCons,
  predio.TipoPred,
  datosconstruccion.areaCons,
  datosconstruccion.materialpred,
  datosconstruccion.anioCons,
  predio.UsoPred,
  EXTRACT(YEAR FROM datosconstruccion.anioCons) as anioConsD,
  predio.direccion
  FROM
  predio
  INNER JOIN datosconstruccion ON datosconstruccion.idPred = predio.idPred
  WHERE
  predio.idPred = datosconstruccion.idPred AND
  predio.idCont = '$rs';";
  $result = $db->query($sql);
  $data = '<table class="table table-dark table-bordered">
  <thead>
    <tr>
      <th scope="col">Dirección del predio</th>
      <th scope="col">Valor del predio</th>
    </tr>
  </thead>
  <tbody>
';
  $suma = 0;
  if(mysqli_num_rows($result) > 0 ){
    foreach($db->while_loop($result) as $valor){
      $monto = calculoPredial($valor['areaM2Pred'], $valor['areaCons'], $valor['valorUnitarioM2'], $valor['TipoPred'], $valor['materialpred'], $valor['estadoConservacionCons'], $valor['anioConsD']);
      $suma += $monto;
      $data .= '  
        <tr>
          <td>'.$valor['direccion'].'</td>
          <td>S/. '.$monto.'</td>
        </tr>
      ';
    }
    $message = '';
    if($suma <= 15*4050){
      $message = 'El monto es menor a 15 UIT(0.2%).';
      $impuesto = $suma*0.2/100;
    }elseif ($suma>15*4050 and $suma<=60*4050){
      $message = 'El monto es mayor a 15 UIT y menor a 60(0.6%).';
      $impuesto = $suma*0.6/100;
    }elseif($suma>60*4050){
      $message = 'El monto es mayor a 60 UIT.(1%)';
      $impuesto = $suma*1/100;
    }
    $data .= '
      <tr class="bg -warning">
        <td>Valor total de bienes: </td>
        <td>S/.'.$suma.'</td>
      </tr>
      <tr class="bg-success">
        <td>'.$message.'<br>El impuesto es: </td>
        <td>S/.<span id="monto">'.$impuesto.'</span></td>
      </tr>
      </tbody>
    </table>
  ';
  $date = date('Y');
  $sql = "SELECT * FROM	pagoimpuestopredial WHERE anioIdImpuPred = '$date' and idCont = '$rs';";
  $result = $db->query($sql);
  $sqlTrim = "SELECT * FROM	pagotrim WHERE anio = '$date' and idContribuyente = '$rs';";
  $resultTrim = $db->query($sqlTrim);
  
  $pagadoMod = false;
  if(mysqli_num_rows($result) < 1 and mysqli_num_rows($resultTrim) < 1){
    $data.='
      <div class="form-row">
        <label>Selecciona forma de pago:</label>
        <select class="form-control" onchange="cambiarFormPago()">
          <option value="2">Pago único</option>  
          <option value="1">Pago trimestral</option> 
        </select>
      </div>
    ';
    $pagadoMod = true;
  }
  if($pagadoMod){
    $data .= '
    <div class="row">
      <div class="mt-3" id="pagoUnico">
        <button class="btn btn-primary btn-block" onclick="realizarPago()">Pago único</button>
      </div>
      <div class="mt-3  d-none" id="pagoCuotas">
        <button class="btn btn-primary btn-block" onclick="realizarTrim()">Pago trimestral(Realizar primer pago)</button>
      </div>
    </div>
    
    ';
  }

  if(mysqli_num_rows($resultTrim) >= 1){
    $sqlTrim = "SELECT * FROM	pagotrim WHERE anio = '$date' and idContribuyente = '$rs' limit 1;";
    $resultTrim = $db->query($sqlTrim);
    $dates=[];
    foreach($db->while_loop($resultTrim) as $valor){
      $dates['2pago'] = $valor['2pago'];
      $dates['3pago'] = $valor['3pago'];
      $dates['4pago'] = $valor['4pago'];
    }
    $data.='<div class="container bg-dark p-1">';
    if($dates['2pago'] == ''){
      $data.='<button class="btn btn-outline-warning" onclick="realizarTrimPago(2)">Realizar 2do pago</button>';
    }else
    if($dates['3pago'] == ''){
      $data.='<button class="btn btn-outline-warning" onclick="realizarTrimPago(3)">Realizar 3er pago</button>';
    }else
    if($dates['4pago'] == ''){
      $data.='<button class="btn btn-outline-warning" onclick="realizarTrimPago(4)">Realizar 4to pago</button>';
    }else{
      $data .= '<div class="alert alert-warning">Ya se pagaron las cuatro cuotas.</div>';//link al recibo  
    }

    $data.='
        </div>
    ';
  }
  if(mysqli_num_rows($result) > 0 ){
    $data .= '<div class="alert alert-warning">Ya se realizó en un unico pago.</div>';//link al recibo
  }else{
    $data .= '';
  }



    return $data;
  }else{
    return "<div class='badge'>Sin coincidencias..</div>";
  }
}

/*Dado el dni,retorna el codigo del contribuyente*/
function get_codByDNI($DNI){
  global $db;
  $sql = "SELECT idCont FROM contribuyente WHERE DNI = '$DNI' LIMIT 1;";
  $data = [];
  $result = $db->query($sql);

  foreach($db->while_loop($result) as $valor){
    $data['idCont'] = $valor['idCont'];
  }
  
  if(sizeof($data)>0){
    return $data;
  }else{
    $data['idCont'] = "Sin coincidencias";
    return $data;
  }
}

/*Detalles de predio*/
function detailsPred_det($codigo){
  global $db;
  $sql = "SELECT
  predio.areaM2Pred,
  datosconstruccion.valorUnitarioM2,
  datosconstruccion.estadoConservacionCons,
  predio.TipoPred,
  datosconstruccion.areaCons,
  datosconstruccion.materialpred,
  datosconstruccion.anioCons,
  predio.UsoPred,
  predio.archivo,
	contribuyente.DNI,
	contribuyente.nombCont,
  EXTRACT(YEAR FROM datosconstruccion.anioCons) as anioConsD,
  predio.direccion
  FROM
  predio
  INNER JOIN datosconstruccion ON datosconstruccion.idPred = predio.idPred
	INNER JOIN contribuyente ON predio.idCont = contribuyente.idCont
	WHERE predio.idPred = '$codigo';";
  $result = $db->query($sql);

  return $result;
}
function pays(){
  global $db;
  $sql = "SELECT * FROM	impuesto;";
  $data = '
    <table class="table table-sm table-dark table-striped table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Año</th>
      </tr>
    </thead>
    <tbody>    
    ';
    $result = $db->query($sql);
    foreach($db->while_loop($result) as $valor){
      $data .= '
      <tr>
        <td>'.$valor['id'].'</td>
        <td>'.$valor['anio'].'</td>
      </tr>
      ';
    }
    $data .= '
    </tbody>
      </table>
    ';
    return $data;
}
function addPays(){
  global $db;
  $data = '';
  $date = date('Y');
  $sql = "SELECT * FROM	impuesto WHERE anio = '$date';";
  $result = $db->query($sql);
  if(mysqli_num_rows($result) > 0 ){
    $data ="<div class='alert alert-danger'>El año ya fue agregado</div>";
  }else{
    $sql = "INSERT INTO impuesto(anio) VALUES('$date');";
    $result = $db->query($sql);
    $data ="<div class='alert alert-primary'>Agregado correctamente!</div>";
    
  }
  return $data;
}
/*Dado un año retornar su id*/
function anioId($anio){
  global $db;
  $sql = "SELECT id FROM impuesto WHERE anio = '$anio' LIMIT 1;";
  $data = [];
  $result = $db->query($sql);

  foreach($db->while_loop($result) as $valor){
    $data['id'] = $valor['id'];
  }
  
  if(sizeof($data)>0){
    return $data;
  }else{
    $data['id'] = "Sin";
    return $data;
  }
}
function insertPago($anio,$monto,$dni){
  global $db;
  $cod = get_codByDNI($dni)['idCont'];
  $id = anioId($anio)['id'];
  $fecha = date('Y-m-d');
  $sql = "INSERT INTO pagoimpuestopredial(anioIdImpuPred, fechaPagoImpuPred,montoPagoImpuPred,idImpu, idcont) VALUES('$anio','$fecha','$monto','$id','$cod');";
  $result = $db->query($sql);
}

function insertPagoTrim($anio,$monto,$dni){
  global $db;
  $cod = get_codByDNI($dni)['idCont'];
  $id = anioId($anio)['id'];
  $fecha = date('Y-m-d');
  $monto = round($monto / 4, 1);
  $sql = "INSERT INTO `pagotrim` (`anio`, `1pago`, `1fecha`, `idImpuesto`, `idContribuyente`) VALUES('$anio','$monto','$fecha','$id','$cod');";
  $result = $db->query($sql);
}


function repCont($id){
  global $db;
  $sql = "SELECT * FROM pagoimpuestopredial INNER JOIN impuesto ON impuesto.id = pagoimpuestopredial.idImpu WHERE idCont='$id' ORDER BY anio desc;";
  $result = $db->query($sql);

  return $result;
}

function updatePagoTrim($anio, $monto, $dni, $num){
  global $db;
  $cod = get_codByDNI($dni)['idCont'];
  $id = anioId($anio)['id'];
  $fecha = date('Y-m-d');
  $monto = round($monto / 4, 1);
  $sql = "UPDATE `pagotrim` SET $num"."pago = '$monto',".$num."fecha = '$fecha'";
  $result = $db->query($sql);
}
function repContTrim($id){
  global $db;
  $sql = "SELECT * FROM pagotrim INNER JOIN impuesto ON impuesto.id = pagotrim.idImpuesto WHERE idContribuyente='$id' ORDER BY pagotrim.anio desc;";
  $result = $db->query($sql);

  return $result;
}

function repContTrim2($id){
  global $db;
  $id = get_codByDNI($id)['idCont'];
  $sql = "SELECT * FROM pagotrim INNER JOIN impuesto ON impuesto.id = pagotrim.idImpuesto WHERE idContribuyente='$id' ORDER BY pagotrim.anio desc;";
  $result = $db->query($sql);

  return $result;
}

function repCont2($id){
  global $db;
  $id = get_codByDNI($id)['idCont'];
  $sql = "SELECT * FROM pagoimpuestopredial INNER JOIN impuesto ON impuesto.id = pagoimpuestopredial.idImpu WHERE idCont='$id' ORDER BY anio desc;";
  $result = $db->query($sql);

  return $result;
}
?>


