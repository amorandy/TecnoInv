<?php include "header.php"; ?>
<?php
$error = '';
$good = '';


if(isset($_POST['grupo'])){
    
    if($_POST['grupo'] == 1){

        sendMassPush($_POST['mensaje']);
    }

    if($_POST['grupo'] == 2){

        sendMassMessage($_POST['titulo'],$_POST['mensaje']);
    }

    if($_POST['grupo'] == 3){

        sendMassPush($_POST['mensaje']);
        sendMassMessage($_POST['titulo'],$_POST['mensaje']);
    }


}

?>
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-primary">Dashboard</h4> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">


		  			<?php
if ($error != '') {
?>
<div class="alert alert-danger alert-dismissable">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                                            <?php echo $error; ?>
	                                        </div>
<?php } ?>

			<?php
if ($good != '') {
?>
<div class="alert alert-success alert-dismissable">
	                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                                            <?php echo $good; ?>
	                                        </div>
<?php } ?>


                <!-- Start Page Content -->
                <div class="row">
                                   
                <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title">
                                <h4>Enviar Notificacion</h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="POST">
                                        
                                    <div class="form-group">
                                                  
                                                  <select name="grupo" class="form-control input-default" requiered>
                                                          <option value="">Grupo de usuarios</option>
                                                          <option value="1">Push</option>
                                                          <option value="2">Email</option>
                                                          <option value="3">Todos</option>
                                                      </select>
                                              </div>

                                        <div class="form-group">
                                       
                                         <input type="text" name="titulo" class="form-control input-default" rows="10"  placeholder="Titulo" requiered>
                                           
                                        </div>


                                        <div class="form-group">
                                        <!--<label><code>Usa $name para incluir el nombre del usuario en el mensaje$</code></label> -->
                                         <textarea class="form-control input-default" name="mensaje" rows="10" style="margin-top: 0px; margin-bottom: 0px; height: 120px;" placeholder="Mensaje" requiered></textarea>
                                           
                                        </div>
                                       
                                       
                                        <button type="submit" class="btn btn-success m-b-10 m-l-5">Enviar <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

					
                </div>



               


                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
            <footer class="footer"> © <?php echo date("Y"); ?> All rights reserved.</footer>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>

    

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

    <script src="js/lib/morris-chart/raphael-min.js"></script>
    <script src="js/lib/morris-chart/morris.js"></script>
    <script src="js/lib/morris-chart/morris-init.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>



</body>

</html>