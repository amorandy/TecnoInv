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
$iduser = id;

if (isset( $_POST['name']))
{
    if($_POST['name']==NULL|$_POST['email']==NULL|$_POST['tel']==NULL|$_POST['doc_type']==NULL|$_POST['doc_no']==NULL|$_POST['pais']==NULL|$_POST['banco']==NULL|$_POST['cuenta_no']==NULL) { 
        
       
       $error = "Todos los campos son obligatorios";
        
        }else{ 
            $name = $_POST['name'];
            $email = $_POST['email'];
            $tel = $_POST['tel'];
            $pais = $_POST['pais'];
            $banco = $_POST['banco'];
            $cuenta = $_POST['cuenta_no'];

            $doc_type = $_POST['doc_type'];
            $doc_no = $_POST['doc_no'];


            $sql = ("INSERT INTO beneficiario (name,email,tel,country,banco,no_cuenta,doc_type,doc_no,cliente_id) VALUES ('$name','$email','$tel','$pais','$banco','$cuenta','$doc_type','$doc_no','$iduser')");
            $csql = $db_connect -> query($sql);

            $bien = "Se ha registrado un nuevo beneficiario con exito";


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
                        <h3 class="text-themecolor m-b-0 m-t-0">Perfil</h3>
                        
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
                    <!-- Column -->

                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                    <div class="alert alert-warning alert-dismissable">
                                  <i class="mdi mdi-information-outline"></i> Asegurse de ingresar los datos con cuidados, recuerde que usaremos estos datos para las transferencias.
                                </div>
                        <div class="card">
                            <div class="card-block">
                                <form class="form-horizontal form-material" method="POST">
                                    <div class="form-group">
                                        <label class="col-md-12">Nombre Completo</label>
                                        <div class="col-md-12">
                                            <input type="text" name="name" class="form-control form-control-line" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="text" name="email" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-12">Telefono</label>
                                        <div class="col-md-12">
                                            <input type="text" name="tel" class="form-control form-control-line" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Tipo de Documento</label>
                                        <div class="col-md-12">
                                        <select name="doc_type" class="form-control form-control-line">

                                            <option value="Cedula de Identidad">Cédula de Identidad</option>
                                            <option value="Pasaporte">Pasaporte</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Numero de Documento</label>
                                        <div class="col-md-12">
                                            <input type="text" name="doc_no" class="form-control form-control-line" value="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12">Pais de Destino</label>
                                        <div class="col-md-12">
                                            <select name="pais" class="form-control form-control-line">
<?php  
$tabla23 = ("SELECT id,pais FROM paises"); 
$rs23 = $db_connect -> query($tabla23);

while ($registro = mysqli_fetch_array($rs23)) {
?> 
                                            <option value="<?php echo $registro['id']; ?>"><?php echo $registro['pais']; ?></option>

<?php } ?>

                                            </select>
                                        </div>
                                    </div>

 <div class="form-group">
                                        <label class="col-md-12">Banco</label>
                                        <div class="col-md-12">
                                            <select name="banco" class="form-control form-control-line">
<?php  
$tabla23 = ("SELECT id,nombre FROM banco"); 
$rs23 = $db_connect -> query($tabla23);

while ($registro = mysqli_fetch_array($rs23)) {
?> 
                                            <option value="<?php echo $registro['id']; ?>"><?php echo $registro['nombre']; ?></option>

<?php } ?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Numero de Cuenta</label>
                                        <div class="col-md-12">
                                            <input type="text" name="cuenta_no" class="form-control form-control-line" value="">
                                        </div>
                                    </div>

                                                        <div class="alert alert-warning alert-dismissable">
                                  <i class="mdi mdi-information-outline"></i> Revise cuidadosamente la información que ingresó. Esto es muy importante para evitar problemas futuros.
                                </div>
                           
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success">Crear Beneficiario</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


<div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Beneficiarios Agregados</h3>
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
                                                <th>Nombre</th>
                                                <th>Banco</th>
                                                <th>No. Cuenta</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php  
$id = id;
$tabla23 = ("SELECT * FROM beneficiario WHERE cliente_id = '$iduser'"); 
$rs23 = $db_connect -> query($tabla23);

while ($registro = mysqli_fetch_array($rs23)) {  

    $tabla = ("SELECT nombre FROM banco WHERE id = '".$registro['banco']."'");
    $rs = $db_connect -> query($tabla);
    $arr = mysqli_fetch_array($rs);

?>
                                            <tr>
                                                <td><?php echo $registro['id']; ?></td>
                                                <td><?php echo $registro['name']; ?></td>
                                                <td><?php echo $arr['nombre']; ?></td>
                                                <td><?php echo $registro['no_cuenta']; ?></td>
                            
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


                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © <?php echo date("Y"); ?> Tecno Inversiones RB
            </footer>
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
</body>

</html>
