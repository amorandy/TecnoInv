<?php
include "users/config/int.php";
include "users/config/config.php";
get_config_data();

			    $sql = "SELECT * FROM tasa_principal";
			    $rs = $db_connect -> query($sql);
				$arr = mysqli_fetch_array($rs);
				$co = $arr['co'];
				$do = $arr['do'];
				$pe = $arr['pe'];
				$cl = $arr['cl'];
?>
<!DOCTYPE html>
<html lang="es">
    
<!-- coderthemes.com -->
<head>
        <meta charset="utf-8">

        <link rel="shortcut icon" href="images/favicon.ico">

          <title>Tecnoinversiones, Casa de Cambio, Envia dinero a tus familiares en Venezuela</title>
     <meta name="robots" content="INDEX, FOLLOW"/>
    <meta name="description" content="Envia dinero a tus familiares en Venezuela desde cualquier lugar del mundo, " />
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="img/logo.png"/>
    <!-- Favicon -->
   <meta property="og:url" content="https://tecnoinversionesrb.com"/>

    <!-- Facebook -->
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Casa de Cambio, Envia dinero a tus familiares en venezuela en solo instantes"/>
    <meta property="og:description" content="Envia dinero a tus familiares en Venezuela desde cualquier lugar del mundo, " />
    <meta property="og:image" content="https://tecnoinversionesrb.com/assets/logoviejo.png" />
    <meta property="og:locale" content="es_ES" />

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image"> 
    <meta name="twitter:site" content="@@tecnoinversione"> 
    <meta name="twitter:creator" content="@@tecnoinversione"> 
    <meta name="twitter:title" content="Casa de Cambio, Envia dinero a tus familiares en venezuela en solo instantes"> 
    <meta name="twitter:description" content="Envia dinero a tus familiares en Venezuela desde cualquier lugar del mundo, "> 
    <meta name="twitter:image" content="https://tecnoinversionesrb.com/assets/logoviejo.png"/>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/icons.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">
		
		    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">


    </head>


    <body>


        <nav class="navbar navbar-expand-lg fixed-top navbar-custom navbar-default navbar-light navbar-custom-dark bg-trans sticky">
            <div class="container">
                <!-- LOGO -->
                <a class="navbar-brand logo" href="index.html">
                    <img src="images/logob.png" class="logo logo-white" alt="logo">
                    <img src="images/logo.png" class="logo logo-dark" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
    
    
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="nav navbar-nav ml-auto navbar-center" id="mySidenav">
                        <li class="nav-item">
                            <a href="#home" class="nav-link scroll">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a href="#clients" class="nav-link scroll">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a href="users/login" class="nav-link scroll">LOGIN</a>
                        </li>
                       
                    </ul>
                </div>
            </div>
        </nav>


        <section class="section-lg home-alt bg-img" id="home">
            <div class="bg-overlay-gradient bg-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="home-wrapper text-center">
                            
                            <h1>Envía dinero a tus familiares en 
Venezuela en solo instantes</h1>

                            <a href="users/registro" class="btn btn-custom">Enviar Dinero</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section>

            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="facts-box text-center">
                            <div class="row">
                                <div class="col-sm-3 col-6">
                                    <h2><img src="img/colombia.png"></h2>
                                    <p class="text-muted">Tasa: <?php echo number_format($co, 2); ?></p>
                                </div>

                                <div class="col-sm-3 col-6">
                                    <h2><img src="img/dominican-republic.png"></h2>
                                    <p class="text-muted">Tasa: <?php echo number_format($do, 2); ?></p>
                                </div>

                                <div class="col-sm-3 col-6">
                                    <h2><img src="img/peru.png"></h2>
                                    <p class="text-muted">Tasa: <?php echo number_format($pe, 2); ?></p>
                                </div>

                                <div class="col-sm-3 col-6">
                                    <h2><img src="img/chile.png"></h2>
                                    <p class="text-muted">Tasa: <?php echo number_format($cl, 2); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <div class="clearfix"></div>



        <section class="section" id="features">
            <div class="container">
                <div class="row">

                    <div class="col-sm-4">
                        <div class="features-box text-center">
                            <div class="feature-icon">
                                <i class="pe-7s-lock"></i>
                            </div>
                            <h3>Seguridad</h3>

                            <p class="text-muted">Proporcionamos a nuestros clientes la tranquilidad de saber que todos sus datos y transacciones se manejan completamente en confidencialidad.</p>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="features-box text-center">
                            <div class="feature-icon">
                                <i class="pe-7s-science"></i>
                            </div>
                            <h3>Tecnología</h3>

                            <p class="text-muted">Disponemos una sencilla pero solida plataforma tecnológica, que le permite a través de su smatphone, tablet o pc, realizar todas sus transacciones.</p>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="features-box text-center">
                            <div class="feature-icon">
                                <i class="pe-7s-safe"></i>
                            </div>
                            <h3>Confianza y Respaldo</h3>

                            <p class="text-muted">Nuestros sistema de trabajo le permite tener plena certeza de la recepción y entrega de sus operaciones y usted puede monitorear sus movimientos en tiempo real.</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>


        <section class="section bg-white" id="pricing">
            <div class="container">

                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h2 class="title">Valores y Principios</h2>
                        <p class="title-alt">Somos una organización que ofrece servicios de operaciones cambiarías, estamos comprometidos con el mejoramiento continuo de la calidad en los procesos, conjuntamente con la innovación tecnológica, esfuerzo y profesionalismo. Satisfaciendo así las necesidades de nuestros clientes.</p>
              <h3 class="breakout-head"> Tasa del día: <b>BSF <?php echo number_format(taza, 2); ?> x USD</b></h3>
					
					</div>
                </div>
            </div>
        </section>


        <section class="section" id="clients">
            <div class="container">
                <div class="row text-center">
                    <div class="col-sm-12">
                        <h2 class="title">Tienes alguna pregunta? Contactanos!</h2>
                    
					
					<h3><a href="https://wa.me/18299757640?text=Hola TecnoInversiones, estoy intenresad@ en sus servicios"><i class="fab fa-whatsapp"></i> 1-829-975-7640</h3>
						
						<p><img class="img-fluid" style="width: 250px;" src="img/wsp.png"></p></a>
						
						
							<h4><i class="far fa-envelope"></i> remesas@tecnoinversionesrb.com </h4>
							
							 <span class="fab fa-facebook-square fa-2x"></span>  <span class="fab fa-twitter fa-2x icon"></span> <span class="fab fa-instagram fa-2x icon"></span>
                    </div> <!-- end Col -->
                </div>
            </div>
        </section>
    


      

        <footer class="footer bg-dark">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <p class="copyright">Copyright © 2018 Tecnoinversiones. Desarrollado por <a href="https://www.facebook.com/shamuel22" target="_blank"><font color="#fff"></font></a></p>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </footer>



        <!-- js placed at the end of the document so the pages load faster -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/scrollspy.min.js"></script>

        <!-- Jquery easing -->                                                      
        <script type="text/javascript" src="js/jquery.easing.min.js"></script>

        <!--common script for all pages-->
        <script src="js/jquery.app.js"></script>

        <script type="text/javascript">
            //sticky header on scroll
            $(window).scroll(function() {
                var scroll = $(window).scrollTop();

                if (scroll >= 50) {
                    $(".sticky").addClass("is-sticky");
                } else {
                    $(".sticky").removeClass("is-sticky");
                }
            });
        </script>


    </body>

<!-- coderthemes.com -->
</html>