<?php session_start ();
 
 if(empty($_SESSION['user'])){ 
    header('Location: login.php');
}else{

$email=$_SESSION['user'];

date_default_timezone_set('America/Santo_Domingo'); 
include "config/int.php"; 
include "config/config.php";

$error = '';
$bien = '';

get_user_info($email);
get_country_user_data(country_id);
get_currency_user_data(moneda_id_user);
get_config_data();

$limit = valor * maximo;
$multiple = 0;
$id_c =  id;




if (isset($_FILES["fileimagen"]))
{
    if($_FILES["fileimagen"]["name"]==NULL) { 
        
       
       $error = "Cargue una imagen";
        
        }else{ 

            
            if (!($_FILES['fileimagen']['type'] == "image/jpeg" OR $_FILES['fileimagen']['type'] =="image/gif" OR $_FILES['fileimagen']['type'] =="image/jpeg" OR $_FILES['fileimagen']['type'] =="image/png")){

               
             $error = "La imagen que intentas subir tiene un formato invalido";

            }else{

            

                $temp = explode(".", $_FILES["fileimagen"]["name"]);
                $newfilename = rand(1,100000000000000) . '.' . end($temp);
                move_uploaded_file($_FILES["fileimagen"]["tmp_name"], "../verify_img/" . $newfilename);

                $sql = ("INSERT INTO verificasiones (user_id,status,imagen) VALUES ('$id_c','2','https://www.tecnoinversionesrb.com/verify_img/$newfilename')");
                $csql = $db_connect -> query($sql);


$bien = "Su solicitud de verificasion se ha enviado exitosamente. Usted recibira una respuestan de 24 a 72 horas";

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
    <link rel="icon" type="image/png" href="../admin/images/logo.png">
    <title>Tecno Inversiones RB</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->


<style>
     .sinborde {
    border: 0;
  
  }
  </style>
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            
                            <!-- Light Logo icon -->
                            <img src="assets/images/icon.png" alt="homepage" class="light-logo" width="50"/>
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                         
                         <!-- Light Logo text -->    
                         <img src="assets/images/Logo_Tecnoinversiones_Logo_Blanco.png" class="light-logo" alt="homepage" width="150"/></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->

                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="user" class="profile-pic m-r-10" /><?php $name = explode(" ",name); echo $name['0']; ?></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="index" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="perfil" aria-expanded="false"><i class="mdi mdi-account-check"></i><span class="hide-menu">Perfil</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="transferencias" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">Transferencias</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="beneficiarios" aria-expanded="false"><i class="mdi mdi-emoticon"></i><span class="hide-menu">Beneficiarios</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="logout" aria-expanded="false"><i class="mdi mdi-earth"></i><span class="hide-menu">Salir</span></a>
                        </li>
    
                    </ul>
                    
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            
            <!-- End Bottom points-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Dashboard</h3>

                    </div>
                    
                </div>


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

                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            
                                            <div class="ml-auto">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
<?php
 $sql = "SELECT * FROM verificasiones WHERE user_id = '$id_c' AND status != 1"; 
    $rs = $db_connect -> query($sql);
	$arr = mysqli_fetch_array($rs);
	
	if (mysqli_num_rows($rs)==0){
		
    ?>                                   

<form method="post" name="form" action="" enctype="multipart/form-data" role="form" data-toggle="validator" novalidate="true">

<div class="form-group">
                                      <label class="col-md-12">Documento <small><i class="mdi mdi-information-outline"></i> Cargue una imagen <b>clara</b> de su documento de identidad o pasaporte. Los datos del documento deben coinsidir con la informacion que utilizo al registrarse.</small></label>
                                      <div class="col-md-12">
                                          <input type="file" name="fileimagen" placeholder="" class="form-control form-control-line">
                                      </div>
                                  </div>

<div class="form-group">
                                      <div class="col-sm-12">
                                          <button class="btn btn-success">Enviar</button>
                                      </div>
                                  </div>
                                   </form>

    <?php }else{ ?>

    <h1>Su solicitud ya esta pendiente de revision.</h1>

    <?php } ?>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
          
                    
                </div>
                <!-- Row -->
                <!-- Row -->
            
                    <!-- Column -->
                    
                        <!-- Column -->
      
                    
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            
                </div>
                </div>
                </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"> © <?php echo date("Y"); ?> Tecno Inversiones RB </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- chartist chart -->
    <script src="assets/plugins/chartist-js/dist/chartist.min.js"></script>
    <script src="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!--c3 JavaScript -->
    <script src="assets/plugins/d3/d3.min.js"></script>
    <script src="assets/plugins/c3-master/c3.min.js"></script>
    <!-- Chart JS -->
    <script src="js/dashboard1.js"></script>
</body>

</html>
