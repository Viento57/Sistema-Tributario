<?php 
    require("includes/funciones.php");    
    require("includes/sql.php");
    require("includes/session.php");
    $session->logout();
    $req_fields = array('usuario', 'password');
    $errors = validate_fields($req_fields);

    $username = remove_junk($_POST['usuario']);
    $password = remove_junk($_POST['password']);

    if(empty($errors)){
        
        $user = authenticate($username, $password);
        
        if(sizeof($user) >= 2){

          //Crear sesion con el id del usuario
          $session->login($user['usuaAdmi'], "user_id");
          $session->login($user['apelAdmi'], "apelAdmi");
          $session->login($user['nombAdmi'], "nombAdmi");
          redirect('administrador/administrador.php',false);  
        } else {
          $_SESSION["Error"] = "Nombre de usuario y/o contraseña incorrecto.";
        redirect('index.php',false);  
        }
      
      } else {
         $session->msg("d", $errors);
         redirect('index.php');
      }
?>