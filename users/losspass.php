<?php session_start();

if (isset($_SESSION['user'])){
	header('Location:index.php');
}else{
	

$error = '';
$bien = '';

include "config/config.php";

// SUBMIT LOGIN 
if (isset($_POST['email'])){
    
     require_once('recaptchalib.php');
    $secret = "6LfW4V0UAAAAAJNzn66Yp24LoR3gG2tX8HaVXt_U";
    $response = null;
    $reCaptcha = new ReCaptcha($secret);
    $cap_good = 0;
    
    
  $user = $db_connect->real_escape_string($_POST["email"]);
  
    $sql = "SELECT * FROM clientes WHERE email = '$user'"; 
    $rs = $db_connect -> query($sql);
	$arr = mysqli_fetch_array($rs);
	$status = $arr['status'];
	$name = $arr['name'];
	
	//Comprobamos que no esten vacï¿½os
  if (($user=="")){
		$error = 'Debe colocar su email';
  }else{
	  
	  
	     if ($_POST["g-recaptcha-response"]) {
        $response = $reCaptcha->verifyResponse(
            $_SERVER["REMOTE_ADDR"],
            $_POST["g-recaptcha-response"]
        );
    }

    if ($response != null && $response->success) {
       $cap_good = 1;
      }

      if ($cap_good == 0) {
        $error = "No has pasado la validacion de seguridad";
       }else{
	  
		
	$sql = "SELECT * FROM clientes WHERE email = '$user'"; 
    $rs = $db_connect -> query($sql);
	$arr = mysqli_fetch_array($rs);
	
	if (mysqli_num_rows($rs)==0){
		
		$error = 'El usuario no esta registrado';
		
	}else{
		
			 

		
if($status == 2 or $status == 3) {
		
	$error = 'Su cuenta no esta activa o fue suspendida';	
		
	}else{
		
$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz"; 
$numerodeletras=8; 
$cadena = "";
for($i=0;$i<$numerodeletras;$i++)
{
    $cadena .= substr($caracteres,rand(0,strlen($caracteres)),1); 
}		
		
$sql = "UPDATE clientes SET pass='".crypt($cadena)."' WHERE email='$user'";
$rs = $db_connect -> query($sql);

$to = "$user";
$subject = "Su nueva contraseña";
$message = "Estimado $name\nUsted ha solicitado una nueva contraseña. La nueva contraseña es: $cadena\n\nSi usted no ha solicitado esto, pongase en contacto de inmediato con su agente de cuentas\n\nSaludos Cordiales\nEquipo de TecnoInversiones";
$from = "Tecno Inversiones <noreply@tecnoinversionesrb.com>";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);

$bien = "Te hemos enviado tu nueva contraseña al email";
			  
	}
	}
	}
	}
}
	
	
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">

    <title>Tecno Inversiones RB - Login</title>
    <link rel="manifest" href="manifest.json" />
    <link rel="icon" type="image/png" href="../admin/images/logo.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="assets/form.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    
    <script type="text/javascript">function add_chatinline(){var hccid=96449334;var nt=document.createElement("script");nt.async=true;nt.src="https://mylivechat.com/chatinline.aspx?hccid="+hccid;var ct=document.getElementsByTagName("script")[0];ct.parentNode.insertBefore(nt,ct);}
add_chatinline(); </script>
</head>
<body>
	<!--
    you can substitue the span of reauth email for a input with the email and
    include the remember me checkbox
    -->
    <div class="container">




        <div class="card card-container">


        <?php
if ($error != '') {
?>
<div class="alert alert-danger alert-dismissable">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                                            <?php echo $error; ?>
	                                        </div>
<?php } ?>


        <?php
if ($bien != '') {
?>
<div class="alert alert-success alert-dismissable">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                                            <?php echo $bien; ?>
	                                        </div>
<?php } ?>
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <div class="alert alert-success alert-dismissable">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                                            Ingresa el email con el que te registraste.
	                                        </div>
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Ingrese su Email" required autofocus>
             
                

<div class="g-recaptcha" data-sitekey="6LfW4V0UAAAAAM9amMTQwr7NNbfmGW3Igw_zEquP" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>



                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Enviar</button>
            </form><!-- /form -->
            <a href="login" class="forgot-password">
                Ir al login
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
	
</body>
</html>
