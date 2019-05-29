<?php session_start ();
 
 if(empty($_SESSION['user'])){ 
    header('Location: login');
}else{

$email=$_SESSION['user'];

date_default_timezone_set('America/Santo_Domingo'); 
include "config/int.php"; 
include "config/config.php";

get_user_info($email);
get_country_user_data(country_id);
get_currency_user_data(moneda_id_user);
get_config_data();

$limit = valor * maximo;

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

<link rel="manifest" href="/manifest.json" />
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  var OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "f1f8a13f-74b8-4389-92b9-2f42007563e6",
    });
  });
</script>
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
                    <a class="navbar-brand" href="index">
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
                        <li> <a class="waves-effect waves-dark" href="hacer_transferencia" aria-expanded="false"><i class="mdi mdi-emoticon"></i><span class="hide-menu">Hacer Transferencia</span></a>
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
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Ultimas transacciones</h3>
                                               </div>
                                            <div class="ml-auto">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                    <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Beneficiario</th>
                                                <th>Monto</th>
                                                <th>Fecha</th>
                                                <th>Recibo</th>
                                                <th>Estatus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php  
$id = id;
$tabla23 = ("SELECT * FROM transfers WHERE cliente_id = $id ORDER BY id DESC LIMIT 6"); 
$rs23 = $db_connect -> query($tabla23);

while ($registro = mysqli_fetch_array($rs23)) {  

    $tabla = ("SELECT name FROM beneficiario WHERE id = '".$registro['des_id']."'");
    $rs = $db_connect -> query($tabla);
    $arr = mysqli_fetch_array($rs);

?>
                                            <tr <?php if($registro['preferencial']==1){?>style="background-color: #27c77626;"<?php } ?> >
                                                <td><?php echo $registro['id']; ?></td>
                                                <td><?php echo $arr['name']; ?></td>
<td><?php echo $registro['currency_des']; ?> <?php echo number_format($registro['monto_des'], 2); ?> <?php if($registro['preferencial']==1){?> <span class="label label label-success">Preferencial</span> <?php } ?></td>
                                                <td><?php echo $registro['date']; ?></td>
                                                <td><?php if($registro['operador_imagen'] != null){ ?> <a target="_blank" href="<?php echo $registro['operador_imagen']; ?>"><span class="label label label-success sweet-html">Ver</span></a><?php }else{ ?> No disponible <?php } ?></td>
                                                <td> <?php if($registro['status'] == 1){ ?>
			                        <span class="label label label-success">Validando</span>
								  <?php } ?>
								  <?php if($registro['status'] == 2){ ?>
			                        <span class="label label label-info">Transfiriendo</span>
								  <?php } ?>
								  <?php if($registro['status'] == 3){ ?>
			                        <span class="label label label-success">Completado</span>
								  <?php } ?>
								   <?php if($registro['status'] == 4){ ?>
			                        <span class="label label label-danger">Cancelado</span>
								  <?php } ?>
                                  <?php if($registro['status'] == 5){ ?>
			                        <span class="label label label-danger">Error</span>
								  <?php } ?>
                                  <?php if($registro['status'] == 6){ ?>
			                        <span class="label label label-warning">Esperando</span>
								  <?php } ?>
								   </td>
                                            </tr>


<?php } ?> 


                                           
                                        </tbody>
                                    </table>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5">
                        <div class="card">
                            <div class="card-block">
                                <h3 class="card-title">Enviar dinero </h3>
                                <h6 class="card-subtitle">Estas listo para enviar Felicidad? <i class="fa fa-smile-o font-10 m-r-10 " style="font-size: 17px;"></i></h6>
                                <a href="hacer_transferencia" class="m-t-10 btn btn-primary btn-md btn-rounded">Hacer una Transferencia</a>
                            </div>
                            <div>
                                <hr class="m-t-0 m-b-0">
                            </div>
                            <div class="card-block text-center ">
                            <?php if(status != 3){ ?> Su limite de envio es: <b><?php echo $code; ?> <?php echo number_format($limit,2); ?></b><br>
                            Piensa enviar mas? Verifique su cuenta y elimine estos limites. <a href="verificar">Velificar Ahora</a> <?php }else{ ?><img src="im/veri.png" width="25"> Verificado <?php } ?>
                            </div>
                            <div>
                                <hr class="m-t-0 m-b-0">
                            </div>
                            <div class="card-block text-center ">
                            <h3>Tasa del Dia <br><?php echo number_format(taza, 2);?></h3>
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

    
    <script src="js/lib/sweetalert/sweetalert.min.js"></script>
    <!-- scripit init-->


<style>
.swal-wide{
    width:660px !important;
    height: 660px !important;

}
</style>
</body>

</html>
