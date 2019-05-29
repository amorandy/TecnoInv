<?php session_start();

$register = '';

if(isset($_GET['re_success'])){

    $register = "Se ha registado con exito! Por favor inicie sesion para realizar su primera transferencia";
}

if (isset($_SESSION['user'])){
	header('Location:index.php');
}else{
	

$error = '';

include "config/config.php";

// SUBMIT LOGIN 
if (isset($_POST['email'])){
    require_once('recaptchalib.php');
    $secret = "6LfW4V0UAAAAAJNzn66Yp24LoR3gG2tX8HaVXt_U";
    $response = null;
    $reCaptcha = new ReCaptcha($secret);
    $cap_good = 0;

    

  $user = $db_connect->real_escape_string($_POST["email"]);
  $pass = $db_connect->real_escape_string($_POST["password"]);
  

	
	//Comprobamos que no esten vacï¿½os
  if (($user=="") || ($pass=="")){
		$error = 'Llene ambos campos';
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


		
	$sql = "SELECT id FROM clientes WHERE email = '$user'"; 
    $rs = $db_connect -> query($sql);
	$arr = mysqli_fetch_array($rs);
	
	if (mysqli_num_rows($rs)==0){
		
		$error = 'El usuario no esta registrado';
		
	}else{
		
			   $sql = "SELECT email,pass FROM clientes WHERE email = '$user'";
			    $rs = $db_connect -> query($sql);
				$arr = mysqli_fetch_array($rs);
				$username = $arr['email'];
				$password = $arr['pass'];
				
				
if(!function_exists('hash_equals')) {
  function hash_equals($str1, $str2) {
    if(strlen($str1) != strlen($str2)) {
      return false;
    } else {
      $res = $str1 ^ $str2;
      $ret = 0;
      for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
      return !$ret;
    }
  }
}

if (!hash_equals($password, crypt($pass, $password))) {
   
  $error = 'Contraseña incorrecta';

}else{
				

		

		
		$sql = "SELECT * FROM clientes WHERE email='$user'";
			$rs = $db_connect -> query($sql);
				$arr = mysqli_fetch_array($rs);
				$username = $arr['email'];
			  
			  $_SESSION["user"]=$username;
			  header('Location: index');
			  
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
if ($register != '') {
?>
<div class="alert alert-success alert-dismissable">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                                            <?php echo $register; ?>
	                                        </div>
<?php } ?>
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="assets/images/users/1.jpg" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Ingrese su Email" required autofocus>
                <input type="password" name="password" id="inputPassword" placeholder="Contraseña" class="form-control" required>
                

<div class="g-recaptcha" data-sitekey="6LfW4V0UAAAAAM9amMTQwr7NNbfmGW3Igw_zEquP" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>



                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Entrar</button>
            </form><!-- /form -->
            <a href="losspass" class="forgot-password">
                Perdio su contraseña?
            </a>

             <a href="registro" class="forgot-password">
                No tiene una cuenta?
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
	
</body>
</html>
