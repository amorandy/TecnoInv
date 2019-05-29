<?php include "header.php"; ?>
<?php
$error = '';
$good = '';


$id = $_GET['id'];

require "config/config.php";

if(isset($_POST['name'])){

    if($_POST['name']==NULL|$_POST['email']==NULL|$_POST['password']==NULL|$_POST['status']==NULL|$_POST['billetera']==NULL) { 

        $error = 'Todos los campos son requeridos';
        
        }else{ 

            $billetera_id = $_POST['billetera'];

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $status = $_POST['status'];


             $sql = ("UPDATE operadores SET name='$name',email='$email',password='".password_hash($password, PASSWORD_DEFAULT)."',status='$status',billetera_id='$billetera_id' WHERE id = '$id'");
             $csql = $db_connect -> query($sql);
             
/*
        foreach($moneda_id as $index => $value){

           $sql12 = ("UPDATE wallet SET monto='".$monto[$index]."' WHERE operador_id = '$id' AND divisa_id = '".$moneda_id[$index]."'");
           $csql = $db_connect -> query($sql12);
 

            }

            */

            $good = "Operador agregado con exito";


}
}
$sql = "SELECT * FROM operadores WHERE id = '$id'";
$rs = $db_connect -> query($sql);
$arr=mysqli_fetch_array($rs);
$name = $arr['name'];
$emal = $arr['email'];
?>

        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-primary">Dashboard <small style="color: #a6b7bf;">Estadisticas ultima semana</small></h4> </div>
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
                                <h4>Actualizar Operador</h4>

                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="POST">
                                        <div class="form-group">
                                            <input name="name" type="text" class="form-control input-default " placeholder="Nombre" value="<?php echo $name; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="text" class="form-control input-default " placeholder="Contraseña">
                                        </div>
                                        <div class="form-group">
                                            <input name="email" type="text" class="form-control input-default " placeholder="Email" value="<?php echo $emal; ?>">
                                        </div>
                                        <div class="form-group">
                                                  
                                                    <select name="status" class="form-control input-default">
															<option value="">Estatus...</option>
															<option value="1">Activo</option>
															<option value="2">Inactivo</option>
														</select>
                                                </div>

                                                  <div class="form-group">
                                                  
                                                  <select name="billetera" class="form-control input-default">
                                                          <option value="">Billetera...</option>
<?php  
include "config/config.php";                                      
$tabla23 = ("SELECT * FROM billetera ORDER BY id DESC"); 
$rs23 = $db_connect -> query($tabla23);

while ($registro = mysqli_fetch_array($rs23)) {  
?>
                                                          <option value="<?php echo $registro['id']; ?>"><?php echo $registro['name']; ?></option>
<?php } ?>
                                                      </select>
                                              </div>
                                              <input  type="submit" class="btn btn-info m-b-10 m-l-5" value="Actualizar">
                                    </form>
                                      
                              
                                </div>
                            </div>
                        </div>
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