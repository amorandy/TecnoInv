<?php session_start();
	

$error = '';

include "config/config.php";

// SUBMIT LOGIN 
if (isset($_POST['email'])){
    require_once('recaptchalib.php');
    $secret = "6LfW4V0UAAAAAJNzn66Yp24LoR3gG2tX8HaVXt_U";
    $response = null;
    $reCaptcha = new ReCaptcha($secret);
    $cap_good = 0;

$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; 
$numerodeletras=10; 
$cadena = "";
for($i=0;$i<$numerodeletras;$i++)
{
    $cadena .= substr($caracteres,rand(0,strlen($caracteres)),1); 
}

    
  $name = $db_connect->real_escape_string($_POST["name"]);
  $email = $db_connect->real_escape_string($_POST["email"]);
  $tel = $db_connect->real_escape_string($_POST["tel"]);
  $pais = $db_connect->real_escape_string($_POST["pais"]);
  $doc_type = $db_connect->real_escape_string($_POST["doc_type"]);
  $doc_no = $db_connect->real_escape_string($_POST["doc_no"]);
  $pass = $db_connect->real_escape_string (crypt($_POST["password"], $cadena));
  $pass2 = $db_connect->real_escape_string($_POST["password2"]);
  

	
	//Comprobamos que no esten vacï¿½os
  if (($name=="") || ($email=="") || ($tel=="") || ($pais=="") || ($doc_type=="") || ($doc_no=="") || ($pass=="")){
		$error = 'Llene todos los campos';
  }else{
/*
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
*/

        if (!hash_equals($pass, crypt($pass2, $pass))) {
   
            $error = "Las contraseñas no coinsiden";
          
          }else{


		
	$sql = "SELECT id FROM clientes WHERE email = '$email'"; 
    $rs = $db_connect -> query($sql);
	$arr = mysqli_fetch_array($rs);
	
	if (mysqli_num_rows($rs)>0){
		
		$error = 'El usuario que intentes registrar ya existe! Pruebe con recuperar contraseña en la pagina de login ---> <a href="login">CLICK AQUI</a>';
		
	}else{

        $ip = $_SERVER['REMOTE_ADDR'];
		
        $_GRABAR_SQL = "INSERT INTO clientes (name,email,tel,pass,country,ip,doc_type,doc_no) VALUES ('$name','$email','$tel','$pass','$pais','$ip','$doc_type','$doc_no')";  
        $db_connect -> query($_GRABAR_SQL);

        header('Location:login?re_success=1');

			  
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
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="assets/images/users/1.jpg" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="POST">
                <span id="reauth-email" class="reauth-email"></span>

<input type="text" name="name" class="form-control" id="inputEmail" placeholder="Nombre Completo" required autofocus>

                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Ingrese su Email" required>

                <input type="text" name="tel" class="form-control" id="inputEmail" placeholder="Numero de Celular" required>
                <select name="pais" class="form-control" id="inputEmail">
                <option value="">Pais de Residencia...</option>
                <?php  
$tabla23 = ("SELECT id,pais FROM paises"); 
$rs23 = $db_connect -> query($tabla23);

while ($registro = mysqli_fetch_array($rs23)) {
?> 
                                            <option value="<?php echo $registro['id']; ?>"><?php echo $registro['pais']; ?></option>

<?php } ?>

                                            </select>


                                            <br>

                                            <select name="doc_type" class="form-control" id="inputEmail">
                <option value="">Tipo de Documento...</option>

                                            <option value="Cedula">Cedula/ID</option>
                                            <option value="Pasaporta">Pasaporte</option>



                                            </select>


                                            <br>

                                            <input type="text" name="doc_no" class="form-control" id="inputEmail" placeholder="Numero de Cedula/Pasaporte" required>
                
                <input type="password" name="password" id="inputPassword" placeholder="Contraseña" class="form-control" required>

                 <input type="password" name="password2" id="inputPassword" placeholder="Repita la Contraseña" class="form-control" required>
                

<div class="g-recaptcha" data-sitekey="6LfW4V0UAAAAAM9amMTQwr7NNbfmGW3Igw_zEquP" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>



                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Registrarme!</button>
            </form><!-- /form -->
            
        </div><!-- /card-container -->
    </div><!-- /container -->
	
</body>
</html>
