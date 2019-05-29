<?php

function preferencial($monto){
    require "config.php";
$sql = "SELECT cantidad1,cantidad2,cantidad3 FROM configuracion";
$rs = $db_connect -> query($sql);
$arr=mysqli_fetch_array($rs);

list($m1, $p1) = explode("/", $arr["cantidad1"]);
list($m2, $p2) = explode("/", $arr["cantidad2"]);
list($m3, $p3) = explode("/", $arr["cantidad3"]);

if ($monto >= $m1 && $monto < $m2) {
    list($m1, $porciento) = explode("/", $arr["cantidad1"]);
    return $porciento;
} elseif ($monto >= $m2 && $monto < $m3) {
    list($m2, $porciento) = explode("/", $arr["cantidad2"]);
    return $porciento;
} elseif ($monto >= $m3) {
    list($m3, $porciento) = explode("/", $arr["cantidad3"]);
    return $porciento;
}else{

    return false;

}


}

function get_user_info($email){
    
require "config.php";

$sql = "SELECT * FROM clientes WHERE email = '$email'";
$rs = $db_connect -> query($sql);
$arr=mysqli_fetch_array($rs);
define("name",     $arr["name"]);
define("id",     $arr["id"]);
define("country_id", $arr["country"]);
define("total",     $arr["total"]);
define("status",     $arr["status"]);
define("tel",     $arr["tel"]);
define("doc_type",     $arr["doc_type"]);
define("doc_no",     $arr["doc_no"]);


//Cerrar conexion
mysqli_close($db_connect);
}

function get_country_user_data($country_id){

    require "config.php";

     $sql = "SELECT * FROM paises WHERE id = $country_id";
     $rs  = $db_connect -> query($sql);
     $arr = mysqli_fetch_array($rs);
     define("moneda_id_user",     $arr["moneda_id"]);
     $GLOBALS['code_co'] = $arr['code'];

 //Cerrar conexion
mysqli_close($db_connect);
}

function get_currency_user_data($moneda_id){

    require "config.php";

    $sql = "SELECT * FROM monedas WHERE id = $moneda_id";
    $rs  = $db_connect -> query($sql);
    $arr = mysqli_fetch_array($rs);
    $GLOBALS['code'] = $arr['code'];
    define("valor",     $arr["valor"]);
//Cerrar conexion
mysqli_close($db_connect);

}

function get_config_data(){

    require "config.php";

    $sql = "SELECT maximo,taza FROM configuracion";
    $rs  = $db_connect -> query($sql);
    $arr = mysqli_fetch_array($rs);
    define("maximo",     $arr["maximo"]);
    define("taza",     $arr["taza"]);
//Cerrar conexion
mysqli_close($db_connect);

}

function get_destinatario_info(&$id){

    require "config.php";

     $sql = "SELECT * FROM beneficiario WHERE id = $id";
     $rs  = $db_connect -> query($sql);
     $arr = mysqli_fetch_array($rs);
     $GLOBALS['country'] = $arr['country'];
     $GLOBALS['banco_des'] = $arr['banco'];


     $co = $arr['country'];

     $sql2 = "SELECT code,moneda_id FROM paises WHERE id = $co";
     $rs2 = $db_connect -> query($sql2);
     $arr2 = mysqli_fetch_array($rs2);
     $GLOBALS['moneda_id'] = $arr2['moneda_id'];
     $GLOBALS['country_de'] = $arr2['code'];

     $mid = $arr2['moneda_id'];

     $sql3 = "SELECT * FROM monedas WHERE id = '$mid'";
     $rs3 = $db_connect -> query($sql3);
     $arr3 = mysqli_fetch_array($rs3);
     $GLOBALS['moneda_des'] = $arr3['code'];
     

     //Cerrar conexion
mysqli_close($db_connect);
}

function select_validador(){

    require "config.php";

    $sql = "SELECT id FROM validadores ORDER BY RAND() LIMIT 1";
    $rs = $db_connect -> query($sql);
    $arr = mysqli_fetch_array($rs);
    $GLOBALS['validador'] = $arr['id'];

    mysqli_close($db_connect);
}