<?php
require_once("constants.php");


class MySqli_DB {

    private $con;
    public $query_id;

    function __construct() {
      $this->db_connect();
    }

/*--------------------------------------------------------------*/
/* Funcion para abrir la conexion a la base de datos
/*--------------------------------------------------------------*/
public function db_connect()
{
  $this->con = mysqli_connect(HOST,USER,PASS);
  mysqli_set_charset($this->con,"UTF8");
  if(!$this->con)
         {
           die(" Database connection failed:". mysqli_connect_error());
         } else {
           $select_db = $this->con->select_db(DB);
             if(!$select_db)
             {
               die("Failed to Select Database". mysqli_connect_error());
             }
         }
}
/*--------------------------------------------------------------*/
/* Funcion para cerrar la conexion a la base de datos
/*--------------------------------------------------------------*/

public function db_disconnect()
{
  if(isset($this->con))
  {
    mysqli_close($this->con);
    unset($this->con);
  }
}
/*--------------------------------------------------------------*/
/* Funcion para ejecutar un query
/*--------------------------------------------------------------*/
public function query($sql)
   {

      if (trim($sql != "")) {
          $this->query_id = $this->con->query($sql);
      }
      if (!$this->query_id)
        // Solo para desarrollo
            die("Error en esta consulta :<pre> " . $sql ."</pre>");
       // Solo para produccion
        //  die("Error en Query");

       return $this->query_id;

   }

/*--------------------------------------------------------------*/
/* Funciones para querys
/*--------------------------------------------------------------*/
public function fetch_array($statement)
{
  return mysqli_fetch_array($statement);
}
public function fetch_object($statement)
{
  return mysqli_fetch_object($statement);
}
public function fetch_assoc($statement)
{
  return mysqli_fetch_assoc($statement);
}
public function num_rows($statement)
{
  return mysqli_num_rows($statement);
}
public function insert_id()
{
  return mysqli_insert_id($this->con);
}
public function affected_rows()
{
  return mysqli_affected_rows($this->con);
}
/*--------------------------------------------------------------*/
 /* Funcion para remover escapes especiales
 /* en una cadena para usar en una consulta mysql
 /*--------------------------------------------------------------*/
 public function escape($str){
   return $this->con->real_escape_string($str);
 }
/*--------------------------------------------------------------*/
/* Funcion para ciclos
/*--------------------------------------------------------------*/
public function while_loop($loop){
 global $db;
   
   $results = array();
   while ($result = $this->fetch_array($loop)) {
      $results[] = $result;
   }
 return $results;
}

}

$db = new MySqli_DB();

?>