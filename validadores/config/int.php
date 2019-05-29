<?php

function get_validador_info ($email){
    
require "config.php";

$sql = "SELECT id,name FROM validadores WHERE email = '$email'";
$rs = $db_connect -> query($sql);
$arr=mysqli_fetch_array($rs);
define("name",     $arr["name"]);
define("idv",     $arr["id"]);


//Cerrar conexion
mysqli_close($db_connect);
}

function generar_registro($idtran,$tipo,$name){


    require "config.php";

    $sql = ("INSERT INTO registros (user,tipo,transfer_id) VALUES ('$name','$tipo','$idtran')");
    $csql = $db_connect -> query($sql);

}


function get_index_week_data ($id){

    require "config.php";

    $sql11 = "SELECT taza FROM configuracion";
    $rs11 = $db_connect -> query($sql11);
    $arr11=mysqli_fetch_array($rs11);

    $sql = "SELECT id FROM transfers WHERE DATE(date) >= '".date("Y-m-d", strtotime ("-7days"))."' AND DATE(date) <= '".date("Y-m-d")."' AND validador_id = '$id'";
    $rs1 = $db_connect -> query($sql);
    //-----------------------------------------
    $sql = "SELECT SUM(monto_usd) AS total FROM transfers WHERE DATE(date) >= '".date("Y-m-d", strtotime ("-7days"))."' AND DATE(date) <= '".date("Y-m-d")."' AND validador_id='$id'";
    $rs = $db_connect -> query($sql);
    $arr=mysqli_fetch_array($rs);
    //-----------------------------------------
    $sql = "SELECT SUM(monto_usd) AS total FROM transfers WHERE DATE(date) >= '".date("Y-m-d", strtotime ("-7days"))."' AND DATE(date) <= '".date("Y-m-d")."' AND validador_id='$id'";
    $rs = $db_connect -> query($sql);
    $arr=mysqli_fetch_array($rs);

    /************************************************ */
    define("totalsum",     $arr["total"]);
    define("total",     mysqli_num_rows($rs1));
    define("taza",     $arr11["taza"]);


  

//Cerrar conexion
mysqli_close($db_connect);
}

function register_validador($name,$email,$password,$status){

require "config.php";

    $sql = ("INSERT INTO validadores (name,email,password,status) VALUES ('$name','$email','".password_hash($password, PASSWORD_DEFAULT)."','$status')");
    $csql = $db_connect -> query($sql);

  if (mysqli_connect_errno())
  {
    
    $error = 'Algo ha salido mal';
  
    }else{

  return true;
  }

//Cerrar conexion
mysqli_close($db_connect);
}

function update_validador($name,$email,$password,$status,$id){

    require "config.php";

    $sql = ("UPDATE validadores SET name='$name',email='$email',password='".password_hash($password, PASSWORD_DEFAULT)."',status='$status' WHERE id= '$id' ");
    $csql = $db_connect -> query($sql);  

    return true;
    
//Cerrar conexion
mysqli_close($db_connect);
}

function register_admins ($name,$email,$password,$status){

    require "config.php";

    $sql = ("INSERT INTO admins (name,email,password,status) VALUES ('$name','$email','".password_hash($password, PASSWORD_DEFAULT)."','$status')");
    $csql = $db_connect -> query($sql);

  if (mysqli_connect_errno())
  {
    
    $error = 'Algo ha salido mal';
  
    }else{

  return true;
  }

//Cerrar conexion
mysqli_close($db_connect);
}

function update_admins($name,$email,$password,$status,$id){

    require "config.php";

    $sql = ("UPDATE admins SET name='$name',email='$email',password='".password_hash($password, PASSWORD_DEFAULT)."',status='$status' WHERE id= '$id' ");
    $csql = $db_connect -> query($sql);  

    return true;
    
//Cerrar conexion
mysqli_close($db_connect);
}


function get_users_data ($id){

    require "config.php";

    $sql = "SELECT * FROM clientes WHERE id = '$id'";
    $rs = $db_connect -> query($sql);
    $arr=mysqli_fetch_array($rs);


    /************************************************ */
    define("name",       $arr["name"]);
    define("email",      $arr["email"]);
    define("tel",        $arr["tel"]);
    define("doc_type",   $arr["doc_type"]);
    define("doc_no",     $arr["doc_no"]);
    define("status",     $arr["status"]);
    define("imagen_doc", $arr["imagen_doc"]);


  

//Cerrar conexion
mysqli_close($db_connect);
}

function get_transaction_info ($id){

    require "config.php";

    $sql = "SELECT * FROM transfers WHERE id = '$id'";
    $rs = $db_connect -> query($sql);
    $arr=mysqli_fetch_array($rs);


    /************************************************ */
    define("tracker",    $arr["tracker"]);
    define("send_to",    $arr["send_to"]);
    define("send_from",  $arr["send_from"]);
    define("date",       $arr["date"]);
    define("date_update", $arr["date_update"]);
    define("date_recibo", $arr["date_recibo"]);
    define("operador_id", $arr["operador_id"]);
    define("validador_id", $arr["validador_id"]);
    define("monto_usd", $arr["monto_usd"]);
    define("monto_local", $arr["monto_local"]);
    define("currency", $arr["currency"]);
    define("currency_des", $arr["currency_des"]);
    define("status", $arr["status"]);
    define("imagen", $arr["imagen"]);
    define("note", $arr["note"]);
    define("banco_id", $arr["banco_id"]);
    define("recibo", $arr["recibo"]);
    define("cliente_id", $arr["cliente_id"]);
    define("des_id", $arr["des_id"]);
    define("taza", $arr["taza"]);
    define("pais_dep", $arr["pais_dep"]);
    define("banco_dep", $arr["banco_dep"]);

//Cerrar conexion
mysqli_close($db_connect);
}


use PHPMailer\PHPMailer\PHPMailer;

function sendMessage ($id,$mid){
    
    require "config.php";

    $sql = "SELECT name,email FROM clientes WHERE id = '$id'";
    $rs = $db_connect -> query($sql);
    $arr=mysqli_fetch_array($rs);
    $name = $arr["name"];
    $email = $arr["email"];


    $sql1 = "SELECT titulo,mensaje FROM mensajes WHERE id = '$mid'";
    $rs1 = $db_connect -> query($sql1);
    $arr1=mysqli_fetch_array($rs1);
    $titulo = $arr1['titulo'];
    $contenido = $arr1['mensaje'];

    error_reporting(E_STRICT | E_ALL);
    date_default_timezone_set('America/Santo_Domingo');
    require 'vendor/autoload.php';
    require 'contents.php';
    $mail = new PHPMailer;
    $body = $html;
    $mail->isSMTP();
    $mail->Host = 'tecnoinversionesrb.com';
    $mail->SMTPAuth = false;
    $mail->SMTPKeepAlive = false;
    $mail->Port = 25;
    $mail->Username = 'info@tecnoinversionesrb.com';
    $mail->Password = 'shamuel2290';
    $mail->setFrom('info@tecnoinversionesrb.com', 'Tecno Inversiones RB');
    $mail->addReplyTo('info@tecnoinversionesrb.com', 'Tecno Inversiones RB');
    $mail->Subject = "$titulo";
    $mail->msgHTML($body);
    $mail->AltBody = '$contenido';
    
        $mail->addAddress("$email","$name");
       
        if (!$mail->send()) {
        
            return false;
    
        } else {
        
            return true;
            
        $mail->clearAddresses();
        $mail->clearAttachments();
    }
//Cerrar conexion
mysqli_close($db_connect);
}


function sendMessageCan ($id,$contenido){
    
    require "config.php";

    $sql = "SELECT name,email FROM clientes WHERE id = '$id'";
    $rs = $db_connect -> query($sql);
    $arr=mysqli_fetch_array($rs);
    $name = $arr["name"];
    $email = $arr["email"];

    error_reporting(E_STRICT | E_ALL);
    date_default_timezone_set('America/Santo_Domingo');
    require 'vendor/autoload.php';
    require 'contents.php';
    $mail = new PHPMailer;
    $body = $html;
    $mail->isSMTP();
    $mail->Host = 'tecnoinversionesrb.com';
    $mail->SMTPAuth = false;
    $mail->SMTPKeepAlive = false;
    $mail->Port = 25;
    $mail->Username = 'info@tecnoinversionesrb.com';
    $mail->Password = 'shamuel2290';
    $mail->setFrom('info@tecnoinversionesrb.com', 'Tecno Inversiones RB');
    $mail->addReplyTo('info@tecnoinversionesrb.com', 'Tecno Inversiones RB');
    $mail->Subject = "Se ha cancelado su transaccion";
    $mail->msgHTML($body);
    $mail->AltBody = '$contenido';
    
        $mail->addAddress("$email","$name");
       
        if (!$mail->send()) {
        
            return false;
    
        } else {
        
            return true;
            
        $mail->clearAddresses();
        $mail->clearAttachments();
    }
//Cerrar conexion
mysqli_close($db_connect);
}

function sendMessageErr ($id,$contenido){
    
    require "config.php";

    $sql = "SELECT name,email FROM clientes WHERE id = '$id'";
    $rs = $db_connect -> query($sql);
    $arr=mysqli_fetch_array($rs);
    $name = $arr["name"];
    $email = $arr["email"];

    error_reporting(E_STRICT | E_ALL);
    date_default_timezone_set('America/Santo_Domingo');
    require 'vendor/autoload.php';
    require 'contents.php';
    $mail = new PHPMailer;
    $body = $html;
    $mail->isSMTP();
    $mail->Host = 'tecnoinversionesrb.com';
    $mail->SMTPAuth = false;
    $mail->SMTPKeepAlive = false;
    $mail->Port = 25;
    $mail->Username = 'info@tecnoinversionesrb.com';
    $mail->Password = 'shamuel2290';
    $mail->setFrom('info@tecnoinversionesrb.com', 'Tecno Inversiones RB');
    $mail->addReplyTo('info@tecnoinversionesrb.com', 'Tecno Inversiones RB');
    $mail->Subject = "Su transferencia tiene un error";
    $mail->msgHTML($body);
    $mail->AltBody = '$contenido';
    
        $mail->addAddress("$email","$name");
       
        if (!$mail->send()) {
        
            return false;
    
        } else {
        
            return true;
            
        $mail->clearAddresses();
        $mail->clearAttachments();
    }
//Cerrar conexion
mysqli_close($db_connect);
}


function sendMassPush($mensaje) {
    $content      = array(
        "en" => $mensaje
    );
    $hashes_array = array();

    $fields = array(
        'app_id' => "4e79cd0f-2635-48d1-bcfa-65f0ac60fd6c",
        'included_segments' => array(
            'All'
        ),
        'data' => array(
            "foo" => "bar"
        ),
        'contents' => $content,
        'web_buttons' => $hashes_array
    );
    
    $fields = json_encode($fields);
    //print("\nJSON sent:\n");
    //print($fields);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic NDBjY2U2YzAtOWE4Yi00ZDVlLWI2NmEtODE3Y2VlMGJkMDk2'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return true;
}
