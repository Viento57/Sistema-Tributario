<?php
 $errors = array();

/*--------------------------------------------------------------*/
/* Funcion para chequear que los campos no esten en blanco
/*--------------------------------------------------------------*/
function validate_fields($var){
    global $errors;
    foreach ($var as $field) {
      $val = remove_junk($_POST[$field]);
      if(isset($val) && $val==''){
        $errors = $field ." No puede estar en blanco.";
        return $errors;
      }
    }
  }

/*--------------------------------------------------------------*/
/* Funcion para remover caracteres html
/*--------------------------------------------------------------*/
function remove_junk($str){
    $str = nl2br($str);
    $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
    return $str;
}
/*--------------------------------------------------------------*/
/* Funcion para crear una cadena aleatoria
/*--------------------------------------------------------------*/
function randString($length = 5)
{
  $str='';
  $cha = "0123456789abcdefghijklmnopqrstuvwxyz";

  for($x=0; $x<$length; $x++)
   $str .= $cha[mt_rand(0,strlen($cha))];
  return $str;
}
/*--------------------------------------------------------------*/
/* Funcion para redirijir
/*--------------------------------------------------------------*/
function redirect($url)
{
    if (headers_sent() === false)
    {
      header('Location: ' . $url);
    }

    exit();
}

/*--------------------------------------------------------------*/
/* Funcion para convertirla primera letra de una palabra a mayuscula
/*--------------------------------------------------------------*/
function first_character($str){
  $val = str_replace('-'," ",$str);
  $val = ucfirst($val);
  return $val;
}
/*--------------------------------------------------------------*/
/* Funcion para mostrar el mensaje del login
   Ex echo displayt_msg($message);
/*--------------------------------------------------------------*/
function display_msg($msg){
  $output = array();
  
  if(!empty($msg)) {
    echo "llego";
     foreach ($msg as $key => $value) {
        $output  = "<div class=\"alert alert-{$key}\">";
        $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
        $output .= remove_junk(first_character($value));
        $output .= "</div>";
     }
     return $output;
  } else {
    return "No llegó" ;
  }
}


  
?>