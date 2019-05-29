<?php

function get_admin_info ($email){
    
    require "config.php";

$sql = "SELECT name FROM admins WHERE email = '$email'";
$rs = $db_connect -> query($sql);
$arr=mysqli_fetch_array($rs);
$GLOBALS['name'] = $arr["name"];


//Cerrar conexion
mysqli_close($db_connect);
}

function get_banco_data (){

    include "config.php";  
    $sql = "SELECT SUM(monto_usd) AS total FROM transfers WHERE DATE(date) >= '".date("Y-m-d")."' AND DATE(date) <= '".date("Y-m-d")."' AND status='2' OR status = '3'";
    $rs = $db_connect -> query($sql);
    $arr1=mysqli_fetch_array($rs);

    $sql = "SELECT SUM(monto_local) AS total FROM transfers WHERE DATE(date) >= '".date("Y-m-d")."' AND DATE(date) <= '".date("Y-m-d")."' AND currency ='DOP' AND status='2' OR status = '3'";
    $rs = $db_connect -> query($sql);
    $arr2=mysqli_fetch_array($rs);


    define("total",       $arr1["total"]);
    define("totaldop",       $arr2["total"]);

}

function get_billetera_data (){

    include "config.php";  
    $sql = "SELECT SUM(monto_usd) AS total FROM billeteras_trans WHERE DATE(date) >= '".date("Y-m-d")."' AND DATE(date) <= '".date("Y-m-d")."'";
    $rs = $db_connect -> query($sql);
    $arr1=mysqli_fetch_array($rs);

    $sql = "SELECT SUM(monto_local) AS total FROM billeteras_trans WHERE DATE(date) >= '".date("Y-m-d")."' AND DATE(date) <= '".date("Y-m-d")."'";
    $rs = $db_connect -> query($sql);
    $arr2=mysqli_fetch_array($rs);


    define("total",       $arr1["total"]);
    define("totalb",       $arr2["total"]);

}

function get_billetera_data_es ($id){

    include "config.php";  
    $sql = "SELECT SUM(monto_usd) AS total FROM billeteras_trans WHERE DATE(date) >= '".date("Y-m-d")."' AND DATE(date) <= '".date("Y-m-d")."' AND billetera_id='$id'";
    $rs = $db_connect -> query($sql);
    $arr1=mysqli_fetch_array($rs);

    $sql = "SELECT SUM(monto_local) AS total FROM billeteras_trans WHERE DATE(date) >= '".date("Y-m-d")."' AND DATE(date) <= '".date("Y-m-d")."' AND billetera_id='$id'";
    $rs = $db_connect -> query($sql);
    $arr2=mysqli_fetch_array($rs);


    define("total",       $arr1["total"]);
    define("totalb",       $arr2["total"]);

}

function get_index_week_data (){

    require "config.php";

    $sql11 = "SELECT taza FROM configuracion";
    $rs11 = $db_connect -> query($sql11);
    $arr11=mysqli_fetch_array($rs11);

    //Transferencias pendientes
    $sql = "SELECT id FROM transfers WHERE DATE(date) >= '".date("Y-m-d")."' AND DATE(date) <= '".date("Y-m-d")."' AND status='6'";
    $rs1 = $db_connect -> query($sql);
    //-----------------------------------------

      //Transferencias validando
      $sql = "SELECT id FROM transfers WHERE DATE(date) >= '".date("Y-m-d")."' AND DATE(date) <= '".date("Y-m-d")."' AND status='1'";
      $rs2 = $db_connect -> query($sql);
      //-----------------------------------------

        //Transferencias completas
        $sql = "SELECT id FROM transfers WHERE DATE(date) >= '".date("Y-m-d")."' AND DATE(date) <= '".date("Y-m-d")."' AND status='3'";
        $rs7 = $db_connect -> query($sql);
        //-----------------------------------------

                //Transferencias operando
                $sql = "SELECT id FROM transfers WHERE DATE(date) >= '".date("Y-m-d")."' AND DATE(date) <= '".date("Y-m-d")."' AND status='2'";
                $rs8 = $db_connect -> query($sql);
                //-----------------------------------------

    $sql11 = "SELECT SUM(monto_local) AS total FROM transfers WHERE DATE(date) >= '".date("Y-m-d")."' AND DATE(date) <= '".date("Y-m-d")."' AND currency ='DOP'";
    $rs11 = $db_connect -> query($sql11);
    $arr1=mysqli_fetch_array($rs11);
    //-----------------------------------------
    $sql = "SELECT SUM(monto_usd) AS total FROM transfers WHERE DATE(date) >= '".date("Y-m-d")."' AND DATE(date) <= '".date("Y-m-d")."'";
    $rs = $db_connect -> query($sql);
    $arr=mysqli_fetch_array($rs);
    //-----------------------------------------
    $sql = "SELECT id FROM clientes WHERE DATE(date) >= '".date("Y-m-d", strtotime ("-7days"))."' AND DATE(date) <= '".date("Y-m-d")."'";
    $rs = $db_connect -> query($sql);

    /************************************************ */
    define("total_client",     mysqli_num_rows($rs));
    define("total_operando",     mysqli_num_rows($rs2));
    define("total_validando",     mysqli_num_rows($rs2));
    define("total_completa",     mysqli_num_rows($rs7));
    define("totalsum",     $arr["total"]);
    define("totalsumdop",     $arr1["total"]);
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
    define("monto_des", $arr["monto_des"]);
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

function sendMassMessage ($titulo,$contenido){
    
    require "config.php";

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

    $sql = "SELECT name,email FROM clientes";
    $rs = $db_connect -> query($sql);

    foreach ($rs as $row) {
        $mail->addAddress($row['email'], $row['name']);

        if (!$mail->send()) {
           
            return false;
            break; //Abandon sending
        
        } else {
            
         return true;
   
        $mail->clearAddresses();
        $mail->clearAttachments();
    }
//Cerrar conexion
mysqli_close($db_connect);
}

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
