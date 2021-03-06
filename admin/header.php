<?php session_start ();

require_once "config/int.php";
include "config/config.php";
 
 $email=$_SESSION['username'];
 
 
 
  if(empty($_SESSION['username'])){ 
     header('Location: login.php');
 }else{


date_default_timezone_set('America/Santo_Domingo'); 

get_admin_info($email); 

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
    <link rel="icon" type="image/png" href="images/logo.png">
    <title>Tecno Inversiones RB</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/lib/sweetalert/sweetalert.css" rel="stylesheet">
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
        <!-- header header  -->
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- Logo -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <!-- Logo icon -->
                        <b><img src="images/logo.png" alt="homepage" width="50" class="dark-logo" /></b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>Admin Panel</span>
                    </a>
                </div>
                <!-- End Logo -->
                <div class="navbar-collapse">
                    <!-- toggle and nav items -->
                    <ul class="navbar-nav mr-auto mt-md-0">
          
                    </ul>
                    <!-- User profile and search -->
                    <ul class="navbar-nav my-lg-0">

                        <!-- End Comment -->
                      
                        <!-- Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-shield"></i> <?php echo $name; ?> <!--<img src="" alt="user" class="profile-pic" />--></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="admin"><i class="ti-user"></i> Perfil</a></li>
                                    <li><a href="logout"><i class="fa fa-power-off"></i> Salir</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- End header header -->
        <!-- Left Sidebar  -->
        <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-label">Inicio</li>
                        <li> <a href="index" aria-expanded="false"><i class="fa fa-tachometer"></i>Dashboard</a> </li>
                        <li class="nav-label">Equipo</li>
                     <li> <a href="validador" aria-expanded="false"><i class="fa fa-user-circle"></i>Validadores</a> </li>
					 <li> <a href="operador" aria-expanded="false"><i class="fa fa-id-card-o"></i>Operadores</a> </li>
					 <li> <a href="admin" aria-expanded="false"><i class="fa fa-shield"></i>Administradores</a> </li>
                       
                        <li class="nav-label">Clientes</li>
                       
					 <li> <a href="clientes" aria-expanded="false"><i class="fa fa-users"></i>Clientes</a> </li>
					 <li> <a href="trans_clientes" aria-expanded="false"><i class="fa fa-exchange"></i>Transacciones</a> </li>
                     <li> <a href="verificaciones" aria-expanded="false"><i class="fa fa-check-circle"></i>Verificaciones</a> </li>
                        <li class="nav-label">Estatisticas</li>
                  
				  
					 <li> <a href="estadisticas" aria-expanded="false"><i class="fa fa-bar-chart"></i>Estadisticas</a> </li>
					
                <li> <a href="registros" aria-expanded="false"><i class="fa fa-archive"></i>Registros</a> </li>
				  
				  
                <li class="nav-label">Notificaciones</li>

               <li> <a href="notificacion" aria-expanded="false"><i class="fa fa-bell"></i>Notificaciones</a> </li>


                        <li class="nav-label">Configuracion</li>

                        
						<li> <a href="configuracion" aria-expanded="false"><i class="fa fa-cogs"></i>Configuraciones</a> </li>
                        <li> <a href="monedas" aria-expanded="false"><i class="fa fa-money"></i>Monedas</a> </li>
                        <li> <a href="billeteras" aria-expanded="false"><i class="fa fa-google-wallet"></i>Billeteras</a> </li>
					 <li> <a href="paises" aria-expanded="false"><i class="fa fa-globe"></i>Paises</a> </li>
                     <li> <a href="bancos" aria-expanded="false"><i class="fa fa-bank"></i>Bancos</a> </li>
                     <li> <a href="logout" aria-expanded="false"><i class="fa fa-power-off"></i>Salir</a> </li>
					 
                        
                      
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>