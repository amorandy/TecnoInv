<?php session_start();

if (isset($_SESSION['username'])){
	header('Location:index.php');
}else{
	

$error = '';

include "config/config.php";

// SUBMIT LOGIN 
if (isset($_POST['email'])){
  $user = $db_connect->real_escape_string($_POST["email"]);
  $pass = $db_connect->real_escape_string($_POST["password"]);
  

	
	//Comprobamos que no esten vacï¿½os
  if (($user=="") || ($pass=="")){
		$error = 'Llene ambos campos';
  }else{
	  

	 
	  
		
	$sql = "SELECT * FROM admins WHERE email = '$user'"; 
    $rs = $db_connect -> query($sql);
	$arr = mysqli_fetch_array($rs);
	
	if (mysqli_num_rows($rs)==0){
		
		$error = 'El usuario no esta registrado';
		
	}else{
		
			   $sql = "SELECT * FROM admins WHERE email = '$user'";
			    $rs = $db_connect -> query($sql);
				$arr = mysqli_fetch_array($rs);
				$username = $arr['email'];
				$password = $arr['password'];
				
				
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
				

		

		
		$sql = "SELECT * FROM admins WHERE email='$user'";
			$rs = $db_connect -> query($sql);
				$arr = mysqli_fetch_array($rs);
				$username = $arr['email'];
			  
			  $_SESSION["username"]=$username;
			  header('Location: index');
			  
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>Tecno Inversiones RB - Admin</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">

        <div class="unix-login">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-4">

<?php
if ($error != '') {
?>
<div class="alert alert-danger alert-dismissable">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                                            <?php echo $error; ?>
	                                        </div>
<?php } ?>


                        <div class="login-content card">
                            <div class="login-form">
                                <h4>Login</h4>
                                <form method="post">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label>Contraseña</label>
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="checkbox">
                                        <label>
        										<input type="checkbox"> Recuerdame
        									</label>
                               

                                    </div>
                                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Entrar</button>
                                   
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script src="js/lib/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>

</body>

</html>